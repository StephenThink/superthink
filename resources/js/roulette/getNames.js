// Get all the names in the list.
const getNames = () => {
    let names = [];
    let items = document.getElementById('names').querySelectorAll('li');

    items.forEach( (el) => {
       let name = el.querySelector('.name') ;
       names.push( 
           {'fillStyle': 'transparent', 'text': name.textContent } 
        );
    });

    return names;

}

export default getNames;
