<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soubor extends Model
{
/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'soubor';

    protected $fillable = ['name','storage_path','state'];

    use HasFactory;
}
