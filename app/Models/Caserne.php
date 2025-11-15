<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Caserne extends Model
{
    use SoftDeletes;

    protected $table = 'casernes';
    protected $primaryKey = 'NumCaserne';
    protected $keyType = 'integer';
    public $incrementing = false;
    public $timestamps = false;

    /**
     * Get the pompiers for the caserne.
     */
    public function pompiers(): HasMany
    {
        return $this->hasMany(Pompier::class, 'NumCaserne', 'NumCaserne');
    }
}
