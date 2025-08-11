<?php

namespace Modules\Contact\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;

    protected $table = 'contact__categories';
    public $translatedAttributes = [
        'title',
        'category_id',
    ];
    protected $fillable = [
        'title',
        'status',
    ];
}
