<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreAttribute extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'is_required',
    ];

    public function values()
    {
        return $this->hasMany(MerchantStoreValue::class, 'store_attribute_id', 'id');
    }

    public function scopeRequired($query, $value = true)
    {
        return $query->where('is_required', $value);
    }
}
