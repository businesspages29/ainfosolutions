<?php

namespace App\Models;

use App\Traits\Searchable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory, Searchable, Sluggable;

    protected $fillable = [
        'name',
        'slug',
    ];

    protected function getSlugColumnName()
    {
        return 'slug';
    }

    protected function getSluggableString()
    {
        return 'name';
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
