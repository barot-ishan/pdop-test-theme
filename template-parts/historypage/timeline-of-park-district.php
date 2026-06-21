<?php
/**
 * Template part: Timeline of Park District
 */

if (!defined('ABSPATH')) {
    exit;
}

$main_heading = get_sub_field('main_heading');
?>

<section class="timeline-history pdop_container" aria-label="Company timeline">

    <div class="timeline-section">

        <?php if ($main_heading): ?>
            <h2 class="pdop_services_heading_white text-center">
                <?= wp_kses_post($main_heading); ?>
            </h2>
        <?php endif; ?>

        <?php
        if (have_rows('timeline_data')):

            $tabs  = [];
            $index = 0;

            while (have_rows('timeline_data')):
                the_row();

                $year = get_sub_field('year');
                $desc = get_sub_field('description');

                $id = 'pdt-t' . preg_replace(
                    '/[^a-z0-9]/i',
                    '-',
                    sanitize_text_field($year)
                );

                $tabs[] = [
                    'id'       => $id,
                    'year'     => $year,
                    'desc'     => $desc,
                    'is_first' => $index === 0,
                ];

                $index++;

            endwhile;

            $total = count($tabs);
        ?>

            <div
                class="pdt-root"
                id="pdt-root"
                data-pdt-total="<?php echo esc_attr($total); ?>"
            >

                <!-- DESKTOP LAYOUT -->
                <div class="pdt-layout">

                    <!-- SIDEBAR -->
                    <div
                        class="pdt-sidebar"
                        id="pdt-sidebar"
                        role="tablist"
                        aria-label="<?php esc_attr_e('Timeline years', 'textdomain'); ?>"
                        aria-orientation="vertical"
                    >

                        <?php foreach ($tabs as $i => $tab): ?>

                            <div class="pdt-tab-row">

                                <div
                                    class="pdt-connector"
                                    aria-hidden="true"
                                ></div>

                                <button
                                    class="pdt-tab-btn<?php echo $tab['is_first'] ? ' pdt-active' : ''; ?>"
                                    id="pdt-btn-<?php echo esc_attr($tab['id']); ?>"
                                    role="tab"
                                    aria-selected="<?php echo $tab['is_first'] ? 'true' : 'false'; ?>"
                                    aria-controls="<?php echo esc_attr($tab['id']); ?>"
                                    tabindex="<?php echo $tab['is_first'] ? '0' : '-1'; ?>"
                                    data-pdt-tab="<?php echo esc_attr($tab['id']); ?>"
                                    data-pdt-index="<?php echo esc_attr($i); ?>"
                                    onclick="pdtSwitch('<?php echo esc_js($tab['id']); ?>', this)"
                                >

                                    <div class="pdt-tab-shape" aria-hidden="true">
                                        <?php echo esc_html($tab['year']); ?>
                                    </div>

                                    <span class="screen-reader-text">
                                        <?php echo esc_html($tab['year']); ?>
                                    </span>

                                </button>

                            </div>

                        <?php endforeach; ?>

                    </div>
                    <!-- /.pdt-sidebar -->


                    <!-- DESKTOP CONTENT -->
                    <div class="pdt-panel">

                        <?php foreach ($tabs as $i => $tab): ?>

                            <div
                                class="pdt-section<?php echo $tab['is_first'] ? ' pdt-active' : ''; ?>"
                                id="<?php echo esc_attr($tab['id']); ?>"
                                role="tabpanel"
                                aria-labelledby="pdt-btn-<?php echo esc_attr($tab['id']); ?>"
                                tabindex="0"
                                data-pdt-index="<?php echo esc_attr($i); ?>"
                                <?php if (!$tab['is_first']): ?>
                                    hidden
                                <?php endif; ?>
                            >

                                <h2 class="pdt-section-title">
                                    <?php echo esc_html($tab['year']); ?>
                                </h2>

                                <div class="pdt-section-body">

                                    <?php
                                    $desc = $tab['desc'];

                                    if (strip_tags($desc) === $desc) {

                                        $paragraphs = array_filter(
                                            array_map(
                                                'trim',
                                                explode("\n\n", $desc)
                                            )
                                        );

                                        foreach ($paragraphs as $para) {
                                            echo '<p>' . nl2br(esc_html($para)) . '</p>';
                                        }

                                    } else {

                                        echo wp_kses_post($desc);

                                    }
                                    ?>

                                </div>

                            </div>

                        <?php endforeach; ?>

                    </div>
                    <!-- /.pdt-panel -->

                </div>
                <!-- /.pdt-layout -->


                <!-- MOBILE TIMELINE -->
                <div class="pdt-mobile-swiper">


                    <!-- YEAR SWIPER -->
                    <div
                        class="pdt-mobile-year-swiper swiper"
                        role="region"
                        aria-label="Timeline Years"
                    >

                        <div class="swiper-wrapper">

                            <?php foreach ($tabs as $i => $tab): ?>

                                <div
                                    class="swiper-slide"
                                    role="group"
                                    aria-label="<?= ($i + 1) . ' of ' . $total; ?>"
                                >

                                    <div class="w-100 d-flex justify-content-center">
                                        <div
                                            class="pdt-connector"
                                            aria-hidden="true"
                                        ></div>
                                    </div>

                                    <div class="pdt-tab-shape">
                                        <?= esc_html($tab['year']); ?>
                                    </div>

                                </div>

                            <?php endforeach; ?>

                        </div>

                    </div>
                    <!-- /.pdt-mobile-year-swiper -->


                    <!-- MOBILE ARROWS -->
                    <div class="pdt-arrows">

                        <div class="pdt-prev" aria-label="Previous year">

                            <!-- PREV SVG -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39" fill="none">
                                <path d="M19.5 1.5C29.4411 1.5 37.5 9.55887 37.5 19.5C37.5 29.4411 29.4411 37.5 19.5 37.5C9.55887 37.5 1.5 29.4411 1.5 19.5C1.5 9.55887 9.55887 1.5 19.5 1.5Z" stroke="white" stroke-width="2"/>
                                <path d="M19.5 38C29.7173 38 38 29.7173 38 19.5C38 9.28273 29.7173 1 19.5 1C9.28273 1 1 9.28273 1 19.5C1 29.7173 9.28273 38 19.5 38Z" stroke="white" stroke-width="2"/>
                                <path d="M22.9529 12.6875L16.0459 19.5025L22.9529 26.3145" stroke="white" stroke-width="2" stroke-miterlimit="10"/>
                            </svg>

                        </div>


                        <div class="pdt-next" aria-label="Next year">

                            <!-- NEXT SVG -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39" fill="none">
                                <path d="M19.5 1.5C29.4411 1.5 37.5 9.55887 37.5 19.5C37.5 29.4411 29.4411 37.5 19.5 37.5C9.55887 37.5 1.5 29.4411 1.5 19.5C1.5 9.55887 9.55887 1.5 19.5 1.5Z" stroke="white" stroke-width="2"/>
                                <path d="M19.5 38C29.7173 38 38 29.7173 38 19.5C38 9.28273 29.7173 1 19.5 1C9.28273 1 1 9.28273 1 19.5C1 29.7173 9.28273 38 19.5 38Z" stroke="white" stroke-width="2"/>
                                <path d="M16.0459 12.6875L22.9529 19.5025L16.0459 26.3145" stroke="white" stroke-width="2" stroke-miterlimit="10"/>
                            </svg>

                        </div>

                    </div>
                    <!-- /.pdt-arrows -->


                    <!-- CONTENT SWIPER -->
                    <div
                        class="pdt-mobile-content-swiper swiper"
                        role="region"
                        aria-label="Timeline Content"
                    >

                        <div class="swiper-wrapper">

                            <?php foreach ($tabs as $tab): ?>

                                <div class="swiper-slide">

                                    <div class="pdt-panel">

                                        <h2 class="pdt-section-title">
                                            <?php echo esc_html($tab['year']); ?>
                                        </h2>

                                        <div class="pdt-section-body">

                                            <?php
                                            $desc = $tab['desc'];

                                            if (strip_tags($desc) === $desc) {

                                                $paragraphs = array_filter(
                                                    array_map(
                                                        'trim',
                                                        explode("\n\n", $desc)
                                                    )
                                                );

                                                foreach ($paragraphs as $para) {
                                                    echo '<p>' . nl2br(esc_html($para)) . '</p>';
                                                }

                                            } else {

                                                echo wp_kses_post($desc);

                                            }
                                            ?>

                                        </div>

                                    </div>

                                </div>

                            <?php endforeach; ?>

                        </div>

                    </div>
                    <!-- /.pdt-mobile-content-swiper -->

                </div>
                <!-- /.pdt-mobile-swiper -->

            </div>
            <!-- /.pdt-root -->

        <?php endif; ?>

    </div>

</section>