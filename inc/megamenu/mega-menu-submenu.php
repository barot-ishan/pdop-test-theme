<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Opens the megamenu wrapper and starts the LEFT column (depth-1 tab nav).
 */
function pdop_render_mega_submenu_open( $item ) {
    ob_start();
    $menu_id = 'megamenu-tabs-' . $item->ID;
    $heading_id  = 'megamenu-heading-' . $item->ID;
    ?>
    <div class="megamenu-subnav" role="navigation" aria-label="<?php echo esc_attr__( 'Sub navigation', 'pdop' ); ?>">
        <div class="megamenu-tab-wrapper">
            <!-- LEFT: depth-1 tab nav -->
            <span id="<?php echo esc_attr( $heading_id ); ?>" class="megamenu-heading" aria-label="<?php echo esc_attr( $item->title ); ?> <?php esc_attr_e( 'navigation', 'pdop' ); ?>">
                <?php echo esc_html( $item->title ); ?>
            </span>

            <ul class="megamenu-tab-nav" role="tablist" id="<?php echo esc_attr( $menu_id ); ?>">
    <?php
    return ob_get_clean();
}

/**
 * Renders a single depth-1 item as a Bootstrap tab trigger.
 *
 * @param object $item     Nav item object.
 * @param int    $index    Position index (0-based) — pass from your walker.
 * @param int    $parent_id The top-level item ID owning this megamenu.
 */
function pdop_render_mega_tab_nav_item( $item, $index, $parent_id ) {
    $tab_id      = 'tab-' . $parent_id . '-' . $item->ID;
    $pane_id     = 'pane-' . $parent_id . '-' . $item->ID;
    $is_active   = ( $index === 0 ) ? 'active' : '';
    $aria_selected = ( $index === 0 ) ? 'true' : 'false';

    ob_start();
    ?>
    <li class="megamenu-tab-nav__item" role="presentation">
        <button
            class="megamenu-tab-nav__btn <?php echo esc_attr( $is_active ); ?>"
            id="<?php echo esc_attr( $tab_id ); ?>"
            data-bs-toggle="tab"
            data-bs-target="#<?php echo esc_attr( $pane_id ); ?>"
            type="button"
            role="tab"
            aria-controls="<?php echo esc_attr( $pane_id ); ?>"
            aria-selected="<?php echo esc_attr( $aria_selected ); ?>"
        >
            <?php echo esc_html( $item->title ); ?>
            <span class="megamenu-tab-nav__arrow" aria-hidden="true"></span>
        </button>
    </li>
    <?php
    return ob_get_clean();
}

/**
 * Closes the tab nav and opens the RIGHT column (depth-2 tab content).
 */
function pdop_render_mega_tab_content_open() {
    ob_start();
    ?>
            </ul><!-- /.megamenu-tab-nav -->

            <!-- RIGHT: depth-2 tab panes -->
            <div class="megamenu-tab-content tab-content">
    <?php
    return ob_get_clean();
}

/**
 * Opens a single tab pane for a depth-1 item.
 *
 * @param object $depth1_item  The depth-1 parent item.
 * @param int    $index        Position index (0-based).
 * @param int    $parent_id    The top-level item ID.
 */
function pdop_render_mega_tab_pane_open( $depth1_item, $index, $parent_id ) {
    $pane_id   = 'pane-' . $parent_id . '-' . $depth1_item->ID;
    $tab_id    = 'tab-' . $parent_id . '-' . $depth1_item->ID;
    $is_active = ( $index === 0 ) ? ' show active' : '';

    ob_start();
    ?>
                <div
                    class="megamenu-tab-pane tab-pane fade<?php echo esc_attr( $is_active ); ?>"
                    id="<?php echo esc_attr( $pane_id ); ?>"
                    role="tabpanel"
                    aria-labelledby="<?php echo esc_attr( $tab_id ); ?>"
                    tabindex="0"
                >
                    <ul class="megamenu-tab-pane__list" role="list">
    <?php
    return ob_get_clean();
}

/**
 * Renders a single depth-2 item inside its parent's tab pane.
 *
 * @param object $item  The depth-2 nav item.
 */
function pdop_render_mega_tab_pane_item( $item ) {
    ob_start();
    ?>
                        <li class="megamenu-tab-pane__item">
                            
                                href="<?php echo esc_url( $item->url ); ?>"
                                class="megamenu-tab-pane__link"
                                <?php echo ( $item->target === '_blank' ) ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
                            >
                                <?php echo esc_html( $item->title ); ?>
                            </a>
                        </li>
    <?php
    return ob_get_clean();
}

/**
 * Closes a single tab pane.
 */
function pdop_render_mega_tab_pane_close() {
    ob_start();
    ?>
                    </ul>
                </div><!-- /.megamenu-tab-pane -->
    <?php
    return ob_get_clean();
}

/**
 * Closes the tab content area and the entire megamenu wrapper.
 */
function pdop_render_mega_submenu_close( $item ) {
    ob_start();
    ?>
            </div><!-- /.megamenu-tab-content -->
        </div><!-- /.megamenu-tab-wrapper -->
    </div><!-- /.megamenu-subnav -->
    <?php
    return ob_get_clean();
}