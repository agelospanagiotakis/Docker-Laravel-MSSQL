<?php

use App\Enums\TableNames;
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
        Schema::create(TableNames::Patients->value, function (Blueprint $table) {
            $table->id('ID');
            $table->string('Code')->nullable();
            $table->string('LastName')->nullable();
            $table->string('FirstName')->nullable();
            $table->integer('Gender')->nullable();
            $table->integer('BirthYear')->nullable();
            $table->string('FatherName')->nullable();
            $table->integer('NationalityID')->nullable();
            $table->integer('InsuranceID')->nullable();
            $table->string('Address')->nullable();
            $table->string('FirstPhone')->nullable();
            $table->string('SecondPhone')->nullable();
            $table->string('ThirdPhone')->nullable();
            $table->string('AM')->nullable();
            $table->integer('EducationLevelID')->nullable();
            $table->integer('ProfessionTypeID')->nullable();
            $table->integer('LastAdmissionID')->nullable();
            $table->string('UserInserted')->nullable();
            $table->string('DateInserted')->nullable();
            $table->string('UserUpdated')->nullable();
            $table->string('DateUpdated')->nullable();
            $table->string('Notes')->nullable();
            $table->string('FillerString1')->nullable();
            $table->string('FillerString2')->nullable();
            $table->string('FillerString3')->nullable();
            $table->integer('FillerInt1')->nullable();
            $table->integer('FillerInt2')->nullable();
            $table->string('FillerDate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableNames::Patients->value);
    }
};
