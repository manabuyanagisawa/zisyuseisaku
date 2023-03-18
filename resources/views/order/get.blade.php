@extends('adminlte::page')

@section('title', '客注システム')

@section('content_header')
<h1>客注システム</h1>
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
                <form method="POST" action="{{ route('order.get') }}">
                    @csrf
                    <div class="card-body">
                    <div class="form-group">
                            <label for="shop_id">移動先店舗(キャンセルする場合は※客注キャンセルを選択)</label><br>
                            <select name="shop_id" class="custom-select w-25">
                            @foreach($shops as $shop)
                                @if($shop->id == $move_item->shop->id)
                                    <option value="{{ $shop->id }}">※客注キャンセル</option>
                                @else
                                    <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                                @endif
                            @endforeach                            </select>
                            <input type="hidden" name="moveItemId" value="{{ $move_item->id }}">
                            <input type="hidden" name="moveStock" value="{{ $move_stock }}">
                        </div>
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary">完了</button>
                    </div>
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
