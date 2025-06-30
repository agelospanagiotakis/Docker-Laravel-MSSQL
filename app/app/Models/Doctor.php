<?php

/**
 * Created by Angelos Panagiotakis.
 */

namespace App\Models;

use App\Enums\TableNames;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Doctor
 *
 * @property int|null $ID
 * @property string|null $FirstName
 * @property string|null $LastName
 * @property string|null $Abbreviation
 * @property string|null $PrintedProfession
 * @property int|null $SpecializationID
 * @property string|null $Title
 * @property int|null $DisplayOrder
 * @property int|null $Role
 * @property bool|null $IsActive
 * @property string|null $UserName
 * @property string|null $UserInserted
 * @property string|null $DateInserted
 * @property string|null $UserUpdated
 * @property string|null $DateUpdated
 *
 * @package App\Models
 */
class Doctor extends Model
{
    use HasFactory;
	protected $table = TableNames::Doctors->value;
	public $incrementing = true;
	public $timestamps = true;

	protected $casts = [
		'ID' => 'int',
		'SpecializationID' => 'int',
		'DisplayOrder' => 'int',
		'Role' => 'int',
		'IsActive' => 'bool'
	];

	protected $fillable = [
		'ID',
		'FirstName',
		'LastName',
		'Abbreviation',
		'PrintedProfession',
		'SpecializationID',
		'Title',
		'DisplayOrder',
		'Role',
		'IsActive',
		'UserName',
		'UserInserted',
		'DateInserted',
		'UserUpdated',
		'DateUpdated'
	];


	public function admissionsAsPrimaryDoctor()
    {
        return $this->hasMany(Admission::class, 'DoctorA');
    }

    public function admissionsAsSecondaryDoctor()
    {
        return $this->hasMany(Admission::class, 'DoctorB');
    }

    public function specialization()
    {
        return $this->belongsTo(Lookup::class, 'SpecializationID');
    }
}
