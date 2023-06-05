<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOrderDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ChiTietDonHang', function (Blueprint $table) {
            $table->integer('SoLuong');
            $table->integer('DonGia');
            $table->string('KichThuoc', 5);
            $table->unsignedInteger('MaDH');
            $table->unsignedInteger('MaSP');

            $table->foreign(['MaDH'])
                ->references('MADH')->on('DonHang')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->foreign(['MaSP'])
                ->references('MaSP')->on('SanPham')
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
        Schema::dropIfExists('ChiTietDonHang');
    }
}