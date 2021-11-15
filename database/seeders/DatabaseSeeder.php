<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(MemberSeed::class);
        $this->call(CongfigSeed::class);
        $this->call(MenuSeed::class);
        $this->call(PermissionSeed::class);
        $this->call(RoleSeed::class);
    }
}
