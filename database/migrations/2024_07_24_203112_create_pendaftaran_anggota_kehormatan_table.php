<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaranAnggotaKehormatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftaran_anggota_kehormatan', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('nik', 30)->unique();
            $table->string('npwp', 30)->unique();
            $table->string('city_born');
            $table->date('born');
            $table->string('village_id');
            $table->text('address');
            $table->string('phone');
            $table->enum('gender', ['Perempuan', 'Laki-Laki']);
            $table->enum('perkawinan', ['Belum Menikah', 'Menikah', 'Pernah Menikah'])->default('Belum Menikah');
            $table->string('file_ktp');
            $table->string('file_npwp');
            $table->string('bidang_pekerjaan');
            $table->string('jabatan')->nullable();
            $table->string('file_bukti_pekerjaan');
            $table->string('email')->unique();
            $table->string('no_kta_kehormatan')->nullable();
            $table->date('tgl_mulai')->nullable();
            $table->date('tgl_akhir')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('ip_client_register')->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendaftaran_anggota_kehormatan');
    }
}
