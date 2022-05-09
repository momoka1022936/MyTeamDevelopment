@extends('layouts.app')

@section('content')
<!-- ヘッダー -->
<header class="flex-md-nowrap border-bottom d-flex container-fluid m-0 row">
    <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-2 ">
        <span class="h2 text-dark text-center">買い物リスト<br>登録</span>
    </div>
    <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-3 ">
        <span class="h2 text-dark text-center">名前</span>
    </div>
    <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-3 ">
        <span class="h2 text-dark text-center">個数</span>
    </div>
    <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-3">
        <span class="h2 text-dark text-center">期限</span>
    </div>

</header>

<div class="container-fluid m-0 row">

    <!-- サイドメニュー -->
    <div class="d-flex flex-column flex-shrink-0  p-3 col-2" style=" height:600px; border-none">
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item mt-4 mt-auto border-0 pt-0">
                <a href="{{ route('needEdit') }}" class="nav-link active" aria-current="page">
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
                <button type="submit" form="list" class="btn btn-primary p-300 w-100" width="16" height="16" >入力内容を登録する</button>
            </li>
        </ul>
        <hr>
        <a class="dropdown-item border border-2 rounded text-center " href="{{ route('logout') }}">
            {{ __('ログアウト') }}
        </a>
    </div>

    <!-- メイン画面 -->

    <!-- 買い物リスト登録フォーム/一覧表示 -->
    <div class="flex-column px-0 d-flex col-9  ml-2 row text-center">
        <form id="list" method="post" class="row border-left" action="{{ route('needs.store') }}" >
            @csrf
            <div class="col-4 border-right p-0  ">
                <input type="hidden" class="mx-5 px-4" name="user_id" value="1">
                
                    <!-- これで名前を登録できる。requiredで、未入力時エラー表示される -->
                <input type="text" class="mx-auto px-2 my-1" name="need_item_name" value="" required="required">
                <ul class="nav nav-pills flex-column mb-auto ">
                    <!-- これで登録された名前をすべて表示することができる。 -->
                    @foreach ($needs as $need)
                    <li class="nav-item text-center mb-3 border-bottom " id="first" >{{ $need->need_item_name }}</li>
                    @endforeach
                </ul>       
            </div>

            <div class="col-4 border-right p-0  ">
                    <!-- これで個数を登録できる。input_fieldで、－入力が不可 -->
                <input type="number" min="0" class="mx-auto px4 my-1 input_field" name="quantity" required="required">
                <ul class="nav nav-pills flex-column mb-auto ">
                    <!-- これで登録された個数をすべて表示することができる。 -->
                    @foreach ($needs as $need)
                    <li class="nav-item text-center  mb-3 border-bottom" id="first">{{ $need->quantity }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="col-4 border-right p-0 ">
                <!-- これで期限を登録できる。 -->
                <input type="date" class="mx-auto px-4 my-1" name="date_of_purchase" required="required">
                <ul class="nav nav-pills flex-column mb-auto ">
                    <!-- これで登録された期限をすべて表示することができる。 -->
                    @foreach ($needs as $need)
                    <li class="nav-item text-center  mb-3 border-bottom" id="first">{{ $need->date_of_purchase }}</li>
                    @endforeach
                </ul>
            </div>
        </form>
    </div> 

    <!-- これは個数のマイナス入力が出来ないようにするための機能 -->
    <script>
        window.addEventListener('DOMContentLoaded', ()=>{
        document.querySelectorAll('.input_field').forEach(x=>{
            x.addEventListener('input',()=>{
            var reg=/[^1-9]/g;
            var val=x.value;
            if(reg.test(val)){
                x.value=val.replace(reg,'');
            }
            });
        });
        });
    </script>
</div>

<!-- 入力フォームの下を調整するため// -->
<style>
    #first:first-child{
        border-top: 1px solid #dee2e6;
        padding-top: 15px;
    }
</style>
@endsection