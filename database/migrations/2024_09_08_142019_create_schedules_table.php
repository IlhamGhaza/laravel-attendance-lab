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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            // user_id
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            // room_id
            $table->foreignId('room_id')->constrained('rooms')->cascadeOnDelete();
            // subject_id
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            // department_id
            $table->foreignId('department_id')->constrained('departments')->cascadeOnDelete();
            // day_of_week enum ('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')
            $table->string('day_of_week');
            // shift_id
            $table->foreignId('shift_id')->constrained('shifts')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['room_id']);
            $table->dropForeign(['subject_id']);
            $table->dropForeign(['department_id']);
            $table->dropForeign(['shift_id']);
        });
    }
};
