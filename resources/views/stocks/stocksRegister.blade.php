@extends('layouts.app')

@section('content')
<header class="flex-md-nowrap border-bottom d-flex container-fluid m-0 row ">
    <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-2">
        <span class="h2 text-center">在庫登録</span>
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
        <div class="align-items-center mb-3 mb-md-0 me-md-auto flex-column d-flex col-4">
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
            <a href="{{ route('stocks.edit') }}" class="nav-link active" aria-current="page">
            <svg class="bi me-2" width="16" height="16"></svg>
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
            <a href="{{ route('/home') }}" class="nav-link active link-dark mt-2">
            <svg class="bi me-2" width="16" height="16"></svg>
            買い物リストへ
            </a>
        </li>
        <div class="button nav-link active link-dark mt-2">
            <!-- 登録ボタン -->
            <input form="path" class="btn btn-primary" type="submit" value="入力内容を登録する">
        </div>
        <div class="button nav-link active link-dark mt-2">
            <!-- 入力内容のリセットボタン -->
            <input form="path" class="btn btn-primary" type="reset" name="reset" value="入力内容をすべて消去" >
        </div>
        <div>
            
        </div>
        </ul>
        <hr>
        <a class="dropdown-item border border-2 rounded text-center " href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('ログアウト') }}
        </a>
    </div>

    <!-- メイン画面 -->
    <div class="flex-column px-0 d-flex col-10 border-left ml-2 row">
        <form  id="path" class="pt-3 form-inline-alignDelete" action="{{ route('stocks.store') }}" method="post">

            @csrf
            <!-- 名前の入力 -->
            <div class="col-3 border-right p-0 ">
                @for($i = 0; $i < 12; $i++)
                    <ul class="border-bottom p-0   mx-2">
                        <input class="w-100 mb-2" type="text" name="stock_item_name[]" value="{{ old('stock_item_name.'.$i) }}">
                        <input form="path" type="hidden" name="user_id[]">
                        @error('stock_item_name.'.$i)
                          <span class="invalid-feedback d-block fs-1">{{ $message }}</span>
                        @enderror
                    </ul>
                @endfor
            </div>
            <!-- 個数の入力 -->
            <div class="minus col-2  border-right  p-0">
            @for($i = 0; $i < 12; $i++)
                <ul class="border-bottom p-0 mx-2">
                    <input class="w-100 mb-2 minus" name="quantity[]" value="{{ old('quantity.'.$i) }}">
                    @error('quantity.'.$i)
                        <span class="invalid-feedback d-block fs-1">{{ $message }}</span>
                    @enderror
                </ul>
                
            @endfor
            </div>
            <!-- アラートまでの個数の入力 -->
            <div class="minus  col-3 m-0 border-right p-0">
            @for($i = 0; $i < 12; $i++)
                <ul class="border-bottom p-0  mx-2">
                    <input class="w-100 mb-2 minus" name="alert_number[]" value="{{ old('alert_number.'.$i) }}">
                    @error('alert_number.'.$i)
                        <span class="invalid-feedback d-block fs-1">{{ $message }}</span>
                    @enderror
                </ul>
                
            @endfor
            </div>
            <!-- 期限の入力 -->
            <div class="col-4 mb-2 pb-3 border-right p-0">
            @for($i = 0; $i < 12; $i++)
                <ul class="border-bottom p-0 mx-2">
                    <input class="w-100 mb-2" type="date" name="stock_expiration[]" value="{{ old('stock_expiration.'.$i) }}">
                    @error('stock_expiration.'.$i)
                        <span class="invalid-feedback d-block fs-1">{{ $message }}</span>
                    @enderror
                </ul> 
            @endfor
            </div>

        </form>
    </div>
@endsection