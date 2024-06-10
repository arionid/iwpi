<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaranAnggotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftaran_anggota', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('nik', 30)->unique();
            $table->string('fullname');
            $table->string('city_born');
            $table->date('born');
            $table->unsignedTinyInteger('province_id');
            $table->text('address');
            $table->string('phone');
            $table->enum('gender', ['Perempuan', 'Laki-Laki']);
            $table->enum('perkawinan', ['Belum Menikah', 'Menikah', 'Pernah Menikah'])->default('Belum Menikah');
            $table->string('file_ktp');
            $table->string('user_agent')->nullable();
            $table->string('ip_client_register')->nullable();
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
        Schema::dropIfExists('pendaftaran_anggota');
    }
}
