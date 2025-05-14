<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolesModel extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $fillable = ['code', 'name', 'description'];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    public function users()
    {
        return $this->hasMany(UsersModel::class, 'role_id', 'id');
    }
}
