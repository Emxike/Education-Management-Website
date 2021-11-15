<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDtbMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtb_members', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->string('password');
            $table->string('full_name')->nullable();
            $table->string("phone")->nullable();
            $table->string("address")->nullable();
            $table->string("avatar")->nullable();
            $table->tinyInteger("status")->default(0)->nullable();
            $table->unsignedBigInteger('role_id')->unsigned()->nullable();
            $table->rememberToken();
            $table->dateTime("created")->useCurrent();
            $table->dateTime("updated")->useCurrent();

        });

        DB::table("dtb_members")->insert(
            array([
                "user_name" => "admin",
                "full_name" => "Admin",
                "role_id" => "1",
                'password' => bcrypt('password')
            ])
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtb_members');
    }
}
