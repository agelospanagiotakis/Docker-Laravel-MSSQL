<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Admission;
use App\Models\Surgery;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // for inpatients write a query to get the number of patients who are admitted to the hospital to do that todate in admissions should be epty
        // use the lastAdmission of the patient to get the number of patients who are admitted to the hospital
        $inpatients = Patient::whereHas('lastAdmission', function ($query) {
            $query->whereNotNull('FromDate')->whereNull('ToDate')->where('Closed', 0);
            // $query->where('Closed', 0);
        })->count();
        

        $admissions = Admission::count();
        $surgeries = Surgery::count();
        $patients = Patient::count();
        
        return view('dashboard.index', compact('inpatients', 'admissions', 'surgeries', 'patients'));
    }
}