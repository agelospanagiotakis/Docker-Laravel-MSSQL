<?php

namespace Tests\Feature;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PatientFormsTest extends TestCase
{
    use RefreshDatabase;

    public function test_patient_page_is_accessible(): void
    {
        $user = User::factory()->create();
        $patient = Patient::factory()->create();
        $admission = \App\Models\Admission::factory()->create(['PatientID' => $patient->ID]);
        \App\Models\TextsAdmission::factory()->create(['AdmissionID' => $admission->ID]);
        \App\Models\Certificate::factory()->create(['AdmissionID' => $admission->ID]);
        \App\Models\Surgery::factory()->create(['AdmissionID' => $admission->ID]);

        $response = $this->actingAs($user)->get('/patients/' . $patient->ID);

        $response->assertStatus(200);
    }
}
