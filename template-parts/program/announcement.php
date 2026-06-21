<?php

if (!defined('ABSPATH')) {
    exit;
}


$announcements = new WP_Query([
    'post_type' => 'announcement',
    'posts_per_page' => -1,
    'meta_query' => [
        [
            'key' => 'select_program_page',
            'value' => get_the_ID(),
            'compare' => 'LIKE'
        ]
    ]
]);

if ($announcements->have_posts()) {
    ?>
    <!-- Announcement -->
    <div class="pdop_announcement">
        <h4>Announcements</h4>
        <div class="announcement_wrapper">
            <?php
            while ($announcements->have_posts()) {
                $announcements->the_post();
                $announcement_title = get_the_title();
                $announcement_desc = get_field('description_of_announcement');
                $announcement_link = get_field('link_to_registration');
                $announcement_date = get_field('date_of_announcement');
                $link_type = get_field('link_type');
                $announcement_link = get_field('external_internal_link');
                $pdf_file = get_field('pdf_file');

                ?>
                <div class="d-flex">
                    <div class="announcement-icon-box-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="79" height="60" viewBox="0 0 79 60" fill="none">
                            <path
                                d="M48.4365 37.4423V16.4141C54.1109 16.4141 58.7107 21.014 58.7107 26.6882V27.168C58.7107 32.8423 54.1107 37.4423 48.4365 37.4423Z"
                                stroke="#009AD0" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M16.6695 36.0742V49.3104C16.6695 52.4869 14.0944 55.062 10.9179 55.062H8.20129C7.82418 55.062 7.51855 54.7564 7.51855 54.3793V36.6859"
                                stroke="#009AD0" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M43.1662 48.9152C40.2553 48.9152 37.8955 46.5554 37.8955 43.6444V10.2082C37.8955 7.29731 40.2553 4.9375 43.1662 4.9375C46.0772 4.9375 48.437 7.29731 48.437 10.2082V43.6444C48.437 46.5554 46.0772 48.9152 43.1662 48.9152Z"
                                stroke="#2B3C73" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M16.6917 36.0739H8.29523C4.42582 36.0739 1.28906 32.9371 1.28906 29.0677V24.7874C1.28906 20.918 4.42582 17.7812 8.29523 17.7812H16.6917V36.0739Z"
                                stroke="#2B3C73" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M16.6914 17.7789V26.9252V36.0716C22.8559 36.0716 28.8903 37.8461 34.0735 41.1831L37.8948 43.6433V26.9251V10.207L34.0735 12.6673C28.8903 16.0043 22.8559 17.7789 16.6914 17.7789Z"
                                stroke="#2B3C73" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M63.4517 18.4702L67.9257 15.923C68.524 15.5824 69.285 15.7912 69.6256 16.3896C69.9662 16.9879 69.7572 17.7489 69.159 18.0895L64.685 20.6366C64.2838 20.865 63.8092 20.8463 63.4375 20.6286C63.255 20.5218 63.0972 20.367 62.9852 20.17C62.6446 19.5717 62.8535 18.8107 63.4517 18.4702ZM71.0623 28.3757L65.7895 28.3439C65.5629 28.3425 65.3506 28.2807 65.1682 28.1739C64.7964 27.9563 64.5479 27.5517 64.5506 27.09C64.5548 26.4015 65.1163 25.8469 65.8045 25.8511L71.0773 25.8829C71.7656 25.8869 72.3203 26.4485 72.3162 27.1369C72.3121 27.8252 71.7506 28.3799 71.0623 28.3757ZM69.4957 37.8508C69.148 38.4449 68.3843 38.6445 67.7903 38.2968L63.3474 35.6956C62.7533 35.3479 62.5536 34.5843 62.9014 33.9902C63.2493 33.3961 64.0128 33.1965 64.6069 33.5443L69.0498 36.1454C69.6439 36.4932 69.8436 37.2567 69.4957 37.8508Z"
                                fill="#2B3C73" />
                        </svg>
                        <div class="content-box-announcement">
                            <div class="content-box-announcement-inner">
                                <h5><?php echo $announcement_title; ?></h5>
                                <div class="announcement_desc"><?php echo $announcement_desc; ?></div>
                                <time datetime="<?php echo $announcement_date; ?>"><?php echo $announcement_date; ?></time>
                            </div>
                            <div class="content-box-announcement-pdf">
                                <?php if ($link_type && !empty($pdf_file)): ?>

                                    <a href="<?php echo esc_url($pdf_file['url']); ?>" target="_blank" class="pdf_type">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="20" viewBox="0 0 16 20"
                                            fill="none">
                                            <g clip-path="url(#clip0_40005503_25300)">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M3.12517 0H9.81183L15.479 5.90705V17.3963C15.479 18.8356 14.3146 20 12.8803 20H3.12517C1.6859 20 0.521484 18.8356 0.521484 17.3963V2.60369C0.521459 1.16441 1.68587 0 3.12517 0Z"
                                                    fill="#E5252A" />
                                                <path opacity="0.302" fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M9.80664 0V5.86207H15.4788L9.80664 0Z" fill="white" />
                                                <path
                                                    d="M3.41406 14.9227V11.2695H4.96829C5.3531 11.2695 5.65796 11.3745 5.88784 11.5894C6.11772 11.7993 6.23267 12.0841 6.23267 12.4389C6.23267 12.7938 6.11772 13.0786 5.88784 13.2885C5.65796 13.5034 5.3531 13.6084 4.96829 13.6084H4.3486V14.9227H3.41406ZM4.3486 12.8138H4.86335C5.00326 12.8138 5.11321 12.7838 5.18819 12.7138C5.26314 12.6489 5.30314 12.5589 5.30314 12.439C5.30314 12.319 5.26317 12.2291 5.18819 12.1641C5.11324 12.0941 5.00329 12.0642 4.86335 12.0642H4.3486V12.8138ZM6.61746 14.9227V11.2695H7.91181C8.16668 11.2695 8.40657 11.3045 8.63145 11.3795C8.85633 11.4544 9.06124 11.5594 9.24114 11.7043C9.42106 11.8442 9.56598 12.0341 9.67093 12.274C9.77087 12.5139 9.82586 12.7888 9.82586 13.0986C9.82586 13.4035 9.7709 13.6783 9.67093 13.9182C9.56598 14.1581 9.42106 14.348 9.24114 14.4879C9.06121 14.6328 8.85633 14.7378 8.63145 14.8128C8.40657 14.8877 8.16668 14.9227 7.91181 14.9227H6.61746ZM7.532 14.1281H7.80186C7.94678 14.1281 8.08173 14.1131 8.20666 14.0781C8.32659 14.0432 8.44154 13.9882 8.55149 13.9132C8.65644 13.8383 8.7414 13.7333 8.80136 13.5934C8.86133 13.4535 8.89133 13.2885 8.89133 13.0986C8.89133 12.9037 8.86133 12.7388 8.80136 12.5989C8.7414 12.459 8.65644 12.354 8.55149 12.279C8.44154 12.2041 8.32662 12.1491 8.20666 12.1141C8.08173 12.0792 7.94678 12.0641 7.80186 12.0641H7.532V14.1281ZM10.2956 14.9227V11.2695H12.8943V12.0641H11.2302V12.6488H12.5595V13.4385H11.2302V14.9227H10.2956Z"
                                                    fill="white" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_40005503_25300">
                                                    <rect width="16" height="20" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>

                                        <?php echo esc_html($pdf_file['title']); ?>
                                    </a>

                                <?php elseif (!empty($announcement_link)): ?>

                                    <a href="<?php echo esc_url($announcement_link['url']); ?>"
                                        target="<?php echo esc_attr($announcement_link['target']); ?>"
                                        class="align-self-sm-center flex-shrink-0 d-flex gap-2 align-items-center">

                                        <?php echo esc_html($announcement_link['title']); ?>

                                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14"
                                            fill="none">
                                            <path d="M1 1L7 7L1 13" stroke="black" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </a>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>
    <?php
}

?>

