<?php

namespace App\Http\Controllers\Needs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models;
use \routes\web;
use App\Models\Needsregister; 
use Illuminate\Support\Facades\DB;


class NeedsregisterControllers extends Controller
{
    public function needsregister()
    {
        /*$needsregisterはデータベースのneedsから全てを取得する*/ 
        $needsregister = DB::table('needs')->get();
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
  // MOdelsからNeedsregisretModelをとってcreateでリクエストされた全部のレコードをつくってる
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
    /**５３Needsregisterの空データをつくる。 */
    $needs= new Needsregister();
    /**request allで全部のデータ取得,$fillable（Needsregister.php）だけ取得そして保存 */
    $needs->fill($request->all())->save();

    return redirect('/needs/needsregister');
}


}