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
        Schema::create(TableNames::TextsSurgeries->value, function (Blueprint $table) {
            $table->id('ID');
            $table->foreignId('SurgeryID')->nullable()->constrained('surgeries', 'ID');
            $table->text('SuAbout')->nullable();
            $table->text('SuCut')->nullable();
            $table->text('SuBaccess')->nullable();
            $table->text('SuImplants')->nullable();
            $table->string('SuFill01')->nullable();
            $table->string('SuFill02')->nullable();
            $table->string('SuFill03')->nullable();
            $table->string('SuFill04')->nullable();
            $table->string('SuFill05')->nullable();
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
        Schema::dropIfExists(TableNames::TextsSurgeries->value);
    }
};
