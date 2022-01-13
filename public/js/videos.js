/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************************!*\
  !*** ./resources/js/caseStudies/videos.js ***!
  \********************************************/
var caseVideoParent = document.querySelectorAll('.case-video-parent');
caseVideoParent.forEach(function (item) {
  item.addEventListener('click', function (event) {
    var playState = item.dataset.state;
    stopAllVideos();

    if (playState == "paused") {
      hidePlayModal();
    } else {
      showPlayModal();
    } // console.log("playing:",playing)

  }, {
    capture: true
  });
});

function stopAllVideos() {
  //    console.log("Stopping all videos")
  for (var i = 0; i < caseVideoParent.length; i++) {
    // Pause all Videos
    caseVideoParent[i].lastElementChild.pause();
    caseVideoParent[i].dataset.state = "paused"; // Show Play Modal

    caseVideoParent[i].firstElementChild.classList.remove("opacity-0");
    caseVideoParent[i].firstElementChild.classList.add("opacity-50");
    caseVideoParent[i].firstElementChild.lastElementChild.classList.remove("hidden");
    caseVideoParent[i].firstElementChild.lastElementChild.classList.add("flex");
  }
}

function hidePlayModal() {
  //   console.log("hide")
  event.currentTarget.firstElementChild.classList.remove("opacity-50");
  event.currentTarget.firstElementChild.classList.add("opacity-0");
  event.currentTarget.firstElementChild.firstElementChild.classList.remove("flex");
  event.currentTarget.firstElementChild.firstElementChild.classList.add("hidden");
  event.currentTarget.lastElementChild.play();
  event.currentTarget.dataset.state = "play";
}

function showPlayModal() {
  //   console.log("show")
  event.currentTarget.firstElementChild.classList.add("opacity-50");
  event.currentTarget.firstElementChild.classList.remove("opacity-0");
  event.currentTarget.firstElementChild.firstElementChild.classList.add("flex");
  event.currentTarget.firstElementChild.firstElementChild.classList.remove("hidden");
  event.currentTarget.lastElementChild.pause();
  event.currentTarget.dataset.state = "paused";
} // Monitoring if the video is on or off screen


var observer = new IntersectionObserver(function (entries) {
  entries.forEach(function (entry) {
    // console.log(entry.target, entry.isIntersecting)
    entry.target.dataset.state = "paused";
    entry.target.lastElementChild.pause();
    entry.target.firstElementChild.classList.add("opacity-50");
    entry.target.firstElementChild.classList.remove("opacity-0");
    entry.target.firstElementChild.firstElementChild.classList.add("flex");
    entry.target.firstElementChild.firstElementChild.classList.remove("hidden");
  }); //console.log(entries)
});
caseVideoParent.forEach(function (item) {
  observer.observe(item);
});
/******/ })()
;