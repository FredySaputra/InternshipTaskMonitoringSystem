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
        Schema::create('task_details', function (Blueprint $table) {
            $table->id();
            $table->string('proof',100)->nullable();
            $table->enum('sub_stat',['queue','submitted','accepted','rejected'])->nullable();
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('student_id');

            $table->foreign('task_id')->on('tasks')->references('id');
            $table->foreign('student_id')->on('students')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_details');
    }
};
