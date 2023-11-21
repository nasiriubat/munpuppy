<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class PostCategory extends Model
{
    // use InteractsWithMedia ,HasSlug;

    protected $table = 'post_categories';
    protected $fillable = [
        'post_id','category_id'
    ];


    public function posts(){
        return $this->hasMany(Post::class);
    }

}
