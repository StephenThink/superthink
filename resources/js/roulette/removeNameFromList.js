const removeNameFromList = (e) => {

    // const names = document.querySelector('.names');

    if(names.length <= 1);
        // return message("You can't have less than one brew maker.");


    let el = e.target;

    el.parentNode.remove();

}

export default removeNameFromList;