<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bpharmacist extends Model
{
    use HasFactory;
    public function jinvoice(){
        return $this->hasMany(jinvoice::class,'bpharmacist');
    }

}
