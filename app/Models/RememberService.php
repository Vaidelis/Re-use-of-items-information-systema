<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RememberService extends Model
{
    use HasFactory;
    public $table = "remember_services";
    protected $fillable = ['services_announcement_id', 'users_id'];
    public $primaryKey = 'id';
}
