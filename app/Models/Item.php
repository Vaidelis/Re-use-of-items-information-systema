<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    public $table = "items_announcements";

    protected $fillable = ['name', 'price', 'address', 'image','user_id'];
    public $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function rememberitem()
    {
        return $this->hasMany(RememberItem::class);
    }

}
