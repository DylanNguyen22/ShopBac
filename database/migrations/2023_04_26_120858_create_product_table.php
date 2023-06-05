<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SanPham', function (Blueprint $table) {
            $table->increments("MaSP");
            $table->string("MaTraCuu", 20);
            $table->string("TenSP", 200);
            $table->integer("DonGia");
            $table->text("MoTa");
            $table->text("ChiTiet");
            $table->date("NgayLenKe");
            $table->text("Video");
            $table->integer("SoLuong");     
            $table->integer("LoaiKichThuoc");
            $table->integer("TrangThai");
            $table->unsignedInteger('MaCL');
            $table->unsignedInteger('MaLoai');

            $table->foreign(['MaCL'])
                ->references('MaCL')->on('ChatLieu')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            
            $table->foreign(['Maloai'])
                ->references('MaLoai')->on('LoaiSanpham')
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
        Schema::dropIfExists('SanPham');
    }
}
