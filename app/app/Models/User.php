<?php

/**
 * Created by Angelos Panagiotakis.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 *
 * @property string|null $UserID
 * @property string|null $Password
 * @property string|null $FullName
 * @property string|null $Email
 * @property int|null $DoctorAEI
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

	protected $table = 'users';
    protected $primaryKey = 'id';
    public $incrementing = true;
	public $timestamps = true;

	protected $fillable = [
		'name',
		'email',
		'password',
	];
}
