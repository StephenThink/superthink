
import { gsap } from 'gsap';

// initial load. 
document
.addEventListener('DOMContentLoaded', function() {

    let handle = document.getElementById('handle');
    let burger = document.querySelectorAll('.burger')[0];
    let nav = document.getElementById('navigation-panel');
    let state = handle.dataset.state;

    let open = gsap.timeline();
    let close = gsap.timeline();

    burger.addEventListener('click', function(e) {
        
        e.preventDefault();

        // if(state == 'closed') {
        //     console.log('open the nav');
            // handle.dataset.state = 'open';
            nav.classList.toggle('open');
            handle.classList.toggle('open');
        //     open.to(handle, {
        //         backgroundColor: "#FFC734"
        //     }).to(nav, {
        //         transform: "translateX( calc(100vw + 5rem ) )"
        //     }, "<");

        // }

        // if(state == 'open') {
        //     console.log('close the nav');
        //     handle.dataset.state = 'closed';
        //     close.to(handle, {
        //         backgroundColor: "#42454A"
        //     }).to(nav, {
        //         transform: "translateX( calc(-100vw - 5rem ) )"
        //     })

        // }

    });
    
}, false);