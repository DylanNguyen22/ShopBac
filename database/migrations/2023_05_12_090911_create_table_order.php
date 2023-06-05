<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DonHang', function (Blueprint $table) {
            $table->increments('MaDH');
            $table->string('NgayDat', 10);
            $table->string('DiaChi', 200);
            $table->integer('SoDienThoai');
            $table->string('TenNguoiNhan', 30);
            $table->text('GhiChu');
            $table->integer('TrangThai');
            $table->integer('LoaiThanhToan');
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
        Schema::dropIfExists('DonHang');
    }
}
