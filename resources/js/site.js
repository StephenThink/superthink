// This is all you.
import LocomotiveScroll from 'locomotive-scroll';

import Swiper, { Navigation, Pagination, EffectFade } from 'swiper';
// configure Swiper to use modules
Swiper.use([Navigation, Pagination, EffectFade]);

import 'swiper/swiper-bundle.css';

// not being used 
// import inView from 'in-view/src/in-view.js';
// import barba from '@barba/core';
// import gsap from 'gsap';

// unused
// import './bootstrap.js';

import { scroll, swipe, SharingIsCaring } from './helpers';
// components
import { animateTheBurger } from './components';
// Animations
import { wipe, animateIn } from './animations';
// caseStudies
import { findTheActiveOne, moveSlide } from './caseStudies';
// messages
// import message from './components/message';

let burger = document.querySelectorAll('.burger')[0];
burger.addEventListener('click', animateTheBurger, false);


findTheActiveOne('.filter-section');

var contentSlides =  document.querySelectorAll('.content-slider');

if( contentSlides.length > 0 ){
    contentSlides.forEach( el => {
        el.addEventListener('click', moveSlide);
    });
}


const locomotiveScroll = new LocomotiveScroll({
    el: document.querySelector(scroll.container),
    ...scroll.options,
})

locomotiveScroll.on('call', (value, way, obj) => {
    
    // do something
    if (value === "wipe") wipe(way, obj);
    if (value === "fancy") animateIn(obj.el);

});

// init Swiper:
const swiper = new Swiper(swipe.container, {
    spaceBetween: 30,
    effect: 'fade',
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.custom-button-next',
        prevEl: '.custom-button-prev',
    },
});

let fileInput = document.querySelector(".upload-cv input");

if( fileInput ) {
    document.querySelector(".upload-cv input").onchange = function(e) {
        document.querySelector('.custom-filename').innerHTML = this.value.split(/(\\|\/)/g).pop();   
    };
}

//   enable hover effects on touch screens! 
document.addEventListener("touchstart", function() {}, true);


// Manually toggle light siwtch. 
var lightswitch = document.querySelector('.switch');
var html = document.getElementsByTagName('html')[0];

lightswitch.addEventListener('click', function(e) { 

    if( html.classList.contains('dark')) {
        // dark mode needs turning off. 
        e.target.classList.remove('on');
        html.classList.remove('dark');
        localStorage.setItem('thinkcreative.theme', 'light');

        return;
    }

    e.target.classList.add('on');
    html.classList.add('dark');
    localStorage.setItem('thinkcreative.theme', 'dark');

});

// watch for Dark mode on the system, only when it's changed.
window.matchMedia('(prefers-color-scheme: dark)')
      .addEventListener('change', event => {
                
        if (event.matches) {
            //dark mode
            html.classList.add('dark');
            lightswitch.classList.add('on');
            localStorage.setItem('thinkcreative.theme', 'dark');
        } else {
            //light mode
            html.classList.remove('dark');
            lightswitch.classList.remove('on');
            localStorage.setItem('thinkcreative.theme','light');
        }
})



// Dark mode initial
if (localStorage['thinkcreative.theme'] === 'dark' || (!('thinkcreative.theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    html.classList.add('dark');
    lightswitch.classList.add('on');
} else {
    html.classList.remove('dark');
    lightswitch.classList.remove('on');
}

//  Always be at the top when entering the page.
// barba.hooks.enter(() => {
//     window.scrollTo(0, 0);
// });

//  Always close the navigation when leaving a page. 
// barba.hooks.beforeLeave(() => {
//     let handle = document.getElementById('handle');
//     let nav = document.getElementById('navigation-panel');
//     nav.classList.remove('open');
//     handle.classList.remove('open');
// });

// barba.init({
//     transitions: [{
//         name: 'opacity-transition',
//         leave(data) {

//             return gsap.to(data.current.container, {
//                 opacity: 0
//             }, 5);

//         },
//         enter(data) {
//             inView('.fancy:not(.seen)').on('enter', animateIn);
//             console.log('ENTERING');
//             return gsap.from(data.next.container, {
//                 opacity: 0
//             });
//         }
//       }]
// });

