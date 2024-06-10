<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->bigInteger('author_id')->unsigned();
            $table->string('title');
            $table->text('excerpt');
            $table->longText('content');
            $table->string('featured_img')->nullable();
            $table->integer('status')->default(1);
            $table->string('type', 50)->default('standard');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_image');
            $table->string('tag')->default('[]');
            $table->string('categories');
            $table->dateTime('published_at');
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('author_id')
                    ->references('id')->on('users')
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
        Schema::dropIfExists('blog');
    }
}
