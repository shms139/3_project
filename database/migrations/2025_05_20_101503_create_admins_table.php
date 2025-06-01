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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string("firstname");
            $table->string("lastname");
            $table->string("mobile");
            $table->string("password");
            $table->foreignId("user_id")->constrained("users")->cascadeOnUpdate()->cascadeOnDelete();
            // one to many between admin and Announcements


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
