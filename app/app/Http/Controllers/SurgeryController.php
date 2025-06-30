<?php
namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\Surgery;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Admission;
use App\Models\TextsSurgery;
use Illuminate\Support\Collection;
use Barryvdh\DomPDF\Facade\Pdf;

class SurgeryController extends Controller
{
    public function index()
    {
        // Retrieve last surgeries from the database
        $last_surgeries = Surgery::orderBy('id', 'DESC')->with([
            'admission',
            'operation',
            'doctorOperator',
            'doctorAssistant',
            'doctorAssistantB',
            'doctorAnest',
            'access',
            'anesthesia',
            'istologika',   
        ])->take(50)->get();
        // dd($last_surgeries);
        return view('surgery.index', compact('last_surgeries'));
    }
    public function show($id)
    {
        $surgery = Surgery::find($id);
        $patient = null;
        $doctorOperator = null;
        $doctorAssistant = null;
        $doctorAssistantB = null;
        $doctorAnest = null;
        $director = null;
        
        if (!$surgery->admission) {
            $patient = Patient::find($surgery->admission->patient_id);
        }
        if ($surgery->doctorOperator) {
            $doctorOperator = Doctor::find($surgery->doctorOperator->ID);
        }
        if ($surgery->doctorAssistant) {
            $doctorAssistant = Doctor::find($surgery->doctorAssistant->ID);
        }
        if ($surgery->doctorAssistantB) {
            $doctorAssistantB = Doctor::find($surgery->doctorAssistantB->ID);
        }
        if ($surgery->doctorAnest) {
            $doctorAnest = Doctor::find($surgery->doctorAnest->ID);
        }
        $director = Doctor::where('Role', 0)->first();
        return view('surgery.show', compact('surgery', 'patient', 'doctorOperator', 'doctorAssistant', 'doctorAssistantB', 'doctorAnest', 'director'));
    }   
    public function modalContent($id)
    {
        $surgery = Surgery::findOrFail($id);
        $patient = null;
        $doctorOperator = null;
        $doctorAssistant = null;
        $doctorAssistantB = null;
        $doctorAnest = null;
        $director = null;

        if (!$surgery->admission) {
            $patient = Patient::find($surgery->admission->patient_id);
        }
        if ($surgery->doctorOperator) {
            $doctorOperator = Doctor::find($surgery->doctorOperator->ID);
        }
        if ($surgery->doctorAssistant) {
            $doctorAssistant = Doctor::find($surgery->doctorAssistant->ID);
        }
        if ($surgery->doctorAssistantB) {
            $doctorAssistantB = Doctor::find($surgery->doctorAssistantB->ID);
        }
        if ($surgery->doctorAnest) {
            $doctorAnest = Doctor::find($surgery->doctorAnest->ID);
        }
        $director = Doctor::where('Role', 0)->first();
        return view('surgery.modal-content', compact('surgery', 'patient', 'doctorOperator', 'doctorAssistant', 'doctorAssistantB', 'doctorAnest', 'director'));

    }
    public function printPdf($surgeryid)
    {
        $surgery = Surgery::find($surgeryid);
        $patient = null;
        $doctorOperator = null;
        $doctorAssistant = null;
        $doctorAssistantB = null;
        $doctorAnest = null;
        $director = null;

        if (!$surgery->admission) {
            $patient = Patient::find($surgery->admission->patient_id);
        }
        if ($surgery->doctorOperator) {
            $doctorOperator = Doctor::find($surgery->doctorOperator->ID);
        }
        if ($surgery->doctorAssistant) {
            $doctorAssistant = Doctor::find($surgery->doctorAssistant->ID);
        }
        if ($surgery->doctorAssistantB) {
            $doctorAssistantB = Doctor::find($surgery->doctorAssistantB->ID);
        }
        if ($surgery->doctorAnest) {
            $doctorAnest = Doctor::find($surgery->doctorAnest->ID);
        }


        $pdf = Pdf::loadView('surgery.show', compact('surgery','patient','doctorOperator','doctorAssistant','doctorAssistantB','doctorAnest','director'));
        return $pdf->download('surgery-details-{$surgeryid}.pdf');
    
    }

