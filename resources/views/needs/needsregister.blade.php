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
    <div class="flex-column px-0 py-3 d-flex col-3 border-right  border-left">
        <ul class="nav nav-pills flex-column mb-auto">
            <!-- これで登録したい商品を入力できる。 -->
            {{-- @foreach ($stocks as $stock) --}}
            <li class="nav-item text-center mb-3 border-bottom">{{-- $stock->stock_item_name --}}</li>
            {{-- @endforeach --}}
        </ul>
    </div>
    <div class="flex-column  px-0 py-3 d-flex col-2 border-right ">
        <ul class="nav nav-pills flex-column mb-auto">
            <!-- これで登録したい個数を入力できる。 -->
            {{-- @foreach ($stocks as $stock)--}}
            <li class="nav-item text-center  mb-3 border-bottom">{{-- $stock->quantity --}}</li>
            {{-- @endforeach --}}
        </ul>
    </div>
    <div class="flex-column px-0 py-3  d-flex col-4 border-right">
        <ul class="nav nav-pills flex-column mb-auto">
            <!-- これでいつまでに購入するか設定できる。 -->
            {{-- @foreach ($stocks as $stock) --}}
            <li class="nav-item text-center  mb-3 border-bottom">{{-- $stock->stock_expiration --}}</li>
            {{-- @endforeach --}}
        </ul>
    </div>
    <div class="flex-column px-0 py-3  d-flex col-1 border-right">
        <ul class="nav nav-pills flex-column mb-auto">
            <!-- これでこの列に入力した内容を取り消せる。 -->
            {{-- @foreach ($stocks as $stock) --}}
            <li class="nav-item text-center  mb-3 border-bottom">{{-- $stock->stock_expiration --}}</li>
            {{-- @endforeach --}}
        </ul>
    </div>
</div>
@endsection
