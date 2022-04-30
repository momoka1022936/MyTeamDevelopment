<?php

namespace App\Http\Controllers\Needs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models;
use \routes\web;
use App\Models\Needsregister; 
class NeedsregisterControllers extends Controller
{
    public function needsregister()
    {
        return view('needs.needsregister');
    }


//登録画面の作成をしたい。。。
 /**
   * 登録フォーム
   *
   * @return \Illuminate\View\View
   */
  public function create()
  {
  // まだ登録されているuserはないので、空っぽのUserインスタンスをViewに渡す
      
      return view('needs/needsregister');
  }

  //登録画面からリストに追加。。
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
    public function store(Request $request){
        $needs= new Needsregister();
        $needs->fill($request->all())->save();
    }


}