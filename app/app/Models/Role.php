<?php

/**
 * Created by Angelos Panagiotakis.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\TableNames;

/**
 * Class Role
 *
 * @property int|null $ID
 * @property string|null $RoleName
 * @property string|null $Description
 *
 * @package App\Models
 */
class Role extends Model
{
	protected $table = TableNames::Roles->value;
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID' => 'int'
	];

	protected $fillable = [
		'ID',
		'RoleName',
		'Description'
	];
}