    public function update(Request $request, $id)
    {
        $surgery = Surgery::findOrFail($id);

        $validatedData = $request->validate([
            'DoctorOperator' => 'nullable|string',
            'DoctorAssistant' => 'nullable|string',
            'Notes' => 'nullable|string',
            'DoctorAssistantB' => 'nullable|string',
            'DoctorAnest' => 'nullable|string',
            'DatePerformed' => 'nullable|date',
            'Anesthesia' => 'nullable|string',
            'Access' => 'nullable|string',
            'Operation' => 'nullable|string',
            'Istologika' => 'nullable|string',
            'SuBaccess' => 'nullable|string',
            'SuCut' => 'nullable|string',
            'SuImplants' => 'nullable|string',
            'SuAbout' => 'nullable|string',
        ]);

        $surgery->DatePerformed = $validatedData['DatePerformed'];
        $surgery->Notes = $validatedData['Notes'];

        if (isset($validatedData['DoctorOperator'])) {
            $doctorOperator = Doctor::where(DB::raw("CONCAT(FirstName, ' ', LastName)"), $validatedData['DoctorOperator'])->first();
            if ($doctorOperator) {
                $surgery->DoctorOperatorID = $doctorOperator->ID;
            }
        }

        if (isset($validatedData['DoctorAssistant'])) {
            $doctorAssistant = Doctor::where(DB::raw("CONCAT(FirstName, ' ', LastName)"), $validatedData['DoctorAssistant'])->first();
            if ($doctorAssistant) {
                $surgery->DoctorAssistantID = $doctorAssistant->ID;
            }
        }

        if (isset($validatedData['DoctorAssistantB'])) {
            $doctorAssistantB = Doctor::where(DB::raw("CONCAT(FirstName, ' ', LastName)"), $validatedData['DoctorAssistantB'])->first();
            if ($doctorAssistantB) {
                $surgery->DoctorAssistantBID = $doctorAssistantB->ID;
            }
        }

        if (isset($validatedData['DoctorAnest'])) {
            $doctorAnest = Doctor::where(DB::raw("CONCAT(FirstName, ' ', LastName)"), $validatedData['DoctorAnest'])->first();
            if ($doctorAnest) {
                $surgery->DoctorAnestID = $doctorAnest->ID;
            }
        }

        if (isset($validatedData['Anesthesia'])) {
            $anesthesia = DB::table('Lookup')->where('Value', $validatedData['Anesthesia'])->first();
            if ($anesthesia) {
                $surgery->AnesthesiaID = $anesthesia->ID;
            }
        }

        if (isset($validatedData['Access'])) {
            $access = DB::table('Lookup')->where('Value', $validatedData['Access'])->first();
            if ($access) {
                $surgery->AccessID = $access->ID;
            }
        }

        if (isset($validatedData['Operation'])) {
            $operation = DB::table('Lookup')->where('Value', $validatedData['Operation'])->first();
            if ($operation) {
                $surgery->OperationID = $operation->ID;
            }
        }

        if (isset($validatedData['Istologika'])) {
            $istologika = DB::table('Lookup')->where('Value', $validatedData['Istologika'])->first();
            if ($istologika) {
                $surgery->IstologikaID = $istologika->ID;
            }
        }

        $surgery->save();

        if ($surgery->textsSurgery) {
            $textsSurgery = $surgery->textsSurgery;
            $textsSurgery->SuBaccess = $validatedData['SuBaccess'];
            $textsSurgery->SuCut = $validatedData['SuCut'];
            $textsSurgery->SuImplants = $validatedData['SuImplants'];
            $textsSurgery->SuAbout = $validatedData['SuAbout'];
            $textsSurgery->save();
        }

        return redirect()->back()->with('success', 'Surgery details updated successfully.');
    }
}
