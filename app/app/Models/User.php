<?php

/**
 * Created by Angelos Panagiotakis.
 */

namespace App\Models;

use App\Enums\TableNames;
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

	protected $table = TableNames::Users->value;
    protected $primaryKey = 'UserID';
    public $incrementing = false; // Set this to false if UserID is not auto-incrementing
	public $timestamps = false;

	protected $casts = [
		'DoctorAEI' => 'int'
	];

	protected $fillable = [
		'UserID',
		'Password',
		'FullName',
		'Email',
		'DoctorAEI'
	];
}
