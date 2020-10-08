import removeNameFromList from './removeNameFromList';

const nameToList = () => {
    
    let input = document.querySelector('.addNewName');

    if( input.value == '' )
        return false;

    // Get the element we're gonna push the data to.
    var ul = document.getElementById("names");

    // create elements
    var li = document.createElement("li");
    var name_span = document.createElement('span');
    var delete_span = document.createElement('span');

    // craete text nodes
    var name = document.createTextNode(input.value);
    var cross = document.createTextNode('x');

    //  set attributes/classes
    li.setAttribute('class', 'flex justify-between pb-2');
    name_span.setAttribute('class', 'name');
    delete_span.setAttribute('class', 'text-lg');

    // add an event listener
    delete_span.addEventListener('click', removeNameFromList);
    
    //  append chilren
    name_span.appendChild(name);
    delete_span.appendChild(cross);
    li.appendChild(name_span);
    li.appendChild(delete_span);
    ul.appendChild(li);

    // Set the input value to be empty
    input.value = '';

}

export default nameToList;