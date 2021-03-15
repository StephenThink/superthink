<?php

namespace App\Tags;

use Statamic\Tags\Tags;
use Statamic\Facades\Asset;
use Statamic\Facades\AssetContainer;
use Statamic\Markdown\Parser;

class ServiceContent extends Tags
{
    private $overriding_field = 'overriding_';
    private $parent_entry = '';
    private $is_image;
    
    /**
     * The {{ service_content }} tag.
     *
     * @return string|array
     */
    public function index()
    {   
        
        $this->setStuff();
        
        return  
        // [ 
        //     $this->params->get('field')
        //         =>
                    ( collect(optional($this->context)->value($this->overriding_field))->isEmpty() ? null : optional($this->context)->value($this->overriding_field) )
                    ?? $this->getParent($this->params->get('field')) 
                    ?? $this->context->raw( $this->params->get('field') ) 
                    ?? $this->fatalMessage()
        // ];
        ;  
    }

    public function image() {

        $this->setStuff();
        $this->is_image = true;
        
        return [
            $this->params->get('field')
            =>  ( collect(optional($this->context)->value($this->overriding_field))->isEmpty() ? null : optional($this->context)->value($this->overriding_field) )
                ?? $this->getParent($this->params->get('field')) 
                ?? $this->getAsset($this->context->raw( $this->params->get('field')) ) 
                ?? $this->fatalMessage()
       ];

        
    }

    public function markdown() {

        $this->setStuff();

        return  ( collect(optional($this->context)->value($this->overriding_field))->isEmpty() ? null : optional($this->context)->value($this->overriding_field) )
                ?? $this->getParent($this->params->get('field')) 
                ?? $this->getMarkdown($this->context->raw( $this->params->get('field')) ) 
                ?? $this->fatalMessage();

        
    }

    public function getParent($variable) { 

        return optional( $this->context->value($this->parent_entry), 
                    function( $item ) use ($variable) {

                        if ($this->is_image) {
                            return $this->getAsset($item->first()->value($variable));
                        }

                        return $item->first()->value($variable);

                });

    }

    private function getAsset($path) {
        if( is_null($path) ) return null;

        return AssetContainer::all()->first()->asset($path);
    }

    private function getMarkdown($variable) {

        
        
        return (new Parser())->parse($variable);
        
    }

    private function setStuff() {
        $this->overriding_field .= $this->params->get('field');
        $this->parent_entry = $this->params->get('parent_entry');
    }

    private function fatalMessage() {
        if( ! $this->params->bool('show_error') ) return null;
        return "Something has gone very wrong. Do you have a parent entry or are you missing an original field called {$this->params->get('field')}";
    }
}

