<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kytka extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kytka';


    /**
     * Get the phone associated with the user.
     */
    public function encyklopedie(): HasOne
    {
        return $this->hasOne(Encyklopedie::class, 'id', 'encyklopedieid');
    }

    /**
     * Get the phone associated with the user.
     */
    public function nomenklatura(): HasOne
    {
        return $this->hasOne(Nomenklatura::class, 'id', 'nomenklaturaid');
    }
}
