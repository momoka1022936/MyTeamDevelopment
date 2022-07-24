@extends('layouts.app')

@section('content')
<!-- ヘッダー -->
<header class="flex-md-nowrap border-bottom d-flex container-fluid m-0 row">
    <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-2">
        <span class="h2 text-center">買い物リスト<br>編集</span>
    </div>
    <div class=" px-0 d-flex col-10 ml-2 row  border-right">
        <div class="col-11 pt-3 form-inline-alignDelete">
            <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-4">
                <span class="h2 text-center">名前</span>
            </div>
            <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-3">
                <span class="h2 text-center">個数</span>
            </div>
            <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-5">
                <span class="h2 text-center">期限</span>
            </div>
        </div>
        <div class="col-1 pt-3 form-inline-alignDelete"></div>
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
                <div class="button nav-link active link-dark mt-2 p-0">
                    <svg class="bi me-2" width="16" height="16"></svg>
                    <input form="needUpdate" class="btn btn-primary" type="submit" value="入力内容を変更する">
                </div>
            </li>
            <li>
                <div class="button nav-link active link-dark mt-2 p-0">
                    <svg class="bi me-2" width="16" height="16"></svg>
                    <input form="needDelete" class="btn btn-primary" type="submit" value="選択したものを削除する">
                </div>
            </li>
        </ul>
        <hr>
        <a class="dropdown-item border border-2 rounded text-center " href="{{ route('logout') }}">
            {{ __('ログアウト') }}
        </a>
    </div>
    <!-- メイン画面  -->
    <div class="flex-column-auto px-0 d-flex col-10 border-left ml-2 row">
        <form id="needUpdate" class="col-11 pt-3 form-inline-alignDelete mb-auto " action="{{ route('needs.update') }}"
            method="post">
            @csrf
            @foreach ($needs as $need)
            <!-- 名前の入力 -->
            <div class="col-4 border-right p-0 ">
                <ul class="border-bottom p-0 mx-3">
                    <input class="w-100 mb-2" type="hidden" name="id[{{$need->id}}]" value="{{ $need->id }}">
                    <input class="w-100 mb-2" type="text" name="need_item_name[{{$need->id}}]" value="{{ $need->need_item_name }}" required>
                    <!-- 25文字超えるとエラー表示 -->
                    @if($errors->has("need_item_name.$need->id"))
                    <p class="text-danger">{{$errors->first("need_item_name.$need->id")}} </p>
                    @endif
                </ul>

            </div>
            <!-- 個数の入力 -->
            <div class="minus col-3 border-right  p-0">

                <ul class="border-bottom p-0 mx-3">
                    <input class="w-100 mb-2 minus" name="quantity[{{$need->id}}]" value="{{ $need->quantity }}" required>
                    <!-- 4桁を超えるとエラー表示 -->
                    @if($errors->has("quantity.$need->id"))
                    <p class="text-danger">{{$errors->first("quantity.$need->id")}} </p>
                    @endif
                </ul>

            </div>
            <!-- 期限の入力 -->
            <div class="col-5 mb-0 border-right">

                <ul class="border-bottom p-0 mx-2">
                    <input class="w-100 mb-2 mt-0" type="date" name="date_of_purchase[{{$need->id}}]"
                        value="{{ $need->date_of_purchase }}" required>
                    <!-- 今日以前の日付を入力するとエラー表示 -->
                    @if($errors->has("date_of_purchase.$need->id"))
                    <p class="text-danger">{{$errors->first("date_of_purchase.$need->id")}}</p>
                    @endif
                </ul>
            </div>
            @endforeach
        </form>
        <form id="needDelete" action="{{ route('needs.delete') }}"
            class="col-1 pt-3 form-inline-alignDelete border-right" method="post">
            @csrf
            @method('delete')
            <!-- チェックボタン -->
            <div class="mb-2">
                @foreach ($needs as $need)
                <ul class="border-bottom mx-2">
                    <input class="mb-3 ml-lg-n3 mr-4 mt-2" id="delete" type="checkbox" name="id[]"
                        value="{{ $need->id }}">
                </ul>
                @endforeach
            </div>
        </form>
    </div>
    @endsection