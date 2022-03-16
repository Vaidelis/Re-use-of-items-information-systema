<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceHasTags extends Model
{
    use HasFactory;
    public $table = "services_announcement_has_tags";
    protected $fillable = ['services_announcement_id', 'tags_id'];
    public $primaryKey = 'id';

    public function tags()
    {
        return $this->belongsTo(Tag::class, 'tags_id');
    }
    public function service(){
        return $this->belongsTo(Service::class, 'services_announcement_id');
    }
}
