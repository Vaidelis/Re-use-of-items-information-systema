<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    public $table = "services_announcements";

    protected $fillable = ['name', 'price','user_id', 'categorys_id'];
    public $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function rememberservice()
    {
        return $this->hasMany(RememberService::class);
    }
    public function servicehastags(){
        return $this->hasMany(ServiceHasTags::class);
    }
    public function boughtservices(){
        return $this->hasMany(BoughtService::class);
    }
    public function itemhasserivce(){
        return $this->hasMany(ItemHasService::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'categorys_id');
    }
}
