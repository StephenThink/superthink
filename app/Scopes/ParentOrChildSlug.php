<?php

namespace App\Scopes;

use Statamic\Query\Scopes\Scope;

class ParentOrChildSlug extends Scope
{
    /**
     * Apply the scope.
     *
     * @param \Statamic\Query\Builder $query
     * @param array $values
     * @return void
     */
    public function apply($query, $values)
    {   
            return $query
                    ->whereTaxonomy('services_filter::' . $values['parent_service']);
        // return $query->where('taxonomy', $values['parent_service']);
    }
    // <!-- taxonomy:services_filter="{slug}" taxonomy:services_filter="{{if parent_service ?= parent_service.slug}}" -->
    // :taxonomy:services_filter="{ if !parent_service ? slug : parent_service.slug}"
}
