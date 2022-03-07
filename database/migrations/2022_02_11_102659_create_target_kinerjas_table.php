<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTargetKinerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('target_kinerjas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penyusunanKPI_id');
            $table->unsignedBigInteger('iddKPI');
            $table->bigInteger('skala')->nullable();
            $table->bigInteger('bobot')->nullable();
            $table->timestamps();

            $table->foreign('penyusunanKPI_id')->references('idPenyusunanKPI')->on('form_penyusunan_kpis')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('iddKPI')->references('iddKPI')->on('draft_kpi_individus')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('target_kinerjas');
    }
}
