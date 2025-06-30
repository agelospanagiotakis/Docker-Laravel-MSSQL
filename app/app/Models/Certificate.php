<?php

/**
 * Created by Angelos Panagiotakis.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admission;
use App\Models\TextsCertificate;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Certificate
 *
 * @property int|null $ID
 * @property int|null $AdmissionID
 * @property int|null $DoctorA
 * @property int|null $DoctorB
 * @property string|null $FromDate
 * @property string|null $ToDate
 * @property string|null $IssuedDate
 * @property string|null $Notes
 * @property string|null $FillerString
 * @property int|null $FillerInt
 * @property string|null $UserInserted
 * @property string|null $DateInserted
 * @property string|null $UserUpdated
 * @property string|null $DateUpdated
 *
 * @package App\Models
 */
class Certificate extends Model
{
    use HasFactory;
	protected $table = 'certificates';
	protected $primaryKey = 'ID';
	public $incrementing = true;
	public $timestamps = true;

	protected $casts = [
		'ID' => 'int',
		'AdmissionID' => 'int',
		'DoctorA' => 'int',
		'DoctorB' => 'int',
		'FillerInt' => 'int'
	];

	protected $fillable = [
		'ID',
		'AdmissionID',
		'DoctorA',
		'DoctorB',
		'FromDate',
		'ToDate',
		'IssuedDate',
		'Notes',
		'FillerString',
		'FillerInt',
		'UserInserted',
		'DateInserted',
		'UserUpdated',
		'DateUpdated'
	];

	
    protected $dates = ['FromDate', 'ToDate', 'IssuedDate', 'DateInserted', 'DateUpdated'];
	
	public function admission(): BelongsTo
    {
        return $this->belongsTo(Admission::class, 'AdmissionID', 'ID');
    }

    public function doctorA(): BelongsTo
    {
		return $this->belongsTo(Doctor::class, 'DoctorA', 'ID');

    }

    public function doctorB(): BelongsTo
    {
		return $this->belongsTo(Doctor::class, 'DoctorB', 'ID');
    }
	 
	public function textsCertificate(): HasOne
    {
		return $this->HasOne(TextsCertificate::class, 'CertificateID', 'ID');
    }
	 
}
