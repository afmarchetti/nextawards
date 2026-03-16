let nextawards_menu = document.querySelector('.icon-hamburger');
if(nextawards_menu){
	nextawards_menu.addEventListener("click", function() {
		document.body.classList.toggle('menu-open');
   
    const isOpen = document.body.classList.contains('menu-open');
    nextawards_menu.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
	});
}


/* Add class on scroll */
window.addEventListener('scroll', function() {
	if(window.scrollY > 100){
		document.body.classList.add('scroll-down');
	} else {
		document.body.classList.remove('scroll-down');
	}
});

/* Dropdown menu mobile */
if (window.innerWidth < 1190) {
	let items = document.querySelectorAll('.menu-item-has-children > a');
	items.forEach((item) => {
		item.addEventListener("click", function(e) {
			e.preventDefault();
      
      items.forEach((item_open) => {
        if(item.parentNode.classList.contains('open-dropdown')){ /* nothing */ } else {
          item_open.parentNode.classList.remove('open-dropdown');
        }
			});

			item.parentNode.classList.toggle('open-dropdown');

		});	
	});
}

/* Accordion */
let items = document.querySelectorAll('.accordion .wp-block-column > h3');
items.forEach((item) => {
	item.addEventListener("click", function(e) {
		e.preventDefault();
		item.nextElementSibling.classList.toggle('open-accordion');
	});	
});

// INTERSECTION OBSERVER API

const observerOptions = {
  root: null, // Null = based on viewport
  rootMargin: "0px", // Margin for root if desired
  threshold: 0.3 // Percentage of visibility needed to execute function
};

function observerCallback(entries, observer) {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      // Fade in observed elements that are in view
      entry.target.classList.add('fadeIn');
    }
    else {
      // Fade out observed elements that are not in view
      //entry.target.classList.replace('fadeIn', 'fadeOut');
    }
  });
}

// Grab all relevant elements from DOM
const fadeElms = document.querySelectorAll('.fade');

// Call function for each element
const observer = new IntersectionObserver(observerCallback, observerOptions);
fadeElms.forEach(el => observer.observe(el));


/* Animation on Scroll System v2 (INTERSECTION OBSERVER API) */
(() => {
  const SELECTOR = '.reveal';

  if (!('IntersectionObserver' in window)) {
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll(SELECTOR).forEach(el => el.classList.add('is-inview'));
    });
    return;
  }

  const io = new IntersectionObserver((entries) => {
    for (const e of entries) {
      if (e.isIntersecting) {
        const el = e.target;
        requestAnimationFrame(() => el.classList.add('is-inview'));
        io.unobserve(el);
      }
    }
  }, { rootMargin: '0px 0px -20% 0px', threshold: 0 });

  const observeAll = () => {
    document.querySelectorAll(SELECTOR).forEach(el => {
      if (!el.classList.contains('is-inview')) io.observe(el);
    });
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', observeAll, { once: true });
  } else {
    observeAll();
  }

  // Per supportare elementi aggiunti dopo (es. CMS, SPA)
  new MutationObserver(observeAll)
    .observe(document.documentElement, { childList: true, subtree: true });
})();
/* Animation on Scroll System End */


// js scroll to
document.querySelectorAll('.scroll a[href^="#"]').forEach(elem => {
    elem.addEventListener('click', e => {
        e.preventDefault();
        let block = document.querySelector(elem.getAttribute('href')),
            offset = elem.dataset.offset ? parseInt(elem.dataset.offset) : 0,
            bodyOffset = document.body.getBoundingClientRect().top;
        window.scrollTo({
            top: block.getBoundingClientRect().top - bodyOffset + offset,
            behavior: 'smooth'
        }); 
        document.body.classList.remove('menu-open');
    });
});

