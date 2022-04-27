@extends('layouts.app')

@section('content')
<!-- ヘッダー -->
<header class="flex-md-nowrap border-bottom d-flex container-fluid row ">
    <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-2 m-0 ">
        <span class="h5 text-dark text-center">買い物リスト<br>登録画面</span>
    </div>
    <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-3 m-0 ">
        <span class="h5 text-dark text-center mt-4 ">名前</span>
    </div>
    <div class="align-items-center mb-3 mb-md-0 me-md-auto  flex-column d-flex col-2 m-0">
        <span class="h5 text-dark text-center mt-4">個数</span>
    </div>
    <div class="align-items-center mb-3 mb-md-0 me-md-auto  flex-column d-flex col-4 m-0">
        <span class="h5 text-dark text-center mt-4">期限</span>
    </div>
    <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-1 m-0">
        <span class="h5 text-dark text-center mt-4">確認①</span>
    </div>

</header>

<div class="container-fluid m-0 row">

    <!-- サイドメニュー -->
    <div class="d-flex flex-column flex-shrink-0  p-3 col-2 " style=" height:600px;">
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="#" class="nav-link active text-primary bg-transparent" aria-current="page">
            <svg class="bi me-2 " width="16" height="16"><use xlink:href="#home"/></svg>
            買い物リストへ
            </a>
        </li>
        <li>
            <a href="{{ route('stocksRegister') }}" class="nav-link active link-dark mt-2 text-primary bg-transparent ">
            <svg class="bi me-2" width="16" height="16"></svg>
            入力した内容を登録する
            </a>
        </li>

        </ul>
        </a>
    </div>
    <!-- メイン画面 -->
    
    <!-- 買い物リスト登録フォーム -->
    <form method="post" class="form-inline mx-5" action="/needs/needsregister" >
        @csrf
        <input type="hidden" class="mx-5" name="id" value="ID"><br>
        <input type="text" class="mx-5" name="name" value="商品名"><br>
        <input type="number" class="mx-5" name="number"><br>
        <input type="date" class="mx-5" name="datetime">
        <p><input type="submit" class="mx-5" value="登録"></p>
    </form>
  
    </div>
</div>
@endsection
