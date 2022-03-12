<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    public $table = "tags";

    protected $fillable = ['name', 'categorys_id'];
    public $primaryKey = 'id';

    public function itemhastags(){
        return $this->hasMany(ItemHasTags::class);
    }
}