<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = DB::table("mtb_menu")->get();
        $data = [];
        $dataQC = [];
        $dataQCM = [];
        foreach ($menus as $menu){
            $data[] = [
                "role_id" => 1,
                "menu_id" => $menu->id
            ];

            if (in_array($menu->id, [1, 2, 3, 4 ,5])) {
                $dataQCM[] = [
                    "role_id" => 2,
                    "menu_id" => $menu->id
                ];
            }

            if (in_array($menu->id, [1, 2, 3])) {
                $dataQC[] = [
                    "role_id" => 3,
                    "menu_id" => $menu->id
                ];
            }
        }

        DB::table("dtb_permission_role")->insert($data);
        DB::table("dtb_permission_role")->insert($dataQCM);
        DB::table("dtb_permission_role")->insert($dataQC);
    }
}
