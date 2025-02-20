<?php

use App\Models\Course;
use App\Models\User;
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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->ForeignIdFor(Course::class)->constrained()->cascadeOnDelete();
            $table->ForeignIdFor(User::class, 'student_id')->constrained()->cascadeOnDelete();
            $table->double('final_note');
            $table->string('comments');
            $table->timestamps();
            $table->unique(['course_id', 'student_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
