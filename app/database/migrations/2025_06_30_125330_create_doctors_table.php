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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id('ID');
            $table->string('FirstName')->nullable();
            $table->string('LastName')->nullable();
            $table->string('Abbreviation')->nullable();
            $table->string('PrintedProfession')->nullable();
            $table->integer('SpecializationID')->nullable();
            $table->string('Title')->nullable();
            $table->integer('DisplayOrder')->nullable();
            $table->integer('Role')->nullable();
            $table->boolean('IsActive')->nullable();
            $table->string('UserName')->nullable();
            $table->string('UserInserted')->nullable();
            $table->string('DateInserted')->nullable();
            $table->string('UserUpdated')->nullable();
            $table->string('DateUpdated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
