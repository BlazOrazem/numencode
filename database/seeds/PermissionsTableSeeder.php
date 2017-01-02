<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id'         => '1',
                'name'       => 'view_managers',
                'label'      => 'Admin can view managers',
                'is_admin'   => true,
                'sort_order' => 10,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => '2',
                'name'       => 'manage_managers',
                'label'      => 'Admin can managers managers',
                'is_admin'   => true,
                'sort_order' => 20,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => '3',
                'name'       => 'assign_manager_roles',
                'label'      => 'Admin can assign roles to managers',
                'is_admin'   => true,
                'sort_order' => 30,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => '4',
                'name'       => 'view_users',
                'label'      => 'Admin can view managers',
                'is_admin'   => true,
                'sort_order' => 40,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => '5',
                'name'       => 'manage_users',
                'label'      => 'Admin can managers managers',
                'is_admin'   => true,
                'sort_order' => 50,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => '6',
                'name'       => 'assign_user_roles',
                'label'      => 'Admin can assign roles to users',
                'is_admin'   => true,
                'sort_order' => 60,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => '7',
                'name'       => 'view_roles',
                'label'      => 'Admin can view roles',
                'is_admin'   => true,
                'sort_order' => 70,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => '8',
                'name'       => 'manage_roles',
                'label'      => 'Admin can manage roles',
                'is_admin'   => true,
                'sort_order' => 80,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => '9',
                'name'       => 'manage_permissions',
                'label'      => 'Admin can manage permissions',
                'is_admin'   => true,
                'sort_order' => 90,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => '10',
                'name'       => 'manage_menus',
                'label'      => 'Admin can manage menus',
                'is_admin'   => true,
                'sort_order' => 100,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => '11',
                'name'       => 'view_plugins',
                'label'      => 'Admin can view plugins',
                'is_admin'   => true,
                'sort_order' => 110,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => '12',
                'name'       => 'manage_plugins',
                'label'      => 'Admin can manage plugins',
                'is_admin'   => true,
                'sort_order' => 120,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => '13',
                'name'       => 'view_codelist',
                'label'      => 'Admin can view codelist',
                'is_admin'   => true,
                'sort_order' => 130,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => '14',
                'name'       => 'manage_codelist',
                'label'      => 'Admin can manage codelist',
                'is_admin'   => true,
                'sort_order' => 140,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => '15',
                'name'       => 'view_pages',
                'label'      => 'Admin can view pages',
                'is_admin'   => true,
                'sort_order' => 150,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => '16',
                'name'       => 'manage_pages',
                'label'      => 'Admin can manage pages',
                'is_admin'   => true,
                'sort_order' => 160,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
