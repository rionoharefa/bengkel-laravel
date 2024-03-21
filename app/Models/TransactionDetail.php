<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'transactions_id',
        'products_id',
        'price',
        'code',
        'resi',
        'shipping_status'
            
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        //
    ];

    //relasi transaksi-detail dengan produk tahap integrasi dashboard customer
    public function product(){
        return $this->hasOne(Product::class,'id','products_id');
    }

     //relasi transaksi-detail dengan transaksi tahap integrasi dashboard customer
    public function transaction(){
        return $this->hasOne(Transaction::class,'id','transactions_id');
    }
}