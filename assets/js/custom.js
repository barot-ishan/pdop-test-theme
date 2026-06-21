(function () {
  // ── Shared state ─────────────────────────────────────────────────────────
  var currentIndex = 0;

  function getAllTabs() {
    return Array.from(document.querySelectorAll('#pdt-sidebar [role="tab"]'));
  }

  function getAllPanes() {
    return Array.from(
      document.querySelectorAll('.pdt-panel [role="tabpanel"]'),
    );
  }

  // ── Core switch (activates by tab ID) ────────────────────────────────────
  window.pdtSwitch = function (targetId, triggerBtn) {
    var allBtns = getAllTabs();
    var allPanes = getAllPanes();
    var total = allPanes.length;

    // Deactivate everything
    allBtns.forEach(function (btn) {
      btn.classList.remove("pdt-active");
      btn.setAttribute("aria-selected", "false");
      btn.setAttribute("tabindex", "-1");
    });
    allPanes.forEach(function (pane) {
      pane.classList.remove("pdt-active");
      pane.hidden = true;
    });

    // Activate chosen tab button
    if (triggerBtn) {
      triggerBtn.classList.add("pdt-active");
      triggerBtn.setAttribute("aria-selected", "true");
      triggerBtn.setAttribute("tabindex", "0");
      currentIndex =
        parseInt(triggerBtn.getAttribute("data-pdt-index"), 10) || 0;
    }

    // Activate chosen panel
    var targetPane = document.getElementById(targetId);
    if (targetPane) {
      targetPane.classList.add("pdt-active");
      targetPane.hidden = false;
      currentIndex =
        parseInt(targetPane.getAttribute("data-pdt-index"), 10) || currentIndex;
    }

    // Sync mobile UI
    // syncMobileUI(total);
  };
})();


const yearSwiper = new Swiper('.pdt-mobile-year-swiper', {
    effect: 'slide',
    speed: 600,
    allowTouchMove: false,
});

const contentSwiper = new Swiper('.pdt-mobile-content-swiper', {
    effect: 'fade',
    fadeEffect: {
        crossFade: true,
    },
    autoHeight: true,
    speed: 600,
    allowTouchMove: false,

    navigation: {
        nextEl: '.pdt-next',
        prevEl: '.pdt-prev',
    },
});

yearSwiper.controller.control = contentSwiper;
contentSwiper.controller.control = yearSwiper;