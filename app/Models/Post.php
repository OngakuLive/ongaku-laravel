<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'created_by_id',
        'recipient_id',
        'content'
    ];

    public function created_by() {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function recipient() {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function likes() {
        return $this->morphMany(Like::class,'likeable');
    }
}
