<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class PostTag extends Model
{
    // use InteractsWithMedia ,HasSlug;

    protected $table = 'post_tags';
    protected $fillable = [
        'post_id','tag_id'
    ];


    public function posts(){
        return $this->hasMany(Post::class);
    }

}
