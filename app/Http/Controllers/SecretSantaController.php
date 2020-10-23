<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\SecretSanta\SecretSantaBot;


class SecretSantaController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        // if($request->store


        // create people 
        $people = $this->prepPeopleArray($request);

        
        try {
            $bot = new SecretSantaBot($people);

        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 422); 
 
        }
        
        
        return 
            response()->json([
                'success' => $bot->getResponse()
            ], 200);
        
    }


    function prepPeopleArray($request){
        
        $people = array();
        
        foreach($request->name as $key => $val){
            $people[$key]['name'] = $request->name[$key];
            $people[$key]['email'] = $request->email[$key];
            
        }
        
        return $people;        
    }



}


