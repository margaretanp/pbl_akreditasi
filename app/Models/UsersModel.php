<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Kriteria;

class UsersModel extends Model
{
    use HasApiTokens, SoftDeletes;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['role_id', 'email', 'password', 'name'];

    protected $hidden = ['password', 'deleted_at', 'created_at', 'updated_at'];

    public function role()
    {
        return $this->belongsTo(RolesModel::class);
    }

    public function kriteria()
    {
        return $this->hasMany(KriteriaModel::class, 'user_id');
    }
}
