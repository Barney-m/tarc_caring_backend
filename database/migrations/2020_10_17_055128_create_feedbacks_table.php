<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->string('feedback_id')->primary();
            $table->unsignedBigInteger('feedbackType_id');
            $table->string('choice');
            $table->string('comment');
            $table->string('attachment')->nullable();
            $table->string('creator_id');
            $table->string('handler_id');
            $table->boolean('anonymous');
            $table->string('status');
            $table->timestamps();
            $table->timestamp('approved_date', 0)->nullable();
            $table->timestamp('dismiss_date', 0)->nullable();

            $table->foreign('feedbackType_id')->references('id')->on('feedback_types');
            $table->foreign('creator_id')->references('user_id')->on('users')->nullable();
            $table->foreign('handler_id')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedbacks');
    }
}
