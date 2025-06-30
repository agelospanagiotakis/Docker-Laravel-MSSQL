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
        Schema::create('texts_admissions', function (Blueprint $table) {
            $table->id('ID');
            $table->foreignId('AdmissionID')->nullable()->constrained('admissions', 'ID');
            $table->text('AdParousa')->nullable();
            $table->text('AdPoreia')->nullable();
            $table->text('AdNeuron')->nullable();
            $table->text('AdAtomiko')->nullable();
            $table->text('AdProjections')->nullable();
            $table->string('AdFill01')->nullable();
            $table->string('AdFill02')->nullable();
            $table->string('AdFill03')->nullable();
            $table->string('AdFill04')->nullable();
            $table->string('AdFill05')->nullable();
            $table->string('UserInserted')->nullable();
            $table->dateTime('DateInserted')->nullable();
            $table->string('UserUpdated')->nullable();
            $table->dateTime('DateUpdated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('texts_admissions');
    }
};
