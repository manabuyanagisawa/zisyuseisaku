@extends('adminlte::page')

@section('title', 'お問い合わせ')

@section('content_header')
    <h1>お問い合わせ</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                <form method="POST" action="{{ route('contact.confirm') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                        <label for="shop">店舗</label><br>
                                <select name="shop" class="custom-select w-25">
                                    <option value="">選んでください</option>
                                    @foreach($shop_names as $shop_name => $name)
                                    <option value="{{ $shop_name }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input type="text" class="form-control w-50" id="email" name="email" placeholder="xxxx@ysballa.com" value="{{ old('email') }}">
                        </div>
                        @if ($errors->has('email'))
                        <p class="error-message">{{ $errors->first('email') }}</p>
                        @endif
                        <div class="form-group">
                            <label for="title">タイトル</label>
                            <input type="text" class="form-control w-50" id="title" name="title" placeholder="新商品仕入れ希望" value="{{ old('title') }}">
                        </div>
                        @if ($errors->has('title'))
                        <p class="error-message">{{ $errors->first('title') }}</p>
                        @endif
                        <div class="form-group">
                            <label for="body">内容</label>
                            <textarea type="text" class="form-control w-50" id="body" name="body" placeholder="ジョーダンを仕入れたい etc">{{ old('body') }}</textarea>
                        </div>
                        @if ($errors->has('body'))
                        <p class="error-message">{{ $errors->first('body') }}</p>
                        @endif
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">内容確認</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
