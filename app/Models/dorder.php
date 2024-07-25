<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dorder extends Model
{
    use HasFactory;
    protected $fillable=['first_med','quantity1','price1','second_med','quantity2','price2','third_med','quantity3','price3','fourth_med','quantity4','price4','fifth_med','quantity5','price5','order_satatus','payment_status','user_id'];
    public function talabia3(){
        return $this->hasMany(jinvoice::class,'order_id');
    }
    public function medicines(){
        return $this->belongsToMany(fmedicine::class)->withPivot('quantity');
        }

}
