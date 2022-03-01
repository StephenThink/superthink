import Winwheel from 'winwheeljs';
import alertLoser from './alertLoser';

let theWheel;



const start = ( segments = [{}] ) => {

    // console.log(prize);

    theWheel = new Winwheel({
        'outerRadius'    : 180,
        'numSegments'    : segments.length,
        'segments'       : segments, // This is where the Array of Names gets pushed to.
        'fillStyle'      : 'transparent',
        'textAlignment'  : 'outer',
        'textOrientation': 'horizontal',
        'textFontFamily' : 'geo-regular',
        'textFillStyle'  : '#FFF',
        'lineWidth'      : 0,
        'drawMode'       : 'image',
        'drawText'       : true,
        'responsive'     : true, 
        'animation'      : {
            'type'       : 'spinToStop',
            'duration'   : 6,
            'spins'      : 10,                
            'callbackFinished': alertLoser
        },
        // 'pointerGuide'  :{
        //     'display'     : true,
        //     'strokeStyle' : 'red',
        //     'lineWidth'   : 3
        // }
    });

    var loadedImg = new Image();
    // Create callback to execute once the image has finished loading.
    loadedImg.onload = function() {
        theWheel.wheelImage = loadedImg;    // Make wheelImage equal the loaded image object.
        theWheel.draw();                    // Also call draw function to render the wheel.
    }

    // Set the image source, once complete this will trigger the onLoad callback (above).
    loadedImg.src = "/assets/tea-roulette/tea-centre.png";

}


export { theWheel, start };
