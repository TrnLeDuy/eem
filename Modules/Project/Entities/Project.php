<?php

namespace Modules\Project\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\Support\Traits\MediaRelation;

class Project extends Model
{
    use Translatable, MediaRelation;

    protected $table = 'project__projects';
    public $translatedAttributes = [
        'title',
        'slug',
        'body',
        'meta_title',
        'meta_description',
        'og_title',
        'og_description',
        'og_image',
        'og_type',
    ];
    protected $fillable = [
        'category_id',  
        'status',
        'title',
        'slug',
        'body',
        'meta_title',
        'meta_description',
        'og_title',
        'og_description',
        'og_image',
        'og_type',
    ];

    public function getAvatar()
    {
        $thumbnail = $this->files()->where('zone', 'avatar')->first();
        if ($thumbnail === null) {
            return '';
        }
        return $thumbnail;
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
