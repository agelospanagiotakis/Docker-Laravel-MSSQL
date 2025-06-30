<?php

/**
 * Created by Angelos Panagiotakis.
 */

namespace App\Models;

use App\Enums\TableNames;
use Illuminate\Database\Eloquent\Model;
use App\Models\Visit;
use App\Models\Lookup;
use App\Models\vDoctor;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Surgery;
use App\Models\Certificate;
use App\Models\TextsSurgery;
use App\Models\TextsCertificate;
use App\Models\TextsClinicals;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;


/**
 * Class Admission
 *
 * @property int|null $ID
 * @property string|null $Code
 * @property int|null $PatientID
 * @property string|null $FromDate
 * @property string|null $ToDate
 * @property int|null $DoctorA
 * @property int|null $DoctorB
 * @property string|null $Cause
 * @property int|null $RoomID
 * @property string|null $Bed
 * @property int|null $DiagnosisID
 * @property int|null $LocalizationID
 * @property bool|null $ELeft
 * @property bool|null $ERight
 * @property int|null $SMarkID
 * @property int|null $ResultID
 * @property int|null $IllnessID
 * @property bool|null $Exited
 * @property bool|null $Closed
 * @property bool|null $IsEfimeria
 * @property string|null $Notes
 * @property string|null $UserInserted
 * @property string|null $DateInserted
 * @property string|null $UserUpdated
 * @property string|null $DateUpdated
 * @property string|null $FillerString1
 * @property string|null $FillerString2
 * @property int|null $PatientAge
 * @property int|null $FillerInt2
 * @property string|null $FillerDate
 * @property string|null $sNote1
 *
 * @package App\Models
 */
class Admission extends Model
{
    use HasFactory;
	protected $table = TableNames::Admissions->value;
	protected $primaryKey = 'ID';
	public $incrementing = true;
	public $timestamps = false;
	protected $dates = [
        'FromDate',
        'ToDate',
        'DateInserted',
        'DateUpdated'
    ];
	protected $casts = [
		'ID' => 'int',
		'PatientID' => 'int',
		'DoctorA' => 'int',
		'DoctorB' => 'int',
		'RoomID' => 'int',
		'DiagnosisID' => 'int',
		'LocalizationID' => 'int',
		'ELeft' => 'bool',
		'ERight' => 'bool',
		'SMarkID' => 'int',
		'ResultID' => 'int',
		'IllnessID' => 'int',
		'Exited' => 'bool',
		'Closed' => 'bool',
		'IsEfimeria' => 'bool',
		'PatientAge' => 'int',
		'FillerInt2' => 'int',
		'FromDate' => 'datetime:Y-m-d',
        'ToDate' => 'datetime:Y-m-d',
        'DateInserted' => 'datetime:Y-m-d H:i:s',
        'DateUpdated' => 'datetime:Y-m-d H:i:s',
	];
	protected $fillable = [
		'ID',
		'Code',
		'PatientID',
		'FromDate',
		'ToDate',
		'DoctorA',
		'DoctorB',
		'Cause',
		'RoomID',
		'Bed',
		'DiagnosisID',
		'LocalizationID',
		'ELeft',
		'ERight',
		'SMarkID',
		'ResultID',
		'IllnessID',
		'Exited',
		'Closed',
		'IsEfimeria',
		'Notes',
		'UserInserted',
		'DateInserted',
		'UserUpdated',
		'DateUpdated',
		'FillerString1',
		'FillerString2',
		'PatientAge',
		'FillerInt2',
		'FillerDate',
		'sNote1'
	];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'PatientID');
    }

    public function doctorA()
    {
		return $this->belongsTo(Doctor::class, 'DoctorA', 'ID');

    }

    public function doctorB()
    {
		return $this->belongsTo(Doctor::class, 'DoctorB', 'ID');
    }

    // Lookup Relationships
    public function diagnosis()
    {
        return $this->belongsTo(Lookup::class, 'DiagnosisID','ID');
    }

    public function illness()
    {
        return $this->belongsTo(Lookup::class, 'IllnessID','ID');
    }

    public function localization()
    {
        return $this->belongsTo(Lookup::class, 'LocalizationID','ID');
    }

    public function result()
    {
        return $this->belongsTo(Lookup::class, 'ResultID','ID');
    }

    public function room()
    {
		return $this->belongsTo(Lookup::class, 'RoomID','ID');
    }

    public function smark()
    {
        return $this->belongsTo(Lookup::class, 'SMarkID','ID');
    }

    public function admissions()
    {
        return $this->hasMany(Admission::class, 'PatientID');
    }
	public function textsAdmission()
    {
        return $this->hasOne(TextsAdmission::class, 'AdmissionID', 'ID');
    }

	public function certificates()
    {
        return $this->hasMany(Certificate::class, 'AdmissionID', 'ID');
    }


	
    public function surgeries(): HasMany
    {
		return $this->hasMany(Surgery::class, 'AdmissionID', 'ID');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('Closed', false);
    }

    public function scopeByDoctor($query, $doctorId)
    {
        return $query->where('DoctorA', $doctorId)->orWhere('DoctorB', $doctorId);
    }

    // Accessors & Mutators
    public function getAdmissionDurationAttribute()
    {
        return $this->FromDate->diffInDays($this->ToDate);
    }

    public function getHasSurgeriesAttribute()
    {
        return $this->surgeries()->exists();
    }

    // Custom methods
    public function getSurgeryDetails()
    {
        return $this->surgeries()->with([
            'doctorOperator',
            'doctorAssistant',
            'doctorAssistantB',
            'doctorAnest',
            'textsSurgery'
            ])->get()->map(function ($surgery) {
            return [
                'date' => $surgery->DatePerformed,
                'operation' => $surgery->operation->name,
                'doctor' => $surgery->doctorOperator->name,
            ];
        });
    }

    public function getTotalSurgeriesCount()
    {
        return $this->surgeries()->count();
    }

    public function getLatestSurgery()
    {
        return $this->surgeries()->latest('DatePerformed')->first();
    }
    // public function getDiagnosisAttribute()
    // {
    //     if ($this->DiagnosisID) {
    //         // dd($this->ID);
    //         $admission = Admission::with('diagnosis')->find( $this->ID);
    //         // $diagnosisValue = $this;
    //         if ($admission != null){
    //             // dd($this);
    //             // dd($admission->diagnosis->Value);
    //             // die;
    //             // Assuming 'Value' is the column name
    //             return $admission->diagnosis->Value;
    //         }
    //     } else {
    //         return substr($this->latestVisit->Diagnosis ?? '', 0, 64);
    //     }
    // }
}
