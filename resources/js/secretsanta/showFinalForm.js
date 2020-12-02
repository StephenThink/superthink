import gsap from 'gsap';

const showFinalForm = (e) => {

    e.preventDefault();

    let page1 = document.querySelector('.page-1');
    let page2 = document.querySelector('.page-2');

    let target = e.target;
    
    // @todo
    //  validate that theres 3+ names.

    // @todo
    // and that they have valid emails and names are not empty.


    if( target.classList.contains('secret-santa-final') ) {
        page1.classList.add('hide');
        page2.classList.remove('hide');
    } else if (target.classList.contains('secret-santa-back-to-page-1')) {
        page2.classList.add('hide');
        page1.classList.remove('hide');
    }
    
    return;
    
}

export default showFinalForm;