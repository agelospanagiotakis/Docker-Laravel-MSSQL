<?php

/**
 * Created by Angelos Panagiotakis.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Usersinrole
 *
 * @property int|null $ID
 * @property int|null $RoleID
 * @property string|null $UserID
 *
 * @package App\Models
 */
class Usersinrole extends Model
{
	protected $table = 'usersinrole';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID' => 'int',
		'RoleID' => 'int'
	];

	protected $fillable = [
		'ID',
		'RoleID',
		'UserID'
	];
}
