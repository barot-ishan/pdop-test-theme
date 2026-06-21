<?php
function pdop_render_mega_sidebar( $item ) {

    if ( ! function_exists('get_field') ) return '';

    $featured_image = get_field('featured_image', $item);
    $cta_section    = get_field('cta_section', $item);

    ob_start();
    ?>

    <div class="navsidebar" aria-hidden="true">

        <?php if ( ! empty( $cta_section ) ) :
            $cta_title     = isset($cta_section['cta_title']) ? $cta_section['cta_title'] : '';
            $cta_image     = isset($cta_section['cta_image']) ? $cta_section['cta_image'] : '';
            $cta_paragraph = isset($cta_section['cta_paragraph']) ? $cta_section['cta_paragraph'] : '';
            $cta_btn_text  = isset($cta_section['cta_button_text']) ? $cta_section['cta_button_text'] : '';
            $cta_btn_link  = isset($cta_section['cta_button_link']) ? $cta_section['cta_button_link'] : '';
        ?>
            <div class="ctasec">

                <?php if ( $cta_title ) : ?>
                    <h4><?php echo esc_html( $cta_title ); ?></h4>
                <?php endif; ?>

                <?php if ( ! empty( $cta_image['url'] ) ) : ?>
                    <div class="imgbox">
                        <img src="<?php echo esc_url( $cta_image['url'] ); ?>" alt="<?php echo esc_attr( $cta_image['alt'] ); ?>">
                    </div>
                <?php endif; ?>

                <div class="contentbox">

                    <?php if ( $cta_paragraph ) : ?>
                        <p><?php echo esc_html( $cta_paragraph ); ?></p>
                    <?php endif; ?>

                    <?php if ( $cta_btn_text && ! empty( $cta_btn_link ) ) : ?>
                        <div class="btnsec">
                            <a href="<?php echo esc_url( $cta_btn_link ); ?>" class="btn">
                                <?php echo esc_html( $cta_btn_text ); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                </div>

            </div>
        <?php endif; ?>

        <?php if ( ! empty( $featured_image['url'] ) ) : ?>
            <div class="featuredimg">
                <img src="<?php echo esc_url( $featured_image['url'] ); ?>" alt="<?php echo esc_attr( $featured_image['alt'] ); ?>">
            </div>
        <?php endif; ?>

    </div>

    <?php
    return ob_get_clean();
}