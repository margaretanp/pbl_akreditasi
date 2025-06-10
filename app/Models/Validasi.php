<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Validasi extends Model
{
    protected $table = 'validators';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'kriteria_id', 'validated_at', 'komentar', 'is_validated'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];


    public function user()
    {
        return $this->belongsTo(UsersModel::class, 'user_id', 'id');
    }

    public function kriteria(): BelongsTo
    {   
        return $this->belongsTo(KriteriaModel::class, 'kriteria_id', 'id');
    }
}
