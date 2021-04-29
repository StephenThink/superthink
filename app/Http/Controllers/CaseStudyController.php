<?php

namespace App\Http\Controllers;

use Statamic\Facades\Entry;
use Illuminate\Http\Request;

class CaseStudyController extends Controller
{
    public function index($service) {

        $caseStudies = collect( Entry::whereCollection('case_studies') );

        $byService = $caseStudies->filter(function ($store) use ( $service ) {
            if( is_array($store->services_filter) && in_array( $service, $store->services_filter ) )
                return $store->services_filter;
        })->toArray();

        return (new \Statamic\View\View)
            ->template('case_studies.all')
            ->layout('layout')
            ->with([
                'title' => \Illuminate\Support\Str::title($service),
                'data' => $byService
            ]);

    }
}
