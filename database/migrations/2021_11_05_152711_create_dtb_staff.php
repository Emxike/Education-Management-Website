<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDtbStaff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtb_staff', function (Blueprint $table) {
            $table->id();
            $table->string("staff_name");
            $table->unsignedBigInteger('department_id')->unsigned()->nullable();
            $table->string("password");
            $table->string("avatar")->nullable();
            $table->string("phone", 11)->nullable();
            $table->string("device")->nullable();
            $table->date("birthday")->nullable();
            $table->tinyInteger("sex")->nullable();
            $table->string("email")->nullable();
            $table->string("address")->nullable();
            $table->dateTime("created")->useCurrent();
            $table->dateTime("updated")->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtb_staff');
    }
}
