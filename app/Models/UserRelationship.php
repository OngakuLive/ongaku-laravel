<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRelationship extends Model
{
    protected $fillable = [
        'source_user_id',
        'destination_user_id',
        'relationship_type_id'
    ];

    public function source_user() {
        return $this->belongsTo(User::class, 'source_user_id');
    }

    public function destination_user() {
        return $this->belongsTo(User::class, 'source_user_id');
    }

    public function type() {
        return $this->belongsTo(UserRelationshipType::class, 'relationship_type_id');
    }
}
