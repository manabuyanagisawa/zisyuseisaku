@extends('adminlte::page')

@section('title', '登録完了')

@section('content_header')
    <h1>登録完了しました。</h1>
@stop

@section('content')
    <p>商品の問い合わせは<a href="{{ route('contact.index') }}">こちら</a>から</p>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop
