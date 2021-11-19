const animateTheBurger = ( e ) => {

    if (e instanceof Event)
        e.preventDefault();
        

    let handle = document.getElementById('handle');
    let nav = document.getElementById('navigation-panel');
    
    nav.classList.toggle('open');
    handle.classList.toggle('open');

    // document.body.classList.add('fixed-sjj');

    let fixedsubnav = document.body.classList.contains('fixed-sjj');

   if(fixedsubnav) {
    document.body.style.paddingTop = 0;
    document.body.classList.remove('fixed-sjj');
   }
}


export default animateTheBurger;