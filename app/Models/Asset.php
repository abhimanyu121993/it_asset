<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'brand_id', 'asset_type_id', 'status'];
    public function AssetName()
    {
        return $this->belongsTo('App\Models\AssetType', 'asset_type_id', 'id');
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class,'asset','id');
    }
}
