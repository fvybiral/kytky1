<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encyklopedie extends Model
{
    use HasFactory;

    protected $fillable = ['input', 'normalized_input', 'name', 'addition'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'encyklopedie';
}
