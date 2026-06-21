<?php
if (!defined('ABSPATH')) {
    exit;
}

$heading = get_sub_field('heading');
$subheading = get_sub_field('sub_heading');
$description = get_sub_field('description');

?>
<div class="pdop_program_detail_data_section">
    <div class="program_heading_section">
        <?php
        if (!empty($heading)) {
        ?>
            <h2><?php echo $heading; ?></h2>
        <?php
        }
        if (!empty($subheading)) {
        ?>
            <h3 class="pdop_program_detail_subtitle"><?php echo $subheading; ?></h3>
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