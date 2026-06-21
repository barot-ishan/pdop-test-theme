<?php

if (!defined('ABSPATH')) {
    exit;
}

$link = get_sub_field('link');
$button_color = get_sub_field('button_color');

?>
<div class="pdop_program_detail_data_section">
    <div class="program_single_button text-center">
        <?php
        if (!empty($link)) {
            $button_class = 'pdop_btn';
            if ($button_color == 'secondary') {
                $button_class .= ' pdop_btn_secondary';
            }
        ?>
            <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" title="<?php echo $link['title']; ?>" aria-label="<?php echo $link['title']; ?>" class="<?php echo $button_class; ?>"><?php echo $link['title']; ?></a>
        <?php
        }
        ?>
    </div>
</div>