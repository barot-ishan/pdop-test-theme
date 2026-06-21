<?php

/**
 * Template part: Homepage – Current Projects
 *
 * Displays a grid of project cards that link to the most popular services.
 * Each card has an icon, title, and arrow button.
 * Fields are powered by ACF repeater "current_projects".
 *
 * @package PDOP
 */

if (!defined('ABSPATH')) {
    exit;
}

$heading = get_sub_field('project_heading');
$subtitle = get_sub_field('project_subtitle');
$link = get_sub_field('project_page_link');

?>

<section class="pdop_current_projects pdop_container" aria-labelledby="pdop-current-projects-heading">
    <div class="pdop_current_projects_inner">
        <div class="pdop_current_projects_header">
            <h2 class="pdop_current_projects_heading" id="pdop-current-projects-heading"><?php echo esc_html($heading); ?></h2>
            <div class="pdop_current_projects_subtitle"><?php echo wp_kses_post($subtitle); ?></div>
            <?php if (!empty($link)) { ?>
                <a href="<?php echo esc_url($link['url']); ?>" class="pdop_current_projects_link pdop_btn">
                    <span aria-hidden="true"><?php echo esc_html($link['title']); ?></span>
                    <span class="visually-hidden">View all current projects</span>
                </a>
            <?php } ?>
        </div>

        <?php

        $project_args = [
            'post_type'      => 'project',
            'post_status'    => 'publish',
            'posts_per_page' => 3,
        ];

        $project_query = new WP_Query($project_args);

        if ($project_query->have_posts()) {

        ?>
            <div class="pdop_current_projects_grid swiper pdop_current_projects_swiper">
                <div class="swiper-wrapper">
                    <?php
                    $index = 1;
                    while ($project_query->have_posts()) {
                        $project_query->the_post();

                        $title = get_the_title();
                        $start_date = get_field('start_date');
                        $completion_date   = get_field('completion_date') ? 'Anticipated Date: ' . get_field('completion_date') : 'Anticipated Date: TBD';
                        $project_includes   = get_field('project_includes');
                        $link = get_permalink();

                    ?>
                        <div class="swiper-slide">
                            <article class="pdop_current_projects_card">
                                <div class="pdop_current_projects_card_content">
                                    <img src="/wp-content/uploads/2026/03/project_svg.svg" alt="Construction building and equipment Icon" aria-hidden="true">
                                    <div class="pdop_current_projects_card_startdate" aria-label="Project start date: August 2025"><?php echo esc_html($start_date); ?></div>
                                    <h3 class="pdop_current_projects_card_title" id="pdop_current_project_title_<?php echo $index; ?>"><?php echo esc_html($title); ?></h3>
                                    <?php if (!empty($project_includes)) { ?>
                                        <div class="pdop_current_projects_card_description unset_li li_disc">
                                            <p class="pdop_current_projects_card_description_title">Project includes:</p>
                                            <?php echo wp_kses_post($project_includes); ?>
                                        </div>
                                    <?php } ?>
                                    <div class="pdop_current_projects_card_enddate" aria-label="Anticipated project completion: June 2026"><?php echo esc_html($completion_date); ?></div>
                                    <a href="<?php echo esc_url($link); ?>" class="pdop_current_projects_card_link" title="See Updates" aria-labelledby="pdop_current_project_title_<?php echo $index; ?>"><span aria-hidden="true">See Updates</span>
                                        <span class="visually-hidden">See updates for <?php echo esc_attr($title); ?></span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true">
                                            <mask id="mask0_40001676_8307" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="18" height="18">
                                                <rect width="18" height="18" transform="matrix(-1 0 0 1 18 0)" fill="#D9D9D9" />
                                            </mask>
                                            <g mask="url(#mask0_40001676_8307)">
                                                <path d="M11.112 9.00019L5.46244 14.6498C5.31344 14.7988 5.24081 14.9742 5.24456 15.1761C5.24844 15.3781 5.32487 15.5536 5.47387 15.7026C5.623 15.8516 5.7985 15.9261 6.00037 15.9261C6.20225 15.9261 6.37775 15.8516 6.52687 15.7026L12.2801 9.96076C12.4157 9.82513 12.5162 9.67319 12.5816 9.50494C12.647 9.33669 12.6797 9.16844 12.6797 9.00019C12.6797 8.83194 12.647 8.66369 12.5816 8.49544C12.5162 8.32719 12.4157 8.17526 12.2801 8.03963L6.52687 2.28619C6.37775 2.13719 6.20031 2.06463 5.99456 2.06851C5.78881 2.07238 5.61144 2.14882 5.46244 2.29782C5.31344 2.44682 5.23894 2.62232 5.23894 2.82432C5.23894 3.02619 5.31344 3.20163 5.46244 3.35063L11.112 9.00019Z" fill="#2B3C73" />
                                            </g>
                                        </svg></a>
                                </div>
                            </article>
                        </div>
                    <?php
                        $index++;
                    }
                    ?>
                </div>
                <div class="pdop_current_projects_navigation d-flex d-lg-none justify-content-center gap-4 align-items-center">
                    <button class="pdop_upcoming_events_prev" aria-label="Previous">
                        <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M19.5 1.5C29.4411 1.5 37.5 9.55887 37.5 19.5C37.5 29.4411 29.4411 37.5 19.5 37.5C9.55887 37.5 1.5 29.4411 1.5 19.5C1.5 9.55887 9.55887 1.5 19.5 1.5Z" stroke="white" stroke-width="2" />
                            <path d="M19.5 38C29.7173 38 38 29.7173 38 19.5C38 9.28273 29.7173 1 19.5 1C9.28273 1 1 9.28273 1 19.5C1 29.7173 9.28273 38 19.5 38Z" stroke="white" stroke-width="2" />
                            <path d="M22.9529 12.6875L16.0459 19.5025L22.9529 26.3145" stroke="white" stroke-width="2" stroke-miterlimit="10" />
                        </svg>
                    </button>
                    <button class="pdop_upcoming_events_next" aria-label="Next">
                        <svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39" fill="none" aria-hidden="true">
                            <path d="M19.5 1.5C29.4411 1.5 37.5 9.55887 37.5 19.5C37.5 29.4411 29.4411 37.5 19.5 37.5C9.55887 37.5 1.5 29.4411 1.5 19.5C1.5 9.55887 9.55887 1.5 19.5 1.5Z" stroke="white" stroke-width="2" />
                            <path d="M19.5 38C29.7173 38 38 29.7173 38 19.5C38 9.28273 29.7173 1 19.5 1C9.28273 1 1 9.28273 1 19.5C1 29.7173 9.28273 38 19.5 38Z" stroke="white" stroke-width="2" />
                            <path d="M16.0459 12.6875L22.9529 19.5025L16.0459 26.3145" stroke="white" stroke-width="2" stroke-miterlimit="10" />
                        </svg>
                    </button>
                </div>
            </div>
        <?php
            wp_reset_postdata();
        }
        ?>

    </div>
</section>