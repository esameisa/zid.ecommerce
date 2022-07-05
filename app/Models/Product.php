<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'store_id',
        'name',
        'vat_type', // included in the products price or should be calculated from the products price.
        'vat_percentage', // if vat_type is included in the price, this is the percentage of vat.
        'shipping_cost',
        'price',
        'description'
    ];

    public $translatable = [
        'name',
        'price',
        'description'
    ];
}
