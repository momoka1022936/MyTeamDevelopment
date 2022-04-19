@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="row justify-content-center col-xl-12 ">
        <div class="col-md-8 border-bottom-1 pl-1">
            <div class="card border "> 
                <div class="card-header text-body text-center border-bottom-1 bg-transparent">{{ __('家庭用在庫管理システム
                    ') }}</div>

                    <div class="card-body pb-2 bg-white">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row   ">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('ID') }}</label>                               
                                <div class="col-md-8 m-auto ">    
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror  

                                </div>        
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('パスワード') }}</label>
                                <div class="col-md-8 m-auto">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>   

                            <div class="form-group row mb-0 mx-auto bg-white pl-3">
                                <div class="offset-md-4 py-3 px-4 col-lg-6 col-xl-6">
                                    <button type="submit" class="btn btn-dark-none btn-primary">
                                        {{ __('ログイン') }}
                                    </button>
                                    <a href="register.blade.php" class="btn btn-primary">会員登録</a>
                                </div>
                            </div>    
                        </form>                          
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

