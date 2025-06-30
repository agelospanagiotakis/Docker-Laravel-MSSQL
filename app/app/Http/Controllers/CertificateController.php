<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\TextsCertificate;
use Illuminate\Support\Facades\DB;
use App\Enums\TableNames;

class CertificateController extends Controller
{
    public function update(Request $request, $id)
    {
        $certificate = Certificate::findOrFail($id);

        $validatedData = $request->validate([
            'DoctorA' => 'nullable|string',
            'DoctorB' => 'nullable|string',
            'FromDate' => 'nullable|date',
            'ToDate' => 'nullable|date',
            'IssuedDate' => 'nullable|date',
            'Notes' => 'nullable|string',
            'CeParousa' => 'nullable|string',
            'CeAtomiko' => 'nullable|string',
            'CeNeuron' => 'nullable|string',
            'CeProjections' => 'nullable|string',
            'CePoreia' => 'nullable|string',
            'CeDrugs' => 'nullable|string',
            'CeDirections' => 'nullable|string',
            'CeSickLeave' => 'nullable|string',
        ]);

        $fieldsToUpdate = ['FromDate', 'ToDate', 'Notes', 'IssuedDate'];
        foreach ($fieldsToUpdate as $field) {
            if (array_key_exists($field, $validatedData)) {
                $certificate->$field = $validatedData[$field];
            }
        }

        if (isset($validatedData['DoctorA'])) {
            $doctorA = DB::table(TableNames::Doctors->value)->where(DB::raw("CONCAT(FirstName, ' ', LastName)"), $validatedData['DoctorA'])->first();
            if ($doctorA) {
                $certificate->DoctorA = $doctorA->ID;
            }
        }

        if (isset($validatedData['DoctorB'])) {
            $doctorB = DB::table(TableNames::Doctors->value)->where(DB::raw("CONCAT(FirstName, ' ', LastName)"), $validatedData['DoctorB'])->first();
            if ($doctorB) {
                $certificate->DoctorB = $doctorB->ID;
            }
        }

        $certificate->save();

        if ($certificate->textsCertificate) {
            $textsCertificate = $certificate->textsCertificate;
            $textFields = [
                'CeParousa', 'CeAtomiko', 'CeNeuron', 'CeProjections', 'CePoreia',
                'CeDrugs', 'CeDirections', 'CeSickLeave'
            ];
            foreach ($textFields as $field) {
                if (array_key_exists($field, $validatedData)) {
                    $textsCertificate->$field = $validatedData[$field];
                }
            }
            $textsCertificate->save();
        } else {
            $textsCertificate = new TextsCertificate();
            $textsCertificate->CertificateID = $certificate->ID;
            foreach ($textFields as $field) {
                if (array_key_exists($field, $validatedData)) {
                    $textsCertificate->$field = $validatedData[$field];
                }
            }
            $textsCertificate->save();
        }

        return redirect()->back()->with('success', 'Certificate details updated successfully.');
    }
}
