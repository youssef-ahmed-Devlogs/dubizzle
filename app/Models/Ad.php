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
        'price',
        'debatable'
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
        return $this->morphMany(DBStorage::class, 'storable');
    }

    public function getCover()
    {
        if ($this->images->count()) {
            return asset('storage/' . $this->images[0]->file_path);
        }
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

        // foreach ($options as $option) {
        //     $builder->when($options[$option], function (Builder $builder, $value) use ($option) {
        //         $builder->where($option, $value);
        //     });
        // }
    }

    private function deleteCover($category)
    {
        if ($category->cover && Storage::exists($category->cover))
            Storage::delete($category->cover);
    }
}
