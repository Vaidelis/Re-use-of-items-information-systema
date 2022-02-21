<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    public $table = "services_announcement";

    protected $fillable = ['name', 'price','user_id'];
    public $primaryKey = 'id';
}
