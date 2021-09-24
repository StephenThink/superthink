<?php

namespace App\Tags;

use Statamic\Tags\Tags;

use Illuminate\Support\Arr;
use Statamic\Facades\GlobalSet;

class RandomSports extends Tags
{

    /**
     * The {{ random_sports }} tag.
     *
     * @return string|array
     */
    public function index()
    {

        return collect(
                Arr::random(
                    GlobalSet::findByHandle('activities')->fileData()['data']['activities']
                , 2)
            )->join( ', ', ' and ');

    }

}
