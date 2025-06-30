<?php

/**
 * Created by Angelos Panagiotakis.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Lookuptype
 *
 * @property int|null $ID
 * @property string|null $Code
 * @property string|null $Description
 *
 * @package App\Models
 */
class Lookuptype extends Model
{
	protected $table = 'lookuptype';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID' => 'int'
	];

	protected $fillable = [
		'ID',
		'Code',
		'Description'
	];
}
