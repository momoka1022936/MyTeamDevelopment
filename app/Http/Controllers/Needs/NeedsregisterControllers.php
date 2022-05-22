<?php

namespace App\Http\Controllers\Needs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models;
use \routes\web;
use App\Models\User;
use App\Models\Need; 
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\Contracts\LogoutResponse;


class NeedsregisterControllers extends Controller
{
    public function needsregister(Request $request)
    {
        /*$needsregisterはデータベースのneedsから全てを取得,上から順に新しく登録した物が表示*/ 
        $needsregister = $request->user()->needs()->orderBy('created_at', 'desc')->get();
        /*needs.needsregisterに渡す、関数$needsregisterが使えるようにする*/
        return view('needs.needsregister',['needs'=>$needsregister]);
    }


 /**
   * 登録フォーム
   *
   * @return \Illuminate\View\View
   */

  public function insert(Request $request) 
  {   
  // MOdelsからNeedsregisterModelをとってcreateでリクエストされた全部のレコードをつくってる
  User::create($request->all());
  // redirectで読み込みなおしをしてhomeにとぶようにしてくれる。return をviewにしたらそのままinsertでかえされてしまう。
      return redirect('/needs/home');
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

    return redirect('/needs/needsregister');
    }





    public function register()
    {
        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
            public function toResponse($request)
            {
                return redirect('/login');
            }
        });
    }



   
    ////未ログインの際はログイン画面へredirectされる
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

}    


