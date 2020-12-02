import axios from 'axios';
import message from '../components/message';

const submitForm = (e) => {
    e.preventDefault();
    let button = e.target;
    let loader = button.querySelector('.loader');

    if( button.classList.contains('disabled') )
        return false;
    
    button.classList.add('disabled');
    loader.classList.remove('hidden');

    
    // validate 
    // group name 
    // price
    // deadline
    // drop off point

    let form = document.getElementById('secret-santa-main-form');
    let formData = new FormData(form);

    axios.post('/secret-santa-results', formData)
        .then( (response) => {
            console.log('success');
            loader.classList.add('hidden');
            message('none', 'secretSantaMessage', response.data.success);
        })
        .catch(  ({ response }) => {

            console.log('catch error');
            //  take off the disabled so we can re send
            button.classList.remove('disabled');
            loader.classList.add('hidden');
            message('none', 'secretSantaMessage', response.data.error);
            
        })
        .then();


}

export default submitForm;


