<?php
/**
 * Template part for Values Scroll Section
 */

if (!defined('ABSPATH')) {
    exit;
}

// Fetch all fields once
$bg_image = get_sub_field('background_image');
$title = get_sub_field('title');
$intro_text = get_sub_field('intro_text');
$values = get_sub_field('values');

// Background style (safe)
$bg_style = '';
if (!empty($bg_image['url'])) {
    $bg_style = 'style="background-image: url(' . esc_url($bg_image['url']) . ');"';
}
?>

<section class="pdop_container pdop_values" aria-labelledby="values-section-title">

    <div class="pdop_values_sticky_layer" <?php echo $bg_style; ?>>
    </div>

    <div class="pdop_values_scroll_layer">
        <?php if (!empty($title)): ?>
            <h2 id="values-section-title" class="values_section_title text-center">
                <?php echo esc_html($title); ?>
            </h2>
        <?php endif; ?>

        <?php if (!empty($intro_text)): ?>
            <div class="intro-text text-center">
                <?php echo wp_kses_post($intro_text); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($values) && is_array($values)): ?>
            <div class="values_card_container">

                <?php foreach ($values as $value):

                    // Safe field extraction
                    $image = $value['values_image'] ?? null;
                    $heading = $value['value_title'] ?? '';
                    $desc = $value['value_description'] ?? '';
                    $points = $value['value_points'] ?? '';
                    $cta = $value['values_cta'] ?? null;

                    // Image handling
                    $img_url = !empty($image['url'])
                        ? esc_url($image['url'])
                        : esc_url(get_template_directory_uri() . '/assets/images/placeholder.png');

                    $img_alt = !empty($image['alt'])
                        ? esc_attr($image['alt'])
                        : esc_attr($heading ?: 'Value image');

                    ?>

                    <article class="value_card row gx-0">

                        <div class="values_img d-sm-none d-md-block col-md-4">
                            <img src="<?php echo $img_url; ?>" title="<?php echo $img_alt; ?>" alt="<?php echo $img_alt; ?>">
                        </div>

                        <div class="col-md-8 values_card_content">

                            <?php if (!empty($heading)): ?>
                                <h3 class="values_card_heading">
                                    <?php echo esc_html($heading); ?>
                                </h3>
                            <?php endif; ?>

                            <?php if (!empty($desc)): ?>
                                <div class="values_card_desc">
                                    <?php echo wp_kses_post($desc); ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($points)): ?>
                                <div class="values_points mt-2">
                                    <?php echo wp_kses_post($points); ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($cta['url']) && !empty($cta['title'])):
                                $target = !empty($cta['target']) ? esc_attr($cta['target']) : '_self';
                                $rel = ($target === '_blank') ? 'noopener noreferrer' : '';
                                ?>
                                <a href="<?php echo esc_url($cta['url']); ?>" target="<?php echo $target; ?>"
                                    rel="<?php echo esc_attr($rel); ?>" class="pdop_btn pdop_btn_secondary"
                                    aria-label="Learn more about <?php echo esc_attr($heading); ?>">
                                    <?php echo esc_html($cta['title']); ?>
                                </a>
                            <?php endif; ?>

                        </div>

                    </article>

                <?php endforeach; ?>

            </div>
        <?php endif; ?>
    </div>

</section>