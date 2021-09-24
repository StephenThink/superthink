import gsap from 'gsap'
import animateTheBurger from '../components/hamburger'

const mainNavigationLeave = (container) => {

    let topLeft     = document.querySelector('.screen-top-left')
    let topRight    = document.querySelector('.screen-top-right')
    let bottomLeft  = document.querySelector('.screen-bottom-left')
    let bottomRight = document.querySelector('.screen-bottom-right')

    animateTheBurger()

    let tl = gsap.timeline({
        defaults: { 
            duration: .2,
            ease: "power4.out"

        }
    });

    let bubbles = document.querySelectorAll('.bubble')

    tl.to(bubbles, {
        scale: 2,
        stagger: {
            each: .1,
            from: "random",
            ease: "power2.inOut",
        }

    })


    // tl
    // .to(topLeft, {
    //     x: '0%',
    //     y: '0%'
    // }) 
    // .to( topRight, {
    //     x: '0%',
    //     y: '0%'
    // }, '<')
    // .to( bottomLeft, {
    //     x: '0%',
    //     y: '0%'
    // }, '<')
    // .to( bottomRight, {
    //     x: '0%',
    //     y: '0%',
    // }, '<')

    return tl

}

export default mainNavigationLeave