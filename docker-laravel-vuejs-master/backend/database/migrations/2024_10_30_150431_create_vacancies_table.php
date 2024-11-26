<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recruiter_id')->nullable();
            $table->string('vacancy_name');
            $table->string('description');
            $table->string('requirements');
            $table->string('location');
            $table->string('work_modality');
            $table->date('creation_date')->default(DB::raw('CURRENT_DATE')); // Define o valor padrão como o dia atual
            $table->string('company');
            $table->string('salary');
            $table->string('company_logo');
            $table->integer('min_age');
            $table->timestamps();

            $table->foreign('recruiter_id')->references('id')->on('recruiters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
