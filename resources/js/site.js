// This is all you.
import './bootstrap.js';

import './helpers/Animations';

import { scroll } from './helpers/ScrollerSettings';

import LocomotiveScroll from 'locomotive-scroll';
import inView from 'in-view/src/in-view.js';
import barba from '@barba/core';
import gsap from 'gsap';


// components
import { animateTheBurger } from './components';

// Animations
import { wipe, animateIn } from './animations';

// caseStudies
import { findTheActiveOne, moveSlide } from './caseStudies';

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

