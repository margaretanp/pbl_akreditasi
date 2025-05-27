<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validasi extends Model
{
    protected $fillable = ['id_validator', 'id_user', 'validated_at', 'notes', 'status'];

    public function user() {
        return $this->belongsTo(UsersModel::class, 'id_user');
    }

    public function validator() {
        return $this->belongsTo(UsersModel::class, 'id_validator');
    }
}

