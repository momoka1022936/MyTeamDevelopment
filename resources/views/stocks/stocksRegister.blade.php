@extends('layouts.app')

@section('content')
<header class="flex-md-nowrap border-bottom d-flex container-fluid m-0 row">
    <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-2">
        <span class="h2 text-center">在庫登録</span>
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
            <a href="{{ route('stocks') }}" class="nav-link active link-dark mt-2">
            <svg class="bi me-2" width="16" height="16"></svg>
            在庫一覧画面へ
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
    
    <form class="flex-column px-0 pt-3 d-flexborder-right col-3 border-left" action="/stockCreate" method="post">
        @csrf
            <input class="form-control" type="text" name="stock_item_name" required>
    </form>
    <form class="flex-column px-0 pt-3 d-flexborder-right col-2 border-left" action="/stockCreate" method="post">
        @csrf
            <input class="minus form-control" type="number" name="quantity" pattern="^[0-9]+$" required>
    </form>
    <form class="flex-column px-0 pt-3 d-flexborder-right col-4 border-left" action="/stockCreate" method="post">
        @csrf
            <input class="form-control" type="date" name="stock_expiration">
    </form>


<!-- これは個数のマイナス入力が出来ないようにするための機能 -->
<script>
    window.addEventListener('DOMContentLoaded', ()=>{
    document.querySelectorAll('.minus').forEach(x=>{
        x.addEventListener('input',()=>{
        var reg=/[^0-9]/g;
        var val=x.value;
        if(reg.test(val)){
            x.value=val.replace(reg,'');
        }
        });
    });
    });
</script>
@endsection