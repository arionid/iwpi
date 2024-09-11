<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitKerjaDjpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_kerja_djp', function (Blueprint $table) {
            $table->id();
            $table->string('nama_unit');
            $table->text('alamat');
            $table->string('tlp')->nullable();
            $table->string('pos')->nullable();
            $table->string('kanwil')->nullable();
            $table->string('url')->nullable();
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
        Schema::dropIfExists('unit_kerja_djp');
    }
}
