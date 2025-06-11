<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisKriteriaModel extends Model
{
    use SoftDeletes;

    protected $table = 'jenis_criteria';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];
    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    public function detailKriteria()
    {
        return $this->hasMany(DetailKriteriaModel::class, 'jenis_criteria_id', 'id');
    }
}
