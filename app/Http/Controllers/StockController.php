<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Stock;


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

        // ここで一週間後の日付を取得
        $week1 = date("Y-m-d", strtotime("+1 week"));

        return view('stocks.stocks', [
            'week1' => $week1,
            'stocks' => $stocks,
        ]);
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
            'stock_item_name.0' => 'required|max:25|required_with:quantity.0',
            'stock_item_name.1'  => 'max:25|nullable|required_with:quantity.1',
            'stock_item_name.2'  => 'max:25|nullable|required_with:quantity.2',
            'stock_item_name.3'  => 'max:25|nullable|required_with:quantity.3',
            'stock_item_name.4'  => 'max:25|nullable|required_with:quantity.4',
            'stock_item_name.5'  => 'max:25|nullable|required_with:quantity.5',
            'stock_item_name.6'  => 'max:25|nullable|required_with:quantity.6',
            'stock_item_name.7'  => 'max:25|nullable|required_with:quantity.7',
            'stock_item_name.8'  => 'max:25|nullable|required_with:quantity.8',
            'stock_item_name.9'  => 'max:25|nullable|required_with:quantity.9',
            'stock_item_name.10'  => 'max:25|nullable|required_with:quantity.10',
            'stock_item_name.11'  => 'max:25|nullable|required_with:quantity.11',
            'quantity.0'  => 'required|numeric|min:0|digits_between:1,4|required_with:stock_item_name.0',
            'quantity.1'  => 'nullable|numeric|min:0|digits_between:1,4|required_with:stock_item_name.1',
            'quantity.2'  => 'nullable|numeric|min:0|digits_between:1,4|required_with:stock_item_name.2',
            'quantity.3'  => 'nullable|numeric|min:0|digits_between:1,4|required_with:stock_item_name.3',
            'quantity.4'  => 'nullable|numeric|min:0|digits_between:1,4|required_with:stock_item_name.4',
            'quantity.5'  => 'nullable|numeric|min:0|digits_between:1,4|required_with:stock_item_name.5',
            'quantity.6'  => 'nullable|numeric|min:0|digits_between:1,4|required_with:stock_item_name.6',
            'quantity.7'  => 'nullable|numeric|min:0|digits_between:1,4|required_with:stock_item_name.7',
            'quantity.8'  => 'nullable|numeric|min:0|digits_between:1,4|required_with:stock_item_name.8',
            'quantity.9'  => 'nullable|numeric|min:0|digits_between:1,4|required_with:stock_item_name.9',
            'quantity.10'  => 'nullable|numeric|min:0|digits_between:1,4|required_with:stock_item_name.10',
            'quantity.11'  => 'nullable|numeric|min:0|digits_between:1,4|required_with:stock_item_name.11',
            'stock_expiration.*' => 'nullable|date|after:today',
            'alert_number.*' => 'nullable|numeric|min:0|digits_between:1,4',
        ]);
        
        $i = 0;
        // 一度に入力できるフォームの数(12個)だけfor文を回す
        for($request->stock_item_name[$i]; $i < 12; $i++){
            if(is_null($request->stock_item_name[$i])){
                return redirect('/stocks');
            } else {
                // 登録
                $request->user()->stocks()->create([
                    'stock_item_name' => $request->stock_item_name[$i],
                    'quantity' => $request->quantity[$i],
                    'alert_number' => $request->alert_number[$i],
                    'stock_expiration' => $request->stock_expiration[$i],   
                ]);
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
        return view('stocks.stocksEdit', [
            'stocks' => $stocks
        ]);
    }

    /**
     * 在庫編集機能
     * 
     * @param Request $request
     */
    public function update(Request $request){

        // バリデーション
        // idをバリデート
        $this->validate($request, [
            'id' => "required|array"
        ]);

        $i = 0;
        for ($i = 0; $i < count($request->id); $i++) {
            // 配列として送られてきた各カラムの値を順番にチェック
            $this->validate($request, [                       
                "stock_item_name.{$i}" => "required|max:25",
                "quantity.{$i}" => "required|numeric|min:0|digits_between:1,4",
                "alert_number.{$i}" => 'nullable|numeric|min:0|digits_between:1,4',
                "stock_expiration.{$i}" => 'required|date|after:today',
            ], [
                // エラーメッセージのカスタマイズ
            ], [ 
                // attributesを上書き               
                "stock_item_name.{$i}" => '在庫名',
                "quantity.{$i}" => '在庫',
                "alert_number.{$i}" => 'アラートまでの個数',
                "stock_expiration.{$i}" => '期限',
                ]);
            $i++;
        }
        
        $i = 0;
        // $idの数だけ順番に更新
        foreach($request->id as $id){
            $stock = Stock::find($id);
            $stock->update([
                'stock_item_name' => $request->stock_item_name[$i],
                'quantity' => $request->quantity[$i],
                'alert_number' => $request->alert_number[$i],
                'stock_expiration' => $request->stock_expiration[$i],
            ]);           
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