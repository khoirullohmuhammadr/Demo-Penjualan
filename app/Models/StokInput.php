<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokInput extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id','id');
    }
    protected $table = 'stok_inputs';
    protected $fillable = [
        'products_id',
        'stok',
        'input_date',
    
    ];

}
