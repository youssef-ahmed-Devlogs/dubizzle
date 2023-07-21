<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'parent_id',
        'name',
        'description',
        'cover',
        'order',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id','id');
    }

    public function ads()
    {
        return $this->belongsToMany(Ad::class);
    }
}
