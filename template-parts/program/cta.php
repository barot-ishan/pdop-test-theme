<?php

if (!defined('ABSPATH')) {
    exit;
}

if (have_rows('cta_buttons')) {
?>
    <div class="pdop_program_ctas">
        <?php
        $count = 0;
        while (have_rows('cta_buttons')) {
            the_row();

            $count++;

            $select_behavior = get_sub_field('select_behavior');
            $add_url = get_sub_field('add_url');
            $cta_title = get_sub_field('cta_title');
            $modal_heading = get_sub_field('modal_heading');
            $modal = '';
            if ($select_behavior == 'modal') {
                $modal_id = 'pdop_program_modal_' . uniqid();
                $href = '#' . $modal_id;
                $modal = 'data-bs-toggle="modal"';
                $modal_data = get_sub_field('modal_data');
            }

            if ($select_behavior == 'link') {
                $href = $add_url['url'];
                $target = $add_url['target'];
                $cta_title = $add_url['title'];
            }

        ?>
            <a href="<?php echo $href; ?>" class="d-flex align-items-center justify-content-between" <?php echo $target; ?> <?php echo $modal; ?> aria-label="<?php echo $cta_title; ?>">
                <?php echo $cta_title; ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38" fill="none">
                    <rect width="38" height="38" rx="19" fill="#D0DD28" />
                    <path d="M13 19L23.7528 19" stroke="#2B3C73" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="round" />
                    <path d="M19.4502 14L24.4682 19L19.4502 24" stroke="#2B3C73" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="round" />
                </svg>
            </a>
            <?php if ($count % 2 != 0) { ?>
                <span aria-hidden="true"></span>
            <?php } ?>
            <?php
            if ($select_behavior == 'modal') {
                echo pdop_program_modal($modal_id, $modal_heading, $modal_data);
            }
            ?>
        <?php

        }
        ?>
    </div>
<?php
}

function pdop_program_modal($modal_id, $modal_heading, $modal_data)
{
    ob_start();
?>
    <div class="pdop_program_modal modal fade" id="<?php echo $modal_id; ?>" tabindex="-1" aria-labelledby="<?php echo $modal_id; ?>_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="pdop_program_modal_title" id="<?php echo $modal_id; ?>_label"><?php echo $modal_heading; ?></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="pdop_program_modal_body d-flex gap-5 flex-column">
                        <?php foreach ($modal_data as $key => $value) { ?>
                            <div class="pdop_program_modal_content_section">
                                <?php if (!empty($value['title'])) { ?>
                                    <h6><?php echo $value['title']; ?></h6>
                                <?php } ?>
                                <?php if (!empty($value['description'])) { ?>
                                    <?php echo $value['description']; ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
}
?>

<style>
    .pdop_program_modal.modal {
        --bs-modal-header-border-color: #ECECEC;
        --bs-modal-header-padding: 20px 30px;
        --bs-modal-padding: 20px 30px 32px;
        overflow: hidden;
    }

    .pdop_program_modal.modal.fade .modal-dialog {
        transform: translate(70px, 0);
        margin-right: 0;
        min-height: 100vh;
        margin-top: 0;
        margin-bottom: 0;
    }

    .pdop_program_modal.modal.show .modal-dialog {
        transform: none;
    }

    .pdop_program_modal.modal .modal-content {
        min-height: 100vh;
        border-radius: 20px 0 0 20px;
    }

    .pdop_program_modal_body {
        height: 85vh;
        overflow-y: auto;
    }

    .pdop_program_modal_title {
        font-weight: var(--fw-extrabold);
        text-transform: uppercase;
    }

    .pdop_program_modal_content_section h6 {
        font-weight: var(--fw-bold);
        font-size: var(--body-base);
        text-transform: uppercase;
        margin-bottom: 7px;
        color: var(--color-black);
    }

    .pdop_program_modal_content_section p {
        color: var(--color-black);
    }
</style>