<?php

/**
 * Created by Angelos Panagiotakis.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Job
 *
 * @property int|null $id
 * @property string|null $queue
 * @property string|null $payload
 * @property int|null $attempts
 * @property int|null $reserved_at
 * @property int|null $available_at
 * @property int|null $created_at
 *
 * @package App\Models
 */
class Job extends Model
{
	protected $table = 'jobs';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'attempts' => 'int',
		'reserved_at' => 'int',
		'available_at' => 'int'
	];

	protected $fillable = [
		'id',
		'queue',
		'payload',
		'attempts',
		'reserved_at',
		'available_at'
	];
}
