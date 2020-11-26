// This is all you.
import LocomotiveScroll from 'locomotive-scroll';

import Swiper, { Navigation, Pagination, EffectFade } from 'swiper';
// configure Swiper to use modules
Swiper.use([Navigation, Pagination, EffectFade]);

import 'swiper/swiper-bundle.css';

// not being used 
import inView from 'in-view/src/in-view.js';
import barba from '@barba/core';
import gsap from 'gsap';

// unused
import './bootstrap.js';

import { scroll, swipe, SharingIsCaring } from './helpers';
// components
import { animateTheBurger } from './components';
// Animations
import { wipe, animateIn } from './animations';
// caseStudies
import { findTheActiveOne, moveSlide } from './caseStudies';
// messages
import message from './components/message';

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


//   enable hover effects on touch screens! 
document.addEventListener("touchstart", function() {}, true);


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

