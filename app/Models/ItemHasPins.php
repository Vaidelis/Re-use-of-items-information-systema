<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemHasPins extends Model
{
    use HasFactory;
    public $table = "item_has_pins";

    public $primaryKey = 'id';
}
