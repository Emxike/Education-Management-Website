<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDtbCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtb_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("staff_id");
            $table->unsignedBigInteger("idea_id");
            $table->string("message");
            $table->dateTime("created")->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtb_comments');
    }
}
