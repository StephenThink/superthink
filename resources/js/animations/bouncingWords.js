import Splitting from 'splitting'

const bouncingWords = (el, tagline) => {

    const results   = Splitting({ target: tagline, by: 'words' });

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

    return Array.from(el.querySelectorAll('.word .inner') );

}

export default bouncingWords