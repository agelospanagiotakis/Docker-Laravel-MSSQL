<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Models\Admission;
use App\Models\Certificate;
use App\Models\Surgery;
use App\Models\TextsAdmission;
use Carbon\Carbon; // Make sure to import Carbon
use App\Enums\TableNames;

class AdmissionController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = 20; // Number of items per page

        $startRow = ($page - 1) * $perPage + 1;
        $endRow = $page * $perPage;

        $endDateStr = $request->input('end_date');
        $startDateStr = $request->input('start_date');

        // Check if the end_date is not provided and set the default value
        if (empty($endDateStr)) {
            $endDateStr = Carbon::now()->format('Y-m-d');
        }

        // Check if the start_date is not provided and set the default value
        if (empty($startDateStr)) {
            $startDateStr = Carbon::now()->subMonths(3)->format('Y-m-d');
        }
        $startDate = \Carbon\Carbon::parse($startDateStr)->format('Y-m-d');
        $endDate = \Carbon\Carbon::parse($endDateStr)->format('Y-m-d');

$eloQuery = DB::table(DB::raw('
    (SELECT 
        Patient.*,
LastAdmission.ID as LastAdmission_ID,
LastAdmission.Code as LastAdmission_Code,
LastAdmission.PatientID as LastAdmission_PatientID,
LastAdmission.FromDate as LastAdmission_FromDate,
LastAdmission.ToDate as LastAdmission_ToDate,
LastAdmission.DoctorA as LastAdmission_DoctorA,
LastAdmission.DoctorB as LastAdmission_DoctorB,
LastAdmission.Cause as LastAdmission_Cause,
LastAdmission.RoomID as LastAdmission_RoomID,
LastAdmission.Bed as LastAdmission_Bed,
LastAdmission.DiagnosisID as LastAdmission_DiagnosisID,
LastAdmission.LocalizationID as LastAdmission_LocalizationID,
LastAdmission.ELeft as LastAdmission_ELeft,
LastAdmission.ERight as LastAdmission_ERight,
LastAdmission.SMarkID as LastAdmission_SMarkID,
LastAdmission.ResultID as LastAdmission_ResultID,
LastAdmission.IllnessID as LastAdmission_IllnessID,
LastAdmission.Exited as LastAdmission_Exited,
LastAdmission.Closed as LastAdmission_Closed,
LastAdmission.IsEfimeria as LastAdmission_IsEfimeria,
LastAdmission.Notes as LastAdmission_Notes,
LastAdmission.UserInserted as LastAdmission_UserInserted,
LastAdmission.DateInserted as LastAdmission_DateInserted,
LastAdmission.UserUpdated as LastAdmission_UserUpdated,
LastAdmission.DateUpdated as LastAdmission_DateUpdated,
LastAdmission.FillerString1 as LastAdmission_FillerString1,
LastAdmission.FillerString2 as LastAdmission_FillerString2,
LastAdmission.PatientAge as LastAdmission_PatientAge,
LastAdmission.FillerInt2 as LastAdmission_FillerInt2,
LastAdmission.FillerDate as LastAdmission_FillerDate,
LastAdmission.sNote1 as LastAdmission_sNote1,

DoctorA.ID as DoctorA_ID,
DoctorA.FirstName as DoctorA_FirstName,
DoctorA.LastName as DoctorA_LastName,
DoctorA.Abbreviation as DoctorA_Abbreviation,
DoctorA.PrintedProfession as DoctorA_PrintedProfession,
DoctorA.SpecializationID as DoctorA_SpecializationID,
DoctorA.Title as DoctorA_Title,
DoctorA.DisplayOrder as DoctorA_DisplayOrder,
DoctorA.Role as DoctorA_Role,
DoctorA.IsActive as DoctorA_IsActive,
DoctorA.UserName as DoctorA_UserName,
DoctorA.UserInserted as DoctorA_UserInserted,
DoctorA.DateInserted as DoctorA_DateInserted,
DoctorA.UserUpdated as DoctorA_UserUpdated,
DoctorA.DateUpdated as DoctorA_DateUpdated,

DoctorB.ID as DoctorB_ID,
DoctorB.FirstName as DoctorB_FirstName,
DoctorB.LastName as DoctorB_LastName,
DoctorB.Abbreviation as DoctorB_Abbreviation,
DoctorB.PrintedProfession as DoctorB_PrintedProfession,
DoctorB.SpecializationID as DoctorB_SpecializationID,
DoctorB.Title as DoctorB_Title,
DoctorB.DisplayOrder as DoctorB_DisplayOrder,
DoctorB.Role as DoctorB_Role,
DoctorB.IsActive as DoctorB_IsActive,
DoctorB.UserName as DoctorB_UserName,
DoctorB.UserInserted as DoctorB_UserInserted,
DoctorB.DateInserted as DoctorB_DateInserted,
DoctorB.UserUpdated as DoctorB_UserUpdated,
DoctorB.DateUpdated as DoctorB_DateUpdated,
DiagnosisLookup.ID as DiagnosisLookup_ID,
DiagnosisLookup.Code as DiagnosisLookup_Code,
DiagnosisLookup.LookupTypeID as DiagnosisLookup_LookupTypeID,
DiagnosisLookup.Value as DiagnosisLookup_Value,
DiagnosisLookup.IsActive as DiagnosisLookup_IsActive,
DiagnosisLookup.Abbreviation as DiagnosisLookup_Abbreviation,
DiagnosisLookup.UserInserted as DiagnosisLookup_UserInserted,
DiagnosisLookup.DateInserted as DiagnosisLookup_DateInserted,
DiagnosisLookup.UserUpdated as DiagnosisLookup_UserUpdated,
DiagnosisLookup.DateUpdated as DiagnosisLookup_DateUpdated,

IllnessLookup.ID as IllnessLookup_ID,
IllnessLookup.Code as IllnessLookup_Code,
IllnessLookup.LookupTypeID as IllnessLookup_LookupTypeID,
IllnessLookup.Value as IllnessLookup_Value,
IllnessLookup.IsActive as IllnessLookup_IsActive,
IllnessLookup.Abbreviation as IllnessLookup_Abbreviation,
IllnessLookup.UserInserted as IllnessLookup_UserInserted,
IllnessLookup.DateInserted as IllnessLookup_DateInserted,
IllnessLookup.UserUpdated as IllnessLookup_UserUpdated,
IllnessLookup.DateUpdated as IllnessLookup_DateUpdated,
    
LastAdmission_Result.ID as ResultLookup_ID,
LastAdmission_Result.Code as ResultLookup_Code,
LastAdmission_Result.LookupTypeID as ResultLookup_LookupTypeID,
LastAdmission_Result.Value as ResultLookup_Value,
LastAdmission_Result.IsActive as ResultLookup_IsActive,
LastAdmission_Result.Abbreviation as ResultLookup_Abbreviation,
LastAdmission_Result.UserInserted as ResultLookup_UserInserted,
LastAdmission_Result.DateInserted as ResultLookup_DateInserted,
LastAdmission_Result.UserUpdated as ResultLookup_UserUpdated,
LastAdmission_Result.DateUpdated as ResultLookup_DateUpdated,
    
NationalityLookup.ID as NationalityLookup_ID,
NationalityLookup.Code as NationalityLookup_Code,
NationalityLookup.LookupTypeID as NationalityLookup_LookupTypeID,
NationalityLookup.Value as NationalityLookup_Value,
NationalityLookup.IsActive as NationalityLookup_IsActive,
NationalityLookup.Abbreviation as NationalityLookup_Abbreviation,
NationalityLookup.UserInserted as NationalityLookup_UserInserted,
NationalityLookup.DateInserted as NationalityLookup_DateInserted,
NationalityLookup.UserUpdated as NationalityLookup_UserUpdated,
NationalityLookup.DateUpdated as NationalityLookup_DateUpdated,

InsuranceLookup.ID as InsuranceLookup_ID,
InsuranceLookup.Code as InsuranceLookup_Code,
InsuranceLookup.LookupTypeID as InsuranceLookup_LookupTypeID,
InsuranceLookup.Value as InsuranceLookup_Value,
InsuranceLookup.IsActive as InsuranceLookup_IsActive,
InsuranceLookup.Abbreviation as InsuranceLookup_Abbreviation,
InsuranceLookup.UserInserted as InsuranceLookup_UserInserted,
InsuranceLookup.DateInserted as InsuranceLookup_DateInserted,
InsuranceLookup.UserUpdated as InsuranceLookup_UserUpdated,
InsuranceLookup.DateUpdated as InsuranceLookup_DateUpdated,

EducationLookup.ID as EducationLookup_ID,
EducationLookup.Code as EducationLookup_Code,
EducationLookup.LookupTypeID as EducationLookup_LookupTypeID,
EducationLookup.Value as EducationLookup_Value,
EducationLookup.IsActive as EducationLookup_IsActive,
EducationLookup.Abbreviation as EducationLookup_Abbreviation,
EducationLookup.UserInserted as EducationLookup_UserInserted,
EducationLookup.DateInserted as EducationLookup_DateInserted,
EducationLookup.UserUpdated as EducationLookup_UserUpdated,
EducationLookup.DateUpdated as EducationLookup_DateUpdated,

ProfessionLookup.ID as ProfessionLookup_ID,
ProfessionLookup.Code as ProfessionLookup_Code,
ProfessionLookup.LookupTypeID as ProfessionLookup_LookupTypeID,
ProfessionLookup.Value as ProfessionLookup_Value,
ProfessionLookup.IsActive as ProfessionLookup_IsActive,
ProfessionLookup.Abbreviation as ProfessionLookup_Abbreviation,
ProfessionLookup.UserInserted as ProfessionLookup_UserInserted,
ProfessionLookup.DateInserted as ProfessionLookup_DateInserted,
ProfessionLookup.UserUpdated as ProfessionLookup_UserUpdated,
ProfessionLookup.DateUpdated as ProfessionLookup_DateUpdated,
    
DoctorBSpecializationLookup.ID as DoctorBSpecializationLookup_ID,
DoctorBSpecializationLookup.Code as DoctorBSpecializationLookup_Code,
DoctorBSpecializationLookup.LookupTypeID as DoctorBSpecializationLookup_LookupTypeID,
DoctorBSpecializationLookup.Value as DoctorBSpecializationLookup_Value,
DoctorBSpecializationLookup.IsActive as DoctorBSpecializationLookup_IsActive,
DoctorBSpecializationLookup.Abbreviation as DoctorBSpecializationLookup_Abbreviation,
DoctorBSpecializationLookup.UserInserted as DoctorBSpecializationLookup_UserInserted,
DoctorBSpecializationLookup.DateInserted as DoctorBSpecializationLookup_DateInserted,
DoctorBSpecializationLookup.UserUpdated as DoctorBSpecializationLookup_UserUpdated,
DoctorBSpecializationLookup.DateUpdated as DoctorBSpecializationLookup_DateUpdated,

    
LARoomLookup.ID as LARoomLookup_ID,
LARoomLookup.Code as LARoomLookup_Code,
LARoomLookup.LookupTypeID as LARoomLookup_LookupTypeID,
LARoomLookup.Value as LARoomLookup_Value,
LARoomLookup.IsActive as LARoomLookup_IsActive,
LARoomLookup.Abbreviation as LARoomLookup_Abbreviation,
LARoomLookup.UserInserted as LARoomLookup_UserInserted,
LARoomLookup.DateInserted as LARoomLookup_DateInserted,
LARoomLookup.UserUpdated as LARoomLookup_UserUpdated,
LARoomLookup.DateUpdated as LARoomLookup_DateUpdated,
    

LocalizationLookup.ID as LocalizationLookup_ID,
LocalizationLookup.Code as LocalizationLookup_Code,
LocalizationLookup.LookupTypeID as LocalizationLookup_LookupTypeID,
LocalizationLookup.Value as LocalizationLookup_Value,
LocalizationLookup.IsActive as LocalizationLookup_IsActive,
LocalizationLookup.Abbreviation as LocalizationLookup_Abbreviation,
LocalizationLookup.UserInserted as LocalizationLookup_UserInserted,
LocalizationLookup.DateInserted as LocalizationLookup_DateInserted,
LocalizationLookup.UserUpdated as LocalizationLookup_UserUpdated,
LocalizationLookup.DateUpdated as LocalizationLookup_DateUpdated,


LastAdmissionSMark.ID as LastAdmissionSMark_ID,
LastAdmissionSMark.Code as LastAdmissionSMark_Code,
LastAdmissionSMark.LookupTypeID as LastAdmissionSMark_LookupTypeID,
LastAdmissionSMark.Value as LastAdmissionSMark_Value,
LastAdmissionSMark.IsActive as LastAdmissionSMark_IsActive,
LastAdmissionSMark.Abbreviation as LastAdmissionSMark_Abbreviation,
LastAdmissionSMark.UserInserted as LastAdmissionSMark_UserInserted,
LastAdmissionSMark.DateInserted as LastAdmissionSMark_DateInserted,
LastAdmissionSMark.UserUpdated as LastAdmissionSMark_UserUpdated,
LastAdmissionSMark.DateUpdated as LastAdmissionSMark_DateUpdated,

LastAdmissionIllness.ID as LastAdmissionIllness_ID,
LastAdmissionIllness.Code as LastAdmissionIllness_Code,
LastAdmissionIllness.LookupTypeID as LastAdmissionIllness_LookupTypeID,
LastAdmissionIllness.Value as LastAdmissionIllness_Value,
LastAdmissionIllness.IsActive as LastAdmissionIllness_IsActive,
LastAdmissionIllness.Abbreviation as LastAdmissionIllness_Abbreviation,
LastAdmissionIllness.UserInserted as LastAdmissionIllness_UserInserted,
LastAdmissionIllness.DateInserted as LastAdmissionIllness_DateInserted,
LastAdmissionIllness.UserUpdated as LastAdmissionIllness_UserUpdated,
LastAdmissionIllness.DateUpdated as LastAdmissionIllness_DateUpdated,
    ROW_NUMBER() OVER (ORDER BY LastAdmission.DateUpdated DESC) AS RowNum
    FROM ' . TableNames::Patients->value . '
    LEFT JOIN ' . TableNames::Admissions->value . ' AS LastAdmission ON LastAdmission.ID = Patient.LastAdmissionID
LEFT JOIN Lookup AS InsuranceLookup ON InsuranceLookup.ID = Patient.InsuranceID
LEFT JOIN Lookup AS ProfessionLookup ON ProfessionLookup.ID = Patient.ProfessionTypeID
LEFT JOIN Lookup AS EducationLookup ON EducationLookup.ID = Patient.EducationLevelID
LEFT JOIN Lookup AS DiagnosisLookup ON DiagnosisLookup.ID = LastAdmission.DiagnosisID
LEFT JOIN Lookup AS IllnessLookup ON IllnessLookup.ID = LastAdmission.IllnessID
LEFT JOIN ' . TableNames::Doctors->value . ' AS DoctorA ON DoctorA.ID = LastAdmission.DoctorA
LEFT JOIN ' . TableNames::Doctors->value . ' AS DoctorB ON DoctorB.ID = LastAdmission.DoctorB
LEFT JOIN Lookup AS NationalityLookup ON NationalityLookup.ID = Patient.NationalityID
LEFT JOIN Lookup AS LastAdmission_Result ON LastAdmission_Result.ID = LastAdmission.ResultID
LEFT JOIN Lookup AS DoctorBSpecializationLookup ON DoctorBSpecializationLookup.ID = DoctorB.SpecializationID
LEFT JOIN Lookup AS LARoomLookup ON LARoomLookup.ID = LastAdmission.RoomID
LEFT JOIN Lookup AS LocalizationLookup ON LocalizationLookup.ID = LastAdmission.LocalizationID
LEFT JOIN Lookup AS LastAdmissionSMark ON LastAdmissionSMark.ID = LastAdmission.SMarkID
LEFT JOIN Lookup AS LastAdmissionIllness ON LastAdmissionIllness.ID = LastAdmission.IllnessID
    ) AS Subquery')
    );

        // dd($queryCount);
        if ($request->filled('start_date')) {
            // $eloQuery->whereBetween('LastAdmission.FromDate', [$request->input('start_date'), $request->input('end_date')]);
            $eloQuery->whereBetween('LastAdmission_FromDate', [$request->input('start_date'), $request->input('end_date')]);
        }

        //  $queryPatients = DB::table(DB::raw($queryAsString))
        // $eloQuery->setBindings([$startDate, $endDate])
        // $eloQuery->whereBetween('row_num', [$startRow, $endRow]);

         // Apply filters
         if ($request->filled('doctor_a')) {
            $eloQuery->where('DoctorA.ID', $request->input('doctor_a'));
        }
        if ($request->filled('doctor_b')) {
            $eloQuery->where('DoctorB.ID', $request->input('doctor_b'));
        }
        if ($request->filled('illness')) {
            $eloQuery->where('LastAdmission.IllnessID', $request->input('illness'));
        }
        if ($request->filled('result')) {
            $eloQuery->where('LastAdmission.ResultID', $request->input('result'));
        }
        if ($request->filled('last_name')) {
            $eloQuery->where('Patient.LastName', 'like', '%' . $request->input('last_name') . '%');
        }
        if ($request->filled('first_name')) {
            $eloQuery->where('Patient.FirstName', 'like', '%' . $request->input('first_name') . '%');
        }
        if ($request->filled('patient_code')) {
            $eloQuery->where('Patient.Code', 'like', '%' . $request->input('patient_code') . '%');
        }
        if ($request->filled('gender')) {
            $eloQuery->where('Patient.Gender', $request->input('gender'));
        }
        if ($request->filled('age_from') && $request->filled('age_to')) {
            $eloQuery->whereBetween('LastAdmission.PatientAge', [$request->input('age_from'), $request->input('age_to')]);
        }

        $offset = ($page - 1) * $perPage;  // Calculate the offset

        //clone eloquery
        $eloQueryClone = clone $eloQuery;
        //execute count on elequeryclone  
        $totalItems = $eloQueryClone->count();
        // $totalItems = 100;
        $patients = $eloQuery->whereBetween('RowNum', [$startRow, $endRow])->get();


        $totalPages = ceil($totalItems / $perPage);
        $illnessesType = DB::table('lookuptype')->where('Code', 'illness')->first();
        $resultsType = DB::table('lookuptype')->where('Code', 'Result')->first();

        $illnessesTypeId = $illnessesType ? $illnessesType->ID : null;
        $resultsTypeId = $resultsType ? $resultsType->ID : null;

        $doctorsA = DB::table(TableNames::Doctors->value)
        ->select(DB::raw("ID, CASE WHEN Title IS NULL THEN Firstname + ' ' + Lastname ELSE Title + ' ' + Firstname + ' ' + Lastname END AS Name"))
        ->where('IsActive', true)
        ->orderBy('DisplayOrder')
        ->get();

        $doctorsB =  $doctorsA ;
        $illnesses = DB::table('lookup')->where('LookupTypeID', $illnessesTypeId)->get();
        $results = DB::table('lookup')->where('LookupTypeID', 'like', $resultsTypeId)->get();

        return view('admissions.index',
        [
        'patients' => $patients,
        'startDate' => $startDateStr,
        'endDate' => $endDateStr,
        'page'=> $page,
        'perPage'=>$perPage ,
        'totalPages'=>$totalPages,
        'total'=>$totalItems,
        'doctorsA' => $doctorsA,
        'doctorsB' => $doctorsB,
        'illnesses' => $illnesses,
        'results' => $results
        ]
    );
    }


    // In AdmissionController.php
