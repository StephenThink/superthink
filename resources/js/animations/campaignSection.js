import gsap from 'gsap'
import bouncingWords from './bouncingWords'

const campaignSection = (el) => {

    let title       = el.querySelector('.title');
    let bottomLine  = el.querySelector('.bottom-line');
    let tagline     = el.querySelector('.tagline');

    let items = bouncingWords(el, tagline);

    let tl = gsap.timeline({
        defaults: { 
            duration: 1
        }
    });

    el.classList.add('overflow-hidden')

    if( !el.classList.contains('seen') ) {
           
        tl
        .from(title, {
            y: '-100px',
            duration: 2
        })
        .from( items , {
            y: '100%',
            duration: .8, 
            stagger: 0.2,
            ease: 'Power4.inOut',
        }, 0)
        .from(bottomLine, {
            width : 0,
            ease: "steps(20)",
            duration: 3
        }, 0)


        el.classList.add('seen');
    }

}


export default campaignSection