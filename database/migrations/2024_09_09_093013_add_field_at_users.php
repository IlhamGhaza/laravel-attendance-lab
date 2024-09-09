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
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            //fk department
            $table->foreignId('department_id')->nullable()->constrained('departments')->onDelete('set null');
            //labs_id
            $table->foreignId('lab_id')->nullable()->constrained('labs')->onDelete('set null');
            $table->enum('position', ['assistant', 'tutor', 'ketua', 'staff'])->nullable();
            //face_embedding
            $table->text('face_embedding')->nullable();
            //image_url
            $table->string('image')->nullable();
            //fcm_token
            $table->string('fcm_token')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //drop fk
            $table->dropForeign(['lab_id']);
            $table->dropForeign(['department_id']);
            //drop column
            $table->dropColumn(['first_name', 'last_name', 'date_of_birth', 'gender', 'address', 'position', 'phone', 'lab_id', 'department_id', 'face_embedding', 'image', 'fcm_token']);
        });
    }
};
