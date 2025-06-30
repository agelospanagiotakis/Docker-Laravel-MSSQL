<?php

/**
 * Created by Angelos Panagiotakis.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 *
 * @property int|null $ID
 * @property int|null $AdmissionID
 * @property string|null $FromUser
 * @property string|null $ToUser
 * @property string|null $Subject
 * @property string|null $Notes
 * @property int|null $TypeID
 * @property int|null $StatusID
 * @property int|null $PriorityID
 * @property string|null $DueDate
 * @property string|null $CloseDate
 * @property string|null $UserInserted
 * @property string|null $DateInserted
 * @property string|null $UserUpdated
 * @property string|null $DateUpdated
 *
 * @package App\Models
 */
class Task extends Model
{
	protected $table = 'task';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID' => 'int',
		'AdmissionID' => 'int',
		'TypeID' => 'int',
		'StatusID' => 'int',
		'PriorityID' => 'int'
	];

	protected $fillable = [
		'ID',
		'AdmissionID',
		'FromUser',
		'ToUser',
		'Subject',
		'Notes',
		'TypeID',
		'StatusID',
		'PriorityID',
		'DueDate',
		'CloseDate',
		'UserInserted',
		'DateInserted',
		'UserUpdated',
		'DateUpdated'
	];
}
