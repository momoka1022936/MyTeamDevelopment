@extends('layouts.app')

@section('content')
<!-- ヘッダー -->
<header class="flex-md-nowrap border-bottom d-flex container-fluid m-0 row">
    <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-2 m-0">
        <span class="h2 text-dark text-center">買い物リスト<br>登録</span>
    </div>
    <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-3 m-0">
        <span class="h2 text-dark text-center">名前</span>
    </div>
    <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-2 m-0">
        <span class="h2 text-dark text-center">個数</span>
    </div>
    <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-4 m-0">
        <span class="h2 text-dark text-center">期限</span>
    </div>
</header>

<div class="container-fluid m-0 row">

    <!-- サイドメニュー -->
    <div class="d-flex flex-column flex-shrink-0  p-3 col-2 border-right" style=" height:600px;">
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item mt-4">
                <a href="{{ route('update-needs-form') }}" class="nav-link active" aria-current="page">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"/></svg>
                買い物リスト編集画面
                </a>
            </li>

            <li class="nav-item mt-2">
                <a href="{{ route('/home') }}" class="nav-link active" aria-current="page">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"/></svg>
                買い物リスト一覧へ
                </a>
            </li>

            <li class= "mt-2">    
                <button type="submit" form="list" class="btn btn-primary p-300 w-100" width="16" height="16">入力内容を登録する</button>
            </li>
        </ul>
        <hr>
        <a class="dropdown-item border border-2 rounded text-center " href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('ログアウト') }}
        </a>
    </div>

    <!-- メイン画面 -->

    <!-- 買い物リスト登録フォーム/一覧表示 -->
        
        @csrf
        <div class="flex-column px-0 py-3 d-flex col-3 border-right  border-left">
            <form id="list" method="post"  action="{{ route('needs.store') }}"  >
                <input type="hidden" class="mx-5" name="user_id" value="1">
                    <ul class="nav nav-pills flex-column mb-auto">
                            <!-- これで名前を登録できる。 -->
                        <input type="text" class="mx-5 px-2" name="need_item_name" value="">
                        <!-- これで登録された名前をすべて表示することができる。 -->
                        @foreach ($needs as $need)
                        <li class="nav-item text-center mb-3 border-bottom">{{ $need->need_item_name }}</li>
                        @endforeach
                    </ul>
            </form>       
        </div>

        <div class="flex-column  px-0 py-3 d-flex col-2 border-right ">
            <form id="list" method="post" action="{{ route('needs.store') }}"  >
            @csrf
                <!-- これで個数を登録できる。 -->
                <input type="number" class="mx-5 px2" name="quantity">
            </form>
                <ul class="nav nav-pills flex-column mb-auto">
                    <!-- これで登録された個数をすべて表示することができる。 -->
                    @foreach ($needs as $need)
                    <li class="nav-item text-center  mb-3 border-bottom">{{ $need->quantity }}</li>
                    @endforeach
                </ul>
        </div>

        <div class="flex-column px-0 py-3  d-flex col-4 border-right">
            <form id="list" method="post" action="{{ route('needs.store') }}"  >
                <ul class="nav nav-pills flex-column mb-auto">
                        <!-- これで期限を登録できる。 -->
                    <input type="date" class="mx-5 px-4" name="date_of_purchase">   
                    <!-- これで登録された期限をすべて表示することができる。 -->
                    @foreach ($needs as $need)
                    <li class="nav-item text-center  mb-3 border-bottom">{{ $need->date_of_purchase }}</li>
                    @endforeach
                </ul>
            </form>
        </div> 
      
</div> 
@endsection    
