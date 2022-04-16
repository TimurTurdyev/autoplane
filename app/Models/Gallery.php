<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Gallery extends Model
{
    use HasFactory, Attachable, AsSource, Filterable;

    public $table = 'galleries';

    protected $fillable = [
        'page_id',
        'name',
    ];
}
