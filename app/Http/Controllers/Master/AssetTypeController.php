<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssetTypeController extends Controller
{
    public function index(){

        return view('Backend.Page.Master.assets-type');
    }
}
