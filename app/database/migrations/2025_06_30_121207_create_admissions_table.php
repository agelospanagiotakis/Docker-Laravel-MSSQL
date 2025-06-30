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
        Schema::create('admissions', function (Blueprint $table) {
            $table->id('ID');
            $table->string('Code')->nullable();
            $table->foreignId('PatientID')->nullable()->constrained('patients', 'ID');
            $table->dateTime('FromDate')->nullable();
            $table->dateTime('ToDate')->nullable();
            $table->foreignId('DoctorA')->nullable()->constrained('doctors', 'ID');
            $table->foreignId('DoctorB')->nullable()->constrained('doctors', 'ID');
            $table->string('Cause')->nullable();
            $table->integer('RoomID')->nullable();
            $table->string('Bed')->nullable();
            $table->integer('DiagnosisID')->nullable();
            $table->integer('LocalizationID')->nullable();
            $table->boolean('ELeft')->nullable();
            $table->boolean('ERight')->nullable();
            $table->integer('SMarkID')->nullable();
            $table->integer('ResultID')->nullable();
            $table->integer('IllnessID')->nullable();
            $table->boolean('Exited')->nullable();
            $table->boolean('Closed')->nullable();
            $table->boolean('IsEfimeria')->nullable();
            $table->string('Notes')->nullable();
            $table->string('UserInserted')->nullable();
            $table->dateTime('DateInserted')->nullable();
            $table->string('UserUpdated')->nullable();
            $table->dateTime('DateUpdated')->nullable();
            $table->string('FillerString1')->nullable();
            $table->string('FillerString2')->nullable();
            $table->integer('PatientAge')->nullable();
            $table->integer('FillerInt2')->nullable();
            $table->string('FillerDate')->nullable();
            $table->string('sNote1')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admissions');
    }
};
