<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class acategory extends Model
{
    use HasFactory;
    protected $fillable=['name'];
    public function medicine()
    {
        return $this->hasMany(fmedicine::class,'category');
    }
}
