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
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->date('date');
            $table->string('address');
            $table->string('email');
            $table->string('mobile');
            $table->string('password');
            $table->enum('the_class',["first", 'second', 'third', 'fourth','fifth']);
            $table->string('parents_job');
            $table->string('parents_name');
            $table->foreignId("user_id")->constrained("users")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("p_student_id")->constrained("p_students")->cascadeOnUpdate()->cascadeOnDelete();
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
