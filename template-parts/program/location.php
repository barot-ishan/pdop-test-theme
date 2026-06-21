<?php

if (!defined('ABSPATH')) {
    exit;
}

$heading = get_sub_field('heading');

?>

<div class="pdop_class_location_main">
    <?php
    if (!empty($heading)) {
    ?>
        <h2><?php echo $heading; ?></h2>
    <?php
    }

    if (have_rows('locations')) {
    ?>
        <div class="pdop_class_location_card_main">
            <?php
            while (have_rows('locations')) {
                the_row();

                $image = get_sub_field('image');
                $name = get_sub_field('name');
                $description = get_sub_field('description');
                $link = get_sub_field('link');


            ?>
                <div class="pdop_class_location_card">
                    <?php if (!empty($image)) { ?>
                        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                    <?php } ?>
                    <div class="pdop_class_content">
                        <?php if (!empty($name)) { ?>
                            <h6><?php echo $name; ?></h6>
                        <?php } ?>
                        <?php if (!empty($description)) { ?>
                            <?php echo $description; ?>
                        <?php } ?>
                        <?php if (!empty($link)) { ?>
                            <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" aria-label="<?php echo $link['title']; ?>"><?php echo $link['title']; ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <mask id="mask0_4342_57063" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="18" height="18">
                                        <rect width="18" height="18" transform="matrix(-1 0 0 1 18 0)" fill="#D9D9D9" />
                                    </mask>
                                    <g mask="url(#mask0_4342_57063)">
                                        <path d="M11.112 9.00215L5.46244 14.6517C5.31344 14.8007 5.24081 14.9761 5.24456 15.178C5.24844 15.38 5.32487 15.5555 5.47387 15.7045C5.623 15.8535 5.7985 15.928 6.00037 15.928C6.20225 15.928 6.37775 15.8535 6.52687 15.7045L12.2801 9.96271C12.4157 9.82708 12.5162 9.67515 12.5816 9.5069C12.647 9.33865 12.6797 9.1704 12.6797 9.00215C12.6797 8.8339 12.647 8.66565 12.5816 8.4974C12.5162 8.32915 12.4157 8.17721 12.2801 8.04158L6.52687 2.28815C6.37775 2.13915 6.20031 2.06658 5.99456 2.07046C5.78881 2.07433 5.61144 2.15077 5.46244 2.29977C5.31344 2.44877 5.23894 2.62427 5.23894 2.82627C5.23894 3.02815 5.31344 3.20359 5.46244 3.35258L11.112 9.00215Z" fill="#2B3C73" />
                                    </g>
                                </svg>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    <?php
    }

    ?>
</div>