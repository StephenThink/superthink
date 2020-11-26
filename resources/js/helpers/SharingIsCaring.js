function showMessage(el) {

    el.classList.toggle('hidden');

    setTimeout( () => {
        el.classList.toggle('hidden');
    }, 1000)
}


const SharingIsCaring = function () {

    alert('sharing is caring');

    let hiddenMessage = document.querySelector('.copied-to-clipboard');
    let value = document.querySelector('#sharing_url');

    console.log(value.innerText);
    


    // All but iOS
    // navigator.clipboard.writeText(value.innerText).then(
    //     function() {
    //         //  done
    //         hiddenMessage.innerText = 'Copied to clipboard!';
    //         showMessage(hiddenMessage)
    //     },
    //     function() {
    //         //  failed
    //         hiddenMessage.innerText = 'Something went wrong.';
    //         showMessage(hiddenMessage);
    //     }
    // );

    // in the copy. 
    // @see site.js - line 74 
    // document.execCommand("copy");

    

}

export default SharingIsCaring;


