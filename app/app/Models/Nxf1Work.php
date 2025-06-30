<?php

/**
 * Created by Angelos Panagiotakis.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Nxf1Work
 *
 * @property string|null $Ονοματεπώνυμο
 * @property string|null $ΑΜΚΑ
 * @property float|null $Ημέρ#  Νοσ#
 * @property string|null $Ημ/νία  Εισαγωγής
 * @property string|null $Ημ/νία  Εξιτηρίου
 * @property string|null $Διαγνώσεις Εξόδου
 * @property string|null $Birthday
 * @property int|null $BirthYear
 * @property int|null $id
 * @property string|null $LastName
 * @property string|null $FirstName
 *
 * @package App\Models
 */
class Nxf1Work extends Model
{
	protected $table = 'nxf1_work';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Ημέρ#  Νοσ#' => 'float',
		'BirthYear' => 'int',
		'id' => 'int'
	];

	protected $fillable = [
		'Ονοματεπώνυμο',
		'ΑΜΚΑ',
		'Ημέρ#  Νοσ#',
		'Ημ/νία  Εισαγωγής',
		'Ημ/νία  Εξιτηρίου',
		'Διαγνώσεις Εξόδου',
		'Birthday',
		'BirthYear',
		'id',
		'LastName',
		'FirstName'
	];
}
