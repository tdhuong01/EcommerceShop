<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';
    protected $primaryKey = 'id';
    protected $guarded =[];

    public function products(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
