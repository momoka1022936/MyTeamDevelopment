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

        return view('stocks.stocks', compact('week1','stock_expiration') ,$data);
    }

    //登録画面の表示
    public function stocksRegister()
    {
        return view('stocks.stocksRegister');
    }

    // stocksのテーブルに登録するための機能
    public function stockCreate(Request $request){

        // ここでフォームの内容を取得している
        $inputs = $request->input('user_id','stock_item_name','quantity','stock_expiration');
        // ここで、tokenを削除
        unset($inputs['_token']);

        // ここで配列登録している
        foreach ($inputs as $key => $value){
            $stock = new stock();
            $stock->user_id = $request->input('user_id')[$key];
            $stock->stock_item_name = $request->input('stock_item_name')[$key];
            $stock->quantity = $request->input('quantity')[$key];
            $stock->stock_expiration = $request->input('stock_expiration')[$key];
            $stock->save();
        }
        return redirect('/stocks');
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
            $stock->stock_expiration = $request->stock_expiration[$i];
            $stock->save();
            $i++;
        }
            
        return redirect('/stocks');
    }

    public function stockDelete(Request $request)
    {
      //チェックボックスでチェックしたidを取得
      $delete = array($request->input('delete'));

      //チェックしたidで1件ずつ削除する
      for($i=0; $i<count($delete); $i++){

          $this->delete($delete[$i]);
        }

    return redirect('/stocks');
    }


}