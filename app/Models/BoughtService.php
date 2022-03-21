<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoughtService extends Model
{
    use HasFactory;
    public $table = "bought_services";
    protected $fillable = ['name', 'services_announcement_id', 'users_id', 'path', 'see', 'postname'];
    public $primaryKey = 'id';

    public function service()
    {
        return $this->belongsTo(Service::class, 'services_announcement_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
