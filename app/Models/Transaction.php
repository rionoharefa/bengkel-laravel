<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'users_id',
        'insurance_price',
        'shipping_price',
        'transaction_status',
        'total_price',
        'code'      
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        //
    ];

    //relasi transaksi dengan user tahap integrasi dashboard customer
    public function user(){
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
