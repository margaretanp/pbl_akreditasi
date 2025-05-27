<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisKriteriaModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jenis_kriteria';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];
    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
}
