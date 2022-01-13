/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************************!*\
  !*** ./resources/js/caseStudies/videos.js ***!
  \********************************************/
var caseVideoParent = document.querySelectorAll('.case-video-parent');
caseVideoParent.forEach(function (item) {
  item.addEventListener('click', function (event) {
    var playState = item.dataset.state;
    var imageState = item.dataset.source; // if there is an Video Thumbnail then get rid of the thumbnail and opacity

    if (imageState) {
      event.currentTarget.firstElementChild.style.backgroundImage = null;
      event.currentTarget.firstElementChild.style.opacity = null;
    }

    stopAllVideos();

    if (playState == "paused") {
      hidePlayModal(event.currentTarget);
    } else {
      showPlayModal(event.currentTarget);
    } // console.log("playing:",playing)

  }, {
    capture: true
  });
});

function stopAllVideos() {
  //    console.log("Stopping all videos")
  for (var i = 0; i < caseVideoParent.length; i++) {
    // Pause all Videos
    showPlayModal(caseVideoParent[i]);
  }
}

function hidePlayModal(element) {
  //   console.log("hide")
  console.log(element);
  element.firstElementChild.classList.remove("opacity-50");
  element.firstElementChild.classList.add("opacity-0");
  element.firstElementChild.firstElementChild.classList.remove("flex");
  element.firstElementChild.firstElementChild.classList.add("hidden");
  element.lastElementChild.play();
  element.dataset.state = "play";
}

function showPlayModal(element) {
  //   console.log("show")
  element.firstElementChild.classList.add("opacity-50");
  element.firstElementChild.classList.remove("opacity-0");
  element.firstElementChild.firstElementChild.classList.add("flex");
  element.firstElementChild.firstElementChild.classList.remove("hidden");
  element.lastElementChild.pause();
  element.dataset.state = "paused";
} // Monitoring if the video is on or off screen


var observer = new IntersectionObserver(function (entries) {
  entries.forEach(function (entry) {
    showPlayModal(entry.target); // console.log(entry.target, entry.isIntersecting)
    // ? Before Refactoring
    // entry.target.dataset.state = "paused"
    // entry.target.lastElementChild.pause();
    // entry.target.firstElementChild.classList.add("opacity-50");
    // entry.target.firstElementChild.classList.remove("opacity-0");
    // entry.target.firstElementChild.firstElementChild.classList.add("flex");
    // entry.target.firstElementChild.firstElementChild.classList.remove("hidden");
  }); //console.log(entries)
}); // Get all the videos there own observer

caseVideoParent.forEach(function (item) {
  observer.observe(item);
});
/******/ })()
;