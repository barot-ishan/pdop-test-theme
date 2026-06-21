const toggler = document.querySelector(".navbar-toggler");
const drawer = document.getElementById("mobileDrawer");

drawer.addEventListener("shown.bs.offcanvas", function () {
  toggler.setAttribute("aria-expanded", "true");
});

drawer.addEventListener("hidden.bs.offcanvas", function () {
  toggler.setAttribute("aria-expanded", "false");
});

// Add 'is-scrolled' class to header on scroll + swap logo accessibility
(function () {
  const header = document.querySelector(".site-header");
  if (!header) return;

  const primaryLogo = header.querySelector(".custom-logo-link");
  const scrolledLogo = header.querySelector(".pdop_scrolled_logo");

  let ticking = false;
  let wasScrolled = false;

  function updateLogos(isScrolled) {
    if (isScrolled === wasScrolled) return;
    wasScrolled = isScrolled;

    header.classList.toggle("is-scrolled", isScrolled);

    // Swap logo accessibility: only visible logo is focusable/announced
    if (primaryLogo) {
      primaryLogo.setAttribute("aria-hidden", isScrolled ? "true" : "false");
      primaryLogo.setAttribute("tabindex", isScrolled ? "-1" : "0");
    }
    if (scrolledLogo) {
      scrolledLogo.setAttribute("aria-hidden", isScrolled ? "false" : "true");
      scrolledLogo.setAttribute("tabindex", isScrolled ? "0" : "-1");
    }
  }

  window.addEventListener("scroll", function () {
    if (!ticking) {
      window.requestAnimationFrame(function () {
        updateLogos(window.scrollY > 50);
        ticking = false;
      });
      ticking = true;
    }
  });
})();
