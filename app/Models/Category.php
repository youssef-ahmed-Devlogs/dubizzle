<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'parent_id',
        'name',
        'slug',
        'description',
        'cover',
        'order',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id')->withDefault([
            'name' => ''
        ]);
    }

    public function children()
    {
        return Category::where('parent_id', $this->id)->latest()->get();
    }

    public function ads()
    {
        return $this->belongsToMany(Ad::class);
    }

    public function getCover()
    {
        if ($this->cover) {
            return asset('storage/' . $this->cover);
        }
        return asset('dashboard_/img/undraw_profile.svg');
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        $options = array_merge([
            'search' => '',
        ], $filters);

        $builder->when($options['search'], function (Builder $builder, $search) {
            $builder->where('name', 'LIKE', "%$search%");
        });
    }
}
