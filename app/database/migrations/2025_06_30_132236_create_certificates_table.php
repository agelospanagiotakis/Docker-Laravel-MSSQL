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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id('ID');
            $table->foreignId('AdmissionID')->nullable()->constrained('admissions', 'ID');
            $table->foreignId('DoctorA')->nullable()->constrained('doctors', 'ID');
            $table->foreignId('DoctorB')->nullable()->constrained('doctors', 'ID');
            $table->dateTime('FromDate')->nullable();
            $table->dateTime('ToDate')->nullable();
            $table->dateTime('IssuedDate')->nullable();
            $table->string('Notes')->nullable();
            $table->string('FillerString')->nullable();
            $table->integer('FillerInt')->nullable();
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
        Schema::dropIfExists('certificates');
    }
};
