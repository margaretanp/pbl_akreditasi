<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\UsersModel;

class DetailKriteriaModel extends Model
{
    use SoftDeletes;

    protected $table = 'detail_criteria';
    protected $primaryKey = 'id';

    protected $fillable = ['kriteria_id', 'jenis_kriteria_id', 'description', 'file_url', 'created_by'];
    protected $hidden = [ 'updated_at', 'deleted_at'];


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
    public function validasi()
{
    return $this->hasManyThrough(
        Validasi::class,
        KriteriaModel::class,
        'id', // Foreign key on kriteria table...
        'kriteria_id', // Foreign key on validasi table...
        'kriteria_id', // Local key on detail_kriteria table...
        'id' // Local key on kriteria table...
    );
}
}
