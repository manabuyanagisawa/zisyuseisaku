@extends('adminlte::page')

@section('title', '入力内容確認')

@section('content_header')
    <h1>入力内容確認</h1>
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
                <form method="POST" action="{{ route('contact.send') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="shop">店舗名</label>
                            {{ $shop->name }}
                            <input type="hidden" id="shop" name="shop" value="{{ $inputs['shop'] }}">
                        </div>
                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            {{ $inputs['email'] }}
                            <input type="hidden" id="email" name="email" value="{{ $inputs['email'] }}">
                        </div>
                        <div class="form-group">
                            <label for="title">タイトル</label>
                            {{ $inputs['title'] }}
                            <input type="hidden" id="title" name="title" value="{{ $inputs['title'] }}">
                        </div>
                        <div class="form-group">
                            <label for="body">内容</label>
                            {!! nl2br(e($inputs['body'])) !!}
                            <input type="hidden" id="body" name="body" value="{{ $inputs['body'] }}">
                        </div>
                    <div class="card-footer">
                        <button type="submit" name="action" value="back" class="btn btn-primary">内容修正</button>
                        <button type="submit" name="action" value="submit" class="btn btn-primary">送信する</button>
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
