<?php

/**
 * Created by Angelos Panagiotakis.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Textssurgery
 *
 * @property int|null $ID
 * @property int|null $SurgeryID
 * @property string|null $SuAbout
 * @property string|null $SuCut
 * @property string|null $SuBaccess
 * @property string|null $SuImplants
 * @property string|null $SuFill01
 * @property string|null $SuFill02
 * @property string|null $SuFill03
 * @property string|null $SuFill04
 * @property string|null $SuFill05
 * @property string|null $UserInserted
 * @property string|null $DateInserted
 * @property string|null $UserUpdated
 * @property string|null $DateUpdated
 *
 * @package App\Models
 */
class Textssurgery extends Model
{
	use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'TextsSurgery';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'SurgeryID',
        'SuAbout',
        'SuCut',
        'SuBaccess',
        'SuImplants',
        'SuFill01',
        'SuFill02',
        'SuFill03',
        'SuFill04',
        'SuFill05',
        'UserInserted',
        'DateInserted',
        'UserUpdated',
        'DateUpdated',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'DateInserted' => 'datetime',
        'DateUpdated' => 'datetime',
    ];

    /**
     * Get the surgery that owns the texts.
     */
    public function surgery(): BelongsTo
    {
        return $this->belongsTo(Surgery::class, 'SurgeryID', 'ID');
    }

    /**
     * Scope a query to only include texts for a specific surgery.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $surgeryId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForSurgery($query, $surgeryId)
    {
        return $query->where('SurgeryID', $surgeryId);
    }
	
}
