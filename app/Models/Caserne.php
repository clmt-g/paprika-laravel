<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Caserne extends Model
{
    //
    protected $primaryKey = 'Matricule';
    protected $keyType = 'integer';
    use SoftDeletes;

    // désactiver les timestamps
    public $timestamps = false;

    /**
     * Get the pompiers for the caserne.
     */
    public function pompiers(): HasMany
    {
        return $this->hasMany(Pompier::class); // FIXME 'foreign key' and 'local_key'
    }
}
