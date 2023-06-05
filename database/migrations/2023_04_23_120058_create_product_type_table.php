<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LoaiSanPham', function (Blueprint $table) {
            $table->increments("MaLoai");
            $table->string("TenLoai", 200);
            $table->integer('TrangThai');
            $table->unsignedInteger('MaDanhMuc');

            $table->foreign(['MaDanhMuc'])
                ->references('MaDanhMuc')->on('DanhMuc')
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
        Schema::dropIfExists('LoaiSanPham');
    }
}
