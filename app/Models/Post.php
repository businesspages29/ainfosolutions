<?php

namespace App\Models;

use App\Enums\PostStatus;
use App\Traits\Searchable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory, Searchable, Sluggable;

    protected $fillable = [
        'user_id',
        'category_id',
        'image',
        'title',
        'slug',
        'content',
        'thumbnail',
        'status',
    ];

    protected $casts = [
        'status' => PostStatus::class,
    ];

    protected function getSlugColumnName()
    {
        return 'slug';
    }

    protected function getSluggableString()
    {
        return 'title';
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/'.$this->image) : 'https://placehold.co/300';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', PostStatus::Published);
    }
}
