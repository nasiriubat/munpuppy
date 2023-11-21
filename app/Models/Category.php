<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Category extends Model implements  HasMedia
{
    use InteractsWithMedia ,HasSlug;

    protected $table = 'categories';
    protected $fillable = [
        'name','status','type','slug'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getImageAttribute()
    {
        if (!empty($this->getFirstMediaUrl('categories'))) {
            return asset($this->getFirstMediaUrl('categories'));
        }

        // return asset('frontend/images/default/category.png');

    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_categories', 'category_id','post_id');
        // return $this->morphedByMany(Post::class, 'categories');
    }
    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_categories', 'category_id','blog_id');
        // return $this->morphedByMany(Post::class, 'categories');
    }

}
