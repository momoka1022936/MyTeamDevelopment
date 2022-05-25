<?php

namespace App\Http\Controllers;

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

    public function register(Request $request)
    {
        /*$needs_createはデータベースのneedsから全てを取得,上から順に新しく登録した物が表示*/ 
        $needs_register = $request->user()->needs()->orderBy('created_at', 'desc')->get();
        /*needs.needsregisterに渡す、関数$needsregisterが使えるようにする*/
        return view('needs.needsRegister',['needs'=>$needs_register]);
    }



   


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**request*/
    public function store(Request $request){
        /**バリデーション（文字数100，個数は6桁まで、期限は過去不可）*/
        $request->validate([
            'need_item_name'=>'required | max:100',
            'quantity'=>'digits_between:1,6',
            'date_of_purchase'=>'date|after:today'
        ]);

    // /**５３Needsregisterの空データをつくる。 */
    // $needs= new Need();
    // /**request allで全部のデータ取得,$fillable（Needsregister.php）だけ取得そして保存 */
    // $needs->fill($request->all())->save();
    $request->user()->needs()->create([
        'need_item_name' => $request->need_item_name,
        'quantity' => $request->quantity,
        'date_of_purchase' => $request->date_of_purchase
    ]);

    return redirect('/needs/register');
    }
   
    public function show_by_user($id)
    {
        $user = Auth::user();
        $id = Auth::id();

        $user = User::find($id); 
        $records = Record::where('user_id',$user->id)->sortable()->get(); 


        if($user->id == $id){

        return view('record.showbyuser', [
            'user_name' => $user->name, 
            'records' => $records, 
        ]);
        }else{
            return redirect('/login');
        }

    }


    /**
     * 買い物リスト編集フォーム
     * @param Request $request
     */
    public function edit(Request $request)
    {
        $needs = $request->user()->needs()->get();
        $data = ['needs' => $needs];
        return view('needs.needsEdit', $data);
    }

    /**
     * 買い物リスト編集
     */
    public function update(Request $request)
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
    public function delete(Request $request)
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
