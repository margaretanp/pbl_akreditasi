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
    protected $fillable = ['kriteria_id', 'jenis_kriteria_id', 'status_validasi', 'status_pengerjaan', 'file_url'];
    protected $hidden =['created_at', 'updated_at', 'deleted_at'];

    public function kriteria()
    {
        return $this->belongsTo(KriteriaModel::class, 'kriteria_id', 'id');
    }
    public function jenisKriteria()
    {
        return $this->belongsTo(JenisKriteriaModel::class, 'jenis_kriteria_id', 'id');
    }
    public function validasi()
    {
        return $this->hasMany(Validasi::class, 'id_detail_kriteria', 'id');
    }
}
