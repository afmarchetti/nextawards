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


// parallax cover
// https://github.com/piersrueb/simpleparallax

const simpleParallax = (elem, modifier) => {
  let paras = [...document.querySelectorAll(elem)];
  const sp = () => {
    for (let i = 0; i < paras.length; i++) {
      let x = paras[i].getBoundingClientRect().top / modifier;
      let y = Math.round(x * 100) / 100;
      paras[i].style.objectPosition = "0% " + y + "%";
    }
    requestAnimationFrame(sp);
  };
  requestAnimationFrame(sp);
};

simpleParallax(".parallax-cover .wp-block-cover__image-background", 15);