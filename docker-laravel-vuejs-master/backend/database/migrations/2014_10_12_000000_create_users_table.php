<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('background_id');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('date_of_birth');
            $table->string('cpf')->unique();
            $table->string('city');
            $table->string('state');
            $table->integer('phone');
            $table->text('curriculum');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('background_id')->references('id')->on('academic_backgrounds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
