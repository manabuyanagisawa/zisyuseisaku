@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>商品詳細</h1>
@stop

@section('content')
<div class="row">
    <div class="col-1">
        <h6><span class="badge rounded-pill bg-info text-dark">登録者</span> {{ $registered_user->name }}</h6>
    </div>
        @if(isset($update_user->name))
    <div class="col-1">
        <h6><span class="badge  rounded-pill bg-success">更新者</span> {{ $update_user->name }}</h6>
    </div>
    @endif
</div>
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
                            <input type="text" name="name" value="{{ $registered_item->name }}" class="form-control w-50">
                            
                        </div>

                        <div class="form-group">
                            <label for="price">値段</label><br>
                            <input type="text" name="price" value="{{ $registered_item->price }}" class="form-control w-25">
                        </div>

                        <div class="form-group">
                            <label for="type">種別</label><br>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio01">{{ App\Models\Item::getTypeName(1);}}</label>
                            <input type="radio" name="type" value="1" @if($registered_item->type === 1)checked="checked"@endif>
                            </div>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio02">{{ App\Models\Item::getTypeName(2);}}</label>
                            <input type="radio" name="type" value="2" @if($registered_item->type === 2)checked="checked"@endif>
                            </div>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio03">{{ App\Models\Item::getTypeName(3);}}</label>
                            <input type="radio" name="type" value="3" @if($registered_item->type === 3)checked="checked"@endif>
                            </div>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio04">{{ App\Models\Item::getTypeName(4);}}</label>
                            <input type="radio" name="type" value="4" @if($registered_item->type === 4)checked="checked"@endif>
                            </div>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio05">{{ App\Models\Item::getTypeName(5);}}</label>
                            <input type="radio" name="type" value="5" @if($registered_item->type === 5)checked="checked"@endif>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="brand">ブランド</label><br>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio01">{{ App\Models\Item::getBrandName(1);}}</label>
                            <input type="radio" name="brand" value="1" @if($registered_item->brand === 1)checked="checked"@endif>
                            </div>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio02">{{ App\Models\Item::getBrandName(2);}}</label>
                            <input type="radio" name="brand" value="2" @if($registered_item->brand === 2)checked="checked"@endif>
                            </div>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio03">{{ App\Models\Item::getBrandName(3);}}</label>
                            <input type="radio" name="brand" value="3" @if($registered_item->brand === 3)checked="checked"@endif>
                            </div>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio04">{{ App\Models\Item::getBrandName(4);}}</label>
                            <input type="radio" name="brand" value="4" @if($registered_item->brand === 4)checked="checked"@endif>
                            </div>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio05">{{ App\Models\Item::getBrandName(5);}}</label>
                            <input type="radio" name="brand" value="5" @if($registered_item->brand === 5)checked="checked"@endif>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="wear_size">サイズ</label><br>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio01">{{ App\Models\Item::getSizeName(1);}}</label>
                            <input type="radio" name="wear_size" value="1" @if($registered_item->wear_size === 1)checked="checked"@endif>
                            </div>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio02">{{ App\Models\Item::getSizeName(2);}}</label>
                            <input type="radio" name="wear_size" value="2" @if($registered_item->wear_size === 2)checked="checked"@endif>
                            </div>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio03">{{ App\Models\Item::getSizeName(3);}}</label>
                            <input type="radio" name="wear_size" value="3" @if($registered_item->wear_size === 3)checked="checked"@endif>
                            </div>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio04">{{ App\Models\Item::getSizeName(4);}}</label>
                            <input type="radio" name="wear_size" value="4" @if($registered_item->wear_size === 4)checked="checked"@endif>
                            </div>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio05">{{ App\Models\Item::getSizeName(5);}}</label>
                            <input type="radio" name="wear_size" value="5" @if($registered_item->wear_size === 5)checked="checked"@endif>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="color">カラー</label><br>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio01">{{ App\Models\Item::getColorName(1);}}</label>
                            <input type="radio" name="color" value="1" @if($registered_item->color === 1)checked="checked"@endif>
                            </div>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio02">{{ App\Models\Item::getColorName(2);}}</label>
                            <input type="radio" name="color" value="2" @if($registered_item->color === 2)checked="checked"@endif>
                            </div>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio03">{{ App\Models\Item::getColorName(3);}}</label>
                            <input type="radio" name="color" value="3" @if($registered_item->color === 3)checked="checked"@endif>
                            </div>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio04">{{ App\Models\Item::getColorName(4);}}</label>
                            <input type="radio" name="color" value="4" @if($registered_item->color === 4)checked="checked"@endif>
                            </div>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio05">{{ App\Models\Item::getColorName(5);}}</label>
                            <input type="radio" name="color" value="5" @if($registered_item->color === 5)checked="checked"@endif>
                            </div>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio06">{{ App\Models\Item::getColorName(6);}}</label>
                            <input type="radio" name="color" value="6" @if($registered_item->color === 6)checked="checked"@endif>
                            </div>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio07">{{ App\Models\Item::getColorName(7);}}</label>
                            <input type="radio" name="color" value="7" @if($registered_item->color === 7)checked="checked"@endif>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="season">シーズン</label><br>
                            <input class="form-control w-25" type="text" name="season" value="{{ $registered_item->season }}">
                        </div>

                        <div class="form-group">
                            <label for="shop_id">店舗</label><br>
                            <select name="shop_id" class="custom-select w-25">
                                @foreach ($shop as $shops)
                                    <option value="{{ $shops->id }}" {{ $shops->id == $registered_item->shop_id ? 'selected' : '' }}>
                                        {{ $shops->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="stock">在庫</label><br>
                            <input class="form-control w-25" type="text" name="stock" value="{{ $registered_item->stock }}">
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
