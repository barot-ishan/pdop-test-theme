/**
 * Hero Banner Slider Controller
 *
 * Vanilla JS — zero dependencies.
 * Handles: crossfade slide transitions, quick-link card navigation,
 * autoplay with pause on hover/focus, keyboard navigation,
 * video play/pause per slide, and accessibility updates.
 *
 * @package PDOP
 */

(function () {
  "use strict";

  const AUTOPLAY_INTERVAL = 6000; // ms
  const TRANSITION_DURATION = 600; // ms — matches CSS transition

  // Respect prefers-reduced-motion
  const prefersReducedMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)",
  ).matches;

  const slider = document.querySelector("[data-hero-slider]");
  if (!slider) return;

  const liveRegion = slider.querySelector("[data-slides-live]");
  const slides = slider.querySelectorAll(".pdop_hero_slide");
  const navButtons = slider.querySelectorAll(
    ".pdop_quick_link_card[data-slide-target]",
  );

  if (slides.length <= 1) return; // No slider needed for single slide

  let currentIndex = 0;
  let autoplayTimer = null;
  let isTransitioning = false;
  let isUserInteracting = false;

  /**
   * Go to a specific slide index.
   */
  function goToSlide(targetIndex) {
    if (isTransitioning || targetIndex === currentIndex) return;
    if (targetIndex < 0 || targetIndex >= slides.length) return;

    isTransitioning = true;

    const currentSlide = slides[currentIndex];
    const nextSlide = slides[targetIndex];

    // Deactivate current slide
    currentSlide.classList.remove("is-active");
    currentSlide.setAttribute("aria-hidden", "true");
    setInert(currentSlide, true);
    pauseVideo(currentSlide);

    // Activate next slide
    nextSlide.classList.add("is-active");
    nextSlide.setAttribute("aria-hidden", "false");
    setInert(nextSlide, false);
    playVideo(nextSlide);

    // Update quick-link nav
    navButtons.forEach(function (btn) {
      var isTarget =
        parseInt(btn.getAttribute("data-slide-target"), 10) === targetIndex;
      btn.classList.toggle("is-active", isTarget);
      btn.setAttribute("aria-selected", isTarget ? "true" : "false");
    });

    currentIndex = targetIndex;

    // Release transition lock
    setTimeout(function () {
      isTransitioning = false;
    }, TRANSITION_DURATION);
  }


