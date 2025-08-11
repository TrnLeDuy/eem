<?php

namespace Modules\Contact\Entities;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contact__contacts';
    protected $fillable = [
        'contact_code',
        'contact_name',
        'contact_title',
        'note',
        'email',
        'phone_number',
        'type_id',
        'status',
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'type_id', 'id');
    }

    public function contactDetail()
    {
        return $this->hasOne(ContactDetail::class,'contact_id');
    }
}
