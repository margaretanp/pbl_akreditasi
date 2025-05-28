<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Validasi extends Model
{
    protected $table = 'validasi';
    protected $primaryKey = 'id_validator';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = ['id_validator', 'id_user', 'validated_date', 'komentar', 'status'];
    protected $hidden = ['create_at', 'update_at', 'd   eleted_at'];


    public function user()
    {
        return $this->belongsTo(UsersModel::class, 'id_user', 'id');
    }
}
