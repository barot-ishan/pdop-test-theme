<?php

if (!defined('ABSPATH')) {
    exit;
}

$sections = get_field('program_page_sections');


if ($sections) {
?>
    <div class="pdop_program_top_navigation">
        <?php
        $i = 1;
        foreach ($sections as $section) {
            $layout = $section['acf_fc_layout'];
            if ($layout === 'program_page_card') {
                $heading = $section['title'];
                $icon = $section['icon'];

                $heading_href = strtolower(str_replace(' ', '_', $section['title']));
                if (!empty($heading)) {

        ?>
                    <a href="#<?php echo $heading_href; ?>" class="pdop_program_top_navigation_item">
                        <?php
                        if ($icon && pathinfo($icon['url'], PATHINFO_EXTENSION) === 'svg') {
                            echo file_get_contents($icon['url']);
                        }
                        echo $heading;
                        ?>
                    </a>
        <?php
                }
            }
            $i++;
        }
        ?>
    </div>
<?php
}

?>