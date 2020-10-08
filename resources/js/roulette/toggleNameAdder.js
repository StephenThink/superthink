import gsap from 'gsap';

const toggleNameAdder = (close) => {

    let panel = document.querySelector('.addNamesPanel');
    let amount = (typeof close == 'object' ? 0 : '-100%');

    let ease = (typeof close == 'object' ? 'ease.out' : 'ease.in');

    gsap.to(panel, { 
        duration: 1,
        y: amount,
        ease: ease
    });

}


export default toggleNameAdder;