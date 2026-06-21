<?php
/**
 * Meet the Board Component
 *
 * @package PDOP
 */

if (!defined('ABSPATH')) {
    exit;
}

$main_heading = get_sub_field('main_heading');
?>

<section class="pdop_container board-section" aria-labelledby="board-section-title">
    <div class="row board-main-title-row">
        <div class="col-sm-12">
            <div class="common-section-header">
                <?php if ($main_heading): ?>
                    <h2 class="section-title" id="board-section-title">
                        <?= wp_kses_post($main_heading); ?>
                    </h2>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if (have_rows('boards_commisioners')): ?>
        <div class="board-members-grid" role="list">
            <?php
            while (have_rows('boards_commisioners')):
                the_row();
                $image = get_sub_field('image');
                $img_url = is_array($image) ? $image['url'] : $image;

                // Better alt fallback
                $img_alt = is_array($image) && !empty($image['alt'])
                    ? $image['alt']
                    : get_sub_field('name');

                $name = get_sub_field('name');
                $role = get_sub_field('role');
                $sub_heading = get_sub_field('sub_heading');
                $details = get_sub_field('details');
                ?>
                <div class="board-member-wrap" role="listitem">

                    <article class="board-card-layout" aria-labelledby="member-<?= esc_attr(sanitize_title($name)); ?>">

                        <!-- Info Card -->
                        <div class="card board-info-card">

                            <div class="board-member-image">
                                <img src="<?= esc_url($img_url); ?>" alt="<?= esc_attr($img_alt); ?>" loading="lazy">
                            </div>

                            <div class="board-contact-info">

                                <?php if ($name): ?>
                                    <h3 class="board-member-name" id="member-<?= esc_attr(sanitize_title($name)); ?>">
                                        <?= esc_html($name); ?>
                                    </h3>
                                <?php endif; ?>

                                <?php if ($role): ?>
                                    <p class="board-member-designation">
                                        <?= esc_html($role); ?>
                                    </p>
                                <?php endif; ?>

                                <hr aria-hidden="true">

                                <?php if (have_rows('contact_details')):

                                    while (have_rows('contact_details')):
                                        the_row();

                                        $icon = get_sub_field('icon');
                                        $icon_url = is_array($icon) ? $icon['url'] : $icon;

                                        $text_link = get_sub_field('text_link');

                                        $link_url = $text_link['url'];
                                        $link_title = $text_link['title'];
                                        $link_target = $text_link['target'] ? $text_link['target'] : '_self';

                                        $is_email = strpos($link_url, 'mailto:') === 0;
                                        $is_phone = strpos($link_url, 'tel:') === 0;

                                        if ($is_email && strtolower($link_title) === 'email') {
                                            $link_title = str_replace('mailto:', '', $link_url);
                                        } elseif ($is_phone && strtolower($link_title) === 'phone') {
                                            $link_title = str_replace('tel:', '', $link_url);
                                        }

                                        $wrapper_class = $is_phone
                                            ? 'board-phone'
                                            : 'board-contact-email';

                                        $icon_class = $is_phone
                                            ? 'phone-icon'
                                            : 'email-icon';

                                        // Accessible label
                                        $aria_label = $is_phone
                                            ? 'Call ' . $link_title
                                            : 'Send email to ' . $link_title;

                                        if ($link_target === '_blank') {
                                            $aria_label .= ' (opens in a new tab)';
                                        }
                                        ?>
                                        <p class="<?= esc_attr($wrapper_class); ?>">
                                            <!-- Decorative icon -->
                                            <img src="<?= esc_url($icon_url); ?>" alt="" aria-hidden="true"
                                                class="<?= esc_attr($icon_class); ?>">

                                            <a href="<?= esc_url($link_url); ?>" target="<?= esc_attr($link_target); ?>"
                                                aria-label="<?= esc_attr($aria_label); ?>" <?php if ($link_target === '_blank'): ?>
                                                    rel="noopener noreferrer" <?php endif; ?>>
                                                <?= esc_html($link_title); ?>
                                            </a>
                                        </p>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- About Card -->
                        <div class="card board-about-card">
                            <?php if ($sub_heading): ?>
                                <h4 class="board-about-title">
                                    <?= esc_html($sub_heading); ?>
                                </h4>
                            <?php endif; ?>

                            <div class="board-about-text">
                                <?php if ($details): ?>
                                    <?= wp_kses_post($details); ?>
                                <?php endif; ?>
                            </div>
                        </div>

                    </article>
                </div>

            <?php endwhile; ?>

        </div>

    <?php endif; ?>

</section>
