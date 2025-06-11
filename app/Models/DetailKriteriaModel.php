<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\UsersModel;

class DetailKriteriaModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'detail_kriteria';
    protected $primaryKey = 'id';
    protected $fillable = ['kriteria_id', 'jenis_kriteria_id', 'description', 'file_url', 'created_by'];
    protected $hidden = [ 'updated_at', 'deleted_at'];

    public function kriteria()
    {
        return $this->belongsTo(KriteriaModel::class, 'kriteria_id', 'id');
    }
    public function jenisKriteria()
    {
        return $this->belongsTo(JenisKriteriaModel::class, 'jenis_kriteria_id', 'id');
    }
    public function createdBy()
    {
        return $this->belongsTo(UsersModel::class, 'created_by','id');
    }
}
