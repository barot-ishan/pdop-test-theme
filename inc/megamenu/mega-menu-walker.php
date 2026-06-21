<?php
/**
 * Mega Menu Custom Walker
 *
 * Extends Walker_Nav_Menu to render a two-panel mega menu dropdown.
 *
 * Mega menu behavior is controlled via an ACF field (`is_mega_menu`)
 * assigned to individual menu items (Location: Menu Item).
 * When enabled on a top-level item, its submenu is rendered as a
 * structured mega menu instead of a default <ul>.
 *
 * Output structure for mega items:
 *
 *   <li class="has-mega-menu" aria-haspopup="true" aria-expanded="false">
 *     <a class="menu-link" role="button" aria-haspopup="true"
 *        aria-expanded="false" aria-controls="submenu-{ID}">Label</a>
 *
 *     <div class="megamenu-wrapper" role="region" aria-label="Mega menu">
 *       <div class="megamenu-subnav" role="navigation" aria-label="Sub navigation">
 *         <ul class="sub-menu megamenu-parent-nav" role="list">
 *           <!-- child menu items -->
 *         </ul>
 *       </div>
 *       <div class="navsidebar" aria-hidden="true">
 *         <!-- Sidebar content (via ACF / helper function) -->
 *       </div>
 *     </div>
 *   </li>
 *
 * Non-mega items render as standard Walker_Nav_Menu output.
 * Nested sub-levels (depth > 1) always render as plain <ul class="sub-menu">.
 *
 * @package    pdop
 * @subpackage Inc
 * @since      1.0.1
 *
 * Usage — functions.php:
 *   require_once get_template_directory() . '/inc/mega-menu-walker.php';
 *
 * Usage — header.php (or any template):
 *   wp_nav_menu( array(
 *       'theme_location' => 'mega-menu',
 *       'walker'         => new Mega_Menu_Walker(),
 *   ) );
 *
 * Activation:
 *   1. Create an ACF field:
 *        - Field Name: is_mega_menu
 *        - Field Type: True/False (recommended)
 *        - Location: Menu Item
 *
 *   2. In WP Admin → Appearance → Menus:
 *        - Expand a top-level menu item
 *        - Enable "Mega Menu" (ACF toggle)
 *
 *   3. The walker will automatically:
 *        - Enable mega menu layout
 *        - Add the class "has-mega-menu" to the <li>
 *
 * Sidebar Content:
 *   Use ACF fields on the same menu item and render via:
 *   `pdop_render_mega_sidebar( $item )`
 *
 * @see Walker_Nav_Menu
 */


if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Mega_Menu_Walker' ) ) :

class Mega_Menu_Walker extends Walker_Nav_Menu {

    private $is_mega        = false;
    private $current_item   = null;

    // ─── NEW PROPERTIES ──────────────────────────────────────────────────────
    private $depth1_index        = 0;   // tracks which depth-1 item we're on (for active state)
    private $current_depth1_item = null; // the depth-1 item currently being processed
    private $depth1_nav_output   = '';  // LEFT column buffer  (tab buttons)
    private $pane_output         = '';  // RIGHT column buffer (all panes combined)
    private $current_pane_buffer = '';  // buffer for the pane currently being built
    // ─────────────────────────────────────────────────────────────────────────

