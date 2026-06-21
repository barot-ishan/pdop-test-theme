// Programs

jQuery(document).ready(function ($) {
  $(".pdop_meet_instructor_read_more").on("click", function () {
    let $button = $(this);
    let $paragraph = $("#" + $button.attr("aria-controls"));
    let $text = $button.find(".button-text");
    let $card = $button.closest(".pdop_meet_instructor_card");

    $paragraph.toggleClass("expanded");

    let isExpanded = $paragraph.hasClass("expanded");

    $button.attr("aria-expanded", isExpanded);

    if (isExpanded) {
      $text.text("Read Less");
    } else {
      $text.text("Read More");
      // Scroll back to the card when collapsing
      $("html, body").animate(
        {
          scrollTop: $card.offset().top - 300,
        },
        300,
      );
    }
  });

  $(".accordion-collapse").on("show.bs.collapse", function () {
    $(this).closest(".accordion-item").addClass("active");
  });

  $(".accordion-collapse").on("hidden.bs.collapse", function () {
    $(this).closest(".accordion-item").removeClass("active");
  });

  const $cards = $(".pdop_meet_instructor_card");
  const $searchInput = $("#search_instructor");
  const initialVisible = 2;

  function updateInstructorDisplay() {
    const searchValue = $searchInput.val().toLowerCase().trim();
    let visibleCount = 0;

    $cards.each(function () {
      const $card = $(this);
      const instructorName = $card.find("h6").text().toLowerCase();

      if (instructorName.includes(searchValue)) {
        $card.show();

        if (searchValue === "" && visibleCount >= initialVisible) {
          $card.hide();
        }

        visibleCount++;
      } else {
        $card.hide();
      }
    });

    // show/hide button
    if (
      searchValue === "" &&
      $(".pdop_meet_instructor_card:visible").length < $cards.length
    ) {
      $(".show_all_instructors").show();
    } else {
      $(".show_all_instructors").hide();
    }
  }

  // append button below cards if not exists
  if (!$(".show_all_instructors").length) {
    $(".pdop_meet_instructor").after(`
            <div class="text-center mt-4">
                <button type="button" class="show_all_instructors">
                    Show All 16+ Instructors
                </button>
            </div>
        `);
  }

  // initial load
  updateInstructorDisplay();

  // search filter
  $searchInput.on("keyup", function () {
    updateInstructorDisplay();
  });

  // show all button click
  $(document).on("click", ".show_all_instructors", function () {
    $cards.show();
    $(this).hide();
  });
});


document.addEventListener('click', function(e){
    const link = e.target.closest('.srec_tw_link_details');
    if(!link) return;
    const href = link.getAttribute('href');
    if(!href || !href.startsWith('#')) return;
    history.replaceState(null, null, href);
});


document.addEventListener('DOMContentLoaded', function(){

    // update hash on trigger click
    document.querySelectorAll('.srec_tw_link_details').forEach(function(link){

        link.addEventListener('click', function(){

            const href = this.getAttribute('href');

            if(!href || !href.startsWith('#')) return;

            history.replaceState(null, null, href);

        });

    });

    // open modal from hash on initial page load
    if(window.location.hash){

        const modalEl = document.querySelector(window.location.hash);

        if(modalEl && modalEl.classList.contains('pdop_program_modal')){

            // use bootstrap api
            const modal = new bootstrap.Modal(modalEl);

            modal.show();

        }

    }

    // remove hash when modal closes
    document.querySelectorAll('.pdop_program_modal').forEach(function(modal){

        modal.addEventListener('hidden.bs.modal', function(){

            history.replaceState(
                null,
                null,
                window.location.pathname + window.location.search
            );

        });

    });

});