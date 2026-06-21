<?php

/**
 * Template part: Homepage – About Community
 *
 * Displays the "Your Community. Your Parks. Your Space." section with
 * accreditation badges, community stats grid, and "New to Oak Park?" CTA card.
 * Fields are powered by ACF (about_community_layout).
 *
 * @package PDOP
 */

if (!defined('ABSPATH')) {
    exit;
}

/* ── ACF Fields ──────────────────────────────────────────── */

$heading     = get_sub_field('community_heading') ?: '';
$description = get_sub_field('community_description') ?: '';
$cta_link    = get_sub_field('community_cta');

// Badges
$badges = array();
if (function_exists('have_rows') && have_rows('community_badges')) {
    while (have_rows('community_badges')) {
        the_row();
        $img = get_sub_field('image');
        if ($img) {
            $badges[] = array(
                'url' => is_array($img) ? $img['url'] : $img,
                'alt' => is_array($img) ? ($img['alt'] ?: 'Accreditation badge') : 'Accreditation badge',
            );
        }
    }
}

// Stats
$stats = array();
if (function_exists('have_rows') && have_rows('community_stats')) {
    while (have_rows('community_stats')) {
        the_row();
        $icon = get_sub_field('icon');
        $stats[] = array(
            'icon_url' => is_array($icon) ? $icon['url'] : ($icon ?: ''),
            'icon_alt' => is_array($icon) ? ($icon['alt'] ?: '') : '',
            'text'     => get_sub_field('stat_text') ?: '',
        );
    }
}

// New to Oak Park
$new_heading     = get_sub_field('filler_heading') ?: 'NEW TO OAK PARK?';
$new_description = get_sub_field('filler_description') ?: 'Join us to discover the fun within your reach! Find your local park, learn about our programs from ice skating to esports, get signed up for our newsletter, and more.';
$new_tagline     = get_sub_field('filler_tag_line') ?: "We're so glad you're here!";
$new_cta         = get_sub_field('filler_cta');
$new_image       = get_sub_field('filler_image');

/* ── Fallback static stats ───────────────────────────────── */

$default_stats = array(
    array('icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"><circle cx="10" cy="8" r="3" fill="#50b447"/><circle cx="17" cy="8" r="3" fill="#50b447"/><circle cx="24" cy="8" r="3" fill="#50b447"/><circle cx="7" cy="18" r="3" fill="#50b447"/><circle cx="14" cy="18" r="3" fill="#50b447"/><circle cx="21" cy="18" r="3" fill="#50b447"/><circle cx="27" cy="18" r="3" fill="#50b447"/></svg>', 'text' => 'a community of over <strong>53,000+</strong> residents'),
    array('icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"><rect x="3" y="10" width="24" height="16" rx="2" fill="none" stroke="#50b447" stroke-width="2"/><rect x="7" y="6" width="6" height="8" rx="1" fill="none" stroke="#50b447" stroke-width="2"/><rect x="17" y="6" width="6" height="8" rx="1" fill="none" stroke="#50b447" stroke-width="2"/></svg>', 'text' => 'with <strong>7 neighborhood recreation centers</strong>'),
    array('icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"><rect x="5" y="5" width="20" height="20" rx="3" fill="none" stroke="#50b447" stroke-width="2"/><line x1="5" y1="12" x2="25" y2="12" stroke="#50b447" stroke-width="2"/><circle cx="15" cy="19" r="3" fill="#50b447"/></svg>', 'text' => 'state-of-the-art <strong>Gym and Recreation Center</strong>'),
    array('icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"><path d="M15 3L5 12H8V25H22V12H25L15 3Z" fill="none" stroke="#50b447" stroke-width="2" stroke-linejoin="round"/></svg>', 'text' => 'including <strong>3 Historic Properties</strong>'),
    array('icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"><ellipse cx="15" cy="20" rx="10" ry="5" fill="none" stroke="#50b447" stroke-width="2"/><path d="M8 15C8 15 11 10 15 10C19 10 22 15 22 15" stroke="#50b447" stroke-width="2"/></svg>', 'text' => 'Two outdoor <strong>swimming pools</strong>'),
    array('icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"><path d="M15 5C15 5 5 12 5 18C5 24 10 27 15 27C20 27 25 24 25 18C25 12 15 5 15 5Z" fill="none" stroke="#50b447" stroke-width="2"/></svg>', 'text' => 'One indoor, <strong>year-round ice rink</strong>'),
    array('icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"><circle cx="10" cy="22" r="5" fill="none" stroke="#50b447" stroke-width="2"/><path d="M15 7L25 7L25 17" stroke="#50b447" stroke-width="2"/><line x1="6" y1="6" x2="15" y2="15" stroke="#50b447" stroke-width="2"/></svg>', 'text' => '<strong>18 parks</strong> totalling <strong>84 acres</strong> of parkland'),
    array('icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"><rect x="4" y="8" width="22" height="16" rx="2" fill="none" stroke="#50b447" stroke-width="2"/><line x1="4" y1="14" x2="26" y2="14" stroke="#50b447" stroke-width="2"/><rect x="8" y="17" width="4" height="3" rx="1" fill="#50b447"/><rect x="14" y="17" width="4" height="3" rx="1" fill="#50b447"/></svg>', 'text' => 'and <strong>8,000 recreation programs</strong> and special events annually'),
);

$use_default_stats = empty($stats);

