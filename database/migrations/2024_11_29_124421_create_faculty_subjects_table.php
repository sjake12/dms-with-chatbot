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
        Schema::create('faculty_subject', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('faculty_id');
            $table->unsignedBigInteger('subject_id');
            $table->boolean('can_assign_grades')->default(true);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('faculty_id')->references('faculty_id')->on('faculties')->onDelete('cascade');
            $table->foreign('subject_id')->references('subject_id')->on('subjects')->onDelete('cascade');

            // Ensure unique combination of faculty and subject
            $table->unique(['faculty_id', 'subject_id']);
        });

        // Modify academic_records table to track the grading faculty
        Schema::table('academic_records', function (Blueprint $table) {
            $table->unsignedBigInteger('faculty_id')->nullable()->after('subject_id');
            $table->foreign('faculty_id')->references('faculty_id')->on('faculties')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('academic_records', function (Blueprint $table) {
            $table->dropForeign(['faculty_id']);
            $table->dropColumn('faculty_id');
        });

        Schema::dropIfExists('faculty_subject');
    }
};
