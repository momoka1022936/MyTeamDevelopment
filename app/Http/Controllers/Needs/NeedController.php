<?php

namespace App\Http\Controllers\Needs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Need;
use Illuminate\Support\Facades\DB;

class NeedController extends Controller
{
    public function __construct()

    {
        $this->middleware('auth');
    }

    /**
     * 買い物リスト一覧
     * @param Request $request
     */
    public function index(Request $request)
    {
        $needs = $request->user()->needs()->get();
        $data = ['needs' => $needs];
        return view('needs.home', $data);
    }

    /**
     * 買い物リスト編集フォーム
     * @param Request $request
     */
    public function needEdit(Request $request)
    {
        $needs = $request->user()->needs()->get();
        $data = ['needs' => $needs];
        return view('needs.update', $data);
    }

    /**
     * 買い物リスト編集
     */
    public function needUpdate(Request $request)
    {

        // 入力フォームのバリデーション
        $request->validate([
            'id'=>'required|array',
            'need_item_name.*'=>'required|array',
            'need_item_name.*'=>'between:1,100',
            'quantity.*'=>'digits_between:1,6',
            'date_of_purchase.*'=>'date|after:today'

        ]);
        
        // 0番目から順番に配列の中身を見ていく
        $i = 0;
        
        foreach($request->id as $id){

            // $idでレコードを1件取得
            $need = Need::find($id);
            
            // 取得したレコードの各カラムの値を、リクエストで取得した値に書き換える
            $need->need_item_name = $request->need_item_name[$id];
            $need->quantity = $request->quantity[$id];
            $need->date_of_purchase = $request->date_of_purchase[$id];

            // 書き換えた値を保存
            $need->save();
            
           
            // 次の順番の配列へ
            $i++;
        }
        
        return redirect('/home');
    }

    /**
     * 買い物リスト削除
     */
    public function needDelete(Request $request)
    {
        
        // チェックボックスにチェックがないままでclickするとhomeに遷移
        try {
            $request->validate([
                'id'=>'required',
            ]);
        } catch (\Exception $e) {
            return redirect('/home');
        }
        

        foreach ($request->id as $id) {

            // checkboxからidを取得してレコードを探す
            $need = Need::find($id);
            // 削除
            $need->delete();
        }
        return redirect('/home');
    }
}
