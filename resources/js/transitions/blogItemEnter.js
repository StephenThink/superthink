import gsap from 'gsap'
import { animateIn } from '../animations';

const blogItemEnter = ( container ) => {
    //  get to the top... 
    window.scrollTo(0,0)

    let tl = gsap.timeline()
    let negativeImage = container.querySelector('.negative-image')

    animateIn( container.querySelector('.hero-main-text') )

    tl
    .from( negativeImage.querySelector('img'), {
        height: 0
    })

}

export default blogItemEnter