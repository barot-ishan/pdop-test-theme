document.addEventListener("DOMContentLoaded", function () {
  // Handle toggle click (close others)
  document.querySelectorAll(".pdop_upcoming_events_card_cal").forEach((btn) => {
    btn.addEventListener("click", function () {
      const targetSelector = this.getAttribute("data-bs-target");

      document.querySelectorAll(".pdop_event_dropdown.show").forEach((el) => {
        if ("#" + el.id !== targetSelector) {
          let instance = bootstrap.Collapse.getInstance(el);

          if (!instance) {
            instance = new bootstrap.Collapse(el, {
              toggle: false,
            });
          }

          instance.hide();
        }
      });
    });
  });

  // Handle outside click (close all)
  document.addEventListener("click", function (e) {
    const isInside =
      e.target.closest(".pdop_upcoming_events_card_cal") ||
      e.target.closest(".pdop_event_dropdown");

    if (!isInside) {
      document.querySelectorAll(".pdop_event_dropdown.show").forEach((el) => {
        let instance = bootstrap.Collapse.getInstance(el);

        if (!instance) {
          instance = new bootstrap.Collapse(el, {
            toggle: false,
          });
        }

        instance.hide();
      });
    }
  });
});


document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.js-award-filter-year, .js-award-filter-category').forEach((select) => {

        select.setAttribute('aria-expanded', 'false');

        select.addEventListener('mousedown', function () {

            const isExpanded = this.getAttribute('aria-expanded') === 'true';

            this.setAttribute('aria-expanded', isExpanded ? 'false' : 'true');

        });

        select.addEventListener('blur', function () {

            this.setAttribute('aria-expanded', 'false');

        });

        select.addEventListener('change', function () {

            this.setAttribute('aria-expanded', 'false');

        });

    });

});