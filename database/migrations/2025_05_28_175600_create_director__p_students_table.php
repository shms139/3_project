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
        Schema::create('director__p_students', function (Blueprint $table) {
            $table->id();
            // $table->string('body');
            $table->foreignId("director_id")->constrained("directors")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("p_student_id")->constrained("p_students")->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('director__p_students');
    }
};
