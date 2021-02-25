<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title', 150);
            $table->string('slug', 150);
            $table->string('subtitle', 100);
            $table->mediumText('text');
            $table->string('img_path', 255);
            $table->date('publication_date');
            $table->timestamps();

             // DB relationships
             $table->foreign('user_id')
             ->references('id')
             ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
