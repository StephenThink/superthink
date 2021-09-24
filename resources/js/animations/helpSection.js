import gsap from 'gsap'
import bouncingWords from './bouncingWords'

const helpSection = (el) => {
    
    let help = el.querySelector('.help')
    let afterHelp = el.querySelector('.after-help')
    let tagline = el.querySelector('.tagline')

    let items = bouncingWords(el, tagline);

    let tl = gsap.timeline()

    if( !el.classList.contains('seen') ) {
        tl
        .from(help, {
            duration: .4,
            // x: '-200px',
            transformOrigin :"bottom center",
            scale: "4",
            ease: " elastic. out( 1, 0.3)",
            delay: .3

        })
        .from(afterHelp, {
            duration: .6,
            x: "400px",
        })
        .from( items , {
            y: '100%',
            duration: .8, 
            stagger: 0.2,
            ease: 'Power4.inOut',
        }, 0)

        el.classList.add('seen');

    }

    


}

export default helpSection