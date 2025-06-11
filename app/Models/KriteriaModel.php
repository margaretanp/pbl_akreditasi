<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KriteriaModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'kriteria';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'is_rejected', 'rejected_at','merged_file_url', 'merged_at'];
    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    protected $casts = [
        'is_rejected' => 'boolean',
        'merged_at' => 'datetime',
    ];

    public function DetailKriteria()
    {
        return $this->hasMany(DetailKriteriaModel::class, 'kriteria_id', 'id');
    }
    public function validators()
    {
        return $this->hasMany(Validasi::class, 'kriteria_id', 'id');
    }
    
}
