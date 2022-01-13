const caseVideoParent = document.querySelectorAll('.case-video-parent');


caseVideoParent.forEach((item) => {
    item.addEventListener('click', (event) => {
        const playState = item.dataset.state

        stopAllVideos()

        if (playState == "paused") {
            hidePlayModal(event.currentTarget)
        } else {
            showPlayModal(event.currentTarget)
        }
        // console.log("playing:",playing)

    }, {
        capture: true
    })
})

function stopAllVideos() {

    //    console.log("Stopping all videos")

    for (let i = 0; i < caseVideoParent.length; i++) {
        // Pause all Videos
        showPlayModal(caseVideoParent[i])
    }
}

function hidePlayModal(element) {
    //   console.log("hide")
    element.firstElementChild.classList.remove("opacity-50");
    element.firstElementChild.classList.add("opacity-0");
    element.firstElementChild.firstElementChild.classList.remove("flex");
    element.firstElementChild.firstElementChild.classList.add("hidden");

    element.lastElementChild.play()
    element.dataset.state = "play"


}

function showPlayModal(element) {
    //   console.log("show")
    element.firstElementChild.classList.add("opacity-50");
    element.firstElementChild.classList.remove("opacity-0");
    element.firstElementChild.firstElementChild.classList.add("flex");
    element.firstElementChild.firstElementChild.classList.remove("hidden");
    element.lastElementChild.pause()
    element.dataset.state = "paused"
}

// Monitoring if the video is on or off screen
const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        showPlayModal(entry.target)
        console.log(entry.target, entry.isIntersecting)
       // ? Before Refactoring
       // entry.target.dataset.state = "paused"
       // entry.target.lastElementChild.pause();
       // entry.target.firstElementChild.classList.add("opacity-50");
       // entry.target.firstElementChild.classList.remove("opacity-0");
       // entry.target.firstElementChild.firstElementChild.classList.add("flex");
       // entry.target.firstElementChild.firstElementChild.classList.remove("hidden");
    })
    //console.log(entries)
})

// Get all the videos there own observer
caseVideoParent.forEach(item => {
    observer.observe(item)
})