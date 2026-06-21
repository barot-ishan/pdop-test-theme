<?php

if (!defined('ABSPATH')) {
    exit;
}

if (have_rows('not_sure_section')) {
    while (have_rows('not_sure_section')) {
        the_row();
        $heading = get_sub_field('heading');
        $subheading = get_sub_field('subheading');

?>
        <!-- Not Sure -->
        <div class="pdop_not_sure_container position-relative">
            <div class="pdop_not_sure_content">
                <?php
                if ($heading || $subheading) {
                ?>
                    <h3><?php echo $heading; ?></h3>
                    <p><?php echo $subheading; ?></p>
                <?php
                }
                ?>
                <div class="pdop_not_sure_choices">
                    <?php
                    if (have_rows('not_sure_choices')) {
                        while (have_rows('not_sure_choices')) {
                            the_row();
                            $choice_link = get_sub_field('choice_link');

                            if (!empty($choice_link)) {
                    ?>
                                <a href="<?php echo $choice_link['url']; ?>" target="<?php echo $choice_link['target']; ?>" title="<?php echo $choice_link['title']; ?>" aria-label="<?php echo $choice_link['title']; ?>"><?php echo $choice_link['title']; ?></a>
                    <?php
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="pdop_not_sure_img d-flex justify-content-center position-relative">
                <svg class="position-absolute end-0 bottom-0 w-100" xmlns="http://www.w3.org/2000/svg" width="759" height="200" viewBox="0 0 759 200" fill="none" aria-hidden="true">
                    <path d="M84.1735 41.3743L6.20025 215.374C-14.5529 261.686 19.3308 314 70.0796 314H833.004C871.664 314 903.004 282.66 903.004 244V70C903.004 31.3401 871.664 0 833.004 0H148.053C120.467 0 95.4542 16.2009 84.1735 41.3743Z" fill="#CDE7EF" />
                </svg>
                <img src="https://pdopdev.wpenginepowered.com/wp-content/uploads/2026/04/not_sure_filler_img.webp" alt="">
            </div>
        </div>
<?php
    }
}

?>