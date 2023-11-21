<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia;


class Blog extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title', 'description','is_project','youtube_link', 'status', 'slug', 'meta_title', 'meta_keywords', 'meta_description', 'meta_og_image', 'meta_og_url'
    ];

    public function getImageAttribute()
    {
        if (!empty($this->getFirstMediaUrl('blogs'))) {
            return asset($this->getFirstMediaUrl('blogs'));
        }

        return asset('images/default.png');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'blog_categories');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blog_tags');
    }
}
