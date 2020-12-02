import removeNameFromList from './removeNameFromList';


let numberOfInputs = 0;

const addFormField = (e) => {

    if(e instanceof Event)
        e.preventDefault();
    
    let binSVG = 
    `
    <svg xmlns="http://www.w3.org/2000/svg" viewBox=" 0 0 20 22 " class="fill-current w-full h-full pointer-events-none">
        <path class="a84ca124-37b7-487d-9221-f9b9cccce2dc" d="M 7.67 7.51 V 16.13 A 0.48 0.48 0 0 1 7.19 16.61 H 6.19 A 0.48 0.48 0 0 1 5.71 16.13 V 7.51 A 0.48 0.48 0 0 1 6.23 7 H 7.23 A 0.48 0.48 0 0 1 7.67 7.51 Z M 11.67 7.03 H 10.67 A 0.48 0.48 0 0 0 10.19 7.51 V 16.13 A 0.48 0.48 0 0 0 10.67 16.61 H 11.67 A 0.47 0.47 0 0 0 12.15 16.13 V 7.51 A 0.47 0.47 0 0 0 11.66 7 Z M 16.94 3.19 A 1 1 0 0 1 17.94 4.19 V 4.67 A 0.47 0.47 0 0 1 17.46 5.15 H 16.66 V 18.53 A 1.91 1.91 0 0 1 14.75 20.45 H 3.19 A 1.92 1.92 0 0 1 1.28 18.53 H 1.28 V 5.11 H 0.48 A 0.47 0.47 0 0 1 0 4.63 H 0 V 4.15 A 1 1 0 0 1 1 3.15 H 4 L 5.29 0.93 A 1.9 1.9 0 0 1 6.93 0 H 10.93 A 1.9 1.9 0 0 1 12.6 0.93 L 14 3.19 Z M 6.18 3.19 H 11.74 L 11 2 A 0.24 0.24 0 0 0 10.79 1.89 H 7.07 A 0.25 0.25 0 0 0 6.86 2 Z M 14.7 5.11 H 3.19 V 18.29 A 0.24 0.24 0 0 0 3.43 18.53 H 14.43 A 0.24 0.24 0 0 0 14.67 18.29 Z"/>
    </svg>
    `;

    numberOfInputs++;
    
    var inputNum = numberOfInputs;

    var inputName = 
        document.createElement('input');
        inputName.setAttribute('name', 'name[]');
        inputName.setAttribute('type', 'text');
        inputName.setAttribute('id', 'person' + inputNum);
        // inputName.setAttribute('value', 'name');
        inputName.setAttribute('placeholder', 'Name');

    inputName.classList.add('name', 'px-3', 'w-5/12');


    var inputEmail = 
        document.createElement('input');
            inputEmail.setAttribute('name', 'email[]');
            inputEmail.setAttribute('type', 'email');
            inputEmail.setAttribute('id', 'person' + inputNum);
            // inputEmail.setAttribute('value', 'email');
            inputEmail.setAttribute('placeholder', 'email');
    
    inputEmail.classList.add('email', 'px-3', 'w-5/12');

    var removeInput = 
        document.createElement('span');

    removeInput.classList.add('secret-santa-remove');
    removeInput.addEventListener('click', removeNameFromList);

    removeInput.insertAdjacentHTML('beforeend', binSVG)

    // var remove = document.createTextNode('remove');
    // removeInput.appendChild(remove);

    var list = document.querySelector('ol#nice-list');
    var li = document.createElement("li");
    li.classList.add('mb-1', 'flex', 'justify-between', 'flex-row', 'p-1');

    li.appendChild( inputName );
    li.appendChild( inputEmail );
    li.appendChild( removeInput );

    list.appendChild(li);

    

}

export default addFormField;