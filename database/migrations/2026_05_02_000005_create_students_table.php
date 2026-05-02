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
            $table->string('name',50)->nullable(false);
            $table->string('username',10)->nullable(false)->unique();
            $table->string('password',20)->nullable(false);
            $table->enum('status',['active','inactive'])->nullable(false);
            $table->unsignedBigInteger('school_id');
            $table->unsignedBigInteger('lab_id');
            $table->timestamps();
            $table->foreign('school_id')->on('schools')->references('id');
            $table->foreign('lab_id')->on('labs')->references('id');
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
