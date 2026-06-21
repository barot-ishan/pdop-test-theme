<?php

if (!defined('ABSPATH')) {
    exit;
}

$description = get_sub_field('description');

?>
<div class="pdop_program_detail_data_section">
    <div class="program_single_description">
        <?php
        if (!empty($description)) {
            echo $description;
        }
        ?>
    </div>
</div>