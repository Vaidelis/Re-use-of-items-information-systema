<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesRate extends Model
{
    use HasFactory;
    public $table = "services_rate";

    protected $fillable = ['comment', 'buyername', 'rate', 'times','users_id'];
    public $primaryKey = 'id';
}
