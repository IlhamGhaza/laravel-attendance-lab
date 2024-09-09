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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            //building_id
            $table->foreignId('building_id')->constrained('buildings')->onDelete('cascade');
            $table->string('floor');
            //number
            $table->string('room_number');
            //lab_id
            $table->foreignId('lab_id')->constrained('labs')->onDelete('cascade');
            //status enum
            $table->enum('status', ['occupied', 'vacant', 'maintenance'])->default('vacant');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms', function (Blueprint $table) {
            $table->dropForeign(['building_id']);
        });
    }
};
