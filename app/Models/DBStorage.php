<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DBStorage extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path',
        'file_type',
        'file_size',
        'model',
        'model_id',
    ];
}
