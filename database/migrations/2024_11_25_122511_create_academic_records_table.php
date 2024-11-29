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
        Schema::create('academic_records', function (Blueprint $table) {
            $table->id('record_id');
            $table->foreignId('student_id')
                ->constrained('students', 'student_id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('subject_id')
                ->constrained('subjects', 'subject_id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->decimal('grade', 5, 2)->nullable();
            $table->string('semester');
            $table->string('academic_year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_records');
    }
};
