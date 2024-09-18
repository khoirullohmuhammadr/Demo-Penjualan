<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    public function city()
    {
        return $this->belongsTo(City::class, 'cities_id','id');
    }
    protected $table = 'user_models';
    protected $fillable = [
        'name',
        'image',
        'email',
        'password',
        'birthday',
        'cities_id',
    ];
}
