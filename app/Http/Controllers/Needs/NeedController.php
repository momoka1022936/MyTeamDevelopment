<?php

namespace App\Http\Controllers\Needs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Need;
use Illuminate\Support\Facades\DB;

class NeedController extends Controller
{
    /**
     * 買い物リスト一覧
     */
    public function index()
    {
        $needs = DB::select('select * from needs');
        $data = ['needs' => $needs];
        return view('needs.home', $data);
    }

    /**
     * 買い物リスト編集フォーム
     */
    public function updateForm()
    {
        $needs = DB::select('select * from needs');
        $data = ['needs' => $needs];
        return view('needs.update', $data);
    }
}
