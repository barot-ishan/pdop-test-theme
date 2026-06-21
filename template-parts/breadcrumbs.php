<?php
if (!defined('ABSPATH'))
    exit;

if (!function_exists('pdop_get_breadcrumbs'))
    return;

$breadcrumbs = pdop_get_breadcrumbs();
?>

<nav class="breadcrumbs d-flex align-items-center" aria-label="Breadcrumb">

    <!-- Back Button -->
    <a 
        href="<?php echo esc_url(wp_get_referer() ?: home_url()); ?>" 
        class="breadcrumb-back"
        aria-label="Go back to previous page"
    >
        <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none">
            <path d="M1.67592 4.8125L4.99873 8.13531L4.375 8.75L0 4.375L4.375 0L4.99873 0.614688L1.67592 3.9375H8.75V4.8125H1.67592Z" fill="#CAD8FF"/>
        </svg>
        <span class="visually-hidden">Go back:</span>
        <span>Back</span>
    </a>

    <span class="separator breadcrumb_separator" aria-hidden="true">|</span>

    <ol class="breadcrumb-list d-flex align-items-center list-unstyled mb-0 ms-0">

        <?php foreach ($breadcrumbs as $index => $crumb): ?>

            <li class="breadcrumb-item">

                <?php if (!empty($crumb['url']) && $index !== count($breadcrumbs) - 1): ?>
                    <a href="<?php echo esc_url($crumb['url']); ?>">
                        <?php echo esc_html($crumb['label']); ?>
                    </a>

                    <span class="separator" aria-hidden="true">
                        <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="5" height="9" viewBox="0 0 5 9" fill="none">
                            <path d="M0.5 8.42L3.76 5.16C4.145 4.775 4.145 4.145 3.76 3.76L0.5 0.5" stroke="#CAD8FF" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>

                <?php
    else: ?>
                    <span class="current" aria-current="page">
                        <?php echo esc_html($crumb['label']); ?>
                    </span>
                <?php
    endif; ?>

            </li>

        <?php
endforeach; ?>

    </ol>

</nav>

<?php pdop_breadcrumbs_schema($breadcrumbs); ?>