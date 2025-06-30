<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\TextsCertificate;
use Illuminate\Support\Facades\DB;

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
            'ceProjections' => 'nullable|string',
            'cePoreia' => 'nullable|string',
            'ceDrugs' => 'nullable|string',
            'CeDirections' => 'nullable|string',
            'CeSickLeave' => 'nullable|string',
        ]);

        $certificate->FromDate = $validatedData['FromDate'];
        $certificate->ToDate = $validatedData['ToDate'];
        $certificate->Notes = $validatedData['Notes'];
        $certificate->IssuedDate = $validatedData['IssuedDate'];

        if (isset($validatedData['DoctorA'])) {
            $doctorA = DB::table('doctor')->where(DB::raw("CONCAT(FirstName, ' ', LastName)"), $validatedData['DoctorA'])->first();
            if ($doctorA) {
                $certificate->DoctorA = $doctorA->ID;
            }
        }

        if (isset($validatedData['DoctorB'])) {
            $doctorB = DB::table('doctor')->where(DB::raw("CONCAT(FirstName, ' ', LastName)"), $validatedData['DoctorB'])->first();
            if ($doctorB) {
                $certificate->DoctorB = $doctorB->ID;
            }
        }

        $certificate->save();

        if ($certificate->textsCertificate) {
            $textsCertificate = $certificate->textsCertificate;
            $textsCertificate->CeParousa = $validatedData['CeParousa'];
            $textsCertificate->CeAtomiko = $validatedData['CeAtomiko'];
            $textsCertificate->CeNeuron = $validatedData['CeNeuron'];
            $textsCertificate->ceProjections = $validatedData['ceProjections'];
            $textsCertificate->cePoreia = $validatedData['cePoreia'];
            $textsCertificate->ceDrugs = $validatedData['ceDrugs'];
            $textsCertificate->CeDirections = $validatedData['CeDirections'];
            $textsCertificate->CeSickLeave = $validatedData['CeSickLeave'];
            $textsCertificate->save();
        }

        return redirect()->back()->with('success', 'Certificate details updated successfully.');
    }
}