// js one page scroll home (for Backwards compatibility)
let root_url = document.location.href.match(/(^[^#]*)/)

document.querySelectorAll('.home-scroll a[href^="'+root_url[0]+'#"]').forEach(elem => {
  elem.addEventListener('click', e => {
      e.preventDefault();
      elem_id = elem.getAttribute('href').replace(root_url[0], "");
      let block = document.querySelector(elem_id),
          offset = elem.dataset.offset ? parseInt(elem.dataset.offset) : 0,
          bodyOffset = document.body.getBoundingClientRect().top;
      window.scrollTo({
          top: block.getBoundingClientRect().top - bodyOffset + offset,
          behavior: 'smooth'
      }); 
      document.body.classList.remove('menu-open');
  });
});

// js one page scroll internal page (new class better semantic)
let root_url_2 = document.location.href.match(/(^[^#]*)/)

document.querySelectorAll('.page-scroll a[href^="'+root_url_2[0]+'#"]').forEach(elem => {
  elem.addEventListener('click', e => {
      e.preventDefault();
      elem_id = elem.getAttribute('href').replace(root_url[0], "");
      let block = document.querySelector(elem_id),
          offset = elem.dataset.offset ? parseInt(elem.dataset.offset) : 0,
          bodyOffset = document.body.getBoundingClientRect().top;
      window.scrollTo({
          top: block.getBoundingClientRect().top - bodyOffset + offset,
          behavior: 'smooth'
      }); 
      document.body.classList.remove('menu-open');
  });
});



// parallax cover optimize perfomrmance
const simpleParallax = (selector, modifier) => {
  const paras = Array.from(document.querySelectorAll(selector));
  if (!paras.length) return;

  let ticking = false;

  const update = () => {
    ticking = false;

    for (let i = 0; i < paras.length; i++) {
      const el = paras[i];
      const rect = el.getBoundingClientRect();

      if (rect.bottom < 0 || rect.top > window.innerHeight) continue;

      const y = Math.round((rect.top / modifier) * 100) / 100;
      el.style.objectPosition = `0% ${y}%`;
    }
  };

  const requestTick = () => {
    if (ticking) return;
    ticking = true;
    requestAnimationFrame(update);
  };

  window.addEventListener("scroll", requestTick, { passive: true });
  window.addEventListener("resize", requestTick, { passive: true });

  requestTick();
};

simpleParallax(".parallax-cover .wp-block-cover__image-background", 15);

/**
 * PARALLAX ENGINE — class-based, zero dependencies
 * https://claude.ai/chat/8f42dde2-5bc1-4372-8b87-7f700e861afd
 * ─────────────────────────────────────────────────
 * Add TWO classes to the same element:
 *
 *   parallax-start-{S}-end-{E}  → S = % viewport where movement STARTS
 *                                  E = % viewport where movement ENDS
 *                                  90 = bottom of viewport, 0 = top of viewport
 *                                  E supports negative values (beyond the top)
 *
 *   move-{M}{unit}              → total downward displacement
 *                                  unit = px | vh
 *
 *   On mobile (≤ 768px) the displacement is automatically halved.
 *
 * EXAMPLES
 *   <img class="parallax-start-90-end-10   move-15vh">
 *   <div class="parallax-start-80-end-20   move-200px">
 *   <div class="parallax-start-90-end--20  move-200px">  ← end beyond the top
 */

(() => {
  'use strict';

  const MOBILE_BREAKPOINT = 768;
  const MOBILE_FACTOR     = 0.5;

  // end supports negative values (double dash: end--20)
  const RANGE_RE = /^parallax-start-(\d{1,3})-end-(-?\d{1,3})$/;
  const MOVE_RE  = /^move-(-?\d+(?:\.\d+)?)(px|vh)$/;

  /* ── Parse element classes ── */
  function parseElement(el) {
    let startPct   = null;
    let endPct     = null;
    let moveAmount = null;
    let moveUnit   = null;

    for (const cls of el.classList) {
      const mr = cls.match(RANGE_RE);
      if (mr) { startPct = parseFloat(mr[1]) / 100; endPct = parseFloat(mr[2]) / 100; }

      const mm = cls.match(MOVE_RE);
      if (mm) { moveAmount = parseFloat(mm[1]); moveUnit = mm[2]; }
    }

    if (startPct === null || endPct === null || moveAmount === null) return null;
    return { el, startPct, endPct, moveAmount, moveUnit };
  }

  /* ── Original top position relative to document (ignores transform) ──
     offsetTop traverses offsetParent chain without reading the transform,
     so it is never affected by the translateY we apply.                  */
  function getDocumentTop(el) {
    let top = 0;
    let node = el;
    while (node) {
      top  += node.offsetTop;
      node  = node.offsetParent;
    }
    return top;
  }

  /* ── Collect valid elements ── */
  const items = [];

  document.querySelectorAll('[class*="parallax-start-"]').forEach(el => {
    if (![...el.classList].some(c => MOVE_RE.test(c))) return;
    const cfg = parseElement(el);
    if (!cfg) return;

    el.style.willChange = 'transform';
    el.style.transform  = 'translateY(0px)';

    // Cache original position — never re-read during scroll.
    // This breaks the feedback loop that caused flickering:
    //   getBoundingClientRect() includes the current translateY → trigger
    //   moved with the element → infinite oscillation.
    cfg.originTop = getDocumentTop(el);

    items.push(cfg);
  });

  if (!items.length) return;

  /* ── Viewport height + mobile flag — updated on resize ── */
  let vh       = window.innerHeight;
  let isMobile = window.innerWidth <= MOBILE_BREAKPOINT;

  let resizeTimer;
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
      vh       = window.innerHeight;
      isMobile = window.innerWidth <= MOBILE_BREAKPOINT;
      // Recalculate origins after layout change (e.g. reflow from resize)
      items.forEach(cfg => { cfg.originTop = getDocumentTop(cfg.el); });
    }, 150);
  }, { passive: true });

  /* ── Scroll loop via rAF ── */
  let ticking = false;

  function update() {
    ticking = false;

    const scrollY      = window.scrollY;
    const mobileFactor = isMobile ? MOBILE_FACTOR : 1;

    items.forEach(({ el, startPct, endPct, moveAmount, moveUnit, originTop }) => {
      // Top of element relative to viewport, computed from CACHED original
      // position — never polluted by the active translateY.
      const rectTop    = originTop - scrollY;
      const startLine  = vh * (1 - startPct);
      const endLine    = vh * (1 - endPct);    // negative endPct → endLine > vh
      const totalRange = endLine - startLine;
      const pastStart  = startLine - rectTop;

      if (pastStart <= 0) {
        el.style.transform = 'translateY(0px)';
        return;
      }

      const progress   = Math.min(pastStart / totalRange, 1);
      const unitPx     = moveUnit === 'vh' ? Math.abs(moveAmount) * (vh / 100) : Math.abs(moveAmount);
      const translateY = (progress * unitPx * mobileFactor).toFixed(2);

      el.style.transform = `translateY(${translateY}px)`;
    });
  }

  window.addEventListener('scroll', () => {
    if (!ticking) {
      requestAnimationFrame(update);
      ticking = true;
    }
  }, { passive: true });

  requestAnimationFrame(update);

})();
