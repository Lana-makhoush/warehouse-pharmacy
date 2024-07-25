<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jinvoice extends Model
{
    use HasFactory;
    protected $fillable=['name','quantity','price','expiry_date','total_price','payment_status'];
    
}
