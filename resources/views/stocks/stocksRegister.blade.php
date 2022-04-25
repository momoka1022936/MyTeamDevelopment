@extends('layouts.app')

@section('content')
<div class="container">
    <div class="title">在庫管理登録</div>
    <form action="/stockCreate" method="post">
        @csrf
        <div class="user-datails">
            <div class="input-box">
                <span class="details">ユーザー名</span>
                <input type="text" name="user_id" required>

                <span class="details">名前</span>
                <input type="text" name="stock_item_name" required>

                <span class="details">個数</span>
                <input class="minus" type="number" name="quantity" pattern="^[0-9]+$" required/>
                
                <span class="details">期限</span>
                <input type="date" name="stock_expiration">
            </div>
        </div>
        <div class="button">
            <input type="submit" value="登録する">
        </div>
    </form>
</div>
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