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
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            //date permission is a date column
            $table->date('date_permission');
            //reason
            $table->text('reason');
            //image nullable
            $table->string('image')->nullable();
            // is_approved is a boolean column
            $table->boolean('is_approved')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absences', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    }
};
