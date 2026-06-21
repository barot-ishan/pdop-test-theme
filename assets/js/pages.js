/**
 * Event Schedule — Frontend JavaScript
 *
 * Handles desktop sidebar filter logic (immediate page reload)
 * and mobile slide-up panel with deferred-apply workflow
 * (mirrors Staff Directory plugin approach).
 *
 * @package PDOP
 */
document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    // Auto scroll active category card into view
    (function () {
        var activeCard = document.querySelector(".sc_category_card.active");

        if (activeCard) {
            activeCard.scrollIntoView({
                behavior: "smooth",
                inline: "center",
                block: "nearest"
            });
        }
    })();

    /* =============================================
       DOM References
     ============================================= */
    var root = document.getElementById('fs-filter-root');
    if (!root) return;

    var filterPanel = document.getElementById('fs-filter-panel');
    var filterBtn = document.getElementById('fs-mobile-filter-btn');
    var panelApplyBtn = document.getElementById('fs-filter-apply');
    var panelClearAll = document.getElementById('fs-mobile-clear-all');
    var clearAllBtn = document.getElementById('fs-clear-all');
    var badge = document.getElementById('fs-filter-badge');
    var searchInput = document.getElementById('instructor-search');
    var closeBtns = root.querySelectorAll('[data-fs-close-panel]');

    var allCategoryChecks = root.querySelectorAll('.filter-checkbox-category');
    var allTimeChecks = root.querySelectorAll('.filter-checkbox-time');
    var allLocationChecks = root.querySelectorAll('.filter-checkbox-location');
    var allOrganizerChecks = root.querySelectorAll('.filter-checkbox-organizer');

    // Section fieldsets (for mobile DOM shuffling)
    var sectionCategory = document.getElementById('fs-section-category');
    var sectionTime = document.getElementById('fs-section-time');
    var sectionLocation = document.getElementById('fs-section-location');
    var sectionInstructor = document.getElementById('fs-section-instructor');

    // Mobile tab panes
    var paneCategory = document.getElementById('m-fs-category');
    var paneTime = document.getElementById('m-fs-time');
    var paneLocation = document.getElementById('m-fs-location');
    var paneInstructor = document.getElementById('m-fs-instructor');

    var isMobile = false;

    /**
     * Snapshot of checkbox states, captured when the mobile panel opens.
     * Used to revert changes if the user closes without applying.
     */
    var filterSnapshot = {
        categories: [],
        times: [],
        locations: [],
        organizers: [],
        instructorSearch: ''
    };

    /* =============================================
       Initialise
     ============================================= */
    function init() {
        syncCheckboxesFromURL();
        bindDesktopEvents();
        bindMobileUI();
        updateClearAllState();
    }

    /**
     * Sync checkbox states from the current URL query params.
     *
     * WP Engine (and similar hosts) may serve cached HTML where PHP's
     * `checked` attribute doesn't reflect the current request. This
     * function reads the URL and ensures checkboxes match the active
     * filters on every page load.
     */
    function syncCheckboxesFromURL() {
        var params = new URLSearchParams(window.location.search);

        var timeParam = params.get('time_of_day') || params.get('time');
        syncGroup(params.get('tribe_events_cat'), allCategoryChecks);
        syncGroup(timeParam, allTimeChecks);
        syncGroup(params.get('location'), allLocationChecks);
        syncGroup(params.get('organizer'), allOrganizerChecks);
    }

    function syncGroup(paramValue, checkboxes) {
        if (!checkboxes || !checkboxes.length) return;

        var activeValues = paramValue ? paramValue.split(',') : [];

        checkboxes.forEach(function (cb) {
            var shouldBeChecked = activeValues.indexOf(cb.value) !== -1;
            if (shouldBeChecked) {
                cb.checked = true;
                cb.setAttribute('checked', 'checked');
            } else {
                cb.checked = false;
                cb.removeAttribute('checked');
            }
        });
    }

    // Run sync immediately and also defer slightly in case another script resets them
    syncCheckboxesFromURL();
    setTimeout(function () {
        syncCheckboxesFromURL();
        updateClearAllState();
    }, 500);

    /* =============================================
       Desktop Filter Logic (immediate page reload)
     ============================================= */
    function updateFilters() {
        var url = new URL(window.location.href);

        url.searchParams.delete('tribe_events_cat');
        url.searchParams.delete('time_of_day');
        url.searchParams.delete('location');
        url.searchParams.delete('organizer');
        // Note: 'tag' is intentionally preserved across filter changes

        var getCheckedValues = function (selector) {
            return Array.from(root.querySelectorAll(selector + ':checked')).map(function (el) {
                return el.value;
            });
        };

        var categories = getCheckedValues('.filter-checkbox-category');

        // When subcategory (child) filters are selected, always carry the current
        // featured/parent category so the active card indicator stays correct and
        // TEC has enough context to show events in the right scope.
        // The active featured category is always the current tribe_events_cat on load.
        var currentParams = new URLSearchParams(window.location.search);
        var featuredCat = currentParams.get('tribe_events_cat');

        if (categories.length) {
            // Build the set: featured parent + selected subcategories (deduped)
            var allCats = [];
            if (featuredCat) allCats.push(featuredCat);
            categories.forEach(function (c) {
                if (allCats.indexOf(c) === -1) allCats.push(c);
            });
            url.searchParams.set('tribe_events_cat', allCats.join(','));
        }

        var times = getCheckedValues('.filter-checkbox-time');
        if (times.length) url.searchParams.set('time_of_day', times.join(','));

        var locations = getCheckedValues('.filter-checkbox-location');
        if (locations.length) url.searchParams.set('location', locations.join(','));

        var organizers = getCheckedValues('.filter-checkbox-organizer');
        if (organizers.length) url.searchParams.set('organizer', organizers.join(','));

        window.location.href = url.toString();
    }

    function bindDesktopEvents() {

        // Instructor search filter
        if (searchInput) {
            searchInput.addEventListener('input', function (e) {
                var searchTerm = e.target.value.toLowerCase();
                var instructorItems = root.querySelectorAll('.instructor-item');

                instructorItems.forEach(function (item) {
                    var label = item.querySelector('.instructor-label');
                    var text = label ? label.textContent.toLowerCase() : '';
                    item.style.display = text.indexOf(searchTerm) !== -1 ? 'flex' : 'none';
                });
            });
        }

        // Checkbox change — immediate apply on desktop, deferred on mobile
        root.addEventListener('change', function (e) {
            if (
                e.target.matches(
                    '.filter-checkbox-category, .filter-checkbox-time, .filter-checkbox-location, .filter-checkbox-organizer'
                )
            ) {
                if (isMobile && filterPanel && !filterPanel.hidden) {
                    updatePendingIndicator();
                    updateClearAllState();
                } else {
                    updateFilters();
                }
            }
        });

        // Desktop Clear All
        if (clearAllBtn) {
            clearAllBtn.addEventListener('click', function () {
                var url = new URL(window.location.href);
                var currentTag = url.searchParams.get('tag');

                var newUrl = new URL(window.location.pathname, window.location.origin);
                if (currentTag) newUrl.searchParams.set('tag', currentTag);

                window.location.href = newUrl.toString();
            });
        }
    }

    /* =============================================
       Mobile UI Logic
     ============================================= */
    function bindMobileUI() {
        if (!filterBtn || !filterPanel) return;

        var mql = window.matchMedia('(max-width: 768px)');

        function handleMediaChange(e) {
            isMobile = e.matches;
            if (isMobile) {
                setupMobileDOM();
            } else {
                restoreDesktopDOM();
                closePanel(filterPanel);
            }
        }

        if (mql.addEventListener) {
            mql.addEventListener('change', handleMediaChange);
        } else {
            mql.addListener(handleMediaChange);
        }
        handleMediaChange(mql);

        // Open panel
        filterBtn.addEventListener('click', function () {
            openPanel(filterPanel);
        });

        // Close buttons (overlay + close btn)
        closeBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var panel = btn.closest('.fs-mobile-panel');
                if (panel) closePanel(panel);
            });
        });

        // Apply button
        if (panelApplyBtn) {
            panelApplyBtn.addEventListener('click', function () {
                updateFilters();
                // Page will reload, so no need to close panel
            });
        }

        // Panel Clear All
        if (panelClearAll) {
            panelClearAll.addEventListener('click', function () {
                if (isMobile && filterPanel && !filterPanel.hidden) {
                    // Reset all checkboxes locally (no page reload)
                    allCategoryChecks.forEach(function (cb) { cb.checked = false; });
                    allTimeChecks.forEach(function (cb) { cb.checked = false; });
                    allLocationChecks.forEach(function (cb) { cb.checked = false; });
                    allOrganizerChecks.forEach(function (cb) { cb.checked = false; });

                    if (searchInput) {
                        searchInput.value = '';
                        // Reset instructor visibility
                        root.querySelectorAll('.instructor-item').forEach(function (item) {
                            item.style.display = 'flex';
                        });
                    }

                    updatePendingIndicator();
                    updateClearAllState();
                }
            });
        }

        // Tab switching
        var tabs = filterPanel.querySelectorAll('.fs-mobile-tab');
        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                tabs.forEach(function (t) {
                    t.classList.remove('active');
                    t.setAttribute('aria-selected', 'false');
                });
                var panes = filterPanel.querySelectorAll('.fs-mobile-tab-pane');
                panes.forEach(function (p) {
                    p.classList.remove('active');
                });

                tab.classList.add('active');
                tab.setAttribute('aria-selected', 'true');
                var targetId = tab.getAttribute('data-target');
                if (targetId) {
                    var targetPane = document.getElementById(targetId);
                    if (targetPane) targetPane.classList.add('active');
                }
            });
        });

        // Escape key closes panel
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' || e.key === 'Esc') {
                if (!filterPanel.hidden) closePanel(filterPanel);
            }
        });
    }

    /* =============================================
       Mobile DOM Shuffling
     ============================================= */
    function setupMobileDOM() {
        moveSectionToPane(sectionCategory, paneCategory);
        moveSectionToPane(sectionTime, paneTime);
        moveSectionToPane(sectionLocation, paneLocation);
        moveSectionToPane(sectionInstructor, paneInstructor);
    }

    function restoreDesktopDOM() {
        var sidebar = root.querySelector('.filter-sidebar');
        if (!sidebar) return;

        moveBackToSidebar(sectionCategory, sidebar);
        moveBackToSidebar(sectionTime, sidebar);
        moveBackToSidebar(sectionLocation, sidebar);
        moveBackToSidebar(sectionInstructor, sidebar);
    }

    function moveSectionToPane(section, pane) {
        if (section && pane && !pane.contains(section)) {
            pane.appendChild(section);
        }
    }

    function moveBackToSidebar(section, sidebar) {
        if (section && !sidebar.contains(section)) {
            sidebar.appendChild(section);
        }
    }

    /* =============================================
       Panel Open / Close
     ============================================= */
    function openPanel(panel) {
        snapshotFilters();
        updatePendingIndicator();
        updateClearAllState();
        panel.hidden = false;
        panel.offsetHeight; // force reflow so transition plays
        panel.classList.add('fs-panel--open');
        document.body.classList.add('fs-modal-open');
        filterBtn.setAttribute('aria-expanded', 'true');
    }

    /**
     * Close the mobile panel.
     *
     * @param {HTMLElement} panel  The panel element.
     * @param {boolean}     revert If not explicitly false, restore snapshot.
     */
    function closePanel(panel, revert) {
        if (revert !== false) {
            restoreSnapshot();
        }

        panel.classList.remove('fs-panel--open');
        filterBtn.setAttribute('aria-expanded', 'false');

        var sheet = panel.querySelector('.fs-mobile-panel__sheet');
        var duration = sheet
            ? parseFloat(getComputedStyle(sheet).transitionDuration) * 1000
            : 300;

        setTimeout(function () {
            panel.hidden = true;
            document.body.classList.remove('fs-modal-open');
        }, duration);
    }

    /* =============================================
       Snapshot / Restore (Deferred-Apply)
     ============================================= */
    function snapshotFilters() {
        filterSnapshot.categories = getCheckedArray(allCategoryChecks);
        filterSnapshot.times = getCheckedArray(allTimeChecks);
        filterSnapshot.locations = getCheckedArray(allLocationChecks);
        filterSnapshot.organizers = getCheckedArray(allOrganizerChecks);
        filterSnapshot.instructorSearch = searchInput ? searchInput.value : '';
    }

    function restoreSnapshot() {
        restoreChecks(allCategoryChecks, filterSnapshot.categories);
        restoreChecks(allTimeChecks, filterSnapshot.times);
        restoreChecks(allLocationChecks, filterSnapshot.locations);
        restoreChecks(allOrganizerChecks, filterSnapshot.organizers);

        if (searchInput) {
            searchInput.value = filterSnapshot.instructorSearch;
            searchInput.dispatchEvent(new Event('input', { bubbles: true }));
        }

        updateClearAllState();
    }

    function getCheckedArray(checkboxes) {
        var arr = [];
        checkboxes.forEach(function (cb) {
            if (cb.checked) arr.push(cb.value);
        });
        return arr;
    }

    function restoreChecks(checkboxes, snapshot) {
        checkboxes.forEach(function (cb) {
            cb.checked = snapshot.indexOf(cb.value) !== -1;
        });
    }

    /* =============================================
       Pending Change Indicator
     ============================================= */
    function updatePendingIndicator() {
        if (!panelApplyBtn) return;

        var hasChanges = false;

        if (!arraysEqual(getCheckedArray(allCategoryChecks), filterSnapshot.categories)) hasChanges = true;
        if (!arraysEqual(getCheckedArray(allTimeChecks), filterSnapshot.times)) hasChanges = true;
        if (!arraysEqual(getCheckedArray(allLocationChecks), filterSnapshot.locations)) hasChanges = true;
        if (!arraysEqual(getCheckedArray(allOrganizerChecks), filterSnapshot.organizers)) hasChanges = true;

        panelApplyBtn.textContent = hasChanges ? 'Apply Changes' : 'Apply';
    }

    function arraysEqual(a, b) {
        if (a.length !== b.length) return false;
        for (var i = 0; i < a.length; i++) {
            if (b.indexOf(a[i]) === -1) return false;
        }
        return true;
    }

    /* =============================================
       Clear All State
     ============================================= */
    function updateClearAllState() {
        var isActive =
            getCheckedArray(allCategoryChecks).length > 0 ||
            getCheckedArray(allTimeChecks).length > 0 ||
            getCheckedArray(allLocationChecks).length > 0 ||
            getCheckedArray(allOrganizerChecks).length > 0;

        if (clearAllBtn) {
            clearAllBtn.disabled = !isActive;
            if (isActive) {
                clearAllBtn.removeAttribute('aria-disabled');
            } else {
                clearAllBtn.setAttribute('aria-disabled', 'true');
            }
        }

        if (panelClearAll) {
            panelClearAll.disabled = !isActive;
            if (isActive) {
                panelClearAll.removeAttribute('aria-disabled');
            } else {
                panelClearAll.setAttribute('aria-disabled', 'true');
            }
        }

        if (badge) {
            badge.hidden = !isActive;
        }
    }

    /* =============================================
       Boot
     ============================================= */
    init();

});


