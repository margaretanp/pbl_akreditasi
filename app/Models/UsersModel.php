<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class UsersModel extends Model
{
    use HasApiTokens;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['role_id', 'email', 'password', 'name'];

    protected $hidden = ['password', 'deleted_at', 'created_at', 'updated_at'];

    public function role()
    {
        return $this->belongsTo(RolesModel::class, 'role_id', 'id');
    }
}
