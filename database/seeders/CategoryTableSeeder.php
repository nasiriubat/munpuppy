<?php

namespace Database\seeders;

use App\Models\User;
use App\Enums\Status;
use App\Models\Category;
use App\Enums\CategoryType;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name'     => 'Bank Jobs',
                'status'     => Status::ACTIVE,
                'slug'     => 'bank-jobs',
                'type'     => CategoryType::POST,
            ],
            [
                'name'     => 'It & Communication',
                'status'     => Status::ACTIVE,
                'slug'     => 'it-communication',
                'type'     => CategoryType::POST,

            ],
            [
                'name'     => 'Job Preparation',
                'status'     => Status::ACTIVE,
                'slug'     => 'job-preparation',
                'type'     => CategoryType::BLOG,

            ],
            [
                'name'   => 'Bank Job Preparation',
                'status' => Status::ACTIVE,
                'slug'   => 'stadium',
                'type'   => CategoryType::BLOG,

            ],

        ];


        Category::insert($categories);
    }
}
