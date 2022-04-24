<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class stocksControllers extends Controller
{
    //

    
    public function stocks()
    {
        $stocks = DB::select('select * from stocks');
        $data = ['stocks' => $stocks];
        return view('stocks', $data);
    }
    public function stocksRegister()
    {
        return view('stocksRegister');
    }
    public function stockCreate(Request $request){

        $stock = new Stock;
        $stock->user_id = $request->user_id;
        $stock->stock_item_name = $request->stock_item_name;
        $stock->quantity = $request->quantity;
        $stock->stock_expiration = $request->stock_expiration;

        $stock->save();

        return redirect('/stocks');
    }

}
