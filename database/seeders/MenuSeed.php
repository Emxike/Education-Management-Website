<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            [
                "id" => "1",
                "menu_icon" => "fa fa-home",
                "menu_title" => "Dashboard",
                "menu_href" => "dashboard",
                "menu_color" => "c-blue-500",
                "menu_list" => "0",
                "menu_add" => "0",
                "menu_edit" => "0",
                "menu_sort" => '1'
            ],[
                "id" => "2",
                "menu_icon" => "fas fa-building",
                "menu_title" => "Faculty",
                "menu_href" => "department",
                "menu_color" => "c-red-500",
                "menu_list" => "1",
                "menu_add" => "1",
                "menu_edit" => "1",
                "menu_sort" => '2'
            ],
            [
                "id" => "3",
                "menu_icon" => "fas fa-user",
                "menu_title" => "Student",
                "menu_href" => "staff",
                "menu_color" => "c-red-500",
                "menu_list" => "1",
                "menu_add" => "1",
                "menu_edit" => "1",
                "menu_sort" => '2'
            ],
            [
                "id" => "4",
                "menu_icon" => "fa fa-list",
                "menu_title" => "Categories",
                "menu_href" => "category",
                "menu_color" => "c-red-500",
                "menu_list" => "1",
                "menu_add" => "1",
                "menu_edit" => "1",
                "menu_sort" => '2'
            ],
            [
                "id" => "5",
                "menu_icon" => "fa fa-lightbulb",
                "menu_title" => "Idea",
                "menu_href" => "idea",
                "menu_color" => "c-red-500",
                "menu_list" => "0",
                "menu_add" => "0",
                "menu_edit" => "0",
                "menu_sort" => '2'
            ],
            [
                "id" => "17",
                "menu_icon" => "fa fa-child",
                "menu_title" => "Role",
                "menu_href" => "role",
                "menu_list" => "1",
                "menu_color" => "c-indigo-500",
                "menu_add" => "1",
                "menu_edit" => "1",
                "menu_sort" => "17"
            ], [
                "id" => "18",
                "menu_icon" => "fa fa-key",
                "menu_title" => "Permission",
                "menu_href" => "permission",
                "menu_list" => "0",
                "menu_color" => "c-yellow-500",
                "menu_add" => "0",
                "menu_edit" => "0",
                "menu_sort" => "18"
            ],
            [
                "id" => "19",
                "menu_icon" => "fas fa-users",
                "menu_title" => "Member",
                "menu_href" => "member",
                "menu_list" => "1",
                "menu_color" => "c-yellow-500",
                "menu_add" => "1",
                "menu_edit" => "1",
                "menu_sort" => "19"
            ]
        );

        DB::table("mtb_menu")->insert($data);
    }
}
