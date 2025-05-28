<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailKriteriaModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'detail_kriteria';
    protected $primaryKey = 'id';
    protected $fillable = ['status_validasi', 'status_pengerjaan', 'file_path'];
    protected $hidden =['created_at', 'updated_at', 'deleted_at'];

    public function kriteria()
    {
        return $this->belongsTo(KriteriaModel::class, 'kriteria_id', 'id');
    }
    public function jenisKriteria()
    {
        return $this->belongsTo(JenisKriteriaModel::class, 'jenis_kriteria_id', 'id');
    }
}
