<?php

if (!defined('ABSPATH')) {
    exit;
}

$heading = get_sub_field('heading');

$instructor_data = get_sub_field('instructors_data');

$instructor_data_count = !empty($instructor_data) ? count($instructor_data) : 0;

?>

<div class="pdop_meet_instructor_main">
    <div class="pdop_meet_instructor_header d-flex gap-4 justify-content-between">
        <?php
        if (!empty($heading)) {
        ?>
            <h2 id="instructor-section-title"><?php echo $heading; ?></h2>
        <?php
        }
        ?>

        <div class="search_instructor_wrapper d-flex align-items-center position-relative">
            <label for="search_instructor" class="visually-hidden">
                Search Instructor by Name
            </label>
            <input id="search_instructor" type="text" placeholder="Search Instructor by Name" aria-label="Search Instructor by Name">
        </div>
    </div>
    <div class="pdop_meet_instructor" aria-labelledby="instructor-section-title">
        <?php
        if (have_rows('instructors_data')) {
            $i = 1;
            while (have_rows('instructors_data')) {
                the_row();

                $profile_image = get_sub_field('profile_image');
                $name = get_sub_field('name');
                $description = get_sub_field('description');


        ?>
                <article class="pdop_meet_instructor_card">
                    <div class="pdop_meet_instructor_card_img">
                        <?php

                        if (!empty($profile_image)) {
                        ?>
                            <img src="<?php $profile_image['url']; ?>">
                        <?php
                        } else {
                        ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="246" height="120" viewBox="0 0 246 120" fill="none" aria-hidden="true">
                                <rect width="246" height="120" rx="10" fill="#D9D9D9" />
                                <line x1="8.80182" y1="109.541" x2="235.802" y2="11.5409" stroke="white" />
                                <line y1="-0.5" x2="247.251" y2="-0.5" transform="matrix(-0.918096 -0.396359 -0.396359 0.918096 236 110)" stroke="white" />
                            </svg>
                        <?php
                        }

                        ?>
                    </div>

                    <div class="pdop_meet_instructor_card_content">
                        <?php
                        if (!empty($name)) {
                        ?>
                            <h6><?php echo $name; ?></h6>

                        <?php
                        }

                        if (have_rows('classes_tags')) {
                        ?>
                            <div class="pdop_meet_instructor_card_tags">
                                <span>Classes:</span>
                                <div class="pdop_meet_instructor_card_tag_items d-flex flex-wrap gap-2">
                                    <?php
                                    while (have_rows('classes_tags')) {
                                        the_row();
                                        $tag = get_sub_field('tag');
                                    ?>
                                        <span><?php echo $tag; ?></span>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php
                        }

                        if (!empty($description)) {
                        ?>
                            <div id="instructor-desc-<?php echo $i; ?>" class="pdop_meet_instructor_description">
                                <?php

                                echo $description;

                                ?>
                            </div>

                            <button class="pdop_meet_instructor_read_more" type="button"
                                aria-expanded="false"
                                aria-controls="instructor-desc-<?php echo $i; ?>">
                                <span class="button-text">Read More</span> <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true">
                                    <mask id="mask0_40003834_3533" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="18" height="18">
                                        <rect width="18" height="18" transform="matrix(-1 0 0 1 18 0)" fill="#D9D9D9" />
                                    </mask>
                                    <g mask="url(#mask0_40003834_3533)">
                                        <path d="M11.112 9.00215L5.46244 14.6517C5.31344 14.8007 5.24081 14.9761 5.24456 15.178C5.24844 15.38 5.32487 15.5555 5.47387 15.7045C5.623 15.8535 5.7985 15.928 6.00037 15.928C6.20225 15.928 6.37775 15.8535 6.52687 15.7045L12.2801 9.96271C12.4157 9.82708 12.5162 9.67515 12.5816 9.5069C12.647 9.33865 12.6797 9.1704 12.6797 9.00215C12.6797 8.8339 12.647 8.66565 12.5816 8.4974C12.5162 8.32915 12.4157 8.17721 12.2801 8.04158L6.52687 2.28815C6.37775 2.13915 6.20031 2.06658 5.99456 2.07046C5.78881 2.07433 5.61144 2.15077 5.46244 2.29977C5.31344 2.44877 5.23894 2.62427 5.23894 2.82627C5.23894 3.02815 5.31344 3.20359 5.46244 3.35258L11.112 9.00215Z" fill="#2B3C73" />
                                    </g>
                                </svg>
                            </button>

                        <?php
                        }

                        ?>

                    </div>
                </article>
        <?php
                $i++;
            }
        }
        ?>

    </div>
    <div class="text-center mt-4">
        <button type="button" class="show_all_instructors" aria-label="Show all instructors">
            <span>Show all <?php echo $instructor_data_count; ?></span>
            <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true">
                <path d="M6 8H0V6H6V0H8V6H14V8H8V14H6V8Z" fill="#2B3C73" />
            </svg>
        </button>
    </div>
</div>