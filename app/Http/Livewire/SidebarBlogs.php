<?php

namespace App\Http\Livewire;

use App\Enums\Ask;
use App\Models\Blog;
use App\Models\Post;
use App\Enums\Status;
use Livewire\Component;
use App\Models\Category;
use App\Enums\CategoryType;

class SidebarBlogs extends Component
{
    public $sidebar_blogs,$sidebar_title,$sidebarCategories;
    public function render()
    {
        $this->sidebar_title = 'Blog Categories';
        $this->sidebar_blogs =  Blog::where(['status' => Status::ACTIVE])->orderByDesc('id')->get();
        $this->sidebarCategories = Category::has('blogs', '>', 0)->withCount('blogs')->where(['status' => Status::ACTIVE, 'type' => CategoryType::BLOG])->get();
        return view('livewire.sidebar-blogs');
    }
}
