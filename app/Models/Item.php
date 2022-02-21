<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    public $table = "items_announcement";

    protected $fillable = ['name', 'price', 'address', 'image','user_id'];
    public $primaryKey = 'id';
}
