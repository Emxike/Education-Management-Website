<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMtbMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtb_menu', function (Blueprint $table) {
            $table->id();
            $table->string("menu_icon")->nullable();
            $table->string("menu_title")->nullable();
            $table->string("menu_href")->nullable();
            $table->string("menu_color")->nullable();
            $table->boolean("menu_list")->default(0)->nullable();
            $table->boolean("menu_add")->default(0)->nullable();
            $table->boolean("menu_edit")->default(0)->nullable();
            $table->integer("menu_sort")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mtb_menu');
    }
}