//            [
//                'id'         => '1',
//                'name'       => 'view_managers',
//                'label'      => 'Admin can view all managers.',
//                'is_admin'   => true,
//                'sort_order' => 10,
//                'created_at' => new DateTime,
//                'updated_at' => new DateTime,
//            ],
//            [
//                'id'         => '2',
//                'name'       => 'create_managers',
//                'label'      => 'Admin can create new managers.',
//                'is_admin'   => true,
//                'sort_order' => 20,
//                'created_at' => new DateTime,
//                'updated_at' => new DateTime,
//            ],
//            [
//                'id'         => '3',
//                'name'       => 'edit_managers',
//                'label'      => 'Admin can edit managers.',
//                'is_admin'   => true,
//                'sort_order' => 30,
//                'created_at' => new DateTime,
//                'updated_at' => new DateTime,
//            ],
//            [
//                'id'         => '4',
//                'name'       => 'delete_managers',
//                'label'      => 'Admin can delete managers.',
//                'is_admin'   => true,
//                'sort_order' => 40,
//                'created_at' => new DateTime,
//                'updated_at' => new DateTime,
//            ],
//            [
//                'id'         => '5',
//                'name'       => 'manage_profile',
//                'label'      => 'User can manage their own profile.',
//                'is_admin'   => false,
//                'sort_order' => 100,
//                'created_at' => new DateTime,
//                'updated_at' => new DateTime,
//            ],
//            [
//                'id'         => '6',
//                'name'       => 'write_posts',
//                'label'      => 'User can write their own posts.',
//                'is_admin'   => false,
//                'sort_order' => 110,
//                'created_at' => new DateTime,
//                'updated_at' => new DateTime,
//            ],
//            [
//                'id'         => '7',
//                'name'       => 'manage_posts',
//                'label'      => 'User can manage their own posts.',
//                'is_admin'   => false,
//                'sort_order' => 120,
//                'created_at' => new DateTime,
//                'updated_at' => new DateTime,
//            ],
//            [
//                'id'         => '8',
//                'name'       => 'publish_posts',
//                'label'      => 'User can publish their own posts.',
//                'is_admin'   => false,
//                'sort_order' => 130,
//                'created_at' => new DateTime,
//                'updated_at' => new DateTime,
//            ],
//            [
//                'id'         => '9',
//                'name'       => 'manage_all_posts',
//                'label'      => 'User can manage posts of other users.',
//                'is_admin'   => false,
//                'sort_order' => 140,
//                'created_at' => new DateTime,
//                'updated_at' => new DateTime,
//            ],
//            [
//                'id'         => '10',
//                'name'       => 'publish_all_posts',
//                'label'      => 'User can publish posts of other users.',
//                'is_admin'   => false,
//                'sort_order' => 150,
//                'created_at' => new DateTime,
//                'updated_at' => new DateTime,
//            ],
//            [
//                'id'         => '11',
//                'name'       => 'edit_roles',
//                'label'      => 'Admin can manage roles.',
//                'is_admin'   => true,
//                'sort_order' => 200,
//                'created_at' => new DateTime,
//                'updated_at' => new DateTime,
//            ],
//            [
//                'id'         => '12',
//                'name'       => 'delete_roles',
//                'label'      => 'Admin can delete roles.',
//                'is_admin'   => true,
//                'sort_order' => 210,
//                'created_at' => new DateTime,
//                'updated_at' => new DateTime,
//            ],
//            [
//                'id'         => '13',
//                'name'       => 'edit_permissions',
//                'label'      => 'Admin can edit permissions.',
//                'is_admin'   => true,
//                'sort_order' => 220,
//                'created_at' => new DateTime,
//                'updated_at' => new DateTime,
//            ],
//            [
//                'id'         => '14',
//                'name'       => 'delete_permissions',
//                'label'      => 'Admin can delete permissions.',
//                'is_admin'   => true,
//                'sort_order' => 230,
//                'created_at' => new DateTime,
//                'updated_at' => new DateTime,
//            ],
//            [
//                'id'         => '15',
//                'name'       => 'edit_codelist',
//                'label'      => 'Admin can edit codelist.',
//                'is_admin'   => true,
//                'sort_order' => 220,
//                'created_at' => new DateTime,
//                'updated_at' => new DateTime,
//            ],
//            [
//                'id'         => '16',
//                'name'       => 'delete_codelist',
//                'label'      => 'Admin can delete codelist.',
//                'is_admin'   => true,
//                'sort_order' => 230,
//                'created_at' => new DateTime,
//                'updated_at' => new DateTime,
//            ],
//            [
//                'id'         => '17',
//                'name'       => 'edit_menus',
//                'label'      => 'Admin can edit menu.',
//                'is_admin'   => true,
//                'sort_order' => 240,
//                'created_at' => new DateTime,
//                'updated_at' => new DateTime,
//            ],
//            [
//                'id'         => '18',
//                'name'       => 'delete_menus',
//                'label'      => 'Admin can delete menu.',
//                'is_admin'   => true,
//                'sort_order' => 250,
//                'created_at' => new DateTime,
//                'updated_at' => new DateTime,
//            ],
//            [
//                'id'         => '19',
//                'name'       => 'edit_plugins',
//                'label'      => 'Admin can edit plugin.',
//                'is_admin'   => true,
//                'sort_order' => 260,
//                'created_at' => new DateTime,
//                'updated_at' => new DateTime,
//            ],
//            [
//                'id'         => '20',
//                'name'       => 'delete_plugins',
//                'label'      => 'Admin can delete plugin.',
//                'is_admin'   => true,
//                'sort_order' => 270,
//                'created_at' => new DateTime,
//                'updated_at' => new DateTime,
//            ],
        ];

        DB::table('permissions')->insert($items);
    }
}
