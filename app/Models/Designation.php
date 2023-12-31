<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Designation extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded=[];
    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id', 'id');
    }
    public function users()
    {
        return $this->hasMany(User::class,'designation_id','id');
    }
}