    public function start_lvl( &$output, $depth = 0, $args = null ) {

        if ( $depth === 0 && $this->is_mega ) {
            // ── CHANGED: removed pdop_render_mega_submenu_open() call.
            //    We open the wrapper here and initialise the buffers instead.
            $submenu_id = 'submenu-' . $this->current_item->ID;
            $output .= "\n<div class=\"megamenu\" id=\"" . esc_attr( $submenu_id ) . "\" role=\"region\" aria-label=\"" . esc_attr__( 'Mega menu', 'pdop' ) . "\">";
            $output .= "\n<div class=\"megamenu-wrapper\">";
            $output .= "\n<div class=\"megamenu-tab-wrapper\">";

            // Reset buffers for this mega item
            $this->depth1_nav_output   = '';
            $this->pane_output         = '';
            $this->depth1_index        = 0;

        } elseif ( $depth === 1 && $this->is_mega ) {
            // ── NEW: depth-1 item has children → open its tab pane into the buffer.
            $parent_id = $this->current_item->ID;
            $item_id   = $this->current_depth1_item->ID;
            $pane_id   = 'pane-' . $parent_id . '-' . $item_id;
            $tab_id    = 'tab-'  . $parent_id . '-' . $item_id;
            $active    = ( $this->depth1_index === 1 ) ? ' show active' : '';

            $this->current_pane_buffer .=
                '<div class="megamenu-tab-pane tab-pane fade' . esc_attr( $active ) . '"'
                . ' id="'               . esc_attr( $pane_id ) . '"'
                . ' role="tabpanel"'
                . ' aria-labelledby="'  . esc_attr( $tab_id )  . '"'
                . ' tabindex="0">'
                . '<ul class="megamenu-tab-pane__list" role="list">';

        } else {
            // Unchanged: plain sub-menu for non-mega or depth > 1 non-mega items
            $indent  = str_repeat( "\t", $depth );
            $output .= "\n{$indent}<ul class=\"sub-menu\" role=\"list\">\n";
        }
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {

        if ( $depth === 0 && $this->is_mega ) {
            // ── CHANGED: flush both buffers into the 50/50 layout, then close wrappers.

            // LEFT column — tab nav
            $heading_id = 'megamenu-heading-' . $this->current_item->ID;
            
            // Heading outside the tablist
            $heading_html = '<span'
                        . ' id="'         . esc_attr( $heading_id ) . '"'
                        . ' class="megamenu-heading"'
                        . ' aria-label="' . esc_attr( $this->current_item->title ) . ' ' . esc_attr__( 'navigation', 'pdop' ) . '"'
                        . '>'
                        . esc_html( $this->current_item->title )
                        . '</span>';
            
            $output .= '<div class="megamenu-navlist">';
            $output .= $heading_html;
            $output .= '<ul class="megamenu-tab-nav" role="tablist"'
                     . ' aria-labelledby="' . esc_attr( $heading_id ) . '"'
                     . ' id="megamenu-tabs-' . esc_attr( $this->current_item->ID ) . '">';
            $output .= $this->depth1_nav_output;
            $output .= '</ul>';
            $output .= '</div>';

            // RIGHT column — tab panes
            $output .= '<div class="megamenu-tab-content tab-content">';
            $output .= $this->pane_output;
            $output .= '</div><!-- /.megamenu-tab-content -->';

            $output .= "\n</div><!-- /.megamenu-tab-wrapper -->";

            // Sidebar (unchanged)
            if ( function_exists( 'pdop_render_mega_sidebar' ) ) {
                $output .= pdop_render_mega_sidebar( $this->current_item );
            }

            $output .= "\n</div><!-- /.megamenu-wrapper -->";
            $output .= "\n</div><!-- /.megamenu -->";

        } elseif ( $depth === 1 && $this->is_mega ) {
            // ── NEW: close the current pane and move it into the combined pane buffer.
            $this->current_pane_buffer .= '</ul></div><!-- /.megamenu-tab-pane -->';
            $this->pane_output         .= $this->current_pane_buffer;
            $this->current_pane_buffer  = '';

        } else {
            $indent  = str_repeat( "\t", $depth );
            $output .= "\n{$indent}</ul>\n";
        }
    }

    public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ): void {
        $id                        = $element->{ $this->db_fields['id'] };
        $element->_has_children    = ! empty( $children_elements[ $id ] );
        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {

        // ── UNCHANGED: detect mega flag on depth-0 items
        if ( $depth === 0 ) {
            $is_mega_acf    = get_field( 'is_mega_menu', $item );
            $this->is_mega  = ! empty( $is_mega_acf );
            $this->current_item = $item;
        }

        // ── NEW: depth-1 mega items → write tab nav button into LEFT buffer, skip $output.
        if ( $depth === 1 && $this->is_mega ) {
            $this->depth1_index++;
            $this->current_depth1_item = $item;
            $this->current_pane_buffer = '';

            $parent_id     = $this->current_item->ID;
            $tab_id        = 'tab-'  . $parent_id . '-' . $item->ID;
            $pane_id       = 'pane-' . $parent_id . '-' . $item->ID;
            $is_active     = ( $this->depth1_index === 1 ) ? ' active' : '';
            $aria_selected = ( $this->depth1_index === 1 ) ? 'true' : 'false';
            $tab_index     = ( $this->depth1_index === 1 ) ? '0' : '-1';

            $item_classes = empty( $item->classes ) ? [] : (array) $item->classes;
            $is_link_item = in_array( 'megamenu-link', $item_classes, true );

            $item_classes[] = 'megamenu-tab-nav__item';
            if ( ! empty( $item->_has_children ) ) {
                $item_classes[] = 'has-children';
            }
            $li_class_str = implode( ' ', array_filter( array_map( 'trim', $item_classes ) ) );

            $title = apply_filters( 'the_title', $item->title, $item->ID );
            $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

            if ( $is_link_item ) {
                // ── Render a plain <a> link — no tab association at all
                $atts = [
                    'href'  => ! empty( $item->url ) ? $item->url : '',
                    'class' => 'megamenu-tab-nav__btn megamenu-tab-nav__link',
                ];
                if ( ! empty( $item->target ) ) {
                    $atts['target'] = $item->target;
                    if ( $item->target === '_blank' ) {
                        $atts['rel'] = 'noopener noreferrer';
                    }
                }
                if ( ! empty( $item->attr_title ) ) {
                    $atts['title'] = $item->attr_title;
                }
                if ( ! empty( $item->xfn ) ) {
                    $atts['rel'] = $item->xfn;
                }
                $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

                $attributes = '';
                foreach ( $atts as $attr => $value ) {
                    if ( is_scalar( $value ) && '' !== $value ) {
                        $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                        $attributes .= " {$attr}=\"{$value}\"";
                    }
                }

                $this->depth1_nav_output .=
                    '<li class="' . esc_attr( $li_class_str ) . '" role="presentation">'
                    . '<a' . $attributes . '>' . $title . '</a>'
                    . '</li>';

            } else {
                // ── Render the normal tab <button>
                $btn_atts = [
                    'class'          => 'megamenu-tab-nav__btn' . $is_active,
                    'id'             => $tab_id,
                    'data-bs-toggle' => 'tab',
                    'data-bs-target' => '#' . $pane_id,
                    'type'           => 'button',
                    'role'           => 'tab',
                    'aria-controls'  => $pane_id,
                    'aria-selected'  => $aria_selected,
                    'tabindex'       => $tab_index,
                ];
                $btn_atts = apply_filters( 'nav_menu_link_attributes', $btn_atts, $item, $args, $depth );

                $attributes = '';
                foreach ( $btn_atts as $attr => $value ) {
                    if ( is_scalar( $value ) && '' !== $value ) {
                        $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                        $attributes .= " {$attr}=\"{$value}\"";
                    }
                }

                $this->depth1_nav_output .=
                    '<li class="' . esc_attr( $li_class_str ) . '" role="presentation">'
                    . '<button' . $attributes . '>' . $title . '</button>'
                    . '</li>';
            }

            return;
        }

        // ── NEW: depth-2 mega items → write link into the current pane buffer, skip $output.
        if ( $depth === 2 && $this->is_mega ) {
            $target = ( ! empty( $item->target ) && $item->target === '_blank' )
                      ? ' target="_blank" rel="noopener noreferrer"'
                      : '';

            $this->current_pane_buffer .=
                '<li class="megamenu-tab-pane__item">'
                . '<a class="megamenu-tab-pane__link" href="' . esc_url( $item->url ) . '"' . $target . '>'
                . esc_html( $item->title )
                . '</a>'
                . '</li>';

            return; // ← do NOT write anything to $output for depth-2 mega items
        }

        // ── UNCHANGED: everything below is the original depth-0 / non-mega rendering ──

        $indent  = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $classes = empty( $item->classes ) ? [] : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        if ( $this->is_mega && $depth === 0 ) {
            $classes[] = 'has-mega-menu';
        }

        $class_names = implode( ' ', array_filter( array_map( 'trim', $classes ) ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $item_id    = esc_attr( 'menu-item-' . $item->ID );
        $submenu_id = esc_attr( 'submenu-' . $item->ID );
        $has_children = in_array( 'menu-item-has-children', (array) $item->classes, true );

        $output .= "{$indent}<li id=\"{$item_id}\"{$class_names}";
        if ( $this->is_mega && $depth === 0 && $has_children ) {
            $output .= " aria-haspopup=\"true\" aria-expanded=\"false\"";
        }
        $output .= ">\n";

        $atts           = [];
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target ) ? $item->target : '';
        $atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
        $atts['href']   = ! empty( $item->url ) ? $item->url : '';
        $atts['class']  = 'menu-link';

        if ( $this->is_mega && $depth === 0 && $has_children ) {
            $atts['aria-haspopup'] = 'true';
            $atts['aria-expanded'] = 'false';
            $atts['aria-controls'] = $submenu_id;
            $atts['role']          = 'button';
        }

        $this->current_mega_id = $submenu_id;
        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( is_scalar( $value ) && '' !== $value ) {
                $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= " {$attr}=\"{$value}\"";
            }
        }

        $title       = apply_filters( 'the_title', $item->title, $item->ID );
        $title       = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
        $item_output  = isset( $args->before ) ? $args->before : '';
        $item_output .= "<a{$attributes}>";
        $item_output .= ( isset( $args->link_before ) ? $args->link_before : '' ) . $title . ( isset( $args->link_after ) ? $args->link_after : '' );
        $item_output .= '</a>';
        $item_output .= isset( $args->after ) ? $args->after : '';

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        // ── NEW: depth-1 and depth-2 mega items were never written to $output,
        //    so there's no </li> to close for them.
        if ( $this->is_mega && ( $depth === 1 || $depth === 2 ) ) {
            // nothing — buffered items don't go into $output
        } else {
            $output .= "</li>\n";
        }

        if ( $depth === 0 ) {
            $this->is_mega = false;
        }
    }
}

endif;