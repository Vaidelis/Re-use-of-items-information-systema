<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    public $table = "items_announcements";

    protected $fillable = ['name', 'price', 'address','user_id'];
    public $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function rememberitem()
    {
        return $this->hasMany(RememberItem::class);
    }
    public function boughtitem()
    {
        return $this->hasMany(BoughtItem::class);
    }
    public function image()
    {
        return $this->hasMany(Image::class);
    }

}
