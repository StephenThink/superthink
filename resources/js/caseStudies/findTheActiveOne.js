import gsap from 'gsap';
// finding the active slide

const hits = document.querySelector('.section-hits');
var hitsHeight = 0;
// console.log(hits.offsetHeight);
if (hits) {
    hitsHeight = hits.offsetHeight;
} 
// console.info(hitsHeight);



const findTheActiveOne = (selector, returnFlag) => {

    let wrapper = document.querySelectorAll(selector)[0];
    let active;
    let tallest;
    if( !wrapper )
        return false;

        // console.log(wrapper)
        // console.log("Client Height: ",wrapper.clientHeight)
        // console.log("Offset Height: ",wrapper.offsetHeight)
        // console.log("scroll Height: ",wrapper.scrollHeight)

    wrapper.querySelectorAll('.section')
    .forEach( el => {
// console.log("second ",hitsHeight)

        tallest = hitsHeight;
        tallest = (el.getBoundingClientRect().height >= tallest ? tallest : el.getBoundingClientRect().height)
        // console.log(el);
        // console.log(tallest);
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