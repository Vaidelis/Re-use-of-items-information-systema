<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoughtItem extends Model
{
    use HasFactory;
    public $table = "bought_items";
    protected $fillable = ['items_announcement_id', 'users_id'];
    public $primaryKey = 'id';

    public function item()
    {
        return $this->belongsTo(Item::class, 'items_announcement_id');
    }
}
