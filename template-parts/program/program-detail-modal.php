<?php

if (!defined('ABSPATH')) {
    exit;
}
?>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#programDetailModal">
    Launch demo modal
</button>

<div class="modal fade pdop_program_detail_modal pdop_program_modal" id="programDetailModal" tabindex="-1" aria-labelledby="programDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div class="modal-header border-0 pb-0" style="padding: 30px 40px;">
                <h3 class="modal-title text-uppercase fw-bold m-0" id="programDetailModalLabel" style="font-size: 24px;">PROGRAM DETAIL</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 20px 40px 40px;">

                <div class="row g-4 mb-4">
                    <!-- Left: Main Image -->
                    <div class="col-lg-4">
                        <img src="https://pdopdev.wpenginepowered.com/wp-content/uploads/2026/04/class_loc.png" alt="Express BODYPUMP" class="img-fluid w-100" style="border-radius: 20px; object-fit: cover; aspect-ratio: 4/3;">
                    </div>

                    <!-- Right: Title, Share, Reg, Desc -->
                    <div class="col-lg-8">
                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-3 gap-3">
                            <h4 class="fw-bold m-0" style="font-size: 22px;">Express BODYPUMP (Monday)</h4>

                            <div class="d-flex align-items-center gap-3">
                                <span class="fw-bold" style="font-size: 14px;">Share</span>
                                <div class="d-flex align-items-center gap-2">
                                    <a href="#" aria-label="Share on X" class="text-dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                                            <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865l8.875 11.633Z" />
                                        </svg>
                                    </a>
                                    <a href="#" aria-label="Share on LinkedIn" class="text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#0A66C2" class="bi bi-linkedin" viewBox="0 0 16 16">
                                            <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
                                        </svg>
                                    </a>
                                    <a href="#" aria-label="Share on Facebook" class="text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#1877F2" class="bi bi-facebook" viewBox="0 0 16 16">
                                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                        </svg>
                                    </a>
                                    <a href="#" aria-label="Share on Instagram" class="text-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#E4405F" class="bi bi-instagram" viewBox="0 0 16 16">
                                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.036 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                                        </svg>
                                    </a>
                                    <a href="#" aria-label="Share via Email" class="text-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                        </svg>
                                    </a>
                                    <a href="#" aria-label="Copy Link" class="text-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
                                            <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z" />
                                            <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <a href="#" class="btn btn-outline-primary rounded-pill d-inline-flex align-items-center gap-2 mb-4 px-3 py-1 fw-bold" style="border: 1px solid #2B3C73; color: #2B3C73; background: transparent;">
                            Register Now
                            <span class="rounded-circle d-flex align-items-center justify-content-center" style="width: 24px; height: 24px; background-color: #c4d600; color: #2B3C73;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                </svg>
                            </span>
                        </a>

                        <div class="pdop_program_detail_section_title rounded-2 px-3 py-2 mb-3" style="background-color: #e2f8ff; color: #0079a4; font-weight: 700; font-size: 12px; text-transform: uppercase;">
                            DESCRIPTION
                        </div>
                        <p style="font-size: 14px; line-height: 1.6; color: #333;">LesMills BODYPUMP (TM) is the original barbell class that strengthens your entire body. This 45-minute workout challenges all your major muscle groups by using the best weight room exercises, like squats, presses, lifts, and curls.</p>
                    </div>
                </div>

                <!-- Info and Contact Row -->
                <div class="row g-4 mb-4">
                    <!-- Left: Information Grid -->
                    <div class="col-lg-8">
                        <div class="pdop_program_detail_section_title rounded-2 px-3 py-2 mb-4" style="background-color: #e2f8ff; color: #0079a4; font-weight: 700; font-size: 12px; text-transform: uppercase;">
                            INFORMATION
                        </div>

                        <div class="row g-4" style="font-size: 14px;">
                            <div class="col-md-6 d-flex gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#009AD0" class="bi bi-calendar-event mt-1 flex-shrink-0" viewBox="0 0 16 16">
                                    <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                </svg>
                                <div>
                                    <div style="color: #6c757d; font-size: 12px; margin-bottom: 2px;">Start date:</div>
                                    <div class="fw-medium text-dark">Monday, January 5, 2026</div>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#009AD0" class="bi bi-clock mt-1 flex-shrink-0" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                                </svg>
                                <div>
                                    <div style="color: #6c757d; font-size: 12px; margin-bottom: 2px;">Schedule:</div>
                                    <div class="fw-medium text-dark">Mondays, 6:00 AM - 6:45 AM</div>
                                </div>
                            </div>
                            <div class="col-12 m-0">
                                <hr class="m-0" style="border-color: #e9ecef; opacity: 1;">
                            </div>

                            <div class="col-md-6 d-flex gap-3 mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#009AD0" class="bi bi-calendar2-range mt-1 flex-shrink-0" viewBox="0 0 16 16">
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z" />
                                    <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4zM9 8a1 1 0 0 1 1-1h5v2h-5a1 1 0 0 1-1-1zm-8 2h4a1 1 0 1 1 0 2H1v-2z" />
                                </svg>
                                <div>
                                    <div style="color: #6c757d; font-size: 12px; margin-bottom: 2px;">Duration:</div>
                                    <div class="fw-medium text-dark">From January 5, 2026 until December 28, 2026</div>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex gap-3 mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#009AD0" class="bi bi-person-badge mt-1 flex-shrink-0" viewBox="0 0 16 16">
                                    <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492V2.5z" />
                                </svg>
                                <div>
                                    <div style="color: #6c757d; font-size: 12px; margin-bottom: 2px;">Required Age:</div>
                                    <div class="fw-medium text-dark">15 - 99 years old on the day of the activity</div>
                                </div>
                            </div>
                            <div class="col-12 m-0">
                                <hr class="m-0" style="border-color: #e9ecef; opacity: 1;">
                            </div>

                            <div class="col-md-6 d-flex gap-3 mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#009AD0" class="bi bi-building mt-1 flex-shrink-0" viewBox="0 0 16 16">
                                    <path d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z" />
                                    <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V1zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3V1z" />
                                </svg>
                                <div>
                                    <div style="color: #6c757d; font-size: 12px; margin-bottom: 2px;">Facility:</div>
                                    <div class="fw-medium text-dark">RCRC Multipurpose Room (Large)</div>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex gap-3 mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#009AD0" class="bi bi-geo-alt mt-1 flex-shrink-0" viewBox="0 0 16 16">
                                    <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                </svg>
                                <div>
                                    <div style="color: #6c757d; font-size: 12px; margin-bottom: 2px;">Location:</div>
                                    <div class="fw-medium text-dark">RCRC Multipurpose Room (Large) (RCRC) | 415 Lake Street, Oak Park, IL, 60302</div>
                                </div>
                            </div>
                            <div class="col-12 m-0">
                                <hr class="m-0" style="border-color: #e9ecef; opacity: 1;">
                            </div>

                            <div class="col-md-6 d-flex gap-3 mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#009AD0" class="bi bi-person mt-1 flex-shrink-0" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                </svg>
                                <div>
                                    <div style="color: #6c757d; font-size: 12px; margin-bottom: 2px;">Instructor:</div>
                                    <div class="fw-medium text-dark">Nathalie Deutsch</div>
                                </div>
                            </div>
                            <div class="col-12 m-0">
                                <hr class="m-0" style="border-color: #e9ecef; opacity: 1;">
                            </div>

                            <div class="col-12 d-flex gap-3 mt-4 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#009AD0" class="bi bi-info-circle mt-1 flex-shrink-0" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg>
                                <div>
                                    <div style="color: #6c757d; font-size: 12px; margin-bottom: 2px;">Notes</div>
                                    <div class="fw-medium text-dark">All participants are required to check in with their Digital Access Card on the Amilia APP- photo must be uploaded to, OR with photo ID and sign the waiver every time they enter RCRC.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Point of Contact Card -->
                    <div class="col-lg-4">
                        <div class="rounded-4 p-4 text-center h-100 d-flex flex-column align-items-center" style="background-color: #c4d600;">
                            <img src="/wp-content/uploads/2026/04/erin.png" onerror="this.src='/wp-content/uploads/2026/04/default_event.png'" alt="Erin Coffman" class="rounded-circle mb-3 shadow-sm" style="width: 110px; height: 110px; object-fit: cover;">

                            <div style="font-size: 13px; font-weight: 500; color: #2B3C73;">Point of Contact</div>
                            <h4 class="fw-bold mb-4" style="color: #2B3C73; font-size: 22px;">Erin Coffman</h4>

                            <div class="w-100">
                                <div class="d-flex align-items-start gap-3 mb-3 text-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#2B3C73" class="bi bi-person-fill flex-shrink-0 mt-1" viewBox="0 0 16 16">
                                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                    </svg>
                                    <span style="font-size: 14px; font-weight: 500; color: #2B3C73;">Fitness & Performing Arts Supervisor</span>
                                </div>
                                <div class="d-flex align-items-center gap-3 mb-3 text-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#2B3C73" class="bi bi-telephone-fill flex-shrink-0" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                    </svg>
                                    <span style="font-size: 14px; font-weight: 500; color: #2B3C73;">(708) 725-2074</span>
                                </div>
                                <div class="d-flex align-items-center gap-3 mb-4 text-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#2B3C73" class="bi bi-envelope-fill flex-shrink-0" viewBox="0 0 16 16">
                                        <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z" />
                                    </svg>
                                    <span style="font-size: 14px; font-weight: 500; color: #2B3C73;">Erin.Coffman@pdop.org</span>
                                </div>
                            </div>

                            <a href="mailto:Erin.Coffman@pdop.org" class="btn rounded-pill mt-auto d-inline-flex align-items-center gap-2 px-4 py-2" style="background-color: #2B3C73; color: white; border: none; font-weight: 600;">
                                Contact
                                <span class="rounded-circle d-flex align-items-center justify-content-center" style="width: 24px; height: 24px; background-color: #009AD0; color: white;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Bottom: Important Notes -->
                <div class="rounded-3 p-4" style="background-color: #fdf5e6; border: 1px solid #f6d197;">
                    <h5 class="fw-bold mb-4" style="color: #926b42; font-size: 18px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-medical mb-1 me-2" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z" />
                            <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v.634l.549-.317a.5.5 0 1 1 .5.866L9 6l.549.317a.5.5 0 1 1-.5.866L8.5 6.866V7.5a.5.5 0 0 1-1 0v-.634l-.549.317a.5.5 0 1 1-.5-.866L7 6l-.549-.317a.5.5 0 0 1 .5-.866l.549.317V4.5A.5.5 0 0 1 8 4zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                        </svg>
                        Important Notes
                    </h5>
                    <div class="row g-4 text-dark" style="font-size: 13px;">
                        <div class="col-md-6">
                            <div class="fw-bold mb-2" style="color: #926b42; font-size: 14px;">Please note that there is no class on the following date(s):</div>
                            <ul class="mb-0 ps-3">
                                <li style="margin-bottom: 4px;">Monday, May 25, 2026 from 6:00 AM to 6:45 AM</li>
                                <li>Monday, September 07, 2026 from 6:00 AM to 6:45 AM</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <div class="fw-bold mb-2" style="color: #926b42; font-size: 14px;">Other Exceptions:</div>
                            <div class="mb-1">Monday, January 05, 2026 from 6:00 AM to 6:45 AM:</div>
                            <ul class="mb-3 ps-3">
                                <li>The staff will be Kathleen Braun instead of Nathalie Deutsch</li>
                            </ul>
                            <div class="mb-1">Monday, March 02, 2026 from 6:00 AM to 6:45 AM:</div>
                            <ul class="mb-0 ps-3">
                                <li>The staff will be Kathleen Braun instead of Nathalie Deutsch</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>