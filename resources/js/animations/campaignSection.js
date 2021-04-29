import gsap from 'gsap';
import Splitting from 'splitting';

const campaignSection = (el) => {

    let title       = el.querySelector('.title');
    let bottomLine  = el.querySelector('.bottom-line');
    let tagline     = el.querySelector('.tagline');

    const results   = Splitting({ target: tagline, by: 'words' });

    // console.log(results);

    let tl = gsap.timeline({
        defaults: { 
            duration: 1
        }
    });

    el.classList.add('overflow-hidden')

    if( !el.classList.contains('seen') ) {
        
        let words = Array.from(tagline.querySelectorAll('.word'));

        words.forEach( ( item ) => { 
            let parent = item.parentElement;
            
            // get text
            let text = item.innerText;
            //  Remove text;
            item.innerText = '';

            // create span
            let span = document.createElement('span');

            span.innerText = text;
            // add text to span

            span.classList.add('inline-block', 'inner');
            item.classList.add('overflow-hidden', 'inline-block');

            item.append(span);            

        })

        let items = gsap.utils.toArray(el.querySelectorAll('.word .inner') );

                
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