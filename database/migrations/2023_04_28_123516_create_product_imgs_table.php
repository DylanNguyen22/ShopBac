<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HinhAnh', function (Blueprint $table) {
            $table->increments('MaHA');
            $table->integer('LoaiAnh');
            $table->text('TenAnh');
            $table->unsignedInteger('MaSP');

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
        Schema::dropIfExists('HinhAnh');
    }
}
