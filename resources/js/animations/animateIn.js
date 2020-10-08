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

export default animateIn;