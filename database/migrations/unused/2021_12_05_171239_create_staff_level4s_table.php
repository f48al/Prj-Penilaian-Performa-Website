<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffLevel4sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_level4s', function (Blueprint $table) {
            $table->id('idsl4');
            $table->unsignedBigInteger('iddkpi');
            $table->string('nama');
            $table->string('namaJabatan');
            $table->string('unitKerja');
            $table->date('tanggalLahir');
            $table->date('tanggalMulaiJabatan');

            $table->foreign('iddkpi')->references('iddKPI')->on('draft_kpi_individus')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff_level4s');
    }
}