/* =============================================
   Save Calendar PDF (GLOBAL - delegated)
============================================= */
document.addEventListener('click', function (e) {
    var btn = e.target.closest('.save_calendar');
    if (!btn) return;

    downloadCalendarPDF(btn);
});


async function downloadCalendarPDF(btn) {
    const element = document.querySelector(".tribe-common-l-container");
    if (!element) return;

    // ── Loading state ──
    const originalText = btn.textContent;
    btn.textContent = 'Generating PDF...';
    btn.disabled = true;
    btn.style.opacity = '0.7';
    btn.style.cursor = 'not-allowed';

    // Allow browser to repaint BEFORE heavy work starts
    await new Promise(resolve => requestAnimationFrame(() => setTimeout(resolve, 50)));

    element.style.maxWidth = '300%';
    element.style.padding = '0';

    const hiddenDays = document.querySelectorAll(
        ".tribe-events-calendar-month__day--past-month *, .tribe-events-calendar-month__day--next-month *"
    );

    hiddenDays.forEach(el => {
        el.dataset.originalVisibility = el.style.visibility;
        el.style.visibility = "hidden";
    });

    try {
        const canvas = await html2canvas(element, {
            scale: 2,
            useCORS: true,
            backgroundColor: "#ffffff"
        });

        const imgData = canvas.toDataURL("image/jpeg", 0.6);

        const { jsPDF } = window.jspdf;

        const pdf = new jsPDF({
            orientation: "landscape",
            unit: "mm",
            format: "a4",
            compress: true
        });

        const pageWidth = pdf.internal.pageSize.getWidth();
        const pageHeight = pdf.internal.pageSize.getHeight();
        const ratio = Math.min(pageWidth / canvas.width, pageHeight / canvas.height);
        const newWidth = canvas.width * ratio;
        const newHeight = canvas.height * ratio;
        const x = (pageWidth - newWidth) / 2;
        const y = (pageHeight - newHeight) / 2;

        pdf.addImage(imgData, "JPEG", x, y, newWidth, newHeight, undefined, "FAST");
        pdf.save("pdop-calendar.pdf");

    } catch (err) {
        console.error('PDF generation failed:', err);
        btn.textContent = 'Failed — Try Again';
    }

    hiddenDays.forEach(el => {
        el.style.visibility = el.dataset.originalVisibility || "";
    });

    element.style.maxWidth = '';
    element.style.padding = '';

    // ── Restore button ──
    setTimeout(() => {
        btn.textContent = originalText;
        btn.disabled = false;
        btn.style.opacity = '';
        btn.style.cursor = '';
    }, 1500); // small delay so user sees it complete
}

