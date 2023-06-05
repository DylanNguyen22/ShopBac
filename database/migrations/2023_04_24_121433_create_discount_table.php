<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('KhuyenMai', function (Blueprint $table) {
            $table->increments('MaKM');
            $table->integer('PhanTramKM');
            // $table->integer('MaQuaTang');
            $table->date('NgayBatDau');
            $table->date("NgayHetHan");
            $table->integer("TrangThai");   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('KhuyenMai');
    }
}
