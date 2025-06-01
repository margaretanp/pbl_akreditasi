<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Validasi extends Model
{
    protected $table = 'validasi';
    protected $primaryKey = 'id';
    protected $fillable = ['id_user', 'id_detail_kriteria', 'validated_date', 'komentar', 'status'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];


    public function user()
    {
        return $this->belongsTo(UsersModel::class, 'id_user', 'id');
    }

    public function detailKriteria(): BelongsTo
    {   
        return $this->belongsTo(DetailKriteriaModel::class, 'id_detail_kriteria', 'id');
    }
}
