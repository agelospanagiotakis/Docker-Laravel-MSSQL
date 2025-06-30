<?php

/**
 * Created by Angelos Panagiotakis.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Textsadmission
 *
 * @property int|null $ID
 * @property int|null $AdmissionID
 * @property string|null $AdParousa
 * @property string|null $AdPoreia
 * @property string|null $AdNeuron
 * @property string|null $AdAtomiko
 * @property string|null $AdProjections
 * @property string|null $AdFill01
 * @property string|null $AdFill02
 * @property string|null $AdFill03
 * @property string|null $AdFill04
 * @property string|null $AdFill05
 * @property string|null $UserInserted
 * @property string|null $DateInserted
 * @property string|null $UserUpdated
 * @property string|null $DateUpdated
 *
 * @package App\Models
 */
class TextsAdmission extends Model
{
    use HasFactory;
	protected $table = 'texts_admissions';
	public $incrementing = true;
	public $timestamps = true;

	protected $casts = [
		'ID' => 'int',
		'AdmissionID' => 'int'
	];

	protected $fillable = [
		'ID',
		'AdmissionID',
		'AdParousa',
		'AdPoreia',
		'AdNeuron',
		'AdAtomiko',
		'AdProjections',
		'AdFill01',
		'AdFill02',
		'AdFill03',
		'AdFill04',
		'AdFill05',
		'UserInserted',
		'DateInserted',
		'UserUpdated',
		'DateUpdated'
	];

	protected $dates = ['DateInserted', 'DateUpdated'];

    public function admission()
    {
        return $this->belongsTo(Admission::class, 'AdmissionID', 'ID');
    }
}
