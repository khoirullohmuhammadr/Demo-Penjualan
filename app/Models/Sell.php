<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
  
    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id','id');
    }

    protected $table = 'sells';
    protected $fillable = [
        'products_id',
        'user_id',
        'sell',
        'date',
    
    ];

}
