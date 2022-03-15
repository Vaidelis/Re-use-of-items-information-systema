<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RememberItem extends Model
{
    use HasFactory;
    public $table = "remember_items";
    protected $fillable = ['items_announcement_id', 'users_id'];
    public $primaryKey = 'id';
}
