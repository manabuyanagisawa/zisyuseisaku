@extends('adminlte::page')

@section('title', '店舗登録')

@section('content_header')
    <h1>店舗登録</h1>
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
                <form method="POST" action="{{ route('shop.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">店舗名</label>
                            <input type="text" class="form-control w-50" id="name" name="name" placeholder="店舗名">
                        </div>
                    </div>
            </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">店舗登録</button>
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
