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
        Schema::create('recruiters', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('cnpj');
            $table->string('social_name');
            $table->string('cep');
            $table->string('city');
            $table->string('state');
            $table->boolean('is_recruiter')->default(true)->notNullable();
            $table->string('password');
            $table->string('email');
            $table->string('perfilPicture')->nullable();
            $table->string('phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recruiters');
    }
};
