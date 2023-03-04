@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>登録内容確認</h1>
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
                <form method="POST" action="{{ route('item.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">商品名</label><br>
                            {{ $inquiry['name'] }}
                            <input type="hidden" name="name" value="{{ $inquiry['name'] }}">
                            
                        </div>

                        <div class="form-group">
                            <label for="price">値段</label><br>
                            {{ $inquiry['price'] }}
                            <input type="hidden" name="price" value="{{ $inquiry['price'] }}">
                        </div>

                        <div class="form-group">
                            <label for="type">種別</label><br>
                            {{ App\Models\Item::getTypeName($inquiry['type']);}}
                            <input type="hidden" name="type" value="{{ $inquiry['type'] }}">
                        </div>

                        <div class="form-group">
                            <label for="brand">ブランド</label><br>
                            {{ App\Models\Item::getBrandName($inquiry['brand']);}}
                            <input type="hidden" name="brand" value="{{ $inquiry['brand'] }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" value="back" name="action" class="btn btn-primary">登録内容修正</button>
                        <button type="submit" value="submit" name="action" class="btn btn-primary">登録する</button>
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
