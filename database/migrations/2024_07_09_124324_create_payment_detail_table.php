<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_detail', function (Blueprint $table) {
            $table->id();
            $table->string('order_id', 50);
            $table->unsignedBigInteger('pendaftaran_id');
            $table->string('payment_link_id', 50);
            $table->dateTime('expired_at');
            $table->enum('status', ['pending', 'deny', 'expired','cancel','capture','accept','settlement'])->default('pending');
            $table->string('payment_type', 190);
            $table->timestamps();

            $table->foreign('pendaftaran_id')
                    ->references('id')->on('pendaftaran_anggota')
                    ->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_detail');
    }
}
