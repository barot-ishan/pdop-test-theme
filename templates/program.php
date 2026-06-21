<?php
/*
Template Name: Program
*/

get_header();

get_template_part('template-parts/inner-header');

?>

<section class="pdop_container pdop_program_container_top">
    <?php get_template_part('template-parts/program/announcement'); ?>
    <?php get_template_part('template-parts/program/not-sure'); ?>
</section>

<section class="pdop_container pdop_program_container_main">
    <div class="pdop_program_container_grid">
        <?php get_template_part('template-parts/program/sidebar'); ?>
        <div class="pdop_program_content">
            <?php get_template_part('template-parts/program/top-navigation'); ?>

            <?php

            if (have_rows('program_page_sections')) {
                while (have_rows('program_page_sections')) {
                    the_row();
                    if (get_row_layout() == 'program_page_card') {
                        get_template_part('template-parts/program/program-content-card');
                    }
                }
            }

            ?>

            <div class="pdop_program_content_main pdop_program_content_card">

                <div class="pdop_program_detail_data_section">

                    <div class="program_heading_section">
                        <h2>Explore Fitness</h2>
                        <h3 class="pdop_program_detail_subtitle">Our fitness mantra here at PDOP is health and wellness!</h3>
                        <p>Our goal is to create a sense of community while you exercise and get fit in a fun group setting. Classes are led by motivating, upbeat, high-quality instructors that help create your best workout. We offer a huge variety of classes including dance fitness, yoga, strength training, cardio, and more!</p>
                    </div>

                    <div class="program_highlight_section">
                        <h6>Benefits</h6>
                        <div class="program_highlight_list d-flex">
                            <div class="program_highlight_list_item">
                                <span class="d-block flex-shrink-0" aria-hidden="true"><img src="/wp-content/uploads/2026/04/tick_svg.svg" alt=""></span>
                                <div>
                                    <h6>First Class is on Us</h6>
                                    <p>Dive right into our classes with your first session absolutely free! It's the perfect opportunity to explore our offerings and find the right fit for you. Contact <a href="mailto:erin.coffman@pdop.org">erin.coffman@pdop.org</a> for your one free class promo code.</p>
                                </div>
                            </div>
                            <div class="program_highlight_list_item">
                                <span class="d-block flex-shrink-0" aria-hidden="true"><img src="/wp-content/uploads/2026/04/tick_svg.svg" alt=""></span>
                                <div>
                                    <h6>Flexibility with Punch Passes</h6>
                                    <p>If you're not quite ready for a full monthly commitment, we've got you covered with our convenient punch passes. Enjoy the flexibility to attend classes at your pace.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="program_note_section unset_li">
                        <span class="note_tag">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <mask id="mask0_4325_59649" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="18" height="18">
                                    <rect width="18" height="18" fill="#D9D9D9" />
                                </mask>
                                <g mask="url(#mask0_4325_59649)">
                                    <path d="M7.50195 13.5078C7.08945 13.5078 6.73633 13.3609 6.44258 13.0672C6.14883 12.7734 6.00195 12.4203 6.00195 12.0078V11.0703C5.28945 10.5828 4.73633 9.95781 4.34258 9.19531C3.94883 8.43281 3.75195 7.62031 3.75195 6.75781C3.75195 5.29531 4.26133 4.05469 5.28008 3.03594C6.29883 2.01719 7.53945 1.50781 9.00195 1.50781C10.4645 1.50781 11.7051 2.01719 12.7238 3.03594C13.7426 4.05469 14.252 5.29531 14.252 6.75781C14.252 7.62031 14.0551 8.42969 13.6613 9.18594C13.2676 9.94219 12.7145 10.5703 12.002 11.0703V12.0078C12.002 12.4203 11.8551 12.7734 11.5613 13.0672C11.2676 13.3609 10.9145 13.5078 10.502 13.5078H7.50195ZM7.50195 12.0078H10.502V10.2828L11.1395 9.83281C11.652 9.48281 12.0488 9.03594 12.3301 8.49219C12.6113 7.94844 12.752 7.37031 12.752 6.75781C12.752 5.72031 12.3863 4.83594 11.6551 4.10469C10.9238 3.37344 10.0395 3.00781 9.00195 3.00781C7.96445 3.00781 7.08008 3.37344 6.34883 4.10469C5.61758 4.83594 5.25195 5.72031 5.25195 6.75781C5.25195 7.37031 5.39258 7.94844 5.67383 8.49219C5.95508 9.03594 6.35195 9.48281 6.86445 9.83281L7.50195 10.2828V12.0078ZM7.50195 16.5078C7.28945 16.5078 7.11133 16.4359 6.96758 16.2922C6.82383 16.1484 6.75195 15.9703 6.75195 15.7578V15.0078H11.252V15.7578C11.252 15.9703 11.1801 16.1484 11.0363 16.2922C10.8926 16.4359 10.7145 16.5078 10.502 16.5078H7.50195Z" fill="#0079A4" />
                                </g>
                            </svg>
                            Note:
                        </span>
                        <ul>
                            <li>All of this is included in one fee! Click the buttons below to purchase.</li>
                            <li>Lifelong Learning/Active Adult and Aquatic fitness classes are not included in the Ultimate Fitness Membership.</li>
                        </ul>
                    </div>

                    <div class="program_single_description">
                        <p>We've made it easy for you to pre-register for our classes in Amilia, so you're just a step away from starting your exciting journey with us. For any specific inquiries related to our memberships, punch passes, classes, or programs, please contact <a href="mailto:Erin.Coffman@pdop.org">Erin Coffman</a> via email.</p>
                    </div>

                    <div class="program_single_button text-center">
                        <a href="#" class="pdop_btn">Explore Programs</a>

                    </div>

                    <div class="program_faq_section">
                        <h3>FAQs</h3>
                        <p>Got questions? We've got answers. Here's everything you need to know before getting started.</p>
                        <div class="accordion accordion-flush" id="program_faq_accordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <mask id="mask0_40004214_39573" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                                                <rect width="24" height="24" fill="#D9D9D9" />
                                            </mask>
                                            <g mask="url(#mask0_40004214_39573)">
                                                <path d="M11.989 17.6152C12.2745 17.6152 12.5157 17.5168 12.7125 17.3198C12.9093 17.1226 13.0078 16.8812 13.0078 16.5955C13.0078 16.31 12.9092 16.0688 12.712 15.872C12.5148 15.6753 12.2735 15.577 11.988 15.577C11.7025 15.577 11.4613 15.6756 11.2645 15.8728C11.0677 16.0699 10.9692 16.3113 10.9692 16.5968C10.9692 16.8822 11.0678 17.1234 11.265 17.3203C11.4622 17.5169 11.7035 17.6152 11.989 17.6152ZM11.2808 14.0345H12.6885C12.7013 13.5423 12.7734 13.1491 12.9047 12.8548C13.0363 12.5606 13.3552 12.1706 13.8615 11.6848C14.3013 11.2449 14.6382 10.8388 14.872 10.4663C15.106 10.0939 15.223 9.65417 15.223 9.147C15.223 8.28617 14.9137 7.61375 14.2952 7.12975C13.6766 6.64592 12.9448 6.404 12.1 6.404C11.2653 6.404 10.5747 6.62675 10.028 7.07225C9.48117 7.51775 9.09108 8.04242 8.85775 8.64625L10.1423 9.1615C10.2641 8.8295 10.4724 8.50608 10.7673 8.19125C11.0621 7.87658 11.4999 7.71925 12.0808 7.71925C12.6718 7.71925 13.1086 7.88108 13.3913 8.20475C13.6741 8.52858 13.8155 8.88467 13.8155 9.273C13.8155 9.61283 13.7187 9.92375 13.525 10.2057C13.3315 10.4877 13.0848 10.7602 12.7848 11.023C12.1283 11.6153 11.7135 12.0878 11.5405 12.4405C11.3673 12.793 11.2808 13.3243 11.2808 14.0345ZM12.0017 21.5C10.6877 21.5 9.45267 21.2507 8.2965 20.752C7.14033 20.2533 6.13467 19.5766 5.2795 18.7218C4.42433 17.8669 3.74725 16.8617 3.24825 15.706C2.74942 14.5503 2.5 13.3156 2.5 12.0017C2.5 10.6877 2.74933 9.45267 3.248 8.2965C3.74667 7.14033 4.42342 6.13467 5.27825 5.2795C6.13308 4.42433 7.13833 3.74725 8.294 3.24825C9.44967 2.74942 10.6844 2.5 11.9983 2.5C13.3123 2.5 14.5473 2.74933 15.7035 3.248C16.8597 3.74667 17.8653 4.42342 18.7205 5.27825C19.5757 6.13308 20.2528 7.13833 20.7518 8.294C21.2506 9.44967 21.5 10.6844 21.5 11.9983C21.5 13.3123 21.2507 14.5473 20.752 15.7035C20.2533 16.8597 19.5766 17.8653 18.7218 18.7205C17.8669 19.5757 16.8617 20.2528 15.706 20.7518C14.5503 21.2506 13.3156 21.5 12.0017 21.5Z" fill="#009AD0" />
                                            </g>
                                        </svg> Accordion Item #1
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#program_faq_accordion">
                                    <div class="accordion-body">
                                        <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It’s also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <mask id="mask0_40004214_39573" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                                                <rect width="24" height="24" fill="#D9D9D9" />
                                            </mask>
                                            <g mask="url(#mask0_40004214_39573)">
                                                <path d="M11.989 17.6152C12.2745 17.6152 12.5157 17.5168 12.7125 17.3198C12.9093 17.1226 13.0078 16.8812 13.0078 16.5955C13.0078 16.31 12.9092 16.0688 12.712 15.872C12.5148 15.6753 12.2735 15.577 11.988 15.577C11.7025 15.577 11.4613 15.6756 11.2645 15.8728C11.0677 16.0699 10.9692 16.3113 10.9692 16.5968C10.9692 16.8822 11.0678 17.1234 11.265 17.3203C11.4622 17.5169 11.7035 17.6152 11.989 17.6152ZM11.2808 14.0345H12.6885C12.7013 13.5423 12.7734 13.1491 12.9047 12.8548C13.0363 12.5606 13.3552 12.1706 13.8615 11.6848C14.3013 11.2449 14.6382 10.8388 14.872 10.4663C15.106 10.0939 15.223 9.65417 15.223 9.147C15.223 8.28617 14.9137 7.61375 14.2952 7.12975C13.6766 6.64592 12.9448 6.404 12.1 6.404C11.2653 6.404 10.5747 6.62675 10.028 7.07225C9.48117 7.51775 9.09108 8.04242 8.85775 8.64625L10.1423 9.1615C10.2641 8.8295 10.4724 8.50608 10.7673 8.19125C11.0621 7.87658 11.4999 7.71925 12.0808 7.71925C12.6718 7.71925 13.1086 7.88108 13.3913 8.20475C13.6741 8.52858 13.8155 8.88467 13.8155 9.273C13.8155 9.61283 13.7187 9.92375 13.525 10.2057C13.3315 10.4877 13.0848 10.7602 12.7848 11.023C12.1283 11.6153 11.7135 12.0878 11.5405 12.4405C11.3673 12.793 11.2808 13.3243 11.2808 14.0345ZM12.0017 21.5C10.6877 21.5 9.45267 21.2507 8.2965 20.752C7.14033 20.2533 6.13467 19.5766 5.2795 18.7218C4.42433 17.8669 3.74725 16.8617 3.24825 15.706C2.74942 14.5503 2.5 13.3156 2.5 12.0017C2.5 10.6877 2.74933 9.45267 3.248 8.2965C3.74667 7.14033 4.42342 6.13467 5.27825 5.2795C6.13308 4.42433 7.13833 3.74725 8.294 3.24825C9.44967 2.74942 10.6844 2.5 11.9983 2.5C13.3123 2.5 14.5473 2.74933 15.7035 3.248C16.8597 3.74667 17.8653 4.42342 18.7205 5.27825C19.5757 6.13308 20.2528 7.13833 20.7518 8.294C21.2506 9.44967 21.5 10.6844 21.5 11.9983C21.5 13.3123 21.2507 14.5473 20.752 15.7035C20.2533 16.8597 19.5766 17.8653 18.7218 18.7205C17.8669 19.5757 16.8617 20.2528 15.706 20.7518C14.5503 21.2506 13.3156 21.5 12.0017 21.5Z" fill="#009AD0" />
                                            </g>
                                        </svg> Accordion Item #2
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#program_faq_accordion">
                                    <div class="accordion-body">
                                        <strong>This is the second item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It’s also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <?php echo do_shortcode('[smartrec_program_categories program_id="119997" activities_page="fitness-activities" title="All Fitness Categories" class="pdop_program_category_wrapper"]'); ?>

                <?php echo do_shortcode('[smartrec_this_week_swiper program_id="119997" class="pdop_program_this_week_wrapper"]');
                ?>
            </div>

            <!-- Memberships & Costs Tab Content -->
            <div class="pdop_program_content_membership pdop_program_content_card">

                <!-- Ultimate Fitness Membership -->
                <div class="pdop_membership_section">
                    <div class="pdop_membership_table" role="table" aria-label="Ultimate Fitness Membership Pricing">

                        <div class="pdop_membership_title_main">
                            <div aria-hidden="true"></div>
                            <div class="pdop_membership_title_inner">
                                <!-- Title Row -->
                                <div class="pdop_membership_title_row" role="presentation">
                                    <div class="pdop_membership_header">
                                        <strong>Ultimate Fitness Membership -</strong>
                                        <span>(CRC plus Unlimited Drop-in Fitness Classes)</span>
                                    </div>
                                </div>

                                <!-- Column Group Headers -->
                                <div class="pdop_membership_group_row" role="row">
                                    <div class="pdop_membership_col_group_title pdop_membership_col_monthly" role="columnheader" aria-colspan="2">MONTHLY</div>
                                    <div class="pdop_membership_col_group_title pdop_membership_col_annual" role="columnheader" aria-colspan="2">ANNUAL</div>
                                </div>

                                <!-- Sub Headers (Ages) -->
                                <div class="pdop_membership_sub_row" role="row">
                                    <div class="pdop_membership_col_sub pdop_membership_col_monthly_sub" role="columnheader">Ages 19+</div>
                                    <div class="pdop_membership_col_sub pdop_membership_col_monthly_sub" role="columnheader">Ages 15-18</div>
                                    <div class="pdop_membership_col_sub pdop_membership_col_annual_sub" role="columnheader">Ages 19+</div>
                                    <div class="pdop_membership_col_sub pdop_membership_col_annual_sub" role="columnheader">Ages 15-18</div>
                                </div>
                            </div>
                        </div>


                        <!-- Resident Row -->
                        <div class="pdop_membership_row" role="row">
                            <div class="pdop_membership_row_label" role="rowheader">Resident</div>
                            <div class="pdop_membership_cell" role="cell">
                                <strong>$55/month</strong>
                                <span>($59 starting Dec 31 2025)</span>
                                <a href="#">Buy Now <svg xmlns="http://www.w3.org/2000/svg" width="7" height="11" viewBox="0 0 7 11" fill="none">
                                        <path d="M0.75 0.75L5.75 5.25L0.75 9.75" stroke="#009AD0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg></a>
                            </div>
                            <div class="pdop_membership_cell" role="cell">
                                <strong>$49.50/month</strong>
                                <span>$53.10 starting Dec 31 2025</span>
                                <a href="#">Buy Now &gt;</a>
                            </div>
                            <div class="pdop_membership_cell" role="cell">
                                <strong>$660/year</strong>
                                <span>($708/year starting 12/31/25)</span>
                                <a href="#">Buy Now &gt;</a>
                            </div>
                            <div class="pdop_membership_cell" role="cell">
                                <strong>$594/year</strong>
                                <span>($667.20 starting 12/31/25)</span>
                                <a href="#">Buy Now &gt;</a>
                            </div>
                        </div>

                        <!-- Non-Resident Row -->
                        <div class="pdop_membership_row" role="row">
                            <div class="pdop_membership_row_label" role="rowheader">Non-Resident</div>
                            <div class="pdop_membership_cell" role="cell">
                                <strong>$110/month</strong>
                                <span>($118 starting Dec 31 2025)</span>
                                <a href="#">Buy Now &gt;</a>
                            </div>
                            <div class="pdop_membership_cell" role="cell">
                                <strong>$99/month</strong>
                                <span>($106.20 starting Dec 31 2025)</span>
                                <a href="#">Buy Now &gt;</a>
                            </div>
                            <div class="pdop_membership_cell" role="cell">
                                <strong>$1,320/year</strong>
                                <span>($1416/year starting 12/31/25)</span>
                                <a href="#">Buy Now &gt;</a>
                            </div>
                            <div class="pdop_membership_cell" role="cell">
                                <strong>$1,188/year</strong>
                                <span>($1274.40 starting 12/31/25)</span>
                                <a href="#">Buy Now &gt;</a>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Punch Passes and Single Visits -->
                <div class="pdop_punch_section">
                    <h3>Punch Passes and Single Visits</h3>
                    <p>Lorem ipsum dolor sit amet consectetur. At vulputate imperdiet accumsan scelerisque. Parturient libero viverra suspendisse sed facilisi ornare eget malesuada. Bibendum varius tristique tortor viverra ultrices ipsum consequat diam. Pellentesque in nunc nec facilisi arcu viverra.</p>

                    <div class="pdop_punch_table" role="table" aria-label="Punch Passes and Single Visit Pricing">

                        <div class="pdop_punch_group_row_main">
                            <div aria-hidden="true"></div>
                            <div class="pdop_punch_group_row_inner">
                                <!-- Column Group Headers -->
                                <div class="pdop_punch_group_row" role="row">
                                    <div class="pdop_punch_col_single" role="columnheader">
                                        <div class="pdop_punch_col_title">Single class purchase</div>
                                        <div class="pdop_punch_col_subtitle">Try out one of our classes!</div>
                                    </div>
                                    <div class="pdop_punch_col_passes" role="columnheader" aria-colspan="2">
                                        <div class="pdop_punch_col_title">Punch Passes</div>
                                        <div class="pdop_punch_col_subtitle">If you're not quite ready for a full commitment, we've got you covered with our convenient punch passes. Enjoy the flexibility to attend classes at your pace.</div>
                                    </div>
                                </div>

                                <!-- Sub Headers -->
                                <div class="pdop_punch_sub_row" role="row">
                                    <div aria-hidden="true"></div>
                                    <div class="pdop_punch_col_sub_main">
                                        <div class="pdop_punch_col_sub pdop_punch_col_sub_first" role="columnheader">5 Visit Punch Pass</div>
                                        <div class="pdop_punch_col_sub pdop_punch_col_sub_last" role="columnheader">10 Visit Punch Pass</div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <!-- Resident Row -->
                        <div class="pdop_punch_row" role="row">
                            <div class="pdop_punch_row_label" role="rowheader">Resident</div>
                            <div class="pdop_punch_cell_inner pdop_punch_cell_inner_first">
                                <div class="pdop_punch_cell pdop_punch_cell_single" role="cell">$16</div>
                            </div>
                            <div class="pdop_punch_cell_inner pdop_punch_cell_inner_first pdop_punch_cell_two_col">
                                <div class="pdop_punch_cell" role="cell">$60</div>
                                <div class="pdop_punch_cell" role="cell">$99</div>
                            </div>
                        </div>

                        <!-- Non-Resident Row -->
                        <div class="pdop_punch_row" role="row">
                            <div class="pdop_punch_row_label" role="rowheader">Non-Resident</div>
                            <div class="pdop_punch_cell_inner pdop_punch_cell_inner_last">
                                <div class="pdop_punch_cell pdop_punch_cell_single" role="cell">$21</div>
                            </div>
                            <div class="pdop_punch_cell_inner pdop_punch_cell_inner_last pdop_punch_cell_two_col">
                                <div class="pdop_punch_cell" role="cell">$77</div>
                                <div class="pdop_punch_cell" role="cell">$119</div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="pdop_program_content_card">
                <div class="pdop_class_location_main">
                    <h2>Class Locations</h2>
                    <div class="pdop_class_location_card_main">
                        <div class="pdop_class_location_card">
                            <img src="https://pdopdev.wpenginepowered.com/wp-content/uploads/2026/04/class_loc.png" alt="">
                            <div class="pdop_class_content">
                                <h6>Fitness Center at CRC</h6>
                                <p>Meet all your health and fitness goals in our 4,500 square foot fitness center with a wide variety of options to meet your cardio and strength-training needs.</p>
                                <a href="#">View Details
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                        <mask id="mask0_4342_57063" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="18" height="18">
                                            <rect width="18" height="18" transform="matrix(-1 0 0 1 18 0)" fill="#D9D9D9" />
                                        </mask>
                                        <g mask="url(#mask0_4342_57063)">
                                            <path d="M11.112 9.00215L5.46244 14.6517C5.31344 14.8007 5.24081 14.9761 5.24456 15.178C5.24844 15.38 5.32487 15.5555 5.47387 15.7045C5.623 15.8535 5.7985 15.928 6.00037 15.928C6.20225 15.928 6.37775 15.8535 6.52687 15.7045L12.2801 9.96271C12.4157 9.82708 12.5162 9.67515 12.5816 9.5069C12.647 9.33865 12.6797 9.1704 12.6797 9.00215C12.6797 8.8339 12.647 8.66565 12.5816 8.4974C12.5162 8.32915 12.4157 8.17721 12.2801 8.04158L6.52687 2.28815C6.37775 2.13915 6.20031 2.06658 5.99456 2.07046C5.78881 2.07433 5.61144 2.15077 5.46244 2.29977C5.31344 2.44877 5.23894 2.62427 5.23894 2.82627C5.23894 3.02815 5.31344 3.20359 5.46244 3.35258L11.112 9.00215Z" fill="#2B3C73" />
                                        </g>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="pdop_class_location_card">
                            <img src="https://pdopdev.wpenginepowered.com/wp-content/uploads/2026/04/class_loc.png" alt="">
                            <div class="pdop_class_content">
                                <h6>Fitness Center at CRC</h6>
                                <p>Meet all your health and fitness goals in our 4,500 square foot fitness center with a wide variety of options to meet your cardio and strength-training needs.</p>
                                <a href="#">View Details
                                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none">
                                        <path d="M5.87274 6.93183L0.223179 12.5814C0.0741787 12.7304 0.00155401 12.9058 0.00530434 13.1077C0.00917912 13.3097 0.0856156 13.4852 0.234616 13.6342C0.383741 13.7832 0.559241 13.8577 0.761116 13.8577C0.962991 13.8577 1.13849 13.7832 1.28762 13.6342L7.04087 7.8924C7.17649 7.75677 7.27699 7.60483 7.34237 7.43658C7.40774 7.26833 7.44043 7.10008 7.44043 6.93183C7.44043 6.76358 7.40774 6.59533 7.34237 6.42708C7.27699 6.25883 7.17649 6.1069 7.04087 5.97127L1.28762 0.217835C1.13849 0.0688345 0.961054 -0.00372767 0.755304 0.000147333C0.549554 0.00402233 0.372179 0.0804595 0.223179 0.229459C0.0741787 0.378459 -0.000320435 0.55396 -0.000320435 0.75596C-0.000320435 0.957835 0.0741787 1.13327 0.223179 1.28227L5.87274 6.93183Z" fill="#2B3C73" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pdop_program_content_card">
                <div class="pdop_meet_instructor_main">
                    <div class="pdop_meet_instructor_header d-flex gap-4 justify-content-between">
                        <h2 id="instructor-section-title">Meet Our Fitness Instructors!</h2>
                        <div class="search_instructor_wrapper d-flex align-items-center position-relative">
                            <label for="search_instructor" class="visually-hidden">
                                Search Instructor by Name
                            </label>
                            <input id="search_instructor" type="text" placeholder="Search Instructor by Name" aria-label="Search Instructor by Name">
                        </div>
                    </div>
                    <div class="pdop_meet_instructor" aria-labelledby="instructor-section-title">
                        <?php
                        for ($i = 0; $i < 8; $i++) {
                        ?>
                            <article class="pdop_meet_instructor_card">
                                <div class="pdop_meet_instructor_card_img">
                                    <!-- <img src="" alt=""> -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="246" height="120" viewBox="0 0 246 120" fill="none" aria-hidden="true">
                                        <rect width="246" height="120" rx="10" fill="#D9D9D9" />
                                        <line x1="8.80182" y1="109.541" x2="235.802" y2="11.5409" stroke="white" />
                                        <line y1="-0.5" x2="247.251" y2="-0.5" transform="matrix(-0.918096 -0.396359 -0.396359 0.918096 236 110)" stroke="white" />
                                    </svg>
                                </div>

                                <div class="pdop_meet_instructor_card_content">
                                    <h6>Frances Akwuole</h6>
                                    <div class="pdop_meet_instructor_card_tags">
                                        <span>Classes:</span>
                                        <div class="pdop_meet_instructor_card_tag_items d-flex flex-wrap gap-2">
                                            <span>Strength Conditioning</span>
                                            <span>HIIT</span>
                                        </div>
                                    </div>
                                    <div id="instructor-desc-<?php echo $i; ?>" class="pdop_meet_instructor_description">
                                        <p>
                                            Frances has always had a passion for physical activity, from playing sports like volleyball and boxing to dancing and taking fitness classes. She began teaching while in college and quickly developed a love for inspiring others to not only stay consistent with their workouts but to truly enjoy the process. Frances particularly enjoys teaching HIIT because it allows participants to work at their own pace while fostering a strong sense of camaraderie and community. She creates an energetic and inclusive atmosphere with a diverse music playlist that appeals to all tastes. Frances' classes are fun, challenging, and designed to leave you feeling empowered and unstoppable every time.
                                        </p>
                                    </div>

                                    <button class="pdop_meet_instructor_read_more" type="button"
                                        aria-expanded="false"
                                        aria-controls="instructor-desc-<?php echo $i; ?>">
                                        <span class="button-text">Read More</span> <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true">
                                            <mask id="mask0_40003834_3533" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="18" height="18">
                                                <rect width="18" height="18" transform="matrix(-1 0 0 1 18 0)" fill="#D9D9D9" />
                                            </mask>
                                            <g mask="url(#mask0_40003834_3533)">
                                                <path d="M11.112 9.00215L5.46244 14.6517C5.31344 14.8007 5.24081 14.9761 5.24456 15.178C5.24844 15.38 5.32487 15.5555 5.47387 15.7045C5.623 15.8535 5.7985 15.928 6.00037 15.928C6.20225 15.928 6.37775 15.8535 6.52687 15.7045L12.2801 9.96271C12.4157 9.82708 12.5162 9.67515 12.5816 9.5069C12.647 9.33865 12.6797 9.1704 12.6797 9.00215C12.6797 8.8339 12.647 8.66565 12.5816 8.4974C12.5162 8.32915 12.4157 8.17721 12.2801 8.04158L6.52687 2.28815C6.37775 2.13915 6.20031 2.06658 5.99456 2.07046C5.78881 2.07433 5.61144 2.15077 5.46244 2.29977C5.31344 2.44877 5.23894 2.62427 5.23894 2.82627C5.23894 3.02815 5.31344 3.20359 5.46244 3.35258L11.112 9.00215Z" fill="#2B3C73" />
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                            </article>
                        <?php
                        }
                        ?>

                    </div>
                    <div class="text-center mt-4">
                        <button type="button" class="show_all_instructors" aria-label="Show all instructors">
                            <span>Show all 16</span>
                            <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true">
                                <path d="M6 8H0V6H6V0H8V6H14V8H8V14H6V8Z" fill="#2B3C73" />
                            </svg>
                        </button>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

<?php get_template_part('template-parts/program/program-detail-modal'); ?>

<?php
get_footer();
