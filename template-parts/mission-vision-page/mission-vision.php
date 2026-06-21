<?php
/**
 * Template part for Text and Image Section
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (have_rows('mission_vision_section')): ?>
    <section class="pdop_container mission_vission_sec" aria-label="Mission and Vision Section">
        <div class="mission_vision_row row gx-5">
            
            <?php
            $count = 0; 
            while (have_rows('mission_vision_section')):
                the_row();
                
                $content = get_sub_field('content');
                $image = get_sub_field('image');
                $title = get_sub_field('title');

                if($title){
                    $plain_title = wp_strip_all_tags($title);
                    $words = preg_split('/\s+/', trim($plain_title));
                    $initials = '';
                    foreach ($words as $word) {
                        $initials .= strtolower(substr($word, 0, 1));
                    }
                    $class_name = $initials . '_sec';
                }else{
                    $class_name = '';
                }

                if($count == 0 || $count == 2){
                    $colClass = "col-md-5";
                    // var_dump($count);
                }else{
                    $colClass = "col-md-2";
                }
                $count++;
            ?>

                <div class="mv_col <?php echo esc_attr(trim($class_name . ' ' . $colClass)); ?>">
                    <?php if (!empty($image) && is_array($image)):
                        $img_url = $image['url'] ?? '';
                        $img_alt = $image['alt'] ?? '';
                     endif; ?>

                    <?php if (!empty($title)): ?>
                        <h2 style="--bg-image:url('<?php echo esc_url($img_url); ?>');"><?php echo $title; ?></h2>
                    <?php endif; ?>

                    <?php if (!empty($image) && is_array($image) && $colClass == 'col-md-2'): ?>
                            <img src="<?php echo esc_url($img_url); ?>" title="<?php echo $title; ?> Image" title="<?php echo esc_attr($img_alt); ?>" alt="<?php echo esc_attr($img_alt); ?>" loading="lazy">
                    <?php endif; ?>

                    <?php if (!empty($content)): ?>
                        <div class="mv_content">
                            <?php
                            // Allow safe HTML from WYSIWYG
                            echo wp_kses_post(wpautop($content));
                            ?>
                        </div>
                    <?php endif; ?>

                </div>

            <?php endwhile; ?>

        </div>
    </section>
<?php endif; ?>