<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory,SoftDeletes;

    public function user(){
        return $this->hasOne(User::class);
    }

    public function item(){
        return $this->hasMany(Item::class);
    }
}
