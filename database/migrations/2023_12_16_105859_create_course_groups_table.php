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
        Schema::create('course_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('group_id');
            $table->foreign(['course_id'], 'fk_course_group')->references(['id'])->on('courses')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['group_id'], 'fk_group_course')->references(['id'])->on('groups')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_groups');
    }
};
