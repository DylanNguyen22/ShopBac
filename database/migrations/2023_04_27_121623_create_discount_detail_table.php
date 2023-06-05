<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ChiTietKhuyenMai', function (Blueprint $table) {

            $table->unsignedInteger('MaKM');
            $table->foreign(['MaKM'])
                ->references('MaKM')->on('KhuyenMai')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->unsignedInteger('MaApDung');
            $table->foreign(['MaApDung'])
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
        Schema::dropIfExists('ChiTietKhuyenMai');
    }
}
