import gsap from 'gsap';
import findTheActiveOne from './findTheActiveOne';
// Slide animation
const moveSlide = (e) => {
    let sectionOutMove;
    let tl = gsap.timeline();
    var slide = e.target.dataset.slide;
    let mainSection = document.querySelectorAll('.filter-section')[0];
    let buttons = document.querySelectorAll('.content-slider');
    let allSwipers = document.querySelectorAll('.mySwiper');
    let setSwipers = false

    sectionOutMove = findTheActiveOne('.filter-section', true);

    if (!sectionOutMove.classList.contains('section-services')) {
        // When on everything


        // This only allows the function to run once
        if (!setSwipers) {
            setSwipers = true;
            var swiper = new Swiper(".mySwiper", {
                slidesPerView: 1,
                spaceBetween: 30,
                slidesPerGroup: 1,
                loop: true,
                loopFillGroupWithBlank: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev"
                }
            });
        }
         allSwipers.forEach(($item)=>{
            $item.classList.remove('hidden');
            
        })
    } else {
        // The Time out is there just so that you dont lose the pictures before the end of the transition.
        setTimeout(() => {
            // Hides all the Swipers
            allSwipers.forEach(($item)=>{
                $item.classList.add('hidden');
                
            })    
        }, 500);
        
        
    }
    
    //bail if we have press the same button. 
    if( sectionOutMove.classList.contains('section-' + slide ) ) {
        return 'bail';
    }

    //  removes all actives from buttons
    buttons.forEach( el => {
        el.classList.remove('active');
    });
    
    // add active to cliked element
    e.target.classList.add('active');

    //  remove active from what we're moving out. 
    sectionOutMove.classList.remove('active');
    // find the section to move based on clas from button
    var sectionToMove = document.querySelectorAll('.section-' + slide)[0];
    //  make that active. 
    sectionToMove.classList.add('active');
    
    //  move it all 
    tl.to(sectionToMove, {
        x: 0
    })
    .to(sectionOutMove, {
        x: "-100%"
    }, "<")
    //  make the main section as high as the content
    .to(mainSection, {
        height: ( sectionToMove.getBoundingClientRect().height + 50 ) + 'px'
    }, "<");
    
}



export default moveSlide