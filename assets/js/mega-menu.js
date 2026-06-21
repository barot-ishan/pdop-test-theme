/**
 *  JS for aria-expanded keyboard support
 *
 *
 * @package PDOP
 */

(function () {
    const header = document.querySelector('header');
    const topHeader = document.querySelector('.pdop_top_header');
    const adminBar = document.querySelector('#wpadminbar');

    if (!header) return;

    function setHeaderHeight() {
        const headerHeight = header.offsetHeight;
        const adminBarHeight = adminBar ? adminBar.offsetHeight : 0;

        const isScrolled = header.classList.contains('is-scrolled');

        const topHeaderHeight = (
            topHeader && !isScrolled
                ? topHeader.offsetHeight
                : 0
        );

        const headerStyles = getComputedStyle(header);
        const headerBottomPadding = parseFloat(headerStyles.paddingBottom) || 0;

        const totalHeight = Math.round(
            headerHeight +
            topHeaderHeight +
            adminBarHeight
        ) + 'px';

        header.style.setProperty('--header-height', totalHeight);

        document.querySelectorAll('.megamenu').forEach(menu=>{
            menu.style.setProperty('--header-height', totalHeight);
        });
    }

    setHeaderHeight();

    const ro = new ResizeObserver(setHeaderHeight);

    ro.observe(header);
    if (topHeader) ro.observe(topHeader);
    if (adminBar) ro.observe(adminBar);

    window.addEventListener('resize', setHeaderHeight);

    // Detect class changes like is-scrolled being added/removed
    const mo = new MutationObserver(setHeaderHeight);
    mo.observe(header,{attributes:true,attributeFilter:['class']});
})();





