@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>商品詳細</h1>
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
                <form method="POST" action="{{ route('item.update', ['id' => $registered_item->id]) }}" onsubmit="return confirm('本当に更新しますか？')">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">商品名</label><br>
                            <input type="text" name="name" value="{{ $registered_item->name }}" class="w-75">
                            
                        </div>

                        <div class="form-group">
                            <label for="price">値段</label><br>
                            <input type="text" name="price" value="{{ $registered_item->price }}">
                        </div>

                        <div class="form-group">
                            <label for="type">種別</label><br>
                            {{ App\Models\Item::getTypeName(1);}}
                            <input type="radio" name="type" value="1" @if($registered_item->type === 1)checked="checked"@endif>
                            /{{ App\Models\Item::getTypeName(2);}}
                            <input type="radio" name="type" value="2" @if($registered_item->type === 2)checked="checked"@endif>
                            /{{ App\Models\Item::getTypeName(3);}}
                            <input type="radio" name="type" value="3" @if($registered_item->type === 3)checked="checked"@endif>
                            /{{ App\Models\Item::getTypeName(4);}}
                            <input type="radio" name="type" value="4" @if($registered_item->type === 4)checked="checked"@endif>
                            /{{ App\Models\Item::getTypeName(5);}}
                            <input type="radio" name="type" value="5" @if($registered_item->type === 5)checked="checked"@endif>
                        </div>

                        <div class="form-group">
                            <label for="brand">ブランド</label><br>
                            {{ App\Models\Item::getBrandName(1);}}
                            <input type="radio" name="brand" value="1" @if($registered_item->brand === 1)checked="checked"@endif>
                            /{{ App\Models\Item::getBrandName(2);}}
                            <input type="radio" name="brand" value="2" @if($registered_item->brand === 2)checked="checked"@endif>
                            /{{ App\Models\Item::getBrandName(3);}}
                            <input type="radio" name="brand" value="3" @if($registered_item->brand === 3)checked="checked"@endif>
                            /{{ App\Models\Item::getBrandName(4);}}
                            <input type="radio" name="brand" value="4" @if($registered_item->brand === 4)checked="checked"@endif>
                            /{{ App\Models\Item::getBrandName(5);}}
                            <input type="radio" name="brand" value="5" @if($registered_item->brand === 5)checked="checked"@endif>
                        </div>

                        <div class="form-group">
                            <label for="status">ステータス</label><br>
                            {{ App\Models\Item::getStatusName(1);}}
                            <input type="radio" name="status" value="1" @if($registered_item->status === 1)checked="checked"@endif>
                            /{{ App\Models\Item::getStatusName(2);}}
                            <input type="radio" name="status" value="2" @if($registered_item->status === 2)checked="checked"@endif>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">更新</button>
                    </div>
                </form>
                <div class="card-footer">
                        <form method="POST" action="{{ route('item.delete', ['id' => $registered_item->id]) }}" onsubmit="return confirm('本当に削除しますか？')">
                        @csrf
                        <button type="submit" class="btn btn-primary">削除</button>
                        </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
