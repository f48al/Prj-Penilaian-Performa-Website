<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormPenyusunanKpisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_penyusunan_kpis', function (Blueprint $table) {
            $table->id('idPenyusunanKPI');
            $table->string('dkpiid');
            $table->unsignedBigInteger('profile_id');
            $table->boolean('status_penyusunan')->default(false);
            $table->boolean('status_triwulan1')->default(false);
            $table->boolean('status_triwulan2')->default(false);
            $table->boolean('status_triwulan3')->default(false);
            $table->boolean('status_triwulan4')->default(false);
            $table->date('tanggalRespon')->nullable();
            $table->text('catatan')->nullable();
            $table->integer('tahunKinerja');
            $table->timestamps();

            $table->foreign('profile_id')->references('id')->on('profiles')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_penyusunan_kpis');
    }
}
