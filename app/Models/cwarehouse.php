<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cwarehouse extends Model
{
    use HasFactory;
    protected $fillable=['warehouse_name'];
    public function jinvoice(){
        return $this->hasMany(jinvoice::class,'cwarehouse');
    }

    public function fmedicine(){
        return $this->hasMany(fmedicine::class,'cwarehouse');
    }
}
