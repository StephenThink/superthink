import gsap from 'gsap';
import Toastify from 'toastify-js';
import "toastify-js/src/toastify.css";

const message = (text, loser) => {
    if(! loser ) {
        Toastify({
            text: text,
            duration: 3000, 
            gravity: "top", // `top` or `bottom`
            position: 'right', // `left`, `center` or `right`
            backgroundColor: "white",
            // backgroundColor: "#42454A",
            'className': 'think-toast',
            stopOnFocus: true, // Prevents dismissing of toast on hover
            onClick: function(){} // Callback after click
        }).showToast();
        
        return;
    }

    // toast loser
    Toastify({
        text: `<div class="wrapper"><h1 class="block  text-3xl">${text}</h1><p class="font-bold text-4xl">${loser}</p></div>`,
        // 15 minutes 
        duration: 900000, 
        gravity: "bottom", // `top` or `bottom`
        position: 'center', // `left`, `center` or `right`
        // backgroundColor: "white",
        // backgroundColor: "#42454A",
        'className': 'think-loser-toast',
        stopOnFocus: true, // Prevents dismissing of toast on hover
        onClick: function(){
            console.log(this);
        } // Callback after click
    }).showToast();

}


export default message;