<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fmedicine extends Model
{
    use HasFactory;
protected $fillable=['scintific_name','commercial_name','category','manufacture_company','available_quantity','expairy_date','image'];
    public function category(){
        return $this->hasone(acategory::class);
    }
    public function talabia2(){
        return $this->hasMany(jinvoice::class,'category');
    }
    public function order(){
        return $this->belongsToMany(dorder::class)->withPivot('quantity');
        }

}
