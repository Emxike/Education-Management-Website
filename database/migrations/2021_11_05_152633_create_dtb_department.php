<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDtbDepartment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtb_department', function (Blueprint $table) {
            $table->id();
            $table->string("department_name");
            $table->unsignedBigInteger("member_id")->nullable();
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
        Schema::dropIfExists('dtb_department');
    }
}
