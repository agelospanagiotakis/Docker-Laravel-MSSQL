<?php

/**
 * Created by Angelos Panagiotakis.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Logging
 *
 * @property int|null $irowid
 * @property string|null $workdate
 * @property string|null $login
 * @property string|null $iu
 * @property string|null $tabname
 * @property int|null $recid
 * @property string|null $datent
 *
 * @package App\Models
 */
class Logging extends Model
{
	protected $table = 'logging';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'irowid' => 'int',
		'recid' => 'int'
	];

	protected $fillable = [
		'irowid',
		'workdate',
		'login',
		'iu',
		'tabname',
		'recid',
		'datent'
	];
}
