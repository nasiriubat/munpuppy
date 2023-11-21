<?php

namespace Database\seeders;

use App\Models\Tag;
use App\Models\User;
use App\Enums\Status;
use App\Enums\CategoryType;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            [
                'name'     => 'PHP',
                'status'     => Status::ACTIVE,
                'slug'     => 'php',
                'type'     => CategoryType::POST,
            ],
            [
                'name'     => 'LARAVEL',
                'status'     => Status::ACTIVE,
                'slug'     => 'laravel',
                'type'     => CategoryType::POST,

            ],
            [
                'name'     => 'Technology',
                'status'     => Status::ACTIVE,
                'slug'     => 'technology',
                'type'     => CategoryType::BLOG,

            ],
            [
                'name'   => 'Crypto',
                'status' => Status::ACTIVE,
                'slug'   => 'crypto',
                'type'   => CategoryType::BLOG,

            ],

        ];


        Tag::insert($tags);
    }
}
