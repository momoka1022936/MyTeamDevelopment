<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Stock;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;
use app\Rules\DateFormats;


class StockController extends Controller
{
    //
    public function __construct()

    {
        $this->middleware('auth');
    }
    
    /**
     * 在庫一覧
     * 
     * @param Request $request
     */
    public function stocks(Request $request)
    {
        
        $stocks = $request->user()->stocks()->orderBy('created_at', 'desc')->get();
        $data = ['stocks' => $stocks];

        // ここで一週間後の日付を取得
        $week1 = date("Y-m-d", strtotime("+1 week"));
        // ここで、stock_expirationのカラムのデータをすべて取得する。
        $stock_expiration = array_column($stocks, 'stock_expiration');
        // ここで、quantityのカラムのデータをすべて取得する。
        $quantity  = array_column($stocks, 'quantity');
        // ここで、alert_numberのカラムのデータをすべて取得する。
        $alert_number  = array_column($stocks, 'alert_number');

        return view('stocks.stocks', compact('week1','stock_expiration','alert_number', 'quantity') ,$data);
    }

    /**
     * 在庫登録フォーム
     */
    public function register()
    {
        return view('stocks.stocksRegister');
    }

    /**
     * 在庫登録機能
     * 
     * @param Request $request
     */
    public function store(Request $request){

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
            'stock_expiration.0' => 'required|date|after:today',
            'stock_expiration.1' => 'date|nullable|after:today|required_with:stock_item_name.1,quantity.1',
            'stock_expiration.2' => 'date|nullable|after:today|required_with:stock_item_name.2,quantity.2',
            'stock_expiration.3' => 'date|nullable|after:today|required_with:stock_item_name.3,quantity.3',
            'stock_expiration.4' => 'date|nullable|after:today|required_with:stock_item_name.4,quantity.4',
            'stock_expiration.5' => 'date|nullable|after:today|required_with:stock_item_name.5,quantity.5',
            'stock_expiration.6' => 'date|nullable|after:today|required_with:stock_item_name.6,quantity.6',
            'stock_expiration.7' => 'date|nullable|after:today|required_with:stock_item_name.7,quantity.7',
            'stock_expiration.8' => 'date|nullable|after:today|required_with:stock_item_name.8,quantity.8',
            'stock_expiration.9' => 'date|nullable|after:today|required_with:stock_item_name.9,quantity.9',
            'stock_expiration.10' => 'date|nullable|after:today|required_with:stock_item_name.10,quantity.10',
            'stock_expiration.11' => 'date|nullable|after:today|required_with:stock_item_name.11,quantity.11',
            'alert_number.*' => 'nullable|max:6',
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
                if($i == 11){
                    return redirect('/stocks');
                }
            }
        }            
    }

    /**
     * 在庫編集フォーム
     * 
     * @param Request $request
     */
    public function edit(Request $request){
        $stocks = $request->user()->stocks()->orderBy('created_at', 'desc')->get();
        $data = ['stocks' => $stocks];
        return view('stocks.stocksEdit', $data);
    }

    /**
     * 在庫編集機能
     * 
     * @param Request $request
     */
    public function update(Request $request){

        // バリデーション
        $i = 0;
        foreach ($request->id as $id) {
            // 配列として送られてきた各カラムの値を順番にチェック
            $this->validate($request, [                       
                "stock_item_name.{$i}" => "required|max:100",
                "quantity.{$i}" => "required|max:6",
                "alert_number.{$i}" => 'nullable|max:6',
                "stock_expiration.{$i}" => 'required|date|after:today',
            ], [], [                
                "stock_item_name.{$i}" => '在庫名',
                "quantity.{$i}" => '在庫',
                "alert_number.{$i}" => 'アラートまでの個数',
                "stock_expiration.{$i}" => '期限',
                ]);
            $i++;
        }
        
        // 更新
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

    /**
     * 在庫削除機能
     * 
     * @param Request $request
     */
    public function delete(Request $request){

    // チェックボックスが一つもチェックされていない場合、ホーム画面にリダイレクト
    if (!isset($request->id)) {
        return redirect('/stocks');
    }

    foreach ($request->id as $id) {
        // checkboxからidを取得してレコードを探す
        $stock = Stock::find($id);
        // 削除
        $stock->delete();
    }

    return redirect('/stocks');
    
    }  
}