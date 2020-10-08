import { gsap } from 'gsap';

import { MotionPathPlugin } from "gsap/MotionPathPlugin";

gsap.registerPlugin(MotionPathPlugin);

const animateTheBurger = ( e ) => {
    
    e.preventDefault();

    let handle = document.getElementById('handle');
    let nav = document.getElementById('navigation-panel');
    
    nav.classList.toggle('open');
    handle.classList.toggle('open');

}



// const animateTheBurger = () => {
    
//     gsap.to("#bottom", {
//         motionPath: {
//             path: "#bottom-path",
//             align: "#bottom-path",
//             alignOrigin: [0.5, 0.5],
//             autoRotate: true
//         },
//         duration: 5,
//         ease: "power1.inOut"
//     });

    // const tl = gsap.timeline({defaults:{ease:"power2.inOut"}});

    // gsap.set("#theBurger", { autoAlpha:1 });
    // gsap.set(".buns", { drawSVG: "0% 30%" });
    // gsap.set(".letters", { drawSVG: "53.5% 100%", x: -155 });


    // tl.to(".patty", { duration: 0.35, drawSVG: "50% 50%"}, 0);
    // tl.to(".patty", { duration: 0.1, opacity: 0, ease: "none" }, 0.25);
    // tl.to(".buns", { duration: 0.85, drawSVG: "69% 96.5%" }, 0);
    // tl.to(".letters", { duration: 0.85, drawSVG: "0% 53%", x: 0 }, 0);

    // tl.reversed(true);

    // tl.reversed(!tl.reversed());

// }



export default animateTheBurger;