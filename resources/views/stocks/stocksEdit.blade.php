@extends('layouts.app')
@section('content')
<header class="flex-md-nowrap border-bottom d-flex container-fluid m-0 row">
    <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-2">
        <span class="h2 text-center">編集画面</span>
    </div>
    <div class=" px-0 d-flex col-10 ml-2 row  border-right">
        <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-3">
            <span class="h2 text-center">名前</span>
        </div>
        <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-2">
            <span class="h2 text-center">在庫</span>
        </div>
        <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-3">
            <span class="h2 text-center">アラートまでの個数</span>
        </div>
        <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-3">
            <span class="h2 text-center">期限</span>
        </div>
    </div>
</header>
<div class="container-fluid m-0 row">
    <!-- サイドメニュー -->
    <div class="d-flex flex-column flex-shrink-0  p-3 col-2" style=" height:580px;">
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('stocksRegister') }}" class="nav-link active" aria-current="page">
                    <svg class="bi me-2" width="16" height="16"></svg>
                    在庫登録画面
                </a>
            </li>
            <li>
                <a href="{{ route('stocks') }}" class="nav-link active link-dark mt-2">
                    <svg class="bi me-2" width="16" height="16"></svg>
                    在庫一覧画面へ
                </a>
            </li>
            <li>
                <a href="{{ route('/home') }}" class="nav-link active link-dark mt-2">
                    <svg class="bi me-2" width="16" height="16"></svg>
                    買い物リストへ
                </a>
            </li>
            <div class="button nav-link active link-dark mt-2 p-0">
                <!-- 変更 -->
                <svg class="bi me-2" width="16" height="16"></svg>
                <input form="stockUpdate" class="btn btn-primary" type="submit" value="入力内容を変更する">
            </div>
            <div class="button nav-link active link-dark mt-2 p-0">
                <svg class="bi me-2" width="16" height="16"></svg>
                <!-- 削除 -->
                <input form="stockDelete" class="btn btn-primary" type="submit" value="選択したものを削除する">
            </div>
        </ul>
        <hr>
        <a class="dropdown-item border border-2 rounded text-center " href="{{ route('logout') }}" onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
            {{ __('ログアウト') }}
        </a>
    </div>
    <!-- メイン画面  -->
    <div class="px-0 d-flex col-10 border-left ml-2 row">
        <form id="stockUpdate" class="col-11 pt-3 form-inline-alignDelete" action="/stockUpdate" method="post">
            @csrf
            <!-- 名前の入力 -->
            <div class="col-3 border-right p-0 ">
                <?php $i = 0; ?>
                @foreach ($stocks as $stock)
                <ul class="border-bottom p-0 mx-2">
                    <input class="w-100 mb-2" type="hidden" name="id[]" value="{{$stock->id}}">
                    <input class="w-100 mb-2" type="text" name="stock_item_name[]" value="{{$stock->stock_item_name}}">
                    @if($errors->has("stock_item_name.{$i}"))
                    <p class="text-danger">{{$errors->first("stock_item_name.{$i}")}} </p>
                    @endif
                </ul>
                <?php $i++; ?>
                @endforeach
            </div>
            <!-- 個数の入力 -->
            <div class="minus col-3  border-right  p-0">
                <?php $i = 0; ?>
                @foreach ($stocks as $stock)
                <ul class="border-bottom p-0 mx-2">
                    <input class="w-100 mb-2 minus" type="number" name="quantity[]" value="{{$stock->quantity}}"
                        pattern="^[0-9]+$">
                    @if($errors->has("quantity.{$i}"))
                    <p class="text-danger">{{$errors->first("quantity.{$i}")}} </p>
                    @endif
                </ul>
                <?php $i++; ?>
                @endforeach
            </div>
            <!-- アラートまでの個数の入力 -->
            <div class="minus  col-3 p-0 border-right">
                <?php $i = 0; ?>
                @foreach ($stocks as $stock)
                <ul class="border-bottom p-0  mx-2">
                    <input class="w-100 mb-2 minus" type="number" name="alert_number[]" value="{{$stock->alert_number}}"
                        pattern="^[0-9]+$">
                    @if($errors->has("alert_number.{$i}"))
                    <p class="text-danger">{{$errors->first("alert_number.{$i}")}} </p>
                    @endif
                </ul>
                <?php $i++; ?>
                @endforeach
            </div>
            <!-- 期限の入力 -->
            <div class="col-3 mb-2 border-right">
                <?php $i = 0; ?>
                @foreach ($stocks as $stock)
                <ul class="border-bottom p-0 mx-2">
                    <input class="w-100 mb-2" type="date" name="stock_expiration[]"
                        value="{{ $stock->stock_expiration }}">
                    @if($errors->has('stock_expiration_'.$i))
                    <p class="text-danger">{{$errors->first('stock_expiration_'.$i)}} </p>
                    @endif
                </ul>
                <?php $i++; ?>
                @endforeach
            </div>
        </form>
        <!-- チェックボックス -->
        <form id="stockDelete" action="{{ route('stockDelete') }}"
            class="col-1 pt-3 form-inline-alignDelete border-right" method="post">
            @csrf
            @method('delete')
            <div class="ml-lg-3">
                @foreach ($stocks as $stock)
                <ul class="border-bottom">
                    <input class="mb-3 mx-lg-n4 mt-2" type="checkbox" name="id[]" value="{{ $stock->id }}">
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