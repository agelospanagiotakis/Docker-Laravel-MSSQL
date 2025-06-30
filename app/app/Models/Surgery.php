<?php

/**
 * Created by Angelos Panagiotakis.
 */

namespace App\Models;

use App\Enums\TableNames;
use Illuminate\Database\Eloquent\Model;
//add use for model Operation
use App\Models\Doctor;
use App\Models\Admission;
use App\Models\Textssurgery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;


/**
 * Class Surgery
 *
 * @property int|null $ID
 * @property int|null $AdmissionID
 * @property string|null $DatePerformed
 * @property int|null $OperationID
 * @property int|null $DoctorOperator
 * @property int|null $DoctorAssistant
 * @property int|null $DoctorAssistantB
 * @property int|null $DoctorAnest
 * @property int|null $AccessID
 * @property int|null $AnesthisiaID
 * @property int|null $IstologikaID
 * @property string|null $AnestName
 * @property string|null $Notes
 * @property string|null $UserInserted
 * @property string|null $DateInserted
 * @property string|null $UserUpdated
 * @property string|null $DateUpdated
 * @property string|null $FillerString
 * @property int|null $FillerInt
 *
 * @package App\Models
 */
class Surgery extends Model
{
    use HasFactory;
	protected $table = TableNames::Surgeries->value;
    protected $primaryKey = 'ID';

	public $incrementing = true;
	public $timestamps = true;

	protected $casts = [
		'ID' => 'integer',
        'AdmissionID' => 'integer',
        'DatePerformed' => 'datetime',
        'OperationID' => 'integer',
        'DoctorOperator' => 'integer',
        'DoctorAssistant' => 'integer',
        'DoctorAssistantB' => 'integer',
        'DoctorAnest' => 'integer',
        'AccessID' => 'integer',
        'AnesthisiaID' => 'integer',
        'IstologikaID' => 'integer',
        'DateInserted' => 'datetime',
        'DateUpdated' => 'datetime',
        'FillerInt' => 'integer'
	];

	protected $fillable = [
		'ID',
		'AdmissionID',
		'DatePerformed',
		'OperationID',
		'DoctorOperator',
		'DoctorAssistant',
		'DoctorAssistantB',
		'DoctorAnest',
		'AccessID',
		'AnesthisiaID',
		'IstologikaID',
		'AnestName',
		'Notes',
		'UserInserted',
		'DateInserted',
		'UserUpdated',
		'DateUpdated',
		'FillerString',
		'FillerInt'
	];

	
    // Relationships
    public function admission(): BelongsTo
    {
        return $this->belongsTo(Admission::class, 'AdmissionID', 'ID');
    }


    public function doctorOperator(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'DoctorOperator', 'ID');
    }

    public function doctorAssistant(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'DoctorAssistant', 'ID');
    }

    public function doctorAssistantB(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'DoctorAssistantB', 'ID');
    }

    public function doctorAnest(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'DoctorAnest', 'ID');
    }

    public function textsSurgery(): HasOne
    {
        return $this->hasOne(Textssurgery::class, 'SurgeryID', 'ID');
    }


    public function access(): BelongsTo
    {
        return $this->belongsTo(Lookup::class, 'AccessID', 'ID');
    }

    public function anesthesia(): BelongsTo
    {
        return $this->belongsTo(Lookup::class, 'AnesthisiaID', 'ID');
    }
    
    public function istologika(): BelongsTo
    {
        return $this->belongsTo(Lookup::class, 'IstologikaID', 'ID');
    }

    public function operation(): BelongsTo
    {
        return $this->belongsTo(Lookup::class, 'OperationID', 'ID');
    }
    
    // Scopes
    public function scopeRecentSurgeries($query, $limit = 10)
    {
        return $query->orderBy('DatePerformed', 'desc')->limit($limit);
    }

    public function scopeByDoctor($query, $doctorId)
    {
        return $query->where('DoctorOperator', $doctorId)
                     ->orWhere('DoctorAssistant', $doctorId)
                     ->orWhere('DoctorAssistantB', $doctorId)
                     ->orWhere('DoctorAnest', $doctorId);
    }

    // Accessors & Mutators
    public function getFullSurgeryDetailsAttribute()
    {
        return "Surgery ID: {$this->ID}, Date: {$this->DatePerformed}, Operation: {$this->operation}, Doctor: {$this->doctorOperator->name}";
    }

    


    // New methods related to TextsSurgery
    public function getSurgeryTextAttribute()
    {
        return $this->textsSurgery ? $this->textsSurgery->SuAbout : null;
    }

    public function getCutDetailsAttribute()
    {
        return $this->textsSurgery ? $this->textsSurgery->SuCut : null;
    }

    public function getAccessDetailsAttribute()
    {
        return $this->textsSurgery ? $this->textsSurgery->SuBaccess : null;
    }

    public function getImplantsDetailsAttribute()
    {
        return $this->textsSurgery ? $this->textsSurgery->SuImplants : null;
    }

    public function updateSurgeryText($textData)
    {
        if ($this->textsSurgery) {
            return $this->textsSurgery->update($textData);
        } else {
            return $this->textsSurgery()->create($textData);
        }
    }
}
