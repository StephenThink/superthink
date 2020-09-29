// This is all you.
import './bootstrap.js';

import './helpers/Animations';

import { scroll } from './helpers/ScrollerSettings';

import LocomotiveScroll from 'locomotive-scroll';
import inView from 'in-view/src/in-view.js';
import barba from '@barba/core';
import gsap from 'gsap';

// Loco animation
const animateIn = function (el) {
    
    if( !el.classList.contains('seen') ) {
        gsap.to(el, {
            duration: "1.5",
            y: 0,
            opacity: 1,
            delay: .3,
            ease: "power4.out"
        });
    
        el.classList.add('seen');
    }
    
}
//  Loco animation
const wipe = (way, obj) => { 
    
    let el = obj.el;
    let image = el.querySelectorAll('img')[0];
    let wipe = el.querySelectorAll('.initial-wipe')[0];
    let delay = el.dataset.scrollDelay/3;
   
    gsap.to(wipe, {
        duration: "1.5",
        x: "0",
        ease: "power4.out",
        delay: delay
    });

    gsap.to(image, {
        x: "0",
        duration: "2",
        opacity: 1,
        ease: "power4.out",
        delay: delay
    })
}

// finding the active slide
const findTheActiveOne = (selector, returnFlag) => {
    let wrapper = document.querySelectorAll(selector)[0];
    let active;
    if( !wrapper )
        return false;

    wrapper.querySelectorAll('.section')
    .forEach( el => {
        if(el.classList.contains('active')) {
            if(returnFlag) {
                active = el;
                return;
            }
            wrapper.style.height = (el.getBoundingClientRect().height + 50) + "px";
        } else {
            //  We need to move the other ones!
            gsap.to(el, {
                duration: 0,
                x: "100%"
            });
        }
    });

    if( returnFlag )
        return active;

}

// Slide animation
const moveSlide = (e) => {
    let sectionOutMove;
    let tl = gsap.timeline();
    var slide = e.target.dataset.slide;
    let mainSection = document.querySelectorAll('.filter-section')[0];
    let buttons = document.querySelectorAll('.content-slider');

    sectionOutMove = findTheActiveOne('.filter-section', true);
    
    //bail if we have press the same button. 
    if( sectionOutMove.classList.contains('section-' + slide ) ) {
        return 'bail';
    }

    //  removes all actives from buttons
    buttons.forEach( el => {
        el.classList.remove('active');
    });
    
    // add active to cliked element
    e.target.classList.add('active');

    //  remove active from what we're moving out. 
    sectionOutMove.classList.remove('active');
    // find the section to move based on clas from button
    var sectionToMove = document.querySelectorAll('.section-' + slide)[0];
    //  make that active. 
    sectionToMove.classList.add('active');
    
    //  move it all 
    tl.to(sectionToMove, {
        x: 0
    })
    .to(sectionOutMove, {
        x: "-100%"
    }, "<")
    //  make the main section as high as the content
    .to(mainSection, {
        height: ( sectionToMove.getBoundingClientRect().height + 50 ) + 'px'
    }, "<");
    
}

let doc = document;

doc.addEventListener('DOMContentLoaded', function() {


    const locomotiveScroll = new LocomotiveScroll({
        el: document.querySelector(scroll.container),
        ...scroll.options,
    })



    // inView('.fancy:not(.seen)').on('enter', animateIn);
    // const scroll = new LocomotiveScroll();

    locomotiveScroll.on('call', (value, way, obj) => {
        
        // do something
        if (value === "wipe") wipe(way, obj);
        if (value === "fancy") animateIn(obj.el);

    });

    //  Always be at the top when entering the page.
    barba.hooks.enter(() => {
        window.scrollTo(0, 0);
    });

    //  Always close the navigation when leaving a page. 
    barba.hooks.beforeLeave(() => {
        let handle = document.getElementById('handle');
        let nav = document.getElementById('navigation-panel');
        nav.classList.remove('open');
        handle.classList.remove('open');
    });

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

    findTheActiveOne('.filter-section');

    var contentSlides =  document.querySelectorAll('.content-slider');

    if( contentSlides.length > 0 ){
        contentSlides.forEach( el => {
            el.addEventListener('click', moveSlide);
        });
    }

});
