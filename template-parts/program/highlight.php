<?php
if (!defined('ABSPATH')) {
    exit;
}

$heading = get_sub_field('heading');
$icon = get_sub_field('icon');
?>
<div class="pdop_program_detail_data_section">
    <div class="program_highlight_section">
        <?php
        if (!empty($heading)) {
        ?>
            <h6><?php echo $heading; ?></h6>
        <?php
        }

        if (have_rows('highlights')) {
        ?>
            <div class="program_highlight_list d-flex">
                <?php
                $i = 1;
                while (have_rows('highlights')) {
                    the_row();
                    $title = get_sub_field('title');
                    $description = get_sub_field('description');

                ?>
                    <div class="program_highlight_list_item">
                        <span class="d-flex flex-shrink-0 <?php echo $icon == 'numbered' ? 'numbered_icon' : '' ?> " aria-hidden="true" data-number="<?php echo $i; ?>">
                            <?php

                            if ($icon == 'numbered') {
                            ?>
                                <img src="/wp-content/uploads/2026/04/round_svg.svg" alt="">
                            <?php
                            }

                            if ($icon == 'default') {
                            ?>
                                <img src="/wp-content/uploads/2026/04/tick_svg.svg" alt="">
                            <?php
                            }

                            ?>

                        </span>
                        <div>
                            <?php
                            if (!empty($title)) {
                            ?>
                                <h6><?php echo $title; ?></h6>
                            <?php
                            }
                            if (!empty($description)) {
                            ?>
                                <?php echo $description; ?>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php
                    $i++;
                }
                ?>
            </div>
        <?php
        }

        ?>
    </div>
</div>