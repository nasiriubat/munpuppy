<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','status','type','slug'
    ];

    public function blogs(){
        return $this->hasMany(Blog::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tags', 'tag_id','post_id');
    }
}
