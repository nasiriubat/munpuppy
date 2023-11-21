<?php
namespace Database\seeders;
use App\Models\BackendMenu;
use Illuminate\Database\Seeder;

class BackendMenuTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

         $parent = [
             'administrators' => 8,
         ];

        $menus = [
            [
                'name'      => 'dashboard',
                'link'      => 'dashboard',
                'icon'      => 'fas fa-laptop',
                'parent_id' => 0,
                'priority'  => 9000,
                'status'    => 1,
            ],
            [
                'name'      => 'profile',
                'link'      => 'profile',
                'icon'      => 'far fa-user',
                'parent_id' => 0,
                'priority'  => 8900,
                'status'    => 1,
            ],

            [
                'name'      => 'category',
                'link'      => 'category',
                'icon'      => 'fas fa-user-secret',
                'parent_id' => 0,
                'priority'  => 8500,
                'status'    => 1,
            ],
            [
                'name'      => 'tag',
                'link'      => 'tag',
                'icon'      => 'fas fa-user-secret',
                'parent_id' => 0,
                'priority'  => 8500,
                'status'    => 1,
            ],
            [
                'name'      => 'post',
                'link'      => 'post',
                'icon'      => 'fas fa-walking',
                'parent_id' => 0,
                'priority'  => 8600,
                'status'    => 1,
            ],
            [
                'name'      => 'blog',
                'link'      => 'blog',
                'icon'      => 'fas fa-blog',
                'parent_id' => 0,
                'priority'  => 8600,
                'status'    => 1,
            ],
            [
                'name'      => 'breakingnews',
                'link'      => 'breakingnews',
                'icon'      => 'fas fa-list-alt',
                'parent_id' => 0,
                'priority'  => 8400,
                'status'    => 1,
            ],
            [
                'name'      => 'administrators',
                'link'      => '#',
                'icon'      => 'fas fa-id-card ',
                'parent_id' => 0,
                'priority'  => 81,
                'status'    => 1,
            ],
            [
                'name'      => 'users',
                'link'      => 'adminusers',
                'icon'      => 'fas fa-users',
                'parent_id' => $parent['administrators'],
                'priority'  => 8400,
                'status'    => 1,
            ],
            [
                'name'      => 'role',
                'link'      => 'role',
                'icon'      => 'fa fa-star',
                'parent_id' => $parent['administrators'],
                'priority'  => 2400,
                'status'    => 1,
            ],
            [
                'name'      => 'settings',
                'link'      => 'setting',
                'icon'      => 'fas fa-cogs',
                'parent_id' => 0,
                'priority'  => 2400,
                'status'    => 1,
            ],



        ];

        BackendMenu::insert($menus);
    }
}
