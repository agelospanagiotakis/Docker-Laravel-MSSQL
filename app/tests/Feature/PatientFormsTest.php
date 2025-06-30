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
        $patient->LastAdmissionID = $admission->ID;
        $patient->save();
        $patient->load('lastAdmission');
        \App\Models\TextsAdmission::factory()->create(['AdmissionID' => $admission->ID]);
        \App\Models\Certificate::factory()->create(['AdmissionID' => $admission->ID]);
        \App\Models\Surgery::factory()->create(['AdmissionID' => $admission->ID]);

        $response = $this->actingAs($user)->get('/patients/' . $patient->ID);

        $response->assertStatus(200);
    }

    public function test_certificate_form_can_be_updated()
    {
        $user = User::factory()->create();
        $patient = Patient::factory()->create();
        $admission = \App\Models\Admission::factory()->create(['PatientID' => $patient->ID]);
        $patient->LastAdmissionID = $admission->ID;
        $patient->save();
        $certificate = \App\Models\Certificate::factory()->create(['AdmissionID' => $admission->ID]);
        \App\Models\TextsCertificate::factory()->create(['CertificateID' => $certificate->ID]);

        $newData = [
            'Notes' => 'New Notes',
            'FromDate' => now()->toDateTimeString(),
            'ToDate' => now()->addDays(1)->toDateTimeString(),
            'IssuedDate' => now()->toDateTimeString(),
            'CeParousa' => 'New CeParousa',
            'CeAtomiko' => 'New CeAtomiko',
            'CeNeuron' => 'New CeNeuron',
            'ceProjections' => 'New ceProjections',
            'cePoreia' => 'New cePoreia',
            'ceDrugs' => 'New ceDrugs',
            'CeDirections' => 'New CeDirections',
            'CeSickLeave' => 'New CeSickLeave',
        ];

        $response = $this->actingAs($user)->patch('/certificates/' . $certificate->ID, $newData);

        $response->assertStatus(302);
        $this->assertDatabaseHas('certificates', [
            'Notes' => 'New Notes',
            'FromDate' => $newData['FromDate'],
            'ToDate' => $newData['ToDate'],
            'IssuedDate' => $newData['IssuedDate'],
        ]);
        $this->assertDatabaseHas('texts_certificates', [
            'CeParousa' => 'New CeParousa',
            'CeAtomiko' => 'New CeAtomiko',
            'CeNeuron' => 'New CeNeuron',
            'ceProjections' => 'New ceProjections',
            'cePoreia' => 'New cePoreia',
            'ceDrugs' => 'New ceDrugs',
            'CeDirections' => 'New CeDirections',
            'CeSickLeave' => 'New CeSickLeave',
        ]);
    }

    public function test_surgery_form_can_be_updated()
    {
        $user = User::factory()->create();
        $patient = Patient::factory()->create();
        $admission = \App\Models\Admission::factory()->create(['PatientID' => $patient->ID]);
        $patient->LastAdmissionID = $admission->ID;
        $patient->save();
        $surgery = \App\Models\Surgery::factory()->create(['AdmissionID' => $admission->ID]);
        \App\Models\Textssurgery::factory()->create(['SurgeryID' => $surgery->ID]);

        $newData = [
            'Notes' => 'New Notes',
            'DatePerformed' => now()->toDateTimeString(),
            'SuBaccess' => 'New SuBaccess',
            'SuCut' => 'New SuCut',
            'SuImplants' => 'New SuImplants',
            'SuAbout' => 'New SuAbout',
        ];

        $response = $this->actingAs($user)->patch('/surgeries/' . $surgery->ID, $newData);

        $response->assertStatus(302);
        $this->assertDatabaseHas('surgeries', [
            'Notes' => 'New Notes',
            'DatePerformed' => $newData['DatePerformed'],
        ]);
        $this->assertDatabaseHas('texts_surgeries', [
            'SuBaccess' => 'New SuBaccess',
            'SuCut' => 'New SuCut',
            'SuImplants' => 'New SuImplants',
            'SuAbout' => 'New SuAbout',
        ]);
    }

}
