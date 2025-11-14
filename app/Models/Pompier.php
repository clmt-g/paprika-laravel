<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pompier extends Model
{
    //
    protected $primaryKey = 'Matricule';
    protected $keyType = 'string';
    use SoftDeletes;

    // désactiver les timestamps
    public $timestamps = false;

    /**
     * Get the caserne associated with the pompier.
     */
    public function caserne(): HasOne
    {
        return $this->hasOne(Caserne::class, 'NumCaserne', 'NumCaserne');
    }

    /** Get the grade associated with the pompier
     * @return HasOne
     */
    public function grade(): HasOne {
        return $this->hasOne(Grade::class, 'CodeGrade', 'CodeGrade');
    }

    /** get the responsable associated with the pompier
     * @return BelongsTo
     */
    public function responsable(): BelongsTo {
        return $this->BelongsTo(Pompier::class, 'MatriculeRespo', 'Matricule');
    }
}
