<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array([
            "user_name" => "admin",
            "full_name" => "Admin",
            "role_id" => "1",
            'password' => bcrypt('password')
        ]);
        Member::query()->insert($data);
    }
}
