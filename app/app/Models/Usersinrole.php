<?php

/**
 * Created by Angelos Panagiotakis.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\TableNames;

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
	protected $table = TableNames::UsersInRole->value;
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
