<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Need;
use Illuminate\Support\Facades\Auth;

class NeedController extends Controller
{
    public function __construct()

    {
        $this->middleware('auth');
    }

    /**
     * 買い物リスト一覧
     * 
     * @param Request $request
     */
    public function index(Request $request)
    {
        $needs = $request->user()->needs()->orderBy('created_at', 'desc')->get();
        return view('needs.home', [
            'needs' => $needs
        ]);
    }

    /**
     * 買い物リスト登録フォーム
     * 
     * @param Request $request
     */
    public function register(Request $request)
    {
        // $needs_createはデータベースのneedsから全てを取得,上から順に新しく登録した物が表示
        $needs_register = $request->user()->needs()->orderBy('created_at', 'desc')->get();
        // viewsに表示用の変数を渡す
        return view('needs.needsRegister',[
            'needs' => $needs_register
        ]);
    }

    /**
     * 買い物リスト登録機能
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request){
        // バリデーション（文字数25，個数は4桁まで、期限は過去不可）
        $request->validate([
            'need_item_name'=>'required|max:25',
            'quantity'=>'required|numeric|min:0|digits_between:1,4',
            'date_of_purchase'=>'date|after:today'
        ]);

        // 登録
        $request->user()->needs()->create([
        'need_item_name' => $request->need_item_name,
        'quantity' => $request->quantity,
        'date_of_purchase' => $request->date_of_purchase
    ]);

    return redirect('/needs/register');
    }
   

    /**
     * 買い物リスト編集フォーム
     * 
     * @param Request $request
     */
    public function edit(Request $request)
    {
        $needs = $request->user()->needs()->get();
        return view('needs.needsEdit', [
            'needs' => $needs
        ]);
    }

    /**
     * 買い物リスト編集
     * 
     * @param Request $request
     */
    public function update(Request $request)
    {

        // 入力フォームのバリデーション
        $request->validate([
            'id'=>'required|array',
            'need_item_name.*'=>'required|array',
            'need_item_name.*'=>'required|max:25',
            'quantity.*'=>'required|numeric|min:0|digits_between:1,4',
            'date_of_purchase.*'=>'date|after:today'
        ]);
        
        // 0番目から順番に配列の中身を見ていく
        $i = 0;
        
        foreach($request->id as $id){

            // $idでレコードを1件取得
            $need = Need::find($id);
            // 作成
            $need->update([
            'need_item_name' => $request->need_item_name[$id],
            'quantity' => $request->quantity[$id],
            'date_of_purchase' => $request->date_of_purchase[$id],
            ]);
            // 次の順番の配列へ
            $i++;
        }
        
        return redirect('/home');
    }

    /**
     * 買い物リスト削除
     * 
     * @param Request $request
     */
    public function delete(Request $request)
    {
        
        // チェックボックスにチェックがないままでclickするとhomeに遷移
        try {
            // 可能性のあるケース
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
