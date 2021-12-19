<?php

namespace App\Http\Controllers;

use App\Models\brand;
use App\Models\models;
use Illuminate\Http\Request;
use Inertia\Inertia;

class stockController extends Controller
{
    public function index(Request $request)
    {
        $brandid = $request["cur_brandid"];
    $qty = $request["qty"];
    $op = $request["op"];
    
    $stock=[];
    if ($brandid && $qty && $op) {
        $brand=brand::findOrFail($brandid);
        $stock_original = models::where('brand_id',$brand["id"])->withCount('stock')->has('stock', $op, $qty)->orderBy('stock_count', 'asc')->get()->toArray();
        $leng=count($stock_original);
        if($leng>2){
        $stock=[$stock_original[0],$stock_original[$leng-1]];
        }
    }
    return Inertia::render('Welcome', [
        'brands'=>brand::all(),
        'filter'=>[
            "cur_brandid"=>$brandid,
            "qty"=>$qty,
            "op"=>$op
        ],
        'stock'=>$stock
    ]);
    }
}
