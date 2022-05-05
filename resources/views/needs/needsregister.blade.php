@extends('layouts.app')

@section('content')
<!-- ヘッダー -->
<header class="flex-md-nowrap border-bottom d-flex container-fluid m-0 row">
    <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-2 m-0">
        <span class="h2 text-dark text-center">買い物リスト<br>登録画面</span>
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
    <div class="d-flex flex-column fle+x-shrink-0  p-3 col-2 border-right" style=" height:600px;">
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('/home') }}" class="nav-link active" aria-current="page">
            <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"/></svg>
            買い物リストへ
            </a>
        </li>
        <li class= "mt-2">    
            <button type="submit" form="list" class="btn btn-primary p-300" width="16" height="16">入力した内容を登録する</button>
        </li>

        </ul>
        </a>
    </div>
    <!-- メイン画面 -->
    <div>
    <!-- 買い物リスト登録フォーム -->
        <div>

            <form id="list" method="post" class="form-inline mx-5 d-flex align-items-start "  action="{{ route('needs.store') }}"  >
                @csrf
                <input type="hidden" class="mx-5" name="user_id" value="1">
                <input type="text" class="mx-5 px-2" name="need_item_name" value="">
                <input type="number" class="mx-5 px2" name="quantity">
                <input type="date" class="mx-5 px-4 " name="date_of_purchase">
            </form>
        </div>
        <div class="row">
        <!-- 入力フォーム一覧表示 -->
            <div class="flex-column px-0 py-3 d-flex col-3 border-right  border-left">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <!-- これで登録された名前をすべて表示することができる。 -->
                        @foreach ($needs as $need)
                        <li class="nav-item text-center mb-3 border-bottom">{{ $need->need_item_name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="flex-column  px-0 py-3 d-flex col-2 border-right ">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <!-- これで登録された個数をすべて表示することができる。 -->
                        @foreach ($needs as $need)
                        <li class="nav-item text-center  mb-3 border-bottom">{{ $need->quantity }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="flex-column px-0 py-3  d-flex col-4 border-right">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <!-- これで登録された期限をすべて表示することができる。 -->
                        @foreach ($needs as $need)
                        <li class="nav-item text-center  mb-3 border-bottom">{{ $need->date_of_purchase }}</li>
                        @endforeach
                    </ul>
                </div> 
            </div>
        </div> 
    </div>    
</div>     
