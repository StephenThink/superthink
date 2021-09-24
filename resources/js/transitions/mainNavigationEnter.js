import gsap from 'gsap'

import { animateIn } from '../animations'

const mainNavigationEnter = ( current, next ) => {

    // let topLeft     = document.querySelector('.screen-top-left')
    // let topRight    = document.querySelector('.screen-top-right')
    // let bottomLeft  = document.querySelector('.screen-bottom-left')
    // let bottomRight = document.querySelector('.screen-bottom-right')

    // let heroText    = next.container.querySelector('.hero-main-text')

    // // gsap.to( current.container, {
    // //     autoAlpha: 0,
    // //     height: 0,
    // //     width: 0
    // // })

    let bubbles = document.querySelectorAll('.bubble')
    current.container.classList.add('hidden')

    let timeline = gsap.timeline({
        defaults: { 
            duration: .2,
            ease: "power4.out"
        }
    })

    // timeline.to(topLeft, {
    //     x: '-100%',
    //     y: '-100%',
    //     // onComplete: function() {
    //     //     if( heroText )
    //     //         animateIn( heroText )
    //     // }
    // }) 
    // .to( topRight, {
    //     x: '100%',
    //     y: '-100%'
    // }, '<')
    // .to( bottomLeft, {
    //     x: '-100%',
    //     y: '100%'
    // }, '<')
    // .to( bottomRight, {
    //     x: '100%',
    //     y: '100%',
       
    // }, '<')

    

    tl.to(bubbles, {
        scale: 0,
        stagger: {
            each: 0.1,
            from: "random",
            ease: "power2.inOut",
        }

    })

    

    return timeline;

}

export default mainNavigationEnter;