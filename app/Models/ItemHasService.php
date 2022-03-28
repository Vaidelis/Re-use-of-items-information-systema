<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemHasService extends Model
{
    use HasFactory;
    public $table = "item_has_service";
    protected $fillable = ['items_announcement_id', 'services_announcement_id'];
    public $primaryKey = 'id';

    public function service(){
        return $this->belongsTo(Service::class, 'services_announcement_id');
    }
}
