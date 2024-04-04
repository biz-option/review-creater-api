<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(1);
            $table->string('name')->nullable();
            $table->string('desc')->nullable();
            $table->integer('client_id');
            $table->string('code');
            $table->string('url1')->nullable();
            $table->string('url2')->nullable();
            $table->timestamps();
        });
        Schema::create('form_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id');
            $table->boolean('status')->default(1);
            $table->string('question');
            $table->integer('question_type')->default(1); // 1:text, 2:checkbox, 3:radio
            $table->string('question_part_texts')->nullable();
            $table->string('review_format')->nullable();
            $table->integer('sort_order')->default(1);
            $table->timestamps();
        });
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->integer('form_id');
            $table->timestamps();
        });
        Schema::create('review_details', function (Blueprint $table) {
            $table->id();
            $table->integer('review_id');
            $table->string('question');
            $table->string('answer');
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
        Schema::dropIfExists('forms');
        Schema::dropIfExists('form_questions');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('review_details');
    }
}
