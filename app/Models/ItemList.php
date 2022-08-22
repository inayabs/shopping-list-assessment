<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemList extends Model
{
    use HasFactory;

    protected $table = "item_list";
    
    public function item(){
        return $this->belongsTo(Item::class,'item_id','id');
    }
}
