<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormPenilaianKpisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_penilaian_kpis', function (Blueprint $table) {
            $table->id('idPeniliaianKPI');
            $table->unsignedBigInteger('iddpenilaian');
            $table->unsignedBigInteger('profile_id');
            $table->string('status');
            $table->date('tanggalRespon');
            $table->string('catatan');
            $table->integer('tahunKinerja');

            $table->foreign('iddpenilaian')->references('iddPenilaian')->on('draft_penilaian_kpi_individu_per_triwulans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('profile_id')->references('id')->on('profiles')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('form_penilaian_kpis');
    }
}