( function () {

    // ── aria-expanded toggle on open/close ───────────────────────────────────
    document.querySelectorAll( '.has-mega-menu' ).forEach( item => {
        const trigger = item.querySelector( ':scope > .menu-link' );
        if ( ! trigger ) return;
        
        const megamenu = document.getElementById( trigger.getAttribute( 'aria-controls' ) );

        function openMenu() {
            trigger.setAttribute( 'aria-expanded', 'true' );
            item.setAttribute( 'aria-expanded', 'true' );
            if ( megamenu ) megamenu.removeAttribute( 'hidden' );
        }

        function closeMenu() {
            trigger.setAttribute( 'aria-expanded', 'false' );
            item.setAttribute( 'aria-expanded', 'false' );
            if ( megamenu ) megamenu.setAttribute( 'hidden', '' );
        }

        // Mouse events
        item.addEventListener( 'mouseenter', openMenu );
        item.addEventListener( 'mouseleave', closeMenu );

        // Click event on trigger
        trigger.addEventListener( 'click', (e) => {
            // e.preventDefault(); // If you want click to strictly toggle and not navigate.
            trigger.getAttribute( 'aria-expanded' ) === 'true' ? closeMenu() : openMenu();
        } );

        // Keyboard on trigger
        trigger.addEventListener( 'keydown', ( e ) => {
            if ( e.key === 'Enter' || e.key === ' ' ) {
                e.preventDefault();
                trigger.getAttribute( 'aria-expanded' ) === 'true' ? closeMenu() : openMenu();
            }
            if ( e.key === 'Escape' ) {
                closeMenu();
                trigger.focus();
            }
        } );

        // Keyboard inside megamenu
        if ( megamenu ) {
            megamenu.addEventListener( 'keydown', e => {
                if ( e.key === 'Escape' ) {
                    closeMenu();
                    trigger.focus();
                }
            } );
        }
    } );

    // ── Roving tabindex + arrow key nav on vertical tablist ──────────────────
    document.querySelectorAll( '.megamenu-tab-nav[role="tablist"]' ).forEach( tablist => {
        const tabs = [ ...tablist.querySelectorAll( '[role="tab"]' ) ];

        tablist.addEventListener( 'keydown', e => {
            const idx = tabs.indexOf( document.activeElement );
            if ( idx === -1 ) return;

            let next = null;

            if ( e.key === 'ArrowDown' )  next = tabs[ ( idx + 1 ) % tabs.length ];
            if ( e.key === 'ArrowUp' )    next = tabs[ ( idx - 1 + tabs.length ) % tabs.length ];
            if ( e.key === 'Home' )       next = tabs[ 0 ];
            if ( e.key === 'End' )        next = tabs[ tabs.length - 1 ];

            if ( next ) {
                e.preventDefault();
                // Update roving tabindex
                tabs.forEach( t => t.setAttribute( 'tabindex', '-1' ) );
                next.setAttribute( 'tabindex', '0' );
                next.focus();
                next.click(); // activate the tab panel
            }
            
            // Allow moving to the tab panel content via Right Arrow
            if ( e.key === 'ArrowRight' ) {
                e.preventDefault();
                const activeTab = document.activeElement;
                const paneId = activeTab.getAttribute('aria-controls');
                if (paneId) {
                    const pane = document.getElementById(paneId);
                    if (pane) {
                        const firstLink = pane.querySelector('a, button');
                        if (firstLink) firstLink.focus();
                        else pane.focus();
                    }
                }
            }
        } );
    } );
    
    // ── Tab panel keyboard nav ───────────────────────────────────────────────
    document.querySelectorAll( '.megamenu-tab-pane' ).forEach( pane => {
        pane.addEventListener( 'keydown', e => {
            // Allow returning to tablist via Left Arrow
            if ( e.key === 'ArrowLeft' ) {
                e.preventDefault();
                const tabId = pane.getAttribute('aria-labelledby');
                if (tabId) {
                    const tab = document.getElementById(tabId);
                    if (tab) tab.focus();
                }
            }
        } );
    } );

    // ── Close on outside click ───────────────────────────────────────────────
    document.addEventListener( 'click', e => {
        document.querySelectorAll( '.has-mega-menu' ).forEach( li => {
            const trigger  = li.querySelector( '.menu-link' );
            const megamenu = trigger && document.getElementById( trigger.getAttribute( 'aria-controls' ) );
            
            // Check if the click happened outside the li AND outside the megamenu wrapper
            if ( ! li.contains( e.target ) && ( !megamenu || !megamenu.contains( e.target ) ) ) {
                if ( trigger )  trigger.setAttribute( 'aria-expanded', 'false' );
                if ( megamenu ) megamenu.setAttribute( 'hidden', '' );
                li.setAttribute( 'aria-expanded', 'false' );
            }
        } );
    } );

} )();


document.querySelectorAll('.has-mega-menu').forEach(item=>{
  item.addEventListener('focusin',()=>{
    document.querySelectorAll('.has-mega-menu')
      .forEach(i=>i.setAttribute('aria-expanded','false'));
    item.setAttribute('aria-expanded','true');
  });
});

(function(){
    const items = document.querySelectorAll('.has-mega-menu');
    const body = document.body;

    function updateScrollLock(){
        const openMenu = document.querySelector(
            '.has-mega-menu:hover, .has-mega-menu[aria-expanded="true"]'
        );

        body.classList.toggle('megamenu-open', !!openMenu);
    }

    // optional: prevent layout jump from removed scrollbar
    document.documentElement.style.setProperty(
        '--scrollbar-width',
        (window.innerWidth - document.documentElement.clientWidth) + 'px'
    );

    items.forEach(item=>{
        item.addEventListener('mouseenter', updateScrollLock);
        item.addEventListener('mouseleave', updateScrollLock);
        item.addEventListener('focusin', updateScrollLock);
        item.addEventListener('focusout', ()=>setTimeout(updateScrollLock,10));
    });

    const mo = new MutationObserver(updateScrollLock);
    items.forEach(item=>{
        mo.observe(item,{attributes:true,attributeFilter:['aria-expanded']});
    });
})();



