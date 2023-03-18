@extends('adminlte::page')

@section('title', '客注キャンセル')

@section('content_header')
    <h1>客注をキャンセルしました。</h1>
@stop

@section('content')
    <p>商品の問い合わせは<a href="{{ route('contact.index') }}">こちら</a>から</p>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop
