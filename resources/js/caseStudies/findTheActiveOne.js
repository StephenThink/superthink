import gsap from 'gsap';
// finding the active slide
const findTheActiveOne = (selector, returnFlag) => {

    let wrapper = document.querySelectorAll(selector)[0];
    let active;
    let tallest;
    if( !wrapper )
        return false;


    wrapper.querySelectorAll('.section')
    .forEach( el => {
        
        tallest = (el.getBoundingClientRect().height >= tallest ? tallest : el.getBoundingClientRect().height)
        
        if(el.classList.contains('active')) {
            if(returnFlag) {
                active = el;
                return;
            }
            
        
        } else {
            //  We need to move the other ones!
            gsap.to(el, {
                duration: 0,
                x: "100%"
            });
        }
    })

    wrapper.style.height = tallest + "px";

    if( returnFlag )
        return active;

}

export default findTheActiveOne;