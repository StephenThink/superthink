/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/showReel.js ***!
  \**********************************/
var safariAgent = navigator.userAgent.indexOf("Safari") > -1;
console.log(navigator.userAgent);
var mobileAgent = navigator.userAgent.indexOf("iPhone") > -1;
console.log("iPhone: ", mobileAgent); // This is to be the same as the CSS amount
// ? found in the site.css file animation: showVideo 4s

var timeoutDelay = 2000;
var showVideo = document.querySelector('.show-reel');
var vid = showVideo.querySelector('video');
var playModal = showVideo.querySelector('.play-modal');
var vidBox = vid.getBoundingClientRect();
var body = document.body;
var showPlayReel = document.querySelector('.show-playreel'); // ? Hide the Play Showreel div if on an i-phone and using safari.

if (safariAgent && mobileAgent) {
  showPlayReel.classList.add('hidden');
}

function toggleAutoplay(element) {
  //if (safariAgent) {element.muted = true;}
  element.autoplay = true;
  element.playsinline = true;

  if (mobileAgent) {
    playModal.classList.remove("hidden");
    playModal.classList.add("flex");
  } else {
    if (safariAgent) {
      hideModal();
    } else {
      element.play();
    }
  } //setTimeout(() => element.muted = false, 4000);

}

function hideModal() {
  playModal.classList.toggle("flex");
  playModal.classList.toggle("hidden");
}

function showVid() {
  //console.log(showVideo);
  console.log("Show Video Clicked");
  vid.classList.add('show');
  setTimeout(function () {
    toggleAutoplay(document.querySelector('video'));
  }, timeoutDelay); // console.log(vid);
}

function pausePlay() {
  hideModal();

  if (!vid.paused) {
    vid.pause();
  } else {
    vid.play();
  }
}

function hideAgain() {
  // Hide the Video once off screen.
  vid.pause();
  vid.classList.remove('show');
  playModal.classList.remove("flex");
  playModal.classList.add("hidden");
} // ? When the window scrolls


window.onscroll = function () {
  return ScrollCheck();
};

function ScrollCheck() {
  if (body.scrollTop > vidBox.height || document.documentElement.scrollTop > vidBox.height) {
    hideAgain();
  }
}
/******/ })()
;