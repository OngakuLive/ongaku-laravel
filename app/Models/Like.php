<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'created_by_id',
        'likeable_id',
        'likeable_type'
    ];

    public function likeable() {
        $this->morphTo();
    }
}
