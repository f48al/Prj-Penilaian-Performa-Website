<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffLevel1sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_level1s', function (Blueprint $table) {
            $table->id('idsl1');
            $table->unsignedBigInteger('user_id');
            $table->string('nama');
            $table->string('namaJabatan');
            $table->string('unitKerja');
            $table->date('tanggalLahir');
            $table->date('tanggalMulaiJabatan');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff_level1s');
    }
}
