import { 
    start,
    toggleNameAdder,
    initWheelFunc,
    spinSpinSpin,
    nameToList
} from './roulette';


// Init the wheel. wit 0 segments  
// rubbishname, I know, just went with it.
start();


let showNameAdderButton = document.querySelector('.showNameSelector');
let nameToListSelector = document.querySelector('.addNameToList');
let initWheel = document.querySelector('.initWheel');
let spinTheWheel = document.querySelector('.spinTheWheel');
let closeAddNamesPanel = document.querySelector('.close_addNamesPanel');

//  bring in the panl for adding names
showNameAdderButton.addEventListener('click', toggleNameAdder);

// Spin the wheel event
spinTheWheel.addEventListener('click', spinSpinSpin);

//  Close the toggler 
closeAddNamesPanel.addEventListener('click', function() {
    toggleNameAdder(true)
});

// get all the names and restart the wheel. 
initWheel.addEventListener('click', initWheelFunc);

//  Add name to the list
nameToListSelector.addEventListener('click', nameToList);


