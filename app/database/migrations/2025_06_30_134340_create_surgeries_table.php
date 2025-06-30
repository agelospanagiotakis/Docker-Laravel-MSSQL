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
        Schema::create('surgeries', function (Blueprint $table) {
            $table->id('ID');
            $table->foreignId('AdmissionID')->nullable()->constrained('admissions', 'ID');
            $table->dateTime('DatePerformed')->nullable();
            $table->integer('OperationID')->nullable();
            $table->foreignId('DoctorOperator')->nullable()->constrained('doctors', 'ID');
            $table->foreignId('DoctorAssistant')->nullable()->constrained('doctors', 'ID');
            $table->foreignId('DoctorAssistantB')->nullable()->constrained('doctors', 'ID');
            $table->foreignId('DoctorAnest')->nullable()->constrained('doctors', 'ID');
            $table->integer('AccessID')->nullable();
            $table->integer('AnesthisiaID')->nullable();
            $table->integer('IstologikaID')->nullable();
            $table->string('AnestName')->nullable();
            $table->string('Notes')->nullable();
            $table->string('UserInserted')->nullable();
            $table->dateTime('DateInserted')->nullable();
            $table->string('UserUpdated')->nullable();
            $table->dateTime('DateUpdated')->nullable();
            $table->string('FillerString')->nullable();
            $table->integer('FillerInt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surgeries');
    }
};