/* ---------------------------------------------------------------
 * Touch / Swipe Support
 * ------------------------------------------------------------- */
  var touchStartX = 0;
  var touchStartY = 0;
  var isDragging = false;

  slider.addEventListener("touchstart", function (e) {
    touchStartX = e.touches[0].clientX;
    touchStartY = e.touches[0].clientY;
    isDragging = true;
  }, { passive: true });

  slider.addEventListener("touchmove", function (e) {
    if (!isDragging) return;

    var deltaX = e.touches[0].clientX - touchStartX;
    var deltaY = e.touches[0].clientY - touchStartY;

    // Only prevent scroll if horizontal swipe is dominant
    if (Math.abs(deltaX) > Math.abs(deltaY)) {
      e.preventDefault();
    }
  }, { passive: false });

  slider.addEventListener("touchend", function (e) {
    if (!isDragging) return;
    isDragging = false;

    var deltaX = e.changedTouches[0].clientX - touchStartX;
    var deltaY = e.changedTouches[0].clientY - touchStartY;

    var MIN_SWIPE_DISTANCE = 50; // px — ignore accidental micro-swipes

    // Only fire if horizontal movement is dominant (not a scroll gesture)
    if (Math.abs(deltaX) < MIN_SWIPE_DISTANCE || Math.abs(deltaX) < Math.abs(deltaY)) return;

    onUserInteraction();
    stopAutoplay();

    if (deltaX < 0) {
      nextSlide(); // swiped left → next
    } else {
      prevSlide(); // swiped right → prev
    }
  }, { passive: true });

  /**
   * Set inert on hidden slides — prevents Tab from reaching
   * links/buttons inside invisible slides.
   */
  function setInert(slide, inert) {
    if (inert) {
      slide.setAttribute("inert", "");
    } else {
      slide.removeAttribute("inert");
    }
  }

  /**
   * Advance to the next slide (wraps around).
   */
  function nextSlide() {
    goToSlide((currentIndex + 1) % slides.length);
  }

  /**
   * Go to the previous slide (wraps around).
   */
  function prevSlide() {
    goToSlide((currentIndex - 1 + slides.length) % slides.length);
  }

  /* ---------------------------------------------------------------
   * Video Management
   * ------------------------------------------------------------- */
  function playVideo(slide) {
    var video = slide.querySelector(".pdop_hero_video");
    if (video) {
      video.play().catch(function () {
        // Autoplay blocked — image poster serves as fallback
      });
    }
  }

  function pauseVideo(slide) {
    var video = slide.querySelector(".pdop_hero_video");
    if (video) {
      video.pause();
    }
  }

  /* ---------------------------------------------------------------
   * Autoplay
   * ------------------------------------------------------------- */
  function startAutoplay() {
    if (prefersReducedMotion) return;
    stopAutoplay();
    autoplayTimer = setInterval(nextSlide, AUTOPLAY_INTERVAL);

    // During autoplay, suppress live announcements
    if (liveRegion && !isUserInteracting) {
      liveRegion.setAttribute("aria-live", "off");
    }
  }

  function stopAutoplay() {
    if (autoplayTimer) {
      clearInterval(autoplayTimer);
      autoplayTimer = null;
    }
  }

  /**
   * Switch to "user is interacting" mode — enable live announcements.
   */
  function onUserInteraction() {
    isUserInteracting = true;
    if (liveRegion) {
      liveRegion.setAttribute("aria-live", "polite");
    }
  }

  /* ---------------------------------------------------------------
   * Event Listeners
   * ------------------------------------------------------------- */

  // Quick-link card clicks
  navButtons.forEach(function (btn) {
    btn.addEventListener("click", function () {
      onUserInteraction();
      var target = parseInt(this.getAttribute("data-slide-target"), 10);
      goToSlide(target);
      stopAutoplay();
      // startAutoplay(); // Reset autoplay timer after manual interaction
    });
  });

  // Pause autoplay on hover/focus within slider
  slider.addEventListener("mouseenter", function () {
    onUserInteraction();
    stopAutoplay();
  });
  slider.addEventListener("focusin", function () {
    onUserInteraction();
    stopAutoplay();
  });
  slider.addEventListener("mouseleave", function () {
    isUserInteracting = false;
    // startAutoplay();
  });
  slider.addEventListener("focusout", function (e) {
    // Only restart if focus leaves the slider entirely
    if (!slider.contains(e.relatedTarget)) {
      isUserInteracting = false;
      // startAutoplay();
    }
  });

  // Keyboard navigation — proper tablist pattern (arrow keys move between tabs)
  slider.addEventListener("keydown", function (e) {
    var isNav =
      e.target.closest(".pdop_quick_links") ||
      e.target.classList.contains("pdop_quick_link_card");

    if (!isNav) return; // Only handle keys when nav buttons are focused

    if (e.key === "ArrowRight" || e.key === "ArrowDown") {
      e.preventDefault();
      onUserInteraction();
      nextSlide();
      stopAutoplay();
      // startAutoplay();
      var activeBtn = slider.querySelector(".pdop_quick_link_card.is-active");
      if (activeBtn) activeBtn.focus();
    } else if (e.key === "ArrowLeft" || e.key === "ArrowUp") {
      e.preventDefault();
      onUserInteraction();
      prevSlide();
      stopAutoplay();
      // startAutoplay();
      var activeBtn2 = slider.querySelector(".pdop_quick_link_card.is-active");
      if (activeBtn2) activeBtn2.focus();
    } else if (e.key === "Home") {
      e.preventDefault();
      onUserInteraction();
      goToSlide(0);
      stopAutoplay();
      // startAutoplay();
      if (navButtons[0]) navButtons[0].focus();
    } else if (e.key === "End") {
      e.preventDefault();
      onUserInteraction();
      goToSlide(slides.length - 1);
      stopAutoplay();
      // startAutoplay();
      if (navButtons[navButtons.length - 1])
        navButtons[navButtons.length - 1].focus();
    }
  });

  // Initialize: set inert on all non-active slides
  slides.forEach(function (slide, i) {
    if (i !== 0) {
      setInert(slide, true);
    }
  });

  // Play video on first active slide
  var firstActive = slider.querySelector(".pdop_hero_slide.is-active");
  if (firstActive) {
    playVideo(firstActive);
  }

  // Start autoplay
  // startAutoplay();
})();