document.addEventListener("DOMContentLoaded", function () {
    // Don't miss these events swiper
    upcomingEventsSwiper = new Swiper(".pdop_dontmiss_events_swiper", {
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
            nextEl: ".pdop_dontmiss_events_next",
            prevEl: ".pdop_dontmiss_events_prev",
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

    // Custom Click-Based Tooltip (Overrides TEC hover)
    var tooltipBox = document.createElement('div');
    tooltipBox.id = 'pdop-dynamic-tooltip';
    tooltipBox.style.display = 'none';
    tooltipBox.style.position = 'absolute';
    tooltipBox.style.zIndex = '99';
    document.body.appendChild(tooltipBox);

    document.addEventListener('click', function (e) {
        var card = e.target.closest('.pdop-event-card');
        var closeBtn = e.target.closest('.tooltip-close');

        if (closeBtn) {
            tooltipBox.style.display = 'none';
            if (window._pdopActiveCard) {
                window._pdopActiveCard.classList.remove('is-tooltip-open');
                var fallbackLink = window._pdopActiveCard.querySelector('a, button');
                if (fallbackLink) fallbackLink.focus();
            }
            return;
        }

        // Only handle cards that have our specific data attribute
        if (card && card.hasAttribute('data-pdop-tooltip-id') && !e.target.closest('.tribe-events-calendar-month__calendar-event-title-link, .register, .waitlist, #pdop-dynamic-tooltip')) {
            e.preventDefault();
            e.stopPropagation();

            var tooltipId = card.getAttribute('data-pdop-tooltip-id');
            var template = document.getElementById(tooltipId);

            if (template) {
                // Clear old active classes
                if (window._pdopActiveCard) {
                    window._pdopActiveCard.classList.remove('is-tooltip-open');
                }

                card.classList.add('is-tooltip-open');
                window._pdopActiveCard = card;

                // Ensure wrapper inherits our new styles & ADA props
                tooltipBox.className = 'tribe-events-calendar-month__calendar-event-tooltip pdop-custom-tooltip';
                tooltipBox.setAttribute('role', 'dialog');
                tooltipBox.setAttribute('aria-modal', 'true');
                tooltipBox.setAttribute('aria-label', 'Event Details Window');

                tooltipBox.innerHTML = template.innerHTML;
                tooltipBox.style.display = 'block';

                var rect = card.getBoundingClientRect();

                // Position logic: prefer popover right relative to the cell
                var topPos = rect.top + window.scrollY - 10;
                var leftPos = rect.right + window.scrollX + 10;

                // Prevent horizontal overflow by flipping left
                if (leftPos + 340 > window.innerWidth) {
                    leftPos = Math.max(10, rect.left + window.scrollX - 340);
                }

                tooltipBox.style.top = topPos + 'px';
                tooltipBox.style.left = leftPos + 'px';

                tooltipBox.setAttribute('tabindex', '-1');
                tooltipBox.style.outline = 'none';

                // Shift focus to the tooltip container for screen reader context
                setTimeout(function () {
                    tooltipBox.focus();
                }, 50);
            }
        } else if (!e.target.closest('#pdop-dynamic-tooltip')) {
            // Dismiss active tooltip when clicking anywhere loosely outside
            tooltipBox.style.display = 'none';
            if (window._pdopActiveCard) {
                window._pdopActiveCard.classList.remove('is-tooltip-open');
            }
        }
    });

    // --- INDESTRUCTIBLE Month Title Sync ---
    // Safely parse the actual visible grid dates upon TEC navigation resets
    function forceUpdateMonthTitle() {
        var firstDayNode = document.querySelector('.tribe-events-calendar-month__day[data-view-day]:not(.tribe-events-calendar-month__day--past-month)');
        if (!firstDayNode) return;
        var dateString = firstDayNode.getAttribute('data-view-day');
        if (dateString) {
            var d = new Date(dateString + 'T12:00:00'); // set absolute midday to avoid timezone shifts
            var text = d.toLocaleString('en-US', { month: 'long', year: 'numeric' });
            var titleEl = document.querySelector('.events-current-month');
            if (titleEl) {
                var innerSpan = titleEl.querySelector('span');
                if (innerSpan) innerSpan.innerText = text;
                else titleEl.innerText = text;
            }
        }
    }

    if (typeof jQuery !== 'undefined') {
        jQuery(document).on('afterSetup.tribeEvents init.tribeEvents', forceUpdateMonthTitle);
    }

    // Also run on initial page load (handles WP Engine cache / full reloads)
    forceUpdateMonthTitle();

    /* =============================================
       Scroll Restoration After TEC Navigation
       -------------------------------------------------
       1) Full-page reload on month navigation — TEC
          uses path-based URLs like /schedules/month/2026-05/
          so we detect that pattern and scroll to the
          calendar section.
       2) AJAX views (list / day) — after TEC replaces
          content via AJAX, scroll back to the calendar
          section so the sticky header doesn't clip content.
     ============================================= */

    var scheduleAnchor = document.getElementById('schedule-calendar');

    /**
     * Scroll helper — uses a delay to ensure our scroll fires
     * AFTER TEC's internal scroll-to-top behavior.
     */
    function scrollToCalendar() {
        if (!scheduleAnchor) return;
        setTimeout(function () {
            scheduleAnchor.scrollIntoView({ behavior: 'smooth' });
        }, 200);
    }

    // 1) Full-page reload on month/list/day navigation
    //    Detect path patterns: /schedules/month/YYYY-MM/ or /schedules/list/ or /schedules/day/
    //    Also detect tribe-bar-date query param (list/day paginated URLs)
    if (scheduleAnchor) {
        var path = window.location.pathname;
        var isTECNav = /\/(schedules|events)\/(month\/\d{4}-\d{2}|list|day)/.test(path)
            || window.location.search.indexOf('tribe-bar-date') !== -1;

        if (isTECNav) {
            scrollToCalendar();
        }
    }

    // 2) AJAX-driven views (list, day prev/next)
    if (scheduleAnchor) {
        document.addEventListener('tribe_events_views_v2_after_ajax_success', function () {
            scrollToCalendar();
        });
    }

    /* =============================================
       TEC Search Bar — Clear ("X") Button
       -------------------------------------------------
       Injects an accessible clear button into the TEC
       events bar search input. Hidden when empty,
       shown when the user types. Re-initialised after
       every TEC AJAX update because TEC replaces the
       entire events bar DOM on navigation/search.
     ============================================= */
    function initSearchClearButton() {
        var searchInput = document.getElementById('tribe-events-events-bar-keyword');
        if (!searchInput) return;

        var inputGroup = searchInput.closest('.tribe-events-c-search__input-group');
        if (!inputGroup) return;

        // Guard: don't inject twice if TEC didn't replace the DOM
        if (inputGroup.querySelector('.tec-search-clear-btn')) return;

        // Ensure parent is positioned for absolute placement of the clear btn
        inputGroup.style.position = 'relative';

        // Create the clear button
        var clearBtn = document.createElement('button');
        clearBtn.type = 'button';
        clearBtn.className = 'tec-search-clear-btn';
        clearBtn.setAttribute('aria-label', 'Clear search');
        clearBtn.setAttribute('aria-controls', 'tribe-events-events-bar-keyword');
        clearBtn.hidden = true;
        clearBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>';

        inputGroup.appendChild(clearBtn);

        // Toggle visibility based on input value
        function toggleClear() {
            clearBtn.hidden = !searchInput.value.trim();
        }

        searchInput.addEventListener('input', toggleClear);
        searchInput.addEventListener('change', toggleClear);
        toggleClear(); // initial state

        // Clear action — also triggers TEC search to reload unfiltered results
        clearBtn.addEventListener('click', function () {
            searchInput.value = '';
            clearBtn.hidden = true;

            // Dispatch input event so TEC's internal state recognises the empty value
            searchInput.dispatchEvent(new Event('input', { bubbles: true }));

            // Click TEC's submit button to trigger the AJAX search
            var submitBtn = searchInput.closest('.tribe-events-c-search').querySelector('.tribe-events-c-search__button');
            if (submitBtn) {
                submitBtn.click();
            }

            searchInput.focus(); // return focus to input for ADA
        });
    }

    // Run on initial page load
    initSearchClearButton();

    // Re-run after TEC AJAX replaces the DOM (search, month nav, view switch, etc.)
    if (typeof jQuery !== 'undefined') {
        jQuery(document).on('afterSetup.tribeEvents init.tribeEvents', initSearchClearButton);
    }
    document.addEventListener('tribe_events_views_v2_after_ajax_success', initSearchClearButton);
});

/* =============================================
   TEC View-Switch: Carry tribe_events_cat into AJAX requests
   -----------------------------------------------
   TEC V2 intercepts view-switcher link clicks and makes
   an AJAX (XHR) request to the link's href. Our PHP filter
   already bakes tribe_events_cat into those hrefs on page
   render. However, TEC's JS may reuse its own cached URL
   state for subsequent requests, dropping our param.

   We use jQuery's global ajaxSend to append tribe_events_cat
   to any outbound request that targets TEC's REST endpoint
   or the schedules page URL, ensuring the backend always
   receives the active category.
 ============================================= */
(function ($) {
    if (typeof $ === 'undefined') return;

    /**
     * Before any AJAX request, if it targets TEC's endpoint
     * or the schedules page, append tribe_events_cat.
     */
    $(document).ajaxSend(function (event, jqXHR, settings) {
        var url = settings.url || '';
        var isTecRequest = url.indexOf('/wp-json/tribe/') !== -1
            || url.indexOf('/schedules/') !== -1
            || url.indexOf('/tribe_events/') !== -1;
        if (!isTecRequest) return;

        var params = new URLSearchParams(window.location.search);
        var cat = params.get('tribe_events_cat');
        if (!cat) return;

        // Append as a query param if not already present
        if (url.indexOf('tribe_events_cat=') === -1) {
            var separator = url.indexOf('?') !== -1 ? '&' : '?';
            settings.url = url + separator + 'tribe_events_cat=' + encodeURIComponent(cat);
        }
    });

    /**
     * After TEC replaces the calendar HTML, sync the active card
     * indicator to match the currently active tribe_events_cat.
     */
    $(document).on('afterSetup.tribeEvents', function () {
        var params = new URLSearchParams(window.location.search);
        var cat = params.get('tribe_events_cat');
        if (!cat) return;

        document.querySelectorAll('.sc_category_card').forEach(function (card) {
            var href = card.getAttribute('href') || '';
            var cardUrl = new URL(href, window.location.origin);
            var cardCat = cardUrl.searchParams.get('tribe_events_cat');
            if (cardCat === cat) {
                card.classList.add('active');
                card.setAttribute('aria-current', 'true');
            } else {
                card.classList.remove('active');
                card.removeAttribute('aria-current');
            }
        });
    });

})(typeof jQuery !== 'undefined' ? jQuery : null);

// Awards Swiper
document.addEventListener('DOMContentLoaded', function () {
    const awardsSwiper = document.querySelectorAll('.awardsSwiper');

    awardsSwiper.forEach((awardsSwiper) => {
        new Swiper(awardsSwiper, {
            loop: true,

            slidesPerView: 1,
            spaceBetween: 20,

            pagination: {
                el: awardsSwiper.querySelector('.swiper-pagination'),
                clickable: true,
            },

            navigation: {
                nextEl: '.awardsSwiper .swiper-button-next',
                prevEl: '.awardsSwiper .swiper-button-prev',
            },

            // Accessibility
            a11y: {
                enabled: true,
            },

            keyboard: {
                enabled: true,
                onlyInViewport: true,
            },

            // Performance
            preloadImages: false,
            lazy: true,
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    function updatePlaceholder() {
        const input = document.querySelector('.tribe-events-c-search__input');
        if (input) {
            input.placeholder = 'Search for programs, events and activities and more...';
        }
    }

    updatePlaceholder();

    // Re-apply after AJAX view changes
    document.addEventListener('tribe_events_views_v2_after_ajax_success', updatePlaceholder);
});