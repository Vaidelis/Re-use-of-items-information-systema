<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $table = "categorys";

    protected $fillable = ['name'];
    public $primaryKey = 'id';

    public function item()
    {
        return $this->hasMany(Item::class);
    }
    public function service()
    {
        return $this->hasMany(Service::class);
    }
}
