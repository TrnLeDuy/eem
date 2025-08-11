<?php

namespace Modules\Contact\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title',
        'category_id',
    ];
    protected $table = 'contact__category_translations';
}
