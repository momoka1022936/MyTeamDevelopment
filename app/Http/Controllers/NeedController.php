<?php

namespace App\Http\Controllers;

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
}
