/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/mininav.js ***!
  \*********************************/
// Variables
var body = document.body;
var windowHeight = window.innerHeight;
var sjj = document.querySelector('sjj');
var sjjWidth = sjj.clientWidth;
var sjjHeight = sjj.clientHeight;
var handle = document.querySelector('#handle');
var handleHeight = handle.clientHeight; // Height of the Navbar normally (103 for mobile view)

var nav = document.getElementById('navigation-panel');
var cta = document.querySelector('#cta');
var topOfsjj = sjj.offsetTop;
handleHeight = handleHeight > handle.clientWidth ? 0 : handleHeight;
var ctaTop = cta.offsetTop + handleHeight + sjjHeight;

function fixsjj() {
  // These are help to stop the flickering
  if (window.scrollY >= ctaTop) {
    sjj.classList.remove('flex');
    sjj.classList.add('hidden');
  }

  if (window.scrollY <= ctaTop - 10) {
    sjj.classList.add('flex');
    sjj.classList.remove('hidden');
  } //console.log(topOfsjj, window.scrollY + handleHeight);


  if (window.scrollY + handleHeight >= topOfsjj && window.scrollY <= ctaTop) {
    nav.classList.remove('open');
    handle.classList.remove('open');
    sjj.style.top = handleHeight + 'px';
    sjj.style.width = sjjWidth + 'px';
    body.classList.add('fixed-sjj');
  } else {
    removeMiniNav();
  }
}

function removeMiniNav() {
  body.classList.remove('fixed-sjj');
  sjj.style.top = 0;
}

window.addEventListener('scroll', fixsjj);
window.addEventListener('resize', function () {
  handleHeight = handleHeight > handle.clientWidth ? 0 : handleHeight;
  sjjWidth = sjj.clientWidth;
});
/******/ })()
;