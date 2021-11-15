<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDtbCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtb_customer', function (Blueprint $table) {
            $table->id();
            $table->string("user_name");
            $table->string("password");
            $table->string("full_name")->nullable();
            $table->string("email")->unique()->nullable();
            $table->string("phone")->nullable();
            $table->string("address")->nullable();
            $table->string('birthday')->nullable();
            $table->integer("status")->default(0);
            $table->integer('sex')->default(0);
            $table->string('avatar')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes()->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtb_customer');
    }
}
