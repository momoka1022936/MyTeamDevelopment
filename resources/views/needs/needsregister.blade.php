@extends('layouts.app')

@section('content')
<!-- ヘッダー -->
<header class="flex-md-nowrap border-bottom d-flex container-fluid row ">
    <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-2 m-0 ">
        <span class="h2 text-dark text-center">買い物リスト<br>登録画面</span>
    </div>
    <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-3 m-0 ">
        <span class="h2 text-dark text-center mt-4 ">名前</span>
    </div>
    <div class="align-items-center mb-3 mb-md-0 me-md-auto  flex-column d-flex col-2 m-0">
        <span class="h2 text-dark text-center mt-4">個数</span>
    </div>
    <div class="align-items-center mb-3 mb-md-0 me-md-auto  flex-column d-flex col-4 m-0">
        <span class="h2 text-dark text-center mt-4">期限</span>
    </div>
    
</header>

<div class="container-fluid m-0 row">

    <!-- サイドメニュー -->
    <div class="d-flex flex-column flex-shrink-0  p-3 col-2 border-right" style=" height:600px;">
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('/home') }}" class="nav-link active" aria-current="page">
            <svg class="bi me-2 " width="16" height="16"><use xlink:href="#home"/></svg>
            買い物リストへ
            </a>
        </li>
        <li class= "mt-2">    
            <button type="submit" form="list" class="btn btn-primary" width="16" height="16">入力した内容を登録する</button>
        </li>

        </ul>
        </a>
    </div>
    <!-- メイン画面 -->
    <div>
    <!-- 買い物リスト登録フォーム -->
        <div>
            <form id="list" method="post" class="form-inline mx-5 d-flex align-items-start"  action="{{ route('needs.store') }}"  >
                @csrf
                <input type="hidden" class="mx-5" name="user_id" value="1"><br>
                <input type="text" class="mx-5" name="need_item_name" value=""><br>
                <input type="number" class="mx-5" name="quantity"><br>
                <input type="date" class="mx-5 " name="date_of_purchase">
            </form>
        </div>
    <!-- 入力フォーム一覧表示 -->
        <div>   
            <table class="table width-100">

            @if (count($needs) > 0)
            @foreach($needs as $need)
                <tr>
                    <td class="nav-item text-center  mb-3 border-bottom border-right">{{$need->need_item_name}}</td>
                    <td class="nav-item text-center  mb-3 border-bottom border-right">{{$need->quantity}}</td>
                    <td class="nav-item text-center  mb-3 border-bottom border-right">{{$need->date_of_purchase}}</td>
                </tr>
            
            @endforeach
            @endif
            </tbody>
            </table>
            
            @endsection
        </div>    
    </div>       
