import { theWheel } from './theWheel';
import getNames from './getNames';

import { TweenMax } from '../vendor/TweenMax.min.js';

const spinSpinSpin = () => {

    let names = getNames();

    if( names.length < 1 ) {
        alert("you can't spin without any brew makers"); 
        return;
    }

    if( names.length == 1 ) {
        alert("Flying solo? Get the kettle on {name}"); 
        return;
    }

    theWheel.startAnimation();

}

export default spinSpinSpin;