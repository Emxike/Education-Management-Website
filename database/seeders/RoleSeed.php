<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
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
                "id" => "2",
                "role_name" => "Quality Assurance Manager",
                'is_admin' => true,
            ],
            [
                "id" => "3",
                "role_name" => "Quality Assurance Coordinator",
                'is_admin' => true,
            ],
            [
                "id" => "1",
                "role_name" => "Administrator",
                'is_admin' => true,
            ],
            [
                "id" => "4",
                "role_name" => "Academic",
                'is_client' => false
            ],
            [
                "id" => "5",
                "role_name" => "Support",
                'is_client' => false
            ]

        );

        Role::query()->insert($data);
    }
}
