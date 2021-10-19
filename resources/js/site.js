// This is all you.

//import './pageTransitions.js'
import { page } from './default'

//Alpine
import Alpine from 'alpinejs'
 
window.Alpine = Alpine
 
Alpine.start()

page()

// components
import { animateTheBurger } from './components';

// messages
// import message from './components/message';

let burger = document.querySelectorAll('.burger')[0];
burger.addEventListener('click', animateTheBurger, false);


// Animations
import { wipe, animateIn, campaignSection, helpSection } from './animations';

import LocomotiveScroll from 'locomotive-scroll';
import { scroll, swipe, SharingIsCaring } from './helpers';

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



//   enable hover effects on touch screens! 
document.addEventListener("touchstart", function() {}, true);


// Manually toggle light siwtch. 
var lightswitch = document.querySelector('.switch');
var html = document.getElementsByTagName('html')[0];
var TF = document.querySelector('.target-filter');


lightswitch.addEventListener('click', function(e) { 

    if( html.classList.contains('dark')) {
        // dark mode needs turning off. 
        e.target.classList.remove('on');
        html.classList.remove('dark');
        try {TF.classList.remove('sjinvert');}catch{};
        localStorage.setItem('thinkcreative.theme', 'light');
        console.log("Back to the Light");
        return;
    }

    e.target.classList.add('on');
    html.classList.add('dark');
    try {TF.classList.add('sjinvert');}catch{};
    localStorage.setItem('thinkcreative.theme', 'dark');
    console.log("Step back into the Dark");

});

// watch for Dark mode on the system, only when it's changed.
window.matchMedia('(prefers-color-scheme: dark)')
      .addEventListener('change', event => {
                
        if (event.matches) {
            //dark mode
            html.classList.add('dark');
            lightswitch.classList.add('on');
            localStorage.setItem('thinkcreative.theme', 'dark');
        } else {
            //light mode
            html.classList.remove('dark');
            lightswitch.classList.remove('on');
            localStorage.setItem('thinkcreative.theme','light');
        }
})

// Dark mode initial
if (localStorage['thinkcreative.theme'] === 'dark' || (!('thinkcreative.theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    html.classList.add('dark');
    lightswitch.classList.add('on');
    try {TF.classList.add('sjinvert');}catch{};

    console.log("Dark");

} else {
    html.classList.remove('dark');
    lightswitch.classList.remove('on');
    try {TF.classList.remove('sjinvert');}catch{};
    console.log("Light");

}

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
