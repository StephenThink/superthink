import { 
    toggleFlip,
    addFormField,
    removeNameFromList,
    showFinalForm,
    submitForm
} from './secretsanta';



let next = document.querySelector('.secret-santa-next');
let addMore = document.querySelector('.secret-santa-add-more');
let remove = document.querySelectorAll('.secret-santa-remove');
let final = document.querySelector('.secret-santa-final');
let backToPage1 = document.querySelector('.secret-santa-back-to-page-1');
let submit = document.querySelector('.secret-santa-submit');


next.addEventListener('click', toggleFlip); 
addMore.addEventListener('click', addFormField);

final.addEventListener('click', showFinalForm);
backToPage1.addEventListener('click', showFinalForm)

remove.forEach( el =>  el.addEventListener('click', removeNameFromList) );

submit.addEventListener('click', submitForm);
//  Add an initial form field
addFormField();



window.addEventListener('DOMContentLoaded', (event) => {
    var current = 0,
    slides = document.querySelectorAll(".background-slideshow img");

    setInterval(function() {
    for (var i = 0; i < slides.length; i++) {
        slides[i].style.opacity = 0;
    }
    current = (current != slides.length - 1) ? current + 1 : 0;
    slides[current].style.opacity = 1;
    }, 7000);
});

