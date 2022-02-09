
let safariAgent = navigator.userAgent.indexOf("Safari") > -1;
console.log(navigator.userAgent);
let mobileAgent = navigator.userAgent.indexOf("iPhone") > -1;
console.log("iPhone: ", mobileAgent)


    // This is to be the same as the CSS amount
    // ? found in the site.css file animation: showVideo 4s
    const timeoutDelay = 2000; 

    const showVideo = document.querySelector('.show-reel');
    const vid = document.querySelector('video');
    const playModal = document.querySelector('.play-modal');
    const vidBox = vid.getBoundingClientRect();
    const body = document.body;
    const showPlayReel = document.querySelector('.show-playreel');
    const showReel = document.getElementById('showReel');
    const hideModalView = document.getElementById('hideModal');
    
    showReel.addEventListener("click", showVid);
    hideModalView.addEventListener("click", hideModal);
    vid.addEventListener("click", pausePlay);
    
    // ? Hide the Play Showreel div if on an i-phone and using safari.
    // if (safariAgent && mobileAgent) {
    //     showPlayReel.classList.add('hidden');
    // }

    function toggleAutoplay(element) {
        //if (safariAgent) {element.muted = true;}
          

        element.autoplay = true;
        element.playsinline = true;

        if (mobileAgent) {
           playModal.classList.remove("hidden");
           playModal.classList.add("flex");
        } else {
            if (safariAgent) {
                hideModal()
            } else {
                element.play();
            }
        }

        
        //setTimeout(() => element.muted = false, 4000);
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
            toggleAutoplay(document.querySelector('video'),
            );
        }, timeoutDelay);
        
        
        // console.log(vid);
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
    }

    // ? When the window scrolls
    window.onscroll = () => ScrollCheck();

    function ScrollCheck() {
      if (body.scrollTop > vidBox.height || document.documentElement.scrollTop > vidBox.height) {
        hideAgain();
        
      } 
    }