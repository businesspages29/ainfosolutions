<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    /**
     * Scope a query to search specified fields.
     *
     * @return Builder
     */
    public function scopeSearch(Builder $query, string $search)
    {
        if ($search && property_exists($this, 'searchableFields') && is_array($this->searchableFields)) {
            $query->where(function ($query) use ($search) {
                foreach ($this->searchableFields as $field) {
                    $query->whereLike($field, '%'.$search.'%');
                }
            });
        }

        return $query;
    }
}