/* ── Fallback badges ─────────────────────────────────────── */
$default_badges = array(
    array('url' => '/wp-content/uploads/2026/03/badge-accredited.png', 'alt' => 'Accredited Agency'),
    array('url' => '/wp-content/uploads/2026/03/badge-gold-medal.png', 'alt' => 'Gold Medal Award'),
    array('url' => '/wp-content/uploads/2026/03/badge-capra.png', 'alt' => 'CAPRA Accredited'),
    array('url' => '/wp-content/uploads/2026/03/badge-pdrma.png', 'alt' => 'Proud PDRMA Member Since 2000'),
);
$use_default_badges = empty($badges);
$display_badges = $use_default_badges ? $default_badges : $badges;
?>

<!-- About Community -->
<section class="pdop_community pdop_container" aria-labelledby="pdop-community-heading">

    <div class="pdop_community_inner">
        <!-- Heading -->
        <h2 class="pdop_community_heading" id="pdop-community-heading">
            <?php echo esc_html($heading); ?>
        </h2>

        <!-- Badges -->
        <div class="pdop_community_badges" aria-label="Accreditation badges">
            <?php foreach ($display_badges as $badge) : ?>
                <img class="pdop_community_badge_img"
                    src="<?php echo esc_url($badge['url']); ?>"
                    alt="<?php echo esc_attr($badge['alt']); ?>"
                    loading="lazy" />
            <?php endforeach; ?>
        </div>

        <!-- Divider -->
        <hr class="pdop_community_divider" aria-hidden="true">

        <!-- Description -->
        <div class="pdop_community_description">
            <?php echo wp_kses_post($description); ?>
        </div>

        <!-- Stats grid -->
        <div class="pdop_community_stats">
            <?php if ($use_default_stats) :
                foreach ($default_stats as $stat) : ?>
                    <div class="pdop_community_stat">
                        <span class="pdop_community_stat_icon" aria-hidden="true">
                            <?php echo $stat['icon']; ?>
                        </span>
                        <?php echo wp_kses_post($stat['text']); ?>
                    </div>
                <?php endforeach;
            else :
                foreach ($stats as $stat) : ?>
                    <div class="pdop_community_stat">
                        <span class="pdop_community_stat_icon" aria-hidden="true">
                            <?php if (!empty($stat['icon_url'])) : ?>
                                <img src="<?php echo esc_url($stat['icon_url']); ?>"
                                    alt="<?php echo esc_attr(!empty($stat['icon_alt']) ? $stat['icon_alt'] : wp_strip_all_tags($stat['text']) . ' icon'); ?>"
                                    width="30" height="30" loading="lazy" />
                            <?php endif; ?>
                        </span>
                        <span class="pdop_community_stat_text">
                            <?php echo wp_kses_post($stat['text']); ?>
                        </span>
                    </div>
            <?php endforeach;
            endif; ?>
            <!-- CTA Button -->
            <div class="pdop_community_cta d-flex justify-content-end align-items-start">
                <?php if ($cta_link) :
                    $cta_url    = is_array($cta_link) ? $cta_link['url'] : $cta_link;
                    $cta_title  = is_array($cta_link) ? $cta_link['title'] : 'Get to Know us';
                    $cta_target = is_array($cta_link) && !empty($cta_link['target']) ? $cta_link['target'] : '';
                ?>
                    <a href="<?php echo esc_url($cta_url); ?>"
                        class="pdop_btn"
                        <?php echo $cta_target ? 'target="' . esc_attr($cta_target) . '" rel="noopener"' : ''; ?>>
                        <?php echo esc_html($cta_title); ?>
                    </a>
                <?php else : ?>
                    <a href="#" class="pdop_btn">Get to Know us</a>
                <?php endif; ?>
            </div>
        </div>

        <!-- New to Oak Park Card -->
        <div class="pdop_community_welcome">
            <div class="pdop_community_welcome_content">
                <h3 class="pdop_community_welcome_heading">
                    <?php echo esc_html($new_heading); ?>
                </h3>
                <p class="pdop_community_welcome_desc">
                    <?php echo esc_html($new_description); ?>
                </p>
                <p class="pdop_community_welcome_tagline">
                    <?php echo esc_html($new_tagline); ?>
                </p>
                <div class="pdop_community_welcome_cta">
                    <?php if ($new_cta) :
                        $nurl    = is_array($new_cta) ? $new_cta['url'] : $new_cta;
                        $ntitle  = is_array($new_cta) ? $new_cta['title'] : 'Explore Welcome Bundle';
                        $ntarget = is_array($new_cta) && !empty($new_cta['target']) ? $new_cta['target'] : '';
                    ?>
                        <a href="<?php echo esc_url($nurl); ?>"
                            class="pdop_btn"
                            <?php echo $ntarget ? 'target="' . esc_attr($ntarget) . '" rel="noopener"' : ''; ?>>
                            <?php echo esc_html($ntitle); ?>
                        </a>
                    <?php else : ?>
                        <a href="#" class="pdop_btn">Explore Welcome Bundle</a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="pdop_community_welcome_image">
                <?php if ($new_image) :
                    $img_url = is_array($new_image) ? $new_image['url'] : $new_image;
                    $img_alt = is_array($new_image) ? ($new_image['alt'] ?: 'Welcome to Oak Park') : 'Welcome to Oak Park';
                ?>
                    <img src="<?php echo esc_url($img_url); ?>"
                        alt="<?php echo esc_attr($img_alt); ?>"
                        loading="lazy" />
                <?php else : ?>
                    <img src="/wp-content/uploads/2026/03/new-to-oak-park.jpg"
                        alt="Welcome to Oak Park"
                        loading="lazy" />
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>