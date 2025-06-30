<?php

/**
 * Created by Angelos Panagiotakis.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NxEktosF1Work
 *
 * @property string|null $PRDATES
 * @property string|null $PRGID
 * @property string|null $PRSID
 * @property string|null $F4
 * @property string|null $PATIENTNAME
 * @property string|null $PATIENTID
 * @property string|null $HIS
 * @property string|null $AGE
 * @property string|null $NOSOS
 * @property string|null $SURGERY1
 * @property int|null $DOCTOR_ID
 * @property int|null $PATIENT_ID
 * @property int|null $id
 *
 * @package App\Models
 */
class NxEktosF1Work extends Model
{
	protected $table = 'nx_ektos_f1_work';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'DOCTOR_ID' => 'int',
		'PATIENT_ID' => 'int',
		'id' => 'int'
	];

	protected $fillable = [
		'PRDATES',
		'PRGID',
		'PRSID',
		'F4',
		'PATIENTNAME',
		'PATIENTID',
		'HIS',
		'AGE',
		'NOSOS',
		'SURGERY1',
		'DOCTOR_ID',
		'PATIENT_ID',
		'id'
	];
}
