<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait Sluggable
{
    /**
     * Boot the trait and set up the model events.
     *
     * @return void
     */
    public static function bootSluggable()
    {
        static::saving(function (Model $model) {
            $slugColumn = $model->getSlugColumnName();
            $sluggableString = $model->getSluggableString();
            $model->setAttribute(
                $slugColumn,
                Str::slug($model->getAttribute($sluggableString), $model->getSlugSeparator())
            );

        });
    }

    /**
     * The name of the column to use for slugs.
     *
     * @return string
     */
    protected function getSlugColumnName()
    {
        return property_exists($this, 'slugClassName') ? $this->slugClassName : 'slug';
    }

    /**
     * Get the string to create a slug from.
     *
     * @return string
     */
    protected function getSluggableString()
    {
        return property_exists($this, 'sluggableString') ? $this->sluggableString : 'name';
    }

    /**
     * The character to use to separate words.
     *
     * @return string
     */
    protected function getSlugSeparator()
    {
        return '-';
    }

    /**
     * Scope a query to filter by slug.
     *
     * @param  string  $slug
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSlug(Builder $query, $slug)
    {
        return $query->where('slug', $slug);
    }
}