/**
 * Mobile Menu Drawer — Sliding Panel Navigation
 *
 * Works alongside mobileMenuWalker (PHP) + Bootstrap offcanvas.
 * – [data-open-panel="panel-{id}"]  → opens that sub-panel
 * – [data-panel-back]               → goes to the previous panel in the stack
 * – Panels gain/lose .is-active and .is-parent accordingly
 */

(function () {
  'use strict';

  const DRAWER_ID   = 'mobileDrawer';
  const ACTIVE_CLS  = 'is-active';
  const PARENT_CLS  = 'is-parent';

  /** @type {HTMLElement|null} */
  let drawer = null;

  /** Stack of currently open panels (most-recent last). */
  let panelStack = [];

  // ---------------------------------------------------------------------------
  // Helpers
  // ---------------------------------------------------------------------------

  /** Find a panel element by its data-panel attribute. */
  function getPanel(id) {
    return drawer.querySelector(`.mobile-panel[data-panel="${id}"]`);
  }

  /** The main panel — always the first panel rendered. */
  function getMainPanel() {
    return drawer.querySelector('.mobile-panel--main');
  }

  /** Currently visible (top of stack) panel, or main panel if stack is empty. */
  function getCurrentPanel() {
    return panelStack.length
      ? getPanel(panelStack[panelStack.length - 1])
      : getMainPanel();
  }

  // ---------------------------------------------------------------------------
  // Panel transitions
  // ---------------------------------------------------------------------------

  /**
   * Open a sub-panel.
   * @param {string} panelId   e.g. "panel-42"
   */
  function openPanel(panelId) {
    const next = getPanel(panelId);
    if (!next) return;

    const current = getCurrentPanel();

    // Parent slides RIGHT.
    current.classList.add(PARENT_CLS);
    current.classList.remove(ACTIVE_CLS);

    // Child slides in from LEFT.
    next.classList.add(ACTIVE_CLS);
    next.classList.remove(PARENT_CLS);

    panelStack.push(panelId);

    // Scroll sub-panel to top.
    const nav = next.querySelector('.panel-nav');
    if (nav) nav.scrollTop = 0;
  }

  /**
   * Go back one level.
   */
  function closePanel() {
    if (!panelStack.length) return;

    const currentId = panelStack.pop();
    const current   = getPanel(currentId);
    const previous  = getCurrentPanel();

    // Current slides LEFT (off screen).
    current.classList.remove(ACTIVE_CLS);

    // Previous slides back to centre.
    previous.classList.remove(PARENT_CLS);
    previous.classList.add(ACTIVE_CLS);
  }

  // ---------------------------------------------------------------------------
  // Reset on drawer close
  // ---------------------------------------------------------------------------

  function resetPanels() {
    drawer.querySelectorAll('.mobile-panel').forEach(p => {
      p.classList.remove(ACTIVE_CLS, PARENT_CLS);
    });

    getMainPanel().classList.add(ACTIVE_CLS);
    panelStack = [];
  }

  // ---------------------------------------------------------------------------
  // Event wiring
  // ---------------------------------------------------------------------------

  function init() {
    drawer = document.getElementById(DRAWER_ID);
    if (!drawer) return;

    getMainPanel()?.classList.add(ACTIVE_CLS);

    drawer.addEventListener('click', function (e) {
      const trigger = e.target.closest('[data-open-panel]');

      if (trigger) {
        e.preventDefault();
        openPanel(trigger.dataset.openPanel);
        return;
      }

      const back = e.target.closest('[data-panel-back]');

      if (back) {
        e.preventDefault();
        closePanel();
      }
    });

    drawer.addEventListener('hidden.bs.offcanvas', resetPanels);
  }

  // ---------------------------------------------------------------------------
  // Boot
  // ---------------------------------------------------------------------------

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();

jQuery(function () {
  jQuery('.megamenu a[href*="#"]').addClass('nopage');
});