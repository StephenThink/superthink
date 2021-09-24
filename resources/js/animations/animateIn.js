import gsap from 'gsap';

// Loco animation
const animateIn = function (el) {
    
    let tl = gsap.timeline();

    let intro = document.querySelector('.hero-intro');

    if( !el.classList.contains('seen') ) {
        tl.delay(1).to(el, {
            duration: "1.5",
            y: 0,
            opacity: 1,
            delay: .3,
            ease: "power4.out"
        });

        if( intro ) {

            console.log( intro )
            tl.from( intro, {
                autoAlpha: 0,
                duration: 2,
                ease: "power3.in"
            }, '<')
        }
    
        el.classList.add('seen');
    }
    
}

export default animateIn;