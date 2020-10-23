import message from '../components/message';

const removeNameFromList = (e) => {
    e.preventDefault();

    let list = document.querySelectorAll('ol#nice-list li');
    let owMany = list.length;

    if( owMany <= 3 ) {
        return message('Cant have less than 3 to make the magic happen');
    }

    e.target.parentNode.parentNode.remove();
}

export default removeNameFromList;