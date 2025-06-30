<?php

/**
 * Created by Angelos Panagiotakis.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
	protected $table = 'role';
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
