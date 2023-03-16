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
                            <label for="shop_id">店舗</label><br>
                            <select name="shop_id" class="custom-select w-25">
                            <option value="">選んでください</option>
                            @foreach($shop_names as $shop_name => $name)
                            <option value="{{ $shop_name }}">{{ $name }}</option>
                            @endforeach
                            </select>
                            <input type="hidden" name="moveItemId" value="{{ $move_item_id }}">
                            <input type="hidden" name="moveStock" value="{{ $move_stock }}">
                            <input type="hidden" name="name" value="{{ $move_item->name }}">
                            <input type="hidden" name="price" value="{{ $move_item->price }}">
                            <input type="hidden" name="type" value="{{ $move_item->type }}">
                            <input type="hidden" name="brand" value="{{ $move_item->brand }}">
                            <input type="hidden" name="wear_size" value="{{ $move_item->wear_size }}">
                            <input type="hidden" name="color" value="{{ $move_item->color }}">
                            <input type="hidden" name="season" value="{{ $move_item->season }}">
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
