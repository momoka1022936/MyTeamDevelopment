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
        
        // ここで一週間後の日付を取得
        $week1 = date("Y-m-d",strtotime("+1 week"));
        // ここで、stock_expirationのカラムのデータをすべて取得する。
        $stock_expiration = array_column($stocks, 'stock_expiration');

        $quantity  = array_column($stocks, 'quantity');
        $alert_number  = array_column($stocks, 'alert_number');

        return view('stocks.stocks', compact('week1','stock_expiration','alert_number', 'quantity') ,$data);
    }

    //登録画面の表示
    public function stocksRegister()
    {
        return view('stocks.stocksRegister');
    }

    // stocksのテーブルに登録するための機能
    public function stockCreate(Request $request){



        
        // ここでフォームの内容を取得している
        // ここで、tokenを削除
        $i = 0;

        for($request->stock_item_name[$i]; $i < 12; $i++){
            if(is_null($request->stock_item_name[$i])){
                return redirect('/stocks');
            }else{
                unset($request['_token']);
                $stock = new stock();
                $stock->user_id = $stock->user_id = auth()->id();
                $stock->stock_item_name = $request->stock_item_name[$i];
                $stock->quantity = $request->quantity[$i];
                $stock->alert_number = $request->alert_number[$i];
                $stock->stock_expiration = $request->stock_expiration[$i];
                $stock->save();
            }
        }            
    }

    public function stockEdit(){
        $stocks = DB::select('select * from stocks');
        $data = ['stocks' => $stocks];
        return view('stocks.stocksEdit', $data);
    }

    public function stockUpdate(Request $request){
        //編集機能

        $stocks = $request->only(['id', 'stock_item_name','quantity','stock_expiration']);
        $i = 0;
        foreach($request->id as $id){
            $stock = Stock::find($id);
            $stock->stock_item_name = $request->stock_item_name[$i];
            $stock->quantity = $request->quantity[$i];
            $stock->alert_number = $request->alert_number[$i];
            $stock->stock_expiration = $request->stock_expiration[$i];
            $stock->save();
            $i++;
        }
            
        return redirect('/stocks');
    }

    public function stockDelete(Request $request){
    // 削除機能

    foreach ($request->id as $id) {
        // checkboxからidを取得してレコードを探す
        $stock = Stock::find($id);
        // 削除
        $stock->delete();
    }

    return redirect('/stocks');
    }  
}