<?php

/**
 * Created by Angelos Panagiotakis.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Certificate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class TextsCertificate
 *
 * @property int|null $ID
 * @property int|null $CertificateID
 * @property string|null $CeParousa
 * @property string|null $CePoreia
 * @property string|null $CeNeuron
 * @property string|null $CeAtomiko
 * @property string|null $CeProjections
 * @property string|null $CeDrugs
 * @property string|null $CeDirections
 * @property string|null $CeSickLeave
 * @property string|null $CeSuAbout
 * @property string|null $CeFill02
 * @property string|null $CeFill03
 * @property string|null $CeFill04
 * @property string|null $CeFill05
 * @property string|null $UserInserted
 * @property string|null $DateInserted
 * @property string|null $UserUpdated
 * @property string|null $DateUpdated
 *
 * @package App\Models
 */
class TextsCertificate extends Model
{
    use HasFactory;
	protected $table = 'texts_certificates';
	protected $primaryKey = 'ID';
	public $incrementing = true;
	public $timestamps = true;

	protected $casts = [
		'ID' => 'int',
		'CertificateID' => 'int',
        'DateInserted' => 'datetime',
        'DateUpdated' => 'datetime'
	];
	protected $dates = [
        'DateInserted',
        'DateUpdated'
    ];

	protected $fillable = [
		'ID',
		'CertificateID',
		'CeParousa',
		'CePoreia',
		'CeNeuron',
		'CeAtomiko',
		'CeProjections',
		'CeDrugs',
		'CeDirections',
		'CeSickLeave',
		'CeSuAbout',
		'CeFill02',
		'CeFill03',
		'CeFill04',
		'CeFill05',
		'UserInserted',
		'DateInserted',
		'UserUpdated',
		'DateUpdated'
	];

	public function certificate(): BelongsTo
    {
        return $this->belongsTo(Certificate::class, 'CertificateID', 'ID');
    }

}
