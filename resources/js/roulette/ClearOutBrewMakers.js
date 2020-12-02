const clearOutBrewMakers = () => {
    let items = document.getElementById('names').querySelectorAll('li');

    for (let index = 0; index < items.length; index++) {
        if(index == 0 )
            continue;

        items[index].remove()
        
    }

}

export default clearOutBrewMakers;