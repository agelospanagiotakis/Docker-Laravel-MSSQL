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
        Schema::create('texts_certificates', function (Blueprint $table) {
            $table->id('ID');
            $table->foreignId('CertificateID')->nullable()->constrained('certificates', 'ID');
            $table->text('CeParousa')->nullable();
            $table->text('CePoreia')->nullable();
            $table->text('CeNeuron')->nullable();
            $table->text('CeAtomiko')->nullable();
            $table->text('CeProjections')->nullable();
            $table->text('CeDrugs')->nullable();
            $table->text('CeDirections')->nullable();
            $table->text('CeSickLeave')->nullable();
            $table->text('CeSuAbout')->nullable();
            $table->string('CeFill02')->nullable();
            $table->string('CeFill03')->nullable();
            $table->string('CeFill04')->nullable();
            $table->string('CeFill05')->nullable();
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
        Schema::dropIfExists('texts_certificates');
    }
};
