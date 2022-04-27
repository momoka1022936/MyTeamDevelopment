<?php

namespace App\Http\Controllers\Needs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models;
use \routes\web;

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
}