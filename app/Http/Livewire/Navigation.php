<?php

namespace App\Http\Livewire;

use App\Enums\Status;
use Livewire\Component;
use App\Models\Category;
use App\Enums\CategoryType;

class Navigation extends Component
{
    public $all_categories;
    public function render()
    {
        $this->all_categories = Category::where(['status' => Status::ACTIVE, 'type' => CategoryType::POST])->get();
        return view('livewire.navigation');
    }
}
