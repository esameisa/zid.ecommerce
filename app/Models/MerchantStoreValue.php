<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantStoreValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'store_attribute_id',
        'value'
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function attribute()
    {
        return $this->belongsTo(StoreAttribute::class, 'store_attribute_id', 'id');
    }
}
