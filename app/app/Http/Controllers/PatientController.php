<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Admission;
use App\Models\Certificate;
use App\Models\TextsCertificate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PatientController extends Controller
{
    // public function index()
    // {
    //     // Fetch patients or any required data here
    //     return view('patients.index');
    // }

    // public function index(Request $request)
    // {
    //     // Get search query (Code, LastName, or FirstName)
    //     $search = $request->input('search');

    //     // Fetch patients with pagination (10 records per page)
    //     $patients = Patient::when($search, function ($query, $search) {
    //         return $query->where('Code', 'like', "%$search%")
    //                      ->orWhere('LastName', 'like', "%$search%")
    //                      ->orWhere('FirstName', 'like', "%$search%");
    //     })->paginate(10);

    //     // Pass the patient records and search query to the view
    //     return view('patients.index', compact('patients', 'search'));
    // }

public function index(Request $request)
{
    $search = $request->input('search');
    $page = $request->input('page', 1);  // Current page
    $perPage = 10;// Items per page

    $offset = ($page - 1) * $perPage;  // Calculate the offset
     // Count total number of patients (for pagination)
     $total = DB::table('Patient')
     ->when($search, function ($query, $search) {
         return $query->where('Code', 'like', "%$search%")
                      ->orWhere('LastName', 'like', "%$search%")
                      ->orWhere('FirstName', 'like', "%$search%");
     })
     ->count();

 // Calculate total pages
    $totalPages = ceil($total / $perPage);
    // Query to paginate using ROW_NUMBER() for SQL Server 2008
    $patients = DB::table(DB::raw("(SELECT *, ROW_NUMBER() OVER (ORDER BY Code) AS row_num FROM [Patient]) AS temp"))
        ->when($search, function ($query, $search) {
            return $query->where('Code', 'like', "%$search%")
                         ->orWhere('LastName', 'like', "%$search%")
                         ->orWhere('FirstName', 'like', "%$search%");
        })
        ->whereBetween('row_num', [$offset + 1, $offset + $perPage])
        ->get();

   // Pass the current page, total pages, and other data to the view
   return view('patients.index', compact('patients', 'search', 'page','perPage','totalPages', 'total'));
}

  // Method to show patient details
  public function show($id)
  {
    $textsCertificates = [];
    $patient = Patient::findOrFail($id);
    if ($patient){

        $patient = Patient::with([
            'lastAdmission',
            'lastAdmission.doctorA',
            'lastAdmission.doctorB',
            'lastAdmission.diagnosis',
            'lastAdmission.illness',
            'lastAdmission.result',
            'lastAdmission.room',
            'lastAdmission.localization',
            'lastAdmission.sMark'
        ])->findOrFail($id);

        
        // dd($patient);
        $admissions = Admission::where('PatientID', $id)
        ->with([
            'doctorA',
            'doctorB',
            'diagnosis',
            'illness',
            'result',
            'room',
            'localization',
            'sMark',
            'textsAdmission',
            'certificates' => function ($query) {
                $query->with(['doctorA', 'doctorB', 'textsCertificate']);
            },
            'surgeries' => function ($query) {
                $query->with(['doctorOperator', 'doctorAssistant', 'doctorAssistantB', 'doctorAnest']);
            }
        ])
        ->orderBy('FromDate', 'desc')
        ->get();

        // selectedAdmissionId is the most recent admission
        // $selectedAdmissionId = $admissions->first()->ID ?? null;
        $selectedAdmissionId = $patient->LastAdmissionID ?? null;
        $selectedAdmission = null;
        if ($selectedAdmissionId) {
            $selectedAdmission = Admission::with([
                'doctorA',
                'doctorB',
                'diagnosis',
                'illness',
                'result',
                'room',
                'localization',
                'sMark',
                'textsAdmission',
                'certificates',
                'certificates.doctorA',
                'certificates.doctorB',
                'certificates.textsCertificate',
                // 'certificates.textsCertificate',
                'surgeries',
                'surgeries.doctorOperator',
                'surgeries.DoctorAssistant',
                'surgeries.DoctorAssistantB',
                'surgeries.DoctorAnest',
            ])->find($selectedAdmissionId);
            // dd($selectedAdmission);
            //loop here to get the textsCertificate and add them to the new array textsCertificates
        //   dd($selectedAdmission);

            $selectedSurgeryID = null;
            $selectedSurgeryID = null;
            $selectedSurgeryID = null;
            $selectedSurgeryID = null;
            $selectedSurgeryID = null;
            $selectedSurgeryID = null;
            $selectedSurgeryID = null;
            $selectedSurgery = null;
            foreach ($selectedAdmission->surgeries as $mysurgery) {
                $selectedSurgery = $mysurgery;
                $selectedSurgeryID = $mysurgery->ID;
            }
            $selectedCertificateID = null;
            $selectedCertificate = null;
                // dd($selectedAdmission->certificates);

            foreach ($selectedAdmission->certificates as $myCertificate) {
                $selectedCertificateID = $myCertificate->ID;

                // dd($selectedCertificateID);
                $myCertificateLoaded = Certificate::with([
                    'textsCertificate',
                    'doctorA',
                    'doctorB', 
                ])->find($selectedCertificateID);
                // dd($myCertificateLoaded);
                $selectedCertificate = $myCertificateLoaded;
                // dd($myCertificate);//->
                
                    // $t = TextsCertificate::where('CertificateID', $certificate->ID)->get();
                    //do not do the above but a pure sql query
                    // $t = DB::table('TextsCertificate')
                    // ->where('CertificateID', $certificate->ID);
                    // do the following query and get the result: select * from [TextsCertificate] where [CertificateID] = $certificate->ID
                    // $q = "select * from [TextsCertificate] where [CertificateID] = $myCertificate->ID";
                    // $t = DB::select($q);
                    // var_dump("selectedAdmission $selectedAdmission->ID q $q ",$t);
                    
                    // // if ($t){
                    // var_dump($t)
                    // dd($certificate->ID);
                    // }
                    $textsCertificate = Certificate::find($selectedCertificateID)->textsCertificate;
                    // dd($textsCertificate);
                    $textsCertificateId = $textsCertificate ? $textsCertificate->ID : null;
                    $textsCertificates[] = $textsCertificateId;
            }


// die;

        }

    return view('patients.show', [
        'patient' => $patient,
        'admissions' => $admissions,
        'selectedAdmissionId' => $selectedAdmissionId,
        'selectedSurgeryID' => $selectedSurgeryID,
        'selectedSurgery' => $selectedSurgery,
        'selectedCertificateID' => $selectedCertificateID,
        'selectedCertificate' => $selectedCertificate,
        'selectedAdmission' => $selectedAdmission,
            'textsCertificates'=>$textsCertificates
        ]);
    }

  }

  public function getAdmissionDetailsView($admissionid)
{
    $admission = Admission::with([
        'doctorA', 'doctorB', 
        'room',
        'illness',
        'diagnosis',
        'localization',
        'result',
        'sMark',
        'textsAdmission'
        ])
        ->findOrFail($admissionid);
        // dd($admission);
    return view('patients.partials.admission-details', ['admission' => $admission])->render();
}

  public function getAdmissionDetails($admissionid)
  {
      $admission = Admission::find($admissionid);
      if ($admission) {
          return response()->json($admission);
      }

      return response()->json(null, 404);
  }

  public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $validatedData = $request->validate([
            'Address' => 'nullable|string|max:255',
            'FirstPhone' => 'nullable|string|max:20',
            'SecondPhone' => 'nullable|string|max:20',
            'ThirdPhone' => 'nullable|string|max:20',
        ]);

        $patient->Address = $validatedData['Address'];
        $patient->FirstPhone = $validatedData['FirstPhone'];
        $patient->SecondPhone = $validatedData['SecondPhone'];
        $patient->ThirdPhone = $validatedData['ThirdPhone'];

        $patient->save();

        return redirect()->route('patients.show', $patient->ID)->with('success', 'Patient details updated successfully.');
    }

}
