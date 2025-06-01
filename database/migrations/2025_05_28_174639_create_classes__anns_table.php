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
        Schema::create('classes__anns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('the_class_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('announcement_id')->constrained("announcements")->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes__anns');
    }
};
