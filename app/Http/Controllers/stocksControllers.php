<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;

class stocksControllers extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // stockテーブルのレコードを取得する処理
    //selectは取得するカラムを指定することができる。この場合はすべて取得している。
    public function stocks()
    {
        $stocks = DB::select('select * from stocks');
        $data = ['stocks' => $stocks];
        return view('stocks.stocks', $data);
    }

    //登録画面の表示
    public function stocksRegister()
    {

        return view('stocks.stocksRegister');
    }

    // stocksのテーブルに登録するための機能
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
