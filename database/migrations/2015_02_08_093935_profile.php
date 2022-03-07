<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Profile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('photo')->nullable();
            $table->string('NPK')->nullable();
            $table->enum('gender', ['pria', 'wanita'])->nullable();
            $table->text('address')->nullable();
            $table->string('namaJabatan')->nullable();
            $table->string('unitKerja')->nullable();
            $table->date('tanggalLahir')->nullable();
            $table->date('tanggalMulaiJabatan')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
