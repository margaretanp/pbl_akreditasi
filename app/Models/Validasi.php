<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Validasi extends Model
{
    use SoftDeletes;
    protected $table = 'validators';
    protected $primaryKey = 'id';
    protected $fillable = ['criteria_id', 'user_id', 'comment', 'has_validated', 'validated_at'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'has_validated' => 'boolean',
        'validated_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(UsersModel::class, 'user_id', 'id');
    }

    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(KriteriaModel::class, 'criteria_id', 'id');
    }
}