document.addEventListener("DOMContentLoaded", function () {
  let newsroomSwiper;
  let projectsSwiper;

  function initNewsroomSwiper() {
    const isMobile = window.innerWidth <= 1024;

    // NEWSROOM SWIPER
    if (isMobile && !newsroomSwiper) {
      newsroomSwiper = new Swiper(".pdop_newsroom_grid_swiper", {
        slidesPerView: 1.1,
        spaceBetween: 22,

        a11y: {
          enabled: true,
          slideLabelMessage: "{{index}} of {{slidesLength}}",
        },

        keyboard: {
          enabled: true,
          onlyInViewport: true,
        },

        autoplay: false,

        breakpoints: {
          768: {
            slidesPerView: 2.6,
            spaceBetween: 30,
          },
          520: {
            slidesPerView: 1.2,
            spaceBetween: 22,
          },
        },

        navigation: {
          nextEl: ".pdop_newsroom_navigation .pdop_upcoming_events_next",
          prevEl: ".pdop_newsroom_navigation .pdop_upcoming_events_prev",
        },

        on: {
          init: updateFocus,
          slideChange: updateFocus,
        },
      });
    }

    // PROJECTS SWIPER
    if (isMobile && !projectsSwiper) {
      projectsSwiper = new Swiper(".pdop_current_projects_swiper", {
        slidesPerView: 1.2,
        spaceBetween: 16,

        a11y: {
          enabled: true,
          slideLabelMessage: "{{index}} of {{slidesLength}}",
        },

        keyboard: {
          enabled: true,
          onlyInViewport: true,
        },

        autoplay: false,

        breakpoints: {
          768: {
            slidesPerView: 2.6,
            spaceBetween: 30,
          },
          520: {
            slidesPerView: 1.2,
            spaceBetween: 16,
          },
        },

        navigation: {
          nextEl:
            ".pdop_current_projects_navigation .pdop_upcoming_events_next",
          prevEl:
            ".pdop_current_projects_navigation .pdop_upcoming_events_prev",
        },

        on: {
          init: updateFocus,
          slideChange: updateFocus,
        },
      });
    }

    // DESTROY ON DESKTOP
    if (!isMobile) {
      if (newsroomSwiper) {
        newsroomSwiper.destroy(true, true);
        newsroomSwiper = null;
      }

      if (projectsSwiper) {
        projectsSwiper.destroy(true, true);
        projectsSwiper = null;
      }
    }
  }

  function updateFocus() {
    document.querySelectorAll(".swiper-slide").forEach((slide) => {
      const isActive = slide.classList.contains("swiper-slide-active");

      slide.setAttribute("aria-hidden", !isActive);

      slide.querySelectorAll("a, button").forEach((el) => {
        el.tabIndex = isActive ? 0 : -1;
      });
    });
  }

  // Init
  window.addEventListener("load", initNewsroomSwiper);
  window.addEventListener("resize", initNewsroomSwiper);

  // Upcoming Events
  upcomingEventsSwiper = new Swiper(".pdop_upcoming_events_swiper", {
    slidesPerView: 1.2,
    spaceBetween: 16,

    // Accessibility
    a11y: {
      enabled: true,
      slideLabelMessage: "Slide {{index}} of {{slidesLength}}: Upcoming Event",
    },

    keyboard: {
      enabled: true,
      onlyInViewport: true,
    },

    navigation: {
      nextEl: ".pdop_upcoming_events_next",
      prevEl: ".pdop_upcoming_events_prev",
    },

    // IMPORTANT: no autoplay (ADA)
    autoplay: false,

    breakpoints: {
      1600: {
        slidesPerView: 3.9,
        spaceBetween: 50,
      },
      1400: {
        slidesPerView: 3.9,
        spaceBetween: 30,
      },
      1200: {
        slidesPerView: 3.5,
        spaceBetween: 30,
      },
      1024: {
        slidesPerView: 2.8,
        spaceBetween: 30,
      },
      768: {
        slidesPerView: 2.3,
        spaceBetween: 30,
      },
      520: {
        slidesPerView: 1.2,
        spaceBetween: 16,
      },
    },
  });
});
