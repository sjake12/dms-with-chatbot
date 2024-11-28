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
        Schema::create('students', function (Blueprint $table) {
            $table->id('student_id');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->foreignId('program_id')
                ->constrained('programs', 'program_id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('year_level')
                ->constrained('year_levels', 'year_level_id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
