<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;

/**
 * Class Vdoctor
 *
 * @property int|null $ID
 * @property string|null $Name
 * @property string|null $Abbreviation
 * @property int|null $Role
 * @property bool|null $IsActive
 *
 * @package App\Models
 */
class Vdoctor extends Model
{
    protected $table = 'vDoctor';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID' => 'int',
		'Role' => 'int',
		'IsActive' => 'bool'
	];

	protected $fillable = [
		'ID',
		'Name',
		'Abbreviation',
		'Role',
		'IsActive'
	];
}
