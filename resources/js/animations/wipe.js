import gsap from 'gsap';
//  Loco animation
const wipe = (way, obj) => { 
    
    let el = obj.el;
    let image = el.querySelectorAll('img')[0];
    let wipe = el.querySelectorAll('.initial-wipe')[0];
    let delay = el.dataset.scrollDelay/3;
   
    gsap.to(wipe, {
        duration: "1.5",
        x: "0",
        ease: "power4.out",
        delay: delay
    });

    gsap.to(image, {
        x: "0",
        duration: "2",
        opacity: 1,
        ease: "power4.out",
        delay: delay
    })
}

export default wipe;