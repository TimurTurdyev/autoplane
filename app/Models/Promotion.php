<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Promotion extends Model
{
    use HasFactory, Attachable, AsSource, Filterable;

    public $table = 'promotions';

    protected $fillable = [
        'page_id',
        'name',
        'photo',
        'description',
    ];
}
