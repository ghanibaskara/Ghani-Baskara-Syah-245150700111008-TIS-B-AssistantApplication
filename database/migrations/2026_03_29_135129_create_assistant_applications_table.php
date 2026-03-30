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
        Schema::create('assistant_applications', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->string('student_id')->unique();
            $table->string('course_name');
            $table->decimal('gpa', 3, 2);
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assistant_applications');
    }
};
