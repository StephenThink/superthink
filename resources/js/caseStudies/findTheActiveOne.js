import gsap from 'gsap';
// finding the active slide
const findTheActiveOne = (selector, returnFlag) => {
    let wrapper = document.querySelectorAll(selector)[0];
    let active;
    if( !wrapper )
        return false;

    wrapper.querySelectorAll('.section')
    .forEach( el => {
        if(el.classList.contains('active')) {
            if(returnFlag) {
                active = el;
                return;
            }
            wrapper.style.height = (el.getBoundingClientRect().height + 50) + "px";
        } else {
            //  We need to move the other ones!
            gsap.to(el, {
                duration: 0,
                x: "100%"
            });
        }
    });

    if( returnFlag )
        return active;

}

export default findTheActiveOne;