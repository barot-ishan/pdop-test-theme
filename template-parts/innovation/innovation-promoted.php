<?php
/**
 * Template part: Innovation Promoted
 */
$main_heading = get_sub_field('main_heading');
?>

<section class="pad-bt innovation-promot">
    <div class="pdop_container">
        <?php if ($main_heading): ?>
            <h3 class="text-center fw-bold mb-5 promot-heading"><?= wp_kses_post($main_heading); ?></h3><?php endif; ?>
        <div class="row gy-5">
            <div class="col-lg-6">
                <?php if (have_rows('statistic_details')): ?>
                    <div class="row gy-4">
                        <?php while (have_rows('statistic_details')):
                            the_row();
                            $icon = get_sub_field('icon');
                            $img_url = is_array($icon) ? $icon['url'] : $icon;
                            $img_alt = is_array($icon) ? $icon['alt'] : 'Icon';
                            $number = get_sub_field('number');
                            $title = get_sub_field('title'); ?>
                            <div class="col-sm-6">
                                <div class="statistic-data">
                                    <img src="<?= esc_url($img_url); ?>" alt="<?= esc_attr($img_alt); ?>">
                                    <h3><?= wp_kses_post($number); ?></h3>
                                    <p><?= wp_kses_post($title); ?></p>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-6 ps-lg-4">
                <?php if (have_rows('statistic_description')):
                    while (have_rows('statistic_description')):
                        the_row();
                        $image = get_sub_field('image');
                        $img_url = is_array($image) ? $image['url'] : $image;
                        $img_alt = is_array($image) ? $image['alt'] : '#';
                        $heading = get_sub_field('heading');
                        $description = get_sub_field('description'); ?>
                        <div class="description-column">
                            <?php if ($image): ?><img src="<?= esc_url($img_url); ?>" alt="<?= esc_attr($img_alt); ?>"> <?php endif; ?>
                            <?php if ($heading): ?><h5 class="pb-2"><?= wp_kses_post($heading); ?></h5> <?php endif; ?>
                            <?php if ($description): ?><?php echo wp_kses_post($description); ?> <?php endif; ?>
                        </div>
                    <?php endwhile;
                endif; ?>
            </div>
        </div>
    </div>
</section>