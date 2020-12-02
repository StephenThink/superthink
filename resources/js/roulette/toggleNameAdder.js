import gsap from 'gsap';

const toggleNameAdder = (close) => {

    let tl = gsap.timeline();

    if( tl.isActive() )
        return false;

    let panel = document.querySelector('.addNamesPanel');
    let state = panel.dataset.state;

    let amount = (state == 'closed' ? 0 : '-100%' );
    let ease = (state == 'closed' ? 'ease.out' : 'ease.in' );

    tl.to(panel, { 
        duration: 1,
        y: amount,
        ease: ease,
        onComplete: () => {
            panel.dataset.state = (state == 'closed' ? 'open' : 'closed');
        }
    });

}


export default toggleNameAdder;