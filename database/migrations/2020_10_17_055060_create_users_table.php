<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('user_id')->unique()->primary();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('name')->nullable();
            $table->char('gender', 1)->nullable();
            $table->string('image')->default('default.png')->nullable();
            $table->string('nric_no')->unique()->nullable();
            $table->date('birth_date')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('home_address')->nullable();
            $table->string('correspondence_address')->nullable();
            $table->string('session_join')->nullable();
            $table->string('status')->default('Active');
            $table->uuid('uuid')->nullable();
            $table->unsignedBigInteger('role_id');
            $table->string('faculty_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->string('api_token', 80)->unique()->nullable()->default(null);
            $table->string('device_token')->nullable();

            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('faculty_id')->references('faculty_id')->on('faculties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
