<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
    public function assetmain()
    {
        return $this->belongsTo(Asset::class, 'asset');
    }
    public function asset_type()
    {
        return $this->belongsTo(AssetType::class, 'asset_type_id');
    }
    public function attributes(){
        return $this->belongsTo(Attribute::class,'attribute');
    }
    public function brandmodel()
    {
        return $this->belongsTo(Brandmodel::class, 'brand_model_id');
    }
    public function getsupplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier');
    }
    public function statuses()
    {
        return $this->belongsTo(Status::class, 'status_available');
    }
    public function sublocation(){
        return $this->belongsTo(SubLocationModel::class,'sublocation_id');
    }
    public function assettypeid(){
        return $this->belongsTo(Issuence::class,'product_id');
    }
    // Product.php model
    public function issuances()
    {
        return $this->hasOne(Issuence::class, 'transaction_code', 'transaction_code');
    }

}
