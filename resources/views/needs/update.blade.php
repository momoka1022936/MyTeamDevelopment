@extends('layouts.app')

@section('content')
<!-- ヘッダー -->
<header class="flex-md-nowrap border-bottom d-flex container-fluid m-0 row">
    <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-2">
        <span class="h2 text-center">買い物リスト<br>編集</span>
    </div>
    <div class=" px-0 d-flex col-10 ml-2 row  border-right">
        <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-3">
            <span class="h2 text-center">名前</span>
        </div>
        <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-3">
            <span class="h2 text-center">個数</span>
        </div>
        <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-5">
            <span class="h2 text-center">期限</span>
        </div>
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
                <a href="{{ route('needUpdate') }}" class="nav-link active link-dark mt-2">
                    <svg class="bi me-2" width="16" height="16"></svg>
                    <input form="needUpdate" class="btn btn-primary" type="submit" value="入力内容を変更する">
                </a>
            </li>
            <li>
                <a href="{{ route('needDelete') }}" class="nav-link active link-dark mt-2 p-0">
                    <svg class="bi me-2" width="16" height="16"></svg>
                    <input form="needDelete" class="btn btn-primary" type="submit" value="選択したものを削除する">
                </a>
            </li>
        </ul>
        <hr>
        <a class="dropdown-item border border-2 rounded text-center " href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('ログアウト') }}
        </a>
    </div>
    <!-- メイン画面  -->
    <div class="flex-column px-0 d-flex col-10 border-left ml-2 row">
        <form id="needUpdate" class="col-11 pt-3 form-inline-alignDelete" action="{{ route('needUpdate') }}" method="post">
            @csrf
            <!-- 名前の入力 -->
            <div class="col-4 border-right p-0 ">
                @foreach ($needs as $need)
                <ul class="border-bottom p-0 mx-3">
                    <input class="w-100 mb-2" type="hidden" name="id[]" value="{{ $need->id }}">
                    <input class="w-100 mb-2" type="text" name="need_item_name[]" value="{{ $need->need_item_name }}">
                </ul>
                @endforeach
            </div>
            <!-- 個数の入力 -->
            <div class="minus col-3  border-right  p-0">
                @foreach ($needs as $need)
                <ul class="border-bottom p-0 mx-3">
                    <input class="w-100 mb-2 minus" type="number" name="quantity[]" value="{{ $need->quantity }}">
                </ul>
                @endforeach
            </div>
            <!-- 期限の入力 -->
            <div class="col-5 mb-3 border-right">
                @foreach ($needs as $need)
                <ul class="border-bottom p-0 mx-2">
                    <input class="w-100 mb-2" type="date" name="date_of_purchase[]"
                        value="{{ $need->date_of_purchase }}">
                </ul>
                @endforeach
            </div>
        </form>
        <form id="needDelete" action="{{ route('needDelete') }}" class="col-1 pt-3 form-inline-alignDelete border-right" method="post">
            @csrf
            @method('delete')
            <div class="mb-2">
                @foreach ($needs as $need)
                <ul class="border-bottom mx-2">
                    <input class="mb-3 ml-lg-n3 mr-4 mt-2" id="delete" type="checkbox" name="id[]" value="{{ $need->id }}">
                </ul>
                @endforeach
            </div>
        </form>
    </div>
    <!-- これは個数のマイナス入力が出来ないようにするための機能 -->
    <script>
    window.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.minus').forEach(x => {
            x.addEventListener('input', () => {
                var reg = /[^0-9]/g;
                var val = x.value;
                if (reg.test(val)) {
                    x.value = val.replace(reg, '');
                }
            });
        });
    });
    </script>
    @endsection