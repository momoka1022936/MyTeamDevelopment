@extends('layouts.app')

@section('content')
<div class="container">
        <div class="title">在庫管理登録</div>
        <form action="/stockCreate" method="post">
            @csrf
            <div class="user-details">
                <div class="input-box">
                    <span class="details">ユーザー名</span>
                    <input type="text" name="user_id" placeholder="Enter your name" required>

                    <span class="details">名前</span>
                    <input type="text" name="stock_item_name" placeholder="Enter your name" required>

                    <span class="details">個数</span>
                    <input type="number" name="quantity" placeholder="Enter your username" required>

                    <span class="details">期限</span>
                    <input type="date" name="stock_expiration" required>
                </div>
            </div>
            <div class="button">
                <input type="submit" value="登録する">
            </div>
        </form>
    </div>
@endsection