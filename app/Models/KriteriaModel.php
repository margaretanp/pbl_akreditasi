<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class KriteriaModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'kriteria';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];
    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(UsersModel::class, 'user_id');
    }
}
