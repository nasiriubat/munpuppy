<?php

namespace App\Http\Livewire;

use App\Enums\Ask;
use App\Models\Post;
use App\Enums\Status;
use Livewire\Component;
use App\Models\Category;
use App\Enums\CategoryType;

class SidebarPosts extends Component
{
    public $sidebar_posts,$sidebar_title,$sidebarCategories;
    public function render()
    {
        $this->sidebar_title = 'Internships';
        $this->sidebar_posts =  Post::where(['status' => Status::ACTIVE])->where('internship', Ask::YES)->orderByDesc('id')->get();
        $this->sidebarCategories = Category::has('posts', '>', 0)->withCount('posts')->where(['status' => Status::ACTIVE, 'type' => CategoryType::POST])->get();
        return view('livewire.sidebar-posts');
    }
}
