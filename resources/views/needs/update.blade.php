@extends('layouts.app')

@section('content')
<!-- ヘッダー -->
<header class="flex-md-nowrap border-bottom d-flex container-fluid m-0 row">
    <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-2 m-0">
        <span class="h2 text-dark text-center">買い物リスト<br>編集</span>
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
    <div class="d-flex flex-column flex-shrink-0  p-3 col-2 " style=" height:600px;">
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('/home') }}" class="nav-link active" aria-current="page">
            <svg class="bi me-2" width="16" height="16"></svg>
            買い物リストへ
            </a>
        </li>
        <li>
            <a href="" class="nav-link active link-dark mt-2">
            <svg class="bi me-2" width="16" height="16"></svg>
            買い物リスト編集
            </a>
        </li>
        <li>
            <a href="#" class="nav-link active link-dark mt-2">
            <svg class="bi me-2" width="16" height="16"></svg>
            買い物リスト登録
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
    <div class="flex-column px-0 py-3 d-flex col-3 border-right  border-left">
        <ul class="nav nav-pills flex-column mb-auto">
            <!-- これで登録された名前をすべて表示することができる。 -->
            @foreach($needs as $need)
            <li class="nav-item text-center mb-3 border-bottom">{{ $need->need_item_name }}</li>
            @endforeach
        </ul>
    </div>
    <div class="flex-column  px-0 py-3 d-flex col-2 border-right ">
        <ul class="nav nav-pills flex-column mb-auto">
            <!-- これで登録された個数をすべて表示することができる。 -->
            @foreach($needs as $need)
            <li class="nav-item text-center  mb-3 border-bottom">{{ $need->quantity }}</li>
            @endforeach
        </ul>
    </div>
    <div class="flex-column px-0 py-3  d-flex col-4 border-right">
        <ul class="nav nav-pills flex-column mb-auto">
            <!-- これで登録された期限をすべて表示することができる。 -->
            @foreach($needs as $need)
            <li class="nav-item text-center  mb-3 border-bottom">{{ $need->date_of_purchase }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection