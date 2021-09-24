
// caseStudies
import { findTheActiveOne, moveSlide } from './caseStudies';
// Animations
import { wipe, animateIn, campaignSection, helpSection } from './animations';

import LocomotiveScroll from 'locomotive-scroll';
import { scroll, swipe, SharingIsCaring } from './helpers';

import Swiper, { Navigation, Pagination, EffectFade } from 'swiper';
// configure Swiper to use modules
Swiper.use([Navigation, Pagination, EffectFade]);

import 'swiper/swiper-bundle.css';

export const page = () => {
    
    //  work page slide navigation
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
        if (value === "campaign-section") campaignSection(obj.el)
        if (value === "help-section") helpSection(obj.el)

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
}