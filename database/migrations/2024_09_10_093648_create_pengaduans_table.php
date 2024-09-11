<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaduansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_pengaduan');
            $table->string('kategori');
            $table->string('unit_djp')->nullable();
            $table->string('fullname');
            $table->string('nip')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('kantor')->nullable();
            $table->longText('kronologi')->nullable();
            $table->enum('gender', ['Perempuan', 'Laki-Laki']);
            $table->string('province_id', 4);
            $table->string('regency_id', 8);
            $table->string('files');
            $table->boolean('status')->default(0);
            $table->string('pelapor')->nullable();
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
        Schema::dropIfExists('pengaduan');
    }
}
