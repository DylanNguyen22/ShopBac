<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TaiKhoan', function (Blueprint $table) {
            $table->increments('MaTK');
            $table->string('Email', 50);
            $table->text('MatKhau');
            $table->integer('LoaiTK');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TaiKhoan');
    }
}
