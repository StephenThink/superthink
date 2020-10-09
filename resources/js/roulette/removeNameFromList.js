import message from '../components/message';

const removeNameFromList = (e) => {

    // const names = document.querySelectorAll('.names');

    const names = document.querySelectorAll('#names > li');

    if(names.length <= 2){  
        return message("You can't have less than 2 brew makers");
    }

    let el = e.target;

    el.parentNode.remove();

}

export default removeNameFromList;