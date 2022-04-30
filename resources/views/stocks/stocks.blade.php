@extends('layouts.app')

@section('content')
<!-- ヘッダー -->
<header class="flex-md-nowrap border-bottom d-flex container-fluid m-0 row">
    <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-2">
        <span class="h2 text-center">在庫管理一覧</span>
    </div>
    <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-3">
        <span class="h2 text-center">名前</span>
    </div>
    <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-2 ">
        <span class="h2 text-center">在庫</span>
    </div>
    <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-4">
        <span class="h2 text-center">期限</span>
    </div>
</header>

<div class="container-fluid m-0 row">

    <!-- サイドメニュー -->
    <div class="d-flex flex-column flex-shrink-0  p-3 col-2 " style=" height:600px;">
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">
            <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"/></svg>
            在庫編集画面
            </a>
        </li>
        <li>
            <a href="{{ route('stocksRegister') }}" class="nav-link active link-dark mt-2">
            <svg class="bi me-2" width="16" height="16"></svg>
            在庫登録画面へ
            </a>
        </li>
        <li>
            <a href="#" class="nav-link active link-dark mt-2">
            <svg class="bi me-2" width="16" height="16"></svg>
            買い物リストへ
            </a>
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
    <div class="flex-column px-0 pt-3 d-flex col-3 border-right  border-left">
        <ul class="nav nav-pills flex-column mb-auto">
            <!-- これで登録された名前をすべて表示することができる。 -->
            @foreach ($stocks as $stock)
                <li class="nav-item text-center mb-3 border-bottom">{{ $stock->stock_item_name }}</li>
            @endforeach
        </ul>
    </div>
    <div class="flex-column  px-0 pt-3 d-flex col-2 border-right ">
        <ul class="nav nav-pills flex-column mb-auto">
            <!-- これで登録された個数をすべて表示することができる。 -->
            @foreach ($stocks as $stock)
                <li class="nav-item text-center  mb-3 border-bottom">{{ $stock->quantity }}</li>
            @endforeach
        </ul>
    </div>
    <div class="flex-column px-0 pt-3  d-flex col-4 border-right">
        <ul class="nav nav-pills flex-column mb-auto">
            <!-- これで登録された期限をすべて表示することができる。 -->
            @foreach ($stocks as $stock)
            <!-- このenptyでstock_expirationがnullの場合期限が設定されていないと出る。 -->
                @if (empty($stock->stock_expiration))
                    <li class="nav-item text-center  mb-3 border-bottom">期限が設定されていません</li>
                @else
                    <li class="nav-item text-center  mb-3 border-bottom">{{ $stock->stock_expiration }}</li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
@endsection
