<?php

namespace App\Enums;

enum TableNames: string
{
    case Users = 'User';
    case Patients = 'Patient';
    case Admissions = 'Admission';
    case Doctors = 'Doctor';
    case Certificates = 'Certificate';
    case Surgeries = 'Surgery';
    case TextsAdmissions = 'TextsAdmission';
    case TextsCertificates = 'TextsCertificate';
    case TextsSurgeries = 'TextsSurgery';
    case Lookups = 'Lookup';
    case LookupTypes = 'LookupType';
    case Roles = 'Role';
    case UsersInRole = 'UsersInRole';
}
