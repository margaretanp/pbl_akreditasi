<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KriteriaModel extends Model
{
    use SoftDeletes;
    protected $table = 'criteria';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'is_rejected', 'rejected_at','merged_file_url'];
    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    protected $casts = [
        'is_rejected' => 'boolean',
    ];

    public function detailKriteria()
    {
        return $this->hasMany(DetailKriteriaModel::class, 'criteria_id', 'id');
    }
    public function validators()
    {
        return $this->hasMany(Validasi::class, 'criteria_id', 'id');
    }
}
