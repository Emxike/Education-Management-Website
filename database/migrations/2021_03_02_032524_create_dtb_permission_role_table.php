<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDtbPermissionRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtb_permission_role', function (Blueprint $table) {
            $table->unsignedBigInteger("role_id")->unsigned();
            $table->unsignedBigInteger("menu_id")->unsigned();
            $table->boolean("view_flg")->default(1)->nullable();
            $table->boolean("add_flg")->default(1)->nullable();
            $table->boolean("edit_flg")->default(1)->nullable();
            $table->boolean("del_flg")->default(1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtb_permission_role');
    }
}
