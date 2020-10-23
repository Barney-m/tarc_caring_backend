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
            $table->id();
            $table->unsignedBigInteger('feedbackType_id');
            $table->string('choice')->nullable();
            $table->string('comment');
            $table->string('attachment')->nullable();
            $table->string('creator_id')->nullable();
            $table->string('handler_id')->nullable();
            $table->boolean('anonymous')->nullable();
            $table->unsignedTinyInteger('priority');
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
