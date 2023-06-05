<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diachi', function (Blueprint $table) {
            $table->increments('MaDC');
            $table->string('DiaChi', 400);
            $table->integer('SoDienThoai');
            $table->string('HoVaTen', 50);
            $table->unsignedInteger('MaTK');

            $table->foreign(['MaTK'])
                ->references('MaTK')->on('TaiKhoan')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diachi');
    }
}
