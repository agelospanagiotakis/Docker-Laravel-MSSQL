<?php

/**
 * Created by Angelos Panagiotakis.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Lookup
 *
 * @property int|null $ID
 * @property int|null $Code
 * @property int|null $LookupTypeID
 * @property string|null $Value
 * @property bool|null $IsActive
 * @property string|null $Abbreviation
 * @property string|null $UserInserted
 * @property string|null $DateInserted
 * @property string|null $UserUpdated
 * @property string|null $DateUpdated
 *
 * @package App\Models
 */
class Lookup extends Model
{
	protected $table = 'lookup';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID' => 'int',
		'Code' => 'int',
		'LookupTypeID' => 'int',
		'IsActive' => 'bool'
	];

	protected $fillable = [
		'ID',
		'Code',
		'LookupTypeID',
		'Value',
		'IsActive',
		'Abbreviation',
		'UserInserted',
		'DateInserted',
		'UserUpdated',
		'DateUpdated'
	];

	public function admissionsAsDiagnosis()
    {
        return $this->hasMany(Admission::class, 'DiagnosisID');
    }

    public function admissionsAsIllness()
    {
        return $this->hasMany(Admission::class, 'IllnessID');
    }

    public function admissionsAsLocalization()
    {
        return $this->hasMany(Admission::class, 'LocalizationID');
    }

    public function admissionsAsResult()
    {
        return $this->hasMany(Admission::class, 'ResultID');
    }

    public function admissionsAsRoom()
    {
        return $this->hasMany(Admission::class, 'RoomID');
    }

    public function admissionsAsSMark()
    {
        return $this->hasMany(Admission::class, 'SMarkID');
    }

}
