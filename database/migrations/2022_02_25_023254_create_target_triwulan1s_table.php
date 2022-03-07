<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTargetTriwulan1sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('target_triwulan1s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('target_kinerja_id');
            $table->integer('target')->default(0);
            $table->integer('realisasi_karyawan')->default(0);
            $table->integer('realisasi_atasan')->default(0);
            $table->string('filePendukung')->nullable();
            $table->timestamps();

            $table->foreign('target_kinerja_id')->references('id')->on('target_kinerjas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('target_triwulan1s');
    }
}
