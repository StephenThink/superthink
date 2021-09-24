import gsap from 'gsap'

const mainNavigationOnce = () => {

    // let topLeft     = document.querySelector('.screen-top-left')
    // let topRight    = document.querySelector('.screen-top-right')
    // let bottomLeft  = document.querySelector('.screen-bottom-left')
    // let bottomRight = document.querySelector('.screen-bottom-right')

    let bubbles = document.querySelectorAll(".bubble")

    let tl = gsap.timeline({
        defaults: { 
            duration: .2,
            ease: "power4.inOut"
        }
    })
        
    // tl.to(topLeft, {
    //     x: '-100%',
    //     y: '-100%'
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


    return tl

}

export default mainNavigationOnce;