import gsap from 'gsap'

const blogItemLeave = ( container, trigger ) => {
     
    let items = container.querySelectorAll('.blog-listing-item a')
    let pagination = container.querySelector('.paginate nav')
    let negativeImage = container.querySelector('.negative-image')
    let img     = negativeImage.querySelector('img')
    let link    = negativeImage.querySelector( '.negative-image-link' ) 

    gsap.set( img , {'transform-orgin': 'center center'})

    let height = (parseInt(negativeImage.innerHeight));
    let width = (parseInt(negativeImage.innerWidth));

    let tl = gsap.timeline();

    tl.to( items , {
        y: '-120%',
        stagger: .1,
        ease: "Power4.easeOut"
    })

    if(pagination) {
        tl.to( pagination.querySelector('.pagination-left'), { x: -100 })
        .to( pagination.querySelector('.pagination-right'), { x: 100 }, '<')
        .to( pagination.querySelector('.pagination-center'), { y: '-120%' }, '<')
        .to( pagination.querySelector('.pagination-info'), { y: 100  }, '<')
        .to( img , { height: 0, x: "+=" + (width/2), y: "+=" + (height/2)  })
        .to( link, { autoAlpha: 0 })
    }
    
}

export default blogItemLeave