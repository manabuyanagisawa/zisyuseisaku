@extends('adminlte::page')

@section('title', '客注システム')

@section('content_header')
    <h1>客注システム/{{ $shop_names[$move_item->shop_id] }}</h1>
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
                <form method="POST" action="{{ route('order.lost', ['id' => $move_item->id]) }}">
                    @csrf
                    <div class="card-body">
                    <label>商品名:{{ $move_item->name }}</label><br>
                    <label>値段:¥{{ number_format($move_item->price) }}</label><br>
                    <label>アイテム:{{ App\Models\Item::getTypeName($move_item->type) }}</label><br>
                    <label>ブランド:{{ App\Models\Item::getBrandName($move_item->brand) }}</label><br>
                    <label>サイズ:@if(!empty($move_item->wear_size)){{ App\Models\Item::getSizeName($move_item->wear_size);}}@else - @endif</label><br>
                    <label>カラー:{{ App\Models\Item::getColorName($move_item->color) }}</label><br>
                    <label>シーズン:{{ $move_item->season }}</label><br><br>
                        <div class="form-group">
                            <label for="stock">▼移動数</label><br>
                            <input class="form-control w-25" type="text" name="move_stock" value="{{ old('move_stock') }}" placeholder="移動したい枚数を入力">
                        </div>
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary">移動店舗選択</button>
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
