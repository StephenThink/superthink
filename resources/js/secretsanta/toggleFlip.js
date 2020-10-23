const toggleFlip = (e) => {
    
    let box = document.querySelector('.secret-santa-box');
    let list = box.classList;

    list.add('flipped');

    // if( list.contains('flipped') )
    //     list.remove('flipped');



}   

export default toggleFlip;