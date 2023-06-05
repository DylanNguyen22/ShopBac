<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('GioHang', function (Blueprint $table) {
            $table->increments('MaGH');
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
        Schema::dropIfExists('GioHang');
    }
}
