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
        Schema::create('weekly_programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('director_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('the_class_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('program_name')->default("images/default.jpg");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weekly_programs');
    }
};
