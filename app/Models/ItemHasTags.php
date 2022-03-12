<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemHasTags extends Model
{
    use HasFactory;
    public $table = "items_announcement_has_tags";
    protected $fillable = ['items_announcement_id', 'tags_id'];
    public $primaryKey = 'id';

    public function tags()
    {
        return $this->belongsTo(Tag::class, 'tags_id');
    }
}
