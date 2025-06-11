<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RolesModel extends Model
{
    use SoftDeletes;

    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $fillable = ['code', 'name', 'description'];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    public function users()
    {
        return $this->hasMany(UsersModel::class, 'role_id', 'id');
    }
}