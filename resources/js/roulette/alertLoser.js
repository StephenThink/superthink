import message from '../components/message';
import { theWheel, clearOutBrewMakers } from '../roulette';


const alertLoser = (loser) => {
    
    for (let index = 0; index <= theWheel.numSegments; index++) {
        theWheel.deleteSegment();
        theWheel.draw();    
    }
    
    clearOutBrewMakers();
    // theWheel.clearCanvas();

    message("Get the kettle on...", loser.text)

}


export default alertLoser;