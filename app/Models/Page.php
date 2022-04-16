<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Page extends Model
{
    use HasFactory, Attachable, AsSource, Filterable;

    public $table = 'pages';
    public $timestamps = null;

    protected $fillable = [
        'slug',
        'type',
        'name',
        'heading',
        'meta_title',
        'meta_description',
        'hero',
        'body',
        'setting',
    ];

    protected $casts = [
        'setting' => 'array'
    ];

    /**
     * Get the user's first name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function slugRead(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => $attributes['slug'],
        );
    }

    public function galleries(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Gallery::class);
    }

    public function promotions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Promotion::class);
    }

    public function scopeSearch(Builder $builder, $search)
    {
        return $builder->when($search, function ($query, $search) {
            $query->where(DB::raw("REGEXP_REPLACE(CONCAT(name,heading,meta_title,meta_description,body), '[^[:alnum:]]', '')"), 'like', '%' . preg_replace('/[^[:alnum:]]/u', '', (string)$search) . '%');
        });
    }
}
