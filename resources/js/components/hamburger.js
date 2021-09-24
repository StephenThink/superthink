const animateTheBurger = ( e ) => {

    if (e instanceof Event)
        e.preventDefault();
        

    let handle = document.getElementById('handle');
    let nav = document.getElementById('navigation-panel');
    
    nav.classList.toggle('open');
    handle.classList.toggle('open');

}


export default animateTheBurger;