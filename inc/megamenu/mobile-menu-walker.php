<?php
/**
 * mobileMenuWalker
 *
 * Builds a sliding‑panel mobile drawer.
 * – depth-0 items go into the main <ul> (inside .mobile-panel--main)
 * – depth-1 and depth-2 sub-menus are turned into sibling .mobile-panel divs
 *
 * Usage in template:
 *   $walker = new mobileMenuWalker();
 *   wp_nav_menu([ ..., 'walker' => $walker ]);
 *   $walker->render_panels();
 */
class mobileMenuWalker extends Walker_Nav_Menu {

	/** @var array  All collected sub-panels [{id, title, depth, items_html}] */
	protected array $panels = [];

	/** @var int[]  Stack of indices into $panels — tracks the currently open panel */
	protected array $panel_stack = [];

	/** @var string  Panel id to create when the next start_lvl fires */
	protected string $next_panel_id = '';

	/** @var string  Panel title to use when the next start_lvl fires */
	protected string $current_panel_title = '';

	/** @var bool  True when start_el already closed the <li> (has-submenu + depth > 0) */
	protected bool $self_closed_li = false;

	/** @var int  Sequential counter used to generate unique panel IDs reliably */
	protected int $panel_counter = 0;

	// -------------------------------------------------------------------------
	// Helpers
	// -------------------------------------------------------------------------

	/** Index of the panel currently being written into, or false if none. */
	protected function current_panel_idx(): int|false {
		$c = count( $this->panel_stack );
		return $c > 0 ? $this->panel_stack[ $c - 1 ] : false;
	}

	/** Append HTML to the currently open sub-panel buffer. */
	protected function write_to_panel( string $html ): void {
		$idx = $this->current_panel_idx();
		if ( $idx !== false ) {
			$this->panels[ $idx ]['items_html'] .= $html;
		}
	}

	/** Render a single collected panel as HTML. */
	protected function render_panel( array $panel ): string {
		$depth_label = 'depth-' . $panel['depth'];

		$icon_back = '<svg xmlns="http://www.w3.org/2000/svg" width="10" height="9" viewBox="0 0 10 9" fill="none"><path d="M4.08258 0.5L0.541748 4.04083L4.08258 7.58167" stroke="#3C3C3C" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/><path d="M9.5 4.04077H0.5" stroke="#3C3C3C" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg>';

		$html  = sprintf(
			'<div class="mobile-panel mobile-panel--%s" data-panel="%s" role="region" aria-label="%s submenu">',
			esc_attr( $depth_label ),
			esc_attr( $panel['id'] ),
			esc_attr( $panel['title'] )
		);
		$html .= '<div class="panel-header">';
		$html .= '<span class="panel-title">' . esc_html( $panel['title'] ) . '</span>';
		$html .= '<button type="button" class="panel-back-btn" data-panel-back aria-label="' . esc_attr__( 'Go back' ) . '">' . $icon_back . '</button>';
		$html .= '</div>';
		$html .= '<ul class="mobile-menu-nav panel-nav">';
		$html .= $panel['items_html'];
		$html .= '</ul>';
		$html .= '</div>';

		return $html;
	}

	// -------------------------------------------------------------------------
	// Walker overrides
	// -------------------------------------------------------------------------

	/**
	 * Override display_element() to reliably detect children and stamp the info
	 * directly onto the item object.
	 *
	 * This sidesteps the fragile $args->has_children mechanism which can silently
	 * fail depending on how wp_nav_menu() passes arguments in different WP builds.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ): void {
		$id           = $element->{ $this->db_fields['id'] };
		$has_children = ! empty( $children_elements[ $id ] );

		// Stamp directly on the item — start_el reads these instead of $args.
		$element->_walker_has_children = $has_children;

		if ( $has_children ) {
			// Assign a unique, sequential panel ID now, before start_el fires.
			$element->_walker_panel_id = 'panel-' . ( ++$this->panel_counter );
		} else {
			$element->_walker_panel_id = '';
		}

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	/**
	 * start_lvl fires when a menu item has children.
	 * $depth is the parent item's depth (0 → depth-1 panel; 1 → depth-2 panel).
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ): void {
		$panel = [
			'id'         => $this->next_panel_id,
			'title'      => $this->current_panel_title,
			'depth'      => $depth + 1,
			'items_html' => '',
		];
		$idx                   = count( $this->panels );
		$this->panels[]        = $panel;
		$this->panel_stack[]   = $idx;
	}

	/** end_lvl: close the current sub-panel by popping the stack. */
	public function end_lvl( &$output, $depth = 0, $args = null ): void {
		array_pop( $this->panel_stack );
	}

	/** start_el: build a <li> — redirected to the right buffer based on depth. */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ): void {
		// ── Read children state from the item itself (set in display_element) ──
		$has_children         = ! empty( $item->_walker_has_children );
		$this->self_closed_li = false;

		if ( $has_children ) {
			// Use the pre-computed panel ID stamped in display_element.
			$this->next_panel_id       = $item->_walker_panel_id;
			$this->current_panel_title = $item->title;
		}

		// Build <li> classes.
		// Start with WP's own classes (includes type/object classes, active states,
		// and any custom classes the admin added in Appearance -> Menus).
		$classes = (array) $item->classes;

		// Append our own utility classes.
		$classes[] = 'nav-item';
		if ( $has_children ) { $classes[] = 'has-submenu'; }
		if ( in_array( 'current-menu-item',     $classes, true ) ) { $classes[] = 'current'; }
		if ( in_array( 'current-menu-ancestor', $classes, true ) ) { $classes[] = 'current-ancestor'; }

		// Let WordPress (and other plugins) filter the class list, then dedupe + clean.
		$classes = apply_filters( 'nav_menu_css_class', array_unique( array_filter( $classes ) ), $item, $args, $depth );

		// Anchor attributes — submenu trigger attrs are added directly to <a> when the item has children.
		$atts = [
			'href'   => esc_url( $item->url ),
			'class'  => $has_children ? 'nav-link submenu-toggle' : 'nav-link',
			'target' => ! empty( $item->target ) ? esc_attr( $item->target ) : '',
			'title'  => ! empty( $item->attr_title ) ? esc_attr( $item->attr_title ) : '',
			'rel'    => ! empty( $item->xfn ) ? esc_attr( $item->xfn ) : '',
		];

		if ( $has_children ) {
			$atts['data-open-panel'] = $item->_walker_panel_id;
			$atts['aria-label']      = sprintf( 'Open %s submenu', $item->title );
		}

		$atts        = array_filter( $atts );
		$attr_string = '';
		foreach ( $atts as $key => $val ) {
			$attr_string .= " {$key}=\"{$val}\"";
		}

		$icon_chevron = '<svg xmlns="http://www.w3.org/2000/svg" width="10" height="17" viewBox="0 0 10 17" fill="none"><path d="M0.75 0.75L8.75 8.25L0.75 15.75" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';

		$html  = '<li class="' . implode( ' ', $classes ) . '">';
		// Chevron SVG is included inside the <a> for items with children.
		$html .= '<a' . $attr_string . '>'
		       . apply_filters( 'the_title', $item->title, $item->ID )
		       . ( $has_children ? $icon_chevron : '' )
		       . '</a>';

		if ( $has_children && $depth > 0 ) {
			// Self-close the <li> before start_lvl opens a new panel buffer.
			$html                .= '</li>';
			$this->self_closed_li = true;
		}

		if ( $depth === 0 ) {
			$output .= $html;
		} else {
			$this->write_to_panel( $html );
		}
	}

	/** end_el: close </li> — skipped when start_el already self-closed it. */
	public function end_el( &$output, $item, $depth = 0, $args = null ): void {
		if ( $this->self_closed_li ) {
			$this->self_closed_li = false;
			return;
		}
		if ( $depth === 0 ) {
			$output .= '</li>';
		} else {
			$this->write_to_panel( '</li>' );
		}
	}

	/**
	 * Override walk() to reset state before each render.
	 * Panels are NOT appended to the <ul> output here — call render_panels() separately.
	 */
	public function walk( $elements, $max_depth, ...$args ): string {
		$this->panels        = [];
		$this->panel_stack   = [];
		$this->panel_counter = 0;
		return parent::walk( $elements, $max_depth, ...$args );
	}

	// -------------------------------------------------------------------------
	// Public API
	// -------------------------------------------------------------------------

	/**
	 * Echo all collected sub-panels.
	 * Call this immediately after wp_nav_menu(), outside the main panel <div>.
	 */
	public function render_panels(): void {
		foreach ( $this->panels as $panel ) {
			echo $this->render_panel( $panel ); // phpcs:ignore WordPress.Security.EscapeOutput
		}
	}
}