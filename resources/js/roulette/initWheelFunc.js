import { start } from './theWheel';
import getNames from './getNames';


import toggleNameAdder from './toggleNameAdder';

const initWheelFunc = () => {
    
    // let nameToList = document.querySelector('.addNameToList');
    // let names = nameToList.querySelectorAll('li');
    let segments = getNames();

    start( segments );

    toggleNameAdder(true);
    
}

export default initWheelFunc;