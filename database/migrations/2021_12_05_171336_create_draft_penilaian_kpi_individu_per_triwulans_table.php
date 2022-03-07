<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDraftPenilaianKpiIndividuPerTriwulansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('draft_penilaian_kpi_individu_per_triwulans', function (Blueprint $table) {
            $table->id('iddPenilaian');
            $table->unsignedBigInteger('iddkpi');
            $table->string('waktuTriwulan');
            $table->string('indikatorKunciKerja');
            $table->string('perspektif');
            $table->string('tujuanStrategis');
            $table->bigInteger('skala');
            $table->bigInteger('bobot');
            $table->string('filePendukung')->nullable();
            $table->bigInteger('realisasiKaryawan')->nullable();
            $table->bigInteger('realisasiAtasan')->nullable();
            $table->integer('tahunKinerja');

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
        Schema::dropIfExists('draft_penliaian_kpi_individu_per_triwulans');
    }
}
