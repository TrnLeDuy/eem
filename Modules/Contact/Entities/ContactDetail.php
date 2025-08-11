<?php

namespace Modules\Contact\Entities;

use Illuminate\Database\Eloquent\Model;

class ContactDetail extends Model
{
    protected $table = 'contact__contactdetails';
    public $timestamps = false; // Thêm dòng này để tắt timestamps
    
    protected $fillable = [
        'messages',
        'assembly_address',
        'monthly_consumption_kwh',
        'avg_monthly_cost_vnd',
        'financial_capacity_kw',
        'avl_roof_area_m2',
        'power_phase_count',
        'contact_id',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo('Modules\Product\Entities\Product', 'product_id', 'id');
    }
}
