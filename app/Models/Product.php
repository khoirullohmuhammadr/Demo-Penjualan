<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function stok_input()
    {
        return $this->belongsTo(StokInput::class, 'products_id');
    }
    public function sell()
    {
        return $this->belongsTo(Sell::class, 'sells_id');
    }

    protected $table = 'products';
    protected $fillable = [
        'product_name',
        'image',
    ];
}