public function show($id)
{
    $admission = Admission::with(
        [
        'room', 
        'diagnosis',
        'illness',
        'result',
        'textsAdmission',
        'doctorA',
        'doctorB',
        ]
    )->find($id);

    if ($admission) {
        return response()->json(['details' => $admission->details]); // Adjust this based on the actual data structure
    }

    return response()->json(['error' => 'Admission not found'], 404);
}

    public function details($admissionid)
    {
        $admission = Admission::with(
            [
                'room', 
                'diagnosis',
                'illness',
                'result',
                'textsAdmission',
                'doctorA',
                'doctorB',
            ]
        )->find($admissionid);
        return view('patients.partials.admission-details', ['admission' => $admission])->render();
    }

    public function getDetailsView($admissionid)
    {
        $admission = Admission::with(
            [
            'room', 
            'diagnosis',
            'illness',
            'result',
            'textsAdmission',
            'doctorA',
            'doctorB',
            ]
        )->find($admissionid);

        return view('patients.partials.admission-details', ['admission' => $admission])->render();
    }

    public function getClinicalsView($admissionid)
    {
        $admission = Admission::with(
            [
                'room', 
                'diagnosis',
                'illness',
                'result',
                'textsAdmission',
                'doctorA',
                'doctorB',
            ]
        )->find($admissionid);

        return view('patients.partials.clinicals-details', ['admission' => $admission])->render();
    }

    public function getSurgeriesView($surgeryid)
    {
        $surgery = Surgery::with([
            'doctorOperator',
            'doctorAssistant',
            'doctorAssistantB',
            'doctorAnest',
            'textsSurgery',
            'access',
            'anesthesia',
            'istologika',
            'operation',
            ])->findOrFail($surgeryid);
            // dd($surgery->textsSurgery);
        return view('patients.partials.surgery-details', ['surgery' => $surgery])->render();
    }

    public function getCertificatesView($certificateid)
    {
        $cert = Certificate::with([
            'textsCertificate',
            'doctorA',
            'doctorB',

            ])->findOrFail($certificateid);
            // var_dump($cert);

        return view('patients.partials.certificate-details', ['certificate' => $cert])->render();
    }
    public function surgeriesList($admissionId)
    {
        $admission = Admission::with([
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
        ])->find($admissionId);
        $resp = response()->json($admission->surgeries);;
        // dd($admission->surgeries,$resp);

        return $resp;
    }
    
    public function certificatesList($admissionId)
    {
        $admission = Admission::with([
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
        ])->find($admissionId);
        $resp = response()->json($admission->certificates);;
        return $resp;
    }

    public function update(Request $request, $id)
    {
        $admission = Admission::findOrFail($id);

        $validatedData = $request->validate([
            'Room' => 'nullable|string|max:255',
            'Bed' => 'nullable|string|max:255',
            'Notes' => 'nullable|string',
            'sNote1' => 'nullable|string',
            'DoctorA' => 'nullable|string',
            'DoctorB' => 'nullable|string',
            'IsEfimeria' => 'nullable|boolean',
            'PatientAge' => 'nullable|integer',
            'Code' => 'nullable|string',
            'FromDate' => 'nullable|date',
            'ToDate' => 'nullable|date',
            'Cause' => 'nullable|string',
            'Illness' => 'nullable|string',
            'Diagnosis' => 'nullable|string',
            'Localization' => 'nullable|string',
            'ELeft' => 'nullable|boolean',
            'ERight' => 'nullable|boolean',
            'Result' => 'nullable|string',
            'SMark' => 'nullable|string',
        ]);

        $admission->Bed = $validatedData['Bed'];
        $admission->Notes = $validatedData['Notes'];
        $admission->sNote1 = $validatedData['sNote1'];
        $admission->IsEfimeria = $request->has('IsEfimeria');
        $admission->PatientAge = $validatedData['PatientAge'];
        $admission->Code = $validatedData['Code'];
        $admission->FromDate = $validatedData['FromDate'];
        $admission->ToDate = $validatedData['ToDate'];
        $admission->Cause = $validatedData['Cause'];
        $admission->ELeft = $request->has('ELeft');
        $admission->ERight = $request->has('ERight');

        if (isset($validatedData['Room'])) {
            $room = DB::table('lookup')->where('Value', $validatedData['Room'])->first();
            if ($room) {
                $admission->RoomID = $room->ID;
            }
        }

        if (isset($validatedData['DoctorA'])) {
            $doctorA = DB::table(TableNames::Doctors->value)->where(DB::raw("CONCAT(FirstName, ' ', LastName)"), $validatedData['DoctorA'])->first();
            if ($doctorA) {
                $admission->DoctorA = $doctorA->ID;
            }
        }

        if (isset($validatedData['DoctorB'])) {
            $doctorB = DB::table(TableNames::Doctors->value)->where(DB::raw("CONCAT(FirstName, ' ', LastName)"), $validatedData['DoctorB'])->first();
            if ($doctorB) {
                $admission->DoctorB = $doctorB->ID;
            }
        }

        if (isset($validatedData['Illness'])) {
            $illness = DB::table('lookup')->where('Value', $validatedData['Illness'])->first();
            if ($illness) {
                $admission->IllnessID = $illness->ID;
            }
        }

        if (isset($validatedData['Diagnosis'])) {
            $diagnosis = DB::table('lookup')->where('Value', $validatedData['Diagnosis'])->first();
            if ($diagnosis) {
                $admission->DiagnosisID = $diagnosis->ID;
            }
        }

        if (isset($validatedData['Localization'])) {
            $localization = DB::table('lookup')->where('Value', $validatedData['Localization'])->first();
            if ($localization) {
                $admission->LocalizationID = $localization->ID;
            }
        }

        if (isset($validatedData['Result'])) {
            $result = DB::table('lookup')->where('Value', $validatedData['Result'])->first();
            if ($result) {
                $admission->ResultID = $result->ID;
            }
        }

        if (isset($validatedData['SMark'])) {
            $sMark = DB::table('lookup')->where('Value', $validatedData['SMark'])->first();
            if ($sMark) {
                $admission->SMarkID = $sMark->ID;
            }
        }

        $admission->UserUpdated = auth()->user()->name ?? auth()->user()->UserID;
        $admission->DateUpdated = Carbon::now();
        
        $admission->save();

        return redirect()->back()->with('success', 'Admission details updated successfully.')
            ->with('active_tab_a', $request->input('active_tab_a'))
            ->with('active_tab_b', $request->input('active_tab_b'));
    }

    public function updateTexts(Request $request, $id)
    {
        $validatedData = $request->validate([
            'AdParousa' => 'nullable|string',
            'AdAtomiko' => 'nullable|string',
            'AdNeuron' => 'nullable|string',
            'AdProjections' => 'nullable|string',
            'AdPoreia' => 'nullable|string',
        ]);
    
        $textsAdmission = TextsAdmission::updateOrCreate(
            ['AdmissionID' => $id],
            [
                'AdParousa' => $validatedData['AdParousa'],
                'AdAtomiko' => $validatedData['AdAtomiko'],
                'AdNeuron' => $validatedData['AdNeuron'],
                'AdProjections' => $validatedData['AdProjections'],
                'AdPoreia' => $validatedData['AdPoreia'],
                'UserUpdated' => auth()->user()->name ?? auth()->user()->UserID,
                'DateUpdated' => Carbon::now(),
            ]
        );
    
        return redirect()->back()->with('success', 'Clinical details updated successfully.')
            ->with('active_tab_a', $request->input('active_tab_a'))
            ->with('active_tab_b', $request->input('active_tab_b'));
    }
}
