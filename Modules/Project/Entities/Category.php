<?php

namespace Modules\Project\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;

    protected $table = 'project__categories';
    public $translatedAttributes = [
        'title',
        'slug',
        'meta_title',
        'meta_description',
        'og_title',
        'og_description',
        'og_image',
        'og_type',
    ];
    protected $fillable = [
        'status',
        'show_menu',
        'title',
        'slug',
        'meta_title',
        'meta_description',
        'og_title',
        'og_description',
        'og_image',
        'og_type',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class, 'category_id', 'id');
    }
}
