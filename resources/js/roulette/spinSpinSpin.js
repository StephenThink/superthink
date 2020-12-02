import { theWheel } from './theWheel';
import getNames from './getNames';
import message from '../components/message';

import { TweenMax } from '../vendor/TweenMax.min.js';

const spinSpinSpin = () => {

    let names = getNames();
    let items = theWheel.numSegments;

    if( items < 1 || names.length <= 0 ) {
        message("You can't spin without any brew makers"); 
        return;
    }

    if( names.length <= 0) {
        message("Something isn't right. Try adding some brew makers."); 
        return;
    }

    if( items == 1 ) {
        message(`Flying solo? Get the kettle on <span class="font-bold">${names[0].text}</span>`); 
        return;
    }

    theWheel.startAnimation();

}

export default spinSpinSpin;