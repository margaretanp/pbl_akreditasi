<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailKriteriaModel extends Model
{
    use SoftDeletes;

    protected $table = 'detail_criteria';
    protected $primaryKey = 'id';
    protected $fillable = ['criteria_id', 'jenis_criteria_id', 'created_by', 'description', 'file_url'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function kriteria()
    {
        return $this->belongsTo(KriteriaModel::class, 'criteria_id', 'id');
    }
    public function jenisKriteria()
    {
        return $this->belongsTo(JenisKriteriaModel::class, 'jenis_criteria_id', 'id');
    }
    public function createdBy()
    {
        return $this->belongsTo(UsersModel::class, 'created_by','id');
    }
}
