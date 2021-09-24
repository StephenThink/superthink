<?php

namespace App\Tags;

use Statamic\Tags\Tags;
use \Illuminate\Support\Arr;

class RandomColour extends Tags
{
    /**
     * The {{ random_colour }} tag.
     *
     * @return string|array
     */
    public function index()
    {

       return Arr::Random([
            "yellow", "darker", "dark", "header-dark", "mid-grey", "grey", "light-grey"  
        ]);
    }

}
