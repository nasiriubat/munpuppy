<?php

namespace App\Models;

use App\Models\Category;
use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia, HasSlug;

    protected $table = 'posts';
    protected $fillable = [
        'title','description','category_id','status','slug','apply_link','is_gov','remote_job','internship','deadline','location','meta_title','meta_keywords','meta_description','meta_og_image','meta_og_url'
    ];
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
    public function getImageAttribute()
    {
        if (!empty($this->getFirstMediaUrl('posts'))) {
            return asset($this->getFirstMediaUrl('posts'));
        }

        return asset('frontend/images/default.png');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_categories')->withTimestamps();
        // return $this->morphToMany(Category::class, 'categories');

    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags')->withTimestamps();
    }
    
}
