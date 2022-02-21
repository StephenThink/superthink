import gsap from 'gsap';
import Toastify from 'toastify-js';
import "toastify-js/src/toastify.css";

const message = (text, loser, data) => {

    if( loser == 'secretSantaMessage') {
        console.log('secretSantaMessage')
        
        let toast = Toastify({
            text: `
                <div class="wrapper font-bold">
                    ${data}
                </div>
                `,
            // 15 minutes 
            duration: 900000, 
            gravity: "bottom", 
            position: 'center', 
            'className': 'think-loser-toast',
            stopOnFocus: true, // Prevents dismissing of toast on hover
            onClick: function(){
                
                
                toast.removeElement(toast.toastElement);
                window.clearTimeout(toast.toastElement.timeOutValue);

            } // Callback after click
        }).showToast();
        
        return;
    }


    if(! loser ) {
        
        Toastify({
            text: text,
            duration: 3000,
            // duration: 60000, 
            gravity: "bottom", // `top` or `bottom`
            position: 'right', // `left`, `center` or `right`
            backgroundColor: "white",
            // backgroundColor: "#42454A",
            'className': 'think-toast max-w-none md:max-w-toastify-width',
            stopOnFocus: true, // Prevents dismissing of toast on hover
            onClick: function(){} // Callback after click
        }).showToast();
        
        return;
    }

    
    // toast loser
    let toastEL = Toastify({
        text: `
            <div class="wrapper">
                <h1 class="block  text-3xl">${text}</h1>
                <p class="font-bold text-4xl">${loser}</p>
                <a class="button error-btn bg-dark py-2 px-4 mt-3 mx-auto w-56 rounded-full">CLICK TO CLOSE</a>
            </div>`,
        // 15 minutes 
        duration: 900000, 
        gravity: "bottom", 
        position: 'center', 
        'className': 'think-loser-toast',
        stopOnFocus: true, // Prevents dismissing of toast on hover
        onClick: function(){

            toastEL.removeElement(toastEL.toastElement);
            window.clearTimeout(toastEL.toastElement.timeOutValue);

        } // Callback after click
    }).showToast();

}


export default message;