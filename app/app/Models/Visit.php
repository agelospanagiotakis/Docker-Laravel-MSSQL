<?php

/**
 * Created by Angelos Panagiotakis.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Visit
 *
 * @property int|null $ID
 * @property int|null $PatientID
 * @property string|null $FromDate
 * @property int|null $DoctorA
 * @property int|null $IllnessID
 * @property bool|null $AdmProposed
 * @property string|null $Notes
 * @property string|null $UserInserted
 * @property string|null $DateInserted
 * @property string|null $UserUpdated
 * @property string|null $DateUpdated
 * @property int|null $PatientAge
 * @property string|null $WaitDate
 * @property string|null $ProgramDate
 * @property string|null $Referrer
 * @property string|null $Diagnosis
 *
 * @package App\Models
 */
class Visit extends Model
{
    protected $table = 'Visit';

	public $incrementing = false;
    public $timestamps = false;

	protected $casts = [
		'ID' => 'int',
		'PatientID' => 'int',
		'DoctorA' => 'int',
		'IllnessID' => 'int',
		'AdmProposed' => 'bool',
		'PatientAge' => 'int'
	];

	protected $fillable = [
		'ID',
		'PatientID',
		'FromDate',
		'DoctorA',
		'IllnessID',
		'AdmProposed',
		'Notes',
		'UserInserted',
		'DateInserted',
		'UserUpdated',
		'DateUpdated',
		'PatientAge',
		'WaitDate',
		'ProgramDate',
		'Referrer',
		'Diagnosis'
	];
}
