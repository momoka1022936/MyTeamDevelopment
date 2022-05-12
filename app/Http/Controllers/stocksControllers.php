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

        $request->validate([
            'stock_item_name.0' => 'required|max:100|required_with:quantity.0',
            'stock_item_name.1'  => 'max:100|nullable|required_with:quantity.1',
            'stock_item_name.2'  => 'max:100|nullable|required_with:quantity.2',
            'stock_item_name.3'  => 'max:100|nullable|required_with:quantity.3',
            'stock_item_name.4'  => 'max:100|nullable|required_with:quantity.4',
            'stock_item_name.5'  => 'max:100|nullable|required_with:quantity.5',
            'stock_item_name.6'  => 'max:100|nullable|required_with:quantity.6',
            'stock_item_name.7'  => 'max:100|nullable|required_with:quantity.7',
            'stock_item_name.8'  => 'max:100|nullable|required_with:quantity.8',
            'stock_item_name.9'  => 'max:100|nullable|required_with:quantity.9',
            'stock_item_name.10'  => 'max:100|nullable|required_with:quantity.10',
            'stock_item_name.11'  => 'max:100|nullable|required_with:quantity.11',
            'quantity.0'  => 'required|required_with:stock_item_name.0|max:6',
            'quantity.1'  => 'nullable|required_with:stock_item_name.1|max:6',
            'quantity.2'  => 'nullable|required_with:stock_item_name.2|max:6',
            'quantity.3'  => 'nullable|required_with:stock_item_name.3|max:6',
            'quantity.4'  => 'nullable|required_with:stock_item_name.4|max:6',
            'quantity.5'  => 'nullable|required_with:stock_item_name.5|max:6',
            'quantity.6'  => 'nullable|required_with:stock_item_name.6|max:6',
            'quantity.7'  => 'nullable|required_with:stock_item_name.7|max:6',
            'quantity.8'  => 'nullable|required_with:stock_item_name.8|max:6',
            'quantity.9'  => 'nullable|required_with:stock_item_name.9|max:6',
            'quantity.10'  => 'nullable|required_with:stock_item_name.10|max:6',
            'quantity.11'  => 'nullable|required_with:stock_item_name.11|max:6',
            'alert_number.*' => 'nullable|max:6',
            'stock_expiration.*' => 'date|nullable'
        ]);

        
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