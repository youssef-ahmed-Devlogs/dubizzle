<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'full_description',
        'email',
        'phone_number',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => '',
            'email' => '',
            'phone_number' => '',
        ]);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function images()
    {
        return $this->hasMany(DBStorage::class, 'model_id', 'id')->where('model', Ad::class);
    }

    public function getCover()
    {
        // if ($this->cover) {
        //     return asset('storage/' . $this->cover);
        // }
        return asset('dashboard_/img/undraw_profile.svg');
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        $options = array_merge([
            'search' => '',
        ], $filters);

        $builder->when($options['search'], function (Builder $builder, $search) {
            $builder->where('title', 'LIKE', "%$search%")
                ->orwhere('description', 'LIKE', "%$search%")
                ->orwhere('full_description', 'LIKE', "%$search%");
        });
    }

    private function deleteCover($category)
    {
        if ($category->cover && Storage::exists($category->cover))
            Storage::delete($category->cover);
    }
}
