<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ChiTietGioHang', function (Blueprint $table) {
            $table->unsignedInteger('MaSP');
            $table->integer('SoLuong');
            $table->unsignedInteger('MaGH');

            $table->foreign(['MaSP'])
                ->references('MaSP')->on('SanPham')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->foreign(['MaGH'])
                ->references('MaGH')->on('GioHang')
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
        Schema::dropIfExists('ChiTietGioHang');
    }
}