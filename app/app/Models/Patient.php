<?php

/**
 * Created by Angelos Panagiotakis.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Visit;
use App\Models\Admission;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Patient
 *
 * @property int|null $ID
 * @property string|null $Code
 * @property string|null $LastName
 * @property string|null $FirstName
 * @property int|null $Gender
 * @property int|null $BirthYear
 * @property string|null $FatherName
 * @property int|null $NationalityID
 * @property int|null $InsuranceID
 * @property string|null $Address
 * @property string|null $FirstPhone
 * @property string|null $SecondPhone
 * @property string|null $ThirdPhone
 * @property string|null $AM
 * @property int|null $EducationLevelID
 * @property int|null $ProfessionTypeID
 * @property int|null $LastAdmissionID
 * @property string|null $UserInserted
 * @property string|null $DateInserted
 * @property string|null $UserUpdated
 * @property string|null $DateUpdated
 * @property string|null $Notes
 * @property string|null $FillerString1
 * @property string|null $FillerString2
 * @property string|null $FillerString3
 * @property int|null $FillerInt1
 * @property int|null $FillerInt2
 * @property string|null $FillerDate
 *
 * @package App\Models
 */
class Patient extends Model
{
    use HasFactory;
      // Specify the table name if it's not the plural of the model
    protected $table = 'patients';
    // Specify the primary key if it's not 'id'
    protected $primaryKey = 'ID';
	public $incrementing = true;
	public $timestamps = true;

	protected $casts = [
		'ID' => 'int',
		'Gender' => 'int',
		'BirthYear' => 'int',
		'NationalityID' => 'int',
		'InsuranceID' => 'int',
		'EducationLevelID' => 'int',
		'ProfessionTypeID' => 'int',
		'LastAdmissionID' => 'int',
		'FillerInt1' => 'int',
		'FillerInt2' => 'int'
	];

	protected $fillable = [
		'ID',
		'Code',
		'LastName',
		'FirstName',
		'Gender',
		'BirthYear',
		'FatherName',
		'NationalityID',
		'InsuranceID',
		'Address',
		'FirstPhone',
		'SecondPhone',
		'ThirdPhone',
		'AM',
		'EducationLevelID',
		'ProfessionTypeID',
		'LastAdmissionID',
		'UserInserted',
		'DateInserted',
		'UserUpdated',
		'DateUpdated',
		'Notes',
		'FillerString1',
		'FillerString2',
		'FillerString3',
		'FillerInt1',
		'FillerInt2',
		'FillerDate'
	];


      // Relationship with Admission
      public function lastAdmission()
      {
          return $this->hasOne(Admission::class, 'ID', 'LastAdmissionID');
      }

      // Relationship with Visits
      public function visits()
      {
          return $this->hasMany(Visit::class, 'PatientID', 'ID');
      }

      public function latestVisit()
      {
          return $this->hasOne(Visit::class, 'PatientID', 'ID')->latest();
      }

	  

}
