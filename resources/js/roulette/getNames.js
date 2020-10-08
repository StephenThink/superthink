// Get all the names in the list.
const getNames = () => {
    let names = [];
    let items = document.getElementById('names').querySelectorAll('li');

    items.forEach( (el) => {
       names.push( 
           {'fillStyle': 'transparent', 'text': el.textContent } 
        );
    });

    return names;

}

export default getNames;
