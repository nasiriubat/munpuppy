<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;


class BreakingNews extends Model
{
    protected $table = 'breaking_news';

    public function Post(){
        return $this->belongsTo(Post::class);
    }
}
