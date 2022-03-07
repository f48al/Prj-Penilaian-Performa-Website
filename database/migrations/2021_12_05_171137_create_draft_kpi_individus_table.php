<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDraftKpiIndividusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('draft_kpi_individus', function (Blueprint $table) {
            $table->id('iddKPI');
            $table->string('indikatorKunciKerja');
            $table->string('perspektif');
            $table->string('tujuanStrategis');
            $table->string('glosary');
            $table->string('formula');
            $table->integer('tahunKinerja');
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
        Schema::dropIfExists('draft_kpi_individus');
    }
}
