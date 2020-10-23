<?php
    
namespace App\SecretSanta;

use Illuminate\Support\Facades\Mail;

use Statamic\Facades\Collection;
use Statamic\Facades\Entry;
use Statamic\Facades\Stache;

use \App\SecretSanta\EmailAddressValidator;
use App\Mail\SecretSanta;
/** 
 * Secret Santa Bot 
 * 
 * A class for generating a paired list of people for a secret santa. 
 * The goal is to be automated to prevent one person from having to deal with knowing who has who.
 *
 *
 * @author      Ben Watts
 * @url         http://www.benwatts.ca/
 * @version     2.0
 * @date        Nov. 29, 2009
 *
 */
class SecretSantaBot{

    public $paired;

    public $response = '';

    private $people;
    
    const ERROR_MATCHING_NAMES = 'Something looks wrong! Check that there are no matches <br><a class="button error-btn" >Click to Close</a>';
    const ERROR_NOT_ENOUGH_PEOPLE = 'Need at least 3 people for a Secret Santa <br><a class="button error-btn" >Click to Close</a>';
    const ERROR_EXPECTING_ARRAY = 'Expecting an array of people and emails. Woops. <br><a class="button error-btn" >Click to Close</a>';
    const ERROR_EMAILING_PAIRS = 'Only one pair was found. That is odd. Not emailing. <br><a class="button error-btn" >Click to Close</a>';
    const ERROR_INVALID_EMAIL_ADDRESS = 'An invalid email address was found. <br><a class="button error-btn" >Click to Close</a>';

    
    /**
     * Constructor 
     * Ensures that the people array is usable.
     *
     * @param       people          Multidimensonal array [[name, email], ..] of names and emails
     * @param       test_mode       Boolean value to determine if debug/test information should be displayed
     */
    public function __construct($people = true){
    
        $this->people = $people;

        $this->request = request();

        
            
        if( is_array($people) ){
            if( count($people) >= 3 ){
                if( !$this->anyNamesMatch() ){
                    if( !$this->anyInvalidEmails() ){
                
                        $this->pairPeople();

                        if( $this->request->store == 'on') {
                            $this->storeResults();
                        }

                        $this->sendEmails();

                        
                    } else {
                        throw New \Exception(self::ERROR_INVALID_EMAIL_ADDRESS);
                    }
                } else {
                    throw New \Exception (self::ERROR_MATCHING_NAMES);
                }
            } else {
                throw new \Exception(self::ERROR_NOT_ENOUGH_PEOPLE);
            }        
        } else {
             throw new \Exception(self::ERROR_EXPECTING_ARRAY);
        }
    
    }
    
    
    /** 
     * Does a quick lil' check through the array of people to make sure no two people have the same name. 
     * It would be weird if you had two "Johns", even if they did have different email's ... 
     * Converts to lowercase, trims whitespace when comparing. Nothing fancy. 
     *
     * @return          boolean         returns true if any names match eachother. 
     */
    private function anyNamesMatch(){
        
        $people = $this->people;
        
        while( count($people) > 0 ){
            $name = strtolower(trim($people[0]['name']));
            array_splice($people, 0, 1); // we don't need this name in the array, remove! 
            
            for( $c = 0; $c < count($people); $c++ ){
                $compareto = strtolower(trim($people[$c]['name']));
                if( $name == $compareto ){
                    return true;
                }
            }
            
        }
        return false;
        
    }
    
    
    /**
     * Check through the emails to make sure they're formatted properly.
     * Uh. I guess this is super-rigorous and totally overkill, but whatever.  
     * 
     * @return          boolean         returns true if any emails are invalid
     * @see             http://code.google.com/p/php-email-address-validation/
     */
    private function anyInvalidEmails(){
    
        $people = $this->people;    
    
        // require_once('EmailAddressValidator.php');
        $validator = new EmailAddressValidator;
    
        for( $c = 0; $c < count($people); $c++ ){
            $email = trim($people[$c]['email']);
            if( !$validator->check_email_address($email) ){
              return true;
            }
		    }
		
		  return false;
    }
    
    
    /** 
     * If test_mode is set to true, it will output the content of the email to the screen. 
     * If test_mode is false, it will send out emails and provide no feedback. 
     */ 
    public function sendEmails(){
      
      // These are used to build up HTML to return.  
      $output = '';
      $html = '';

      
    
        if( count($this->paired) >= 1 ){
            foreach( $this->paired as $key => $person ){   
              
              //  get the current request and store it. 
              $request = $this->request;
              

              if( stripos($request->price, '£') === FALSE )
                $price = '£'.$request->price;

              $data = [
                'giver'         => $person[0],
                'reciever'      => $person[1],
                'groupName'     => $request->groupName,
                'price'         => $price,
                'formattedDate' => $request->deadline,
                'dropOff'       => $request->dropOff,
                'additionalinfo' => $request->additionalinfo
              ];

              Mail::to($person[0]['email'])
                ->send(new SecretSanta($data));
              // mail($giver['email'], $subject, $message, $headers);

              $output .= "<li class='mb-2'> <strong>{$data['giver']['name']}</strong> ({$data['giver']['email']}) </li>";
 
            }
            
           
            $html .= '<h2 class="text-3xl">E-mail’s sent</h2>';
            $html .= '<ul id="test-output" class="overflow-y-scroll h-1/3 my-4 bg-dark text-yellow py-2">'.$output.'</ul>';
            $html .= '<p class="mb-4">Please check your spam e-mail folder<br>if you don’t receive the email.</p>';
            $html .= '<a class="button curser-pointer rounded-full bg-yellow text-white border border-white border-2 py-2 px-10 self-center " onClick="event.preventDefault();window.location.reload()" href="#">Reset</a>';

            $this->response = $html;
                

            
            
      } else {
        throw new \Exception(self::ERROR_EMAILING_PAIRS);
      }
    
    } // send emails. 
    
    
    /** 
     * The meat of SecrestSantaBot. 
     * The idea here is to mimic 'pulling a name out of a hat'.
     * As cumbersome as this function may be, it is an improvement over the original: there's no getting caught in potentially-infinite while loops.
     */
    private function pairPeople(){
            
        $num = count($this->people);
        $people_giving = $this->people;
        $people_recieving = $this->people;
    	$paired = array();           
        
        /* 
         This wasn interesting issue: if $people_giving[n] == $people_recieving[n] then you run into a situation 
         where the first two people can get paired up and you're screwed because it means the last person gets their own name. 
         To get around that, the receiver array is shuffled until the names at the end of the two arrays do not match.
         */ 
        do {
            shuffle($people_recieving);
        } while( $people_giving[$num-1]['name'] == $people_recieving[$num-1]['name'] );
        
        /* 
         Loop through all people, if the giver == receiver, increase the index of the receiver (isn't that just magical?).
         Remove the giver from the giver array, receiver from the receiver array, when done. 
         */
    	while( count($people_recieving) > 0 ){
    	
    	   $receiver_index = 0;
    	   if( $people_giving[0]['name'] == $people_recieving[$receiver_index]['name'] ){
    	       $receiver_index = 1;     	       
    	   }
    	   
    	   $paired[] = array($people_giving[0], $people_recieving[$receiver_index]);    	   
                        
            array_splice($people_recieving, $receiver_index, 1);
            array_splice($people_giving, 0, 1);    	   
    	}
    	
    	$this->paired = $paired;    	    	
    	return $paired;
    	
    } // pair people
    
    // 
    public function getResponse() {
      
      return $this->response;

    }

    /*
    * Save entries if the user has as us to.
    */
    public function storeResults() 
    {

        $collection = Collection::findByHandle('secret_santa_submissions');
        $id = Stache::generateId();

        $entry = Entry::make()
                    ->collection( $collection )
                    ->published( true )
                    ->locale('default')
                    ->slug( \Illuminate\Support\Str::slug($this->request->groupName) )
                    ->data([
                        'title' => $this->request->groupName,
                        'price' => $this->request->price,
                        'deadline' => $this->request->deadline,
                        'dropoff' => $this->request->dropOff,
                        'additional_info' => $this->request->additionalinfo,
                        'recipients' => $this->formatPairs(),
                        'content' => 'silence is golden'
                    ])
                    ->set('created_at', now()->timestamp )
                    ->set('updated_at', now()->timestamp )
                    ->save();


    }

    private function formatPairs() {

        $final = [];

        foreach( $this->paired as $key => $people ) {
            
            $matched = [];
            
            foreach( $people as $key => $person) {
                $matched[] = $person['name'] . '(' . $person['email'] . ')';
            }
            
            $final[] = ['cells' => $matched];  
        }
    
        return $final;

    }


}
