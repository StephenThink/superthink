<?php

namespace App\Providers\ViewProviders;

use Statamic\Facades\Entry;
use Illuminate\Support\ServiceProvider;

class CaseStudiesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('pages.work', function ($view) {

            
            $caseStudies = collect(Entry::whereCollection('case_studies'));

            $byService = $caseStudies->filter(function ($store) {
                // return $store->{'core-services'};
                return $store->services_filter;
            })->groupBy(function ($store, $key) {
                // return $store->{'core-services'};
                return $store->services_filter;
                
            })->toArray();


      
            // return $view->with([
            //   'grouped_case_studies' => $byService,
            // ]);
        });
    }
}
