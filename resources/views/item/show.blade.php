@extends('adminlte::page')

@section('title', '商品詳細')

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

                    <div class="form-group" id="wearSize">
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
                    <div class="form-inline mb-3">
                        <div class="form-group">
                            <label for="season">シーズン</label><br>
                            <input class="form-control mx-sm-3" type="text" name="season" value="{{ $registered_item->season }}">
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">更新</button>
            </form>
            <form method="POST" action="{{ route('item.delete', ['id' => $registered_item->id]) }}" onsubmit="return confirm('本当に削除しますか？')">
                @csrf
                <button type="submit" class="btn btn-primary">削除</button>
            </form>
        </div>
        <hr class="border-2 border-secondary">
        <h3 class="mb-3 mt-4">在庫登録/在庫リスト</h3>
        <form method="POST" action="{{ route('item.create-stock', ['id' => $registered_item->id]) }}" onsubmit="return confirm('本当に登録しますか？')">
            @csrf
            <div class="form-inline">
                <div class="form-group mb-3">
                    <label for="shop_id">店舗</label>
                    <select name="shop_id" class="custom-select mx-sm-3">
                        @foreach ($shop as $shops)
                        <option value="{{ $shops->id }}" {{ $shops->id == $registered_item->shop_id ? 'selected' : '' }}>
                            {{ $shops->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="stock">在庫</label>
                    <input class="form-control mx-sm-3" type="number" name="stock" value="{{ $registered_item->stock }}">
                </div>
                <button type="submit" class="btn btn-primary mb-3">在庫追加</button>
        </form>
        <form method="POST" action="{{ route('item.reduce-stock', ['id' => $registered_item->id]) }}" onsubmit="return confirm('本当に登録しますか？')">
            @csrf
            <div class="form-inline ">
                <div class="form-group mb-1">
                    <label for="shop_id">店舗</label>
                    <select name="shop_id" class="custom-select mx-sm-3">
                        @foreach ($shop as $shops)
                        <option value="{{ $shops->id }}" {{ $shops->id == $registered_item->shop_id ? 'selected' : '' }}>
                            {{ $shops->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-1">
                    <label for="stock">在庫</label>
                    <input class="form-control mx-sm-3" type="number" name="stock" value="{{ $registered_item->stock }}">
                </div>
                <button type="submit" class="btn btn-secondary mb-1">在庫減算</button>
        </form>

        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    @if($inventories === null)
                    <p class="text-center pt-5">在庫がありません。</p>
                    @else
                    <tr>
                        <th>店舗名</th>
                        <th>在庫数</th>
                        <th>客注処理</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventories as $inventory)
                    @if($inventory->stock > 0)
                    <tr>
                        <td>{{ $inventory->shop->name }}</td>
                        <td>{{ $inventory->stock }}枚/個</td>
                        <td>
                            <form method="POST" action="{{ route('item.fluctuating-stock', ['id' => $registered_item->id]) }}" onsubmit="return confirm('本当に登録しますか？')">
                                @csrf
                                <div class="form-inline ">
                                    <div class="form-group mb-1">
                                        <label for="get_shop">店舗</label>
                                        <select name="get_shop" class="custom-select mx-sm-3">
                                            @foreach ($shop as $shops)
                                            @if($inventory->shop->name === $shops->name)
                                                <option value="{{ $shops->id }}" disabled style="display:none">{{ $shops->name }}</option>
                                            @else
                                                <option value="{{ $shops->id }}" {{ $shops->id == $registered_item->shop_id ? 'selected' : '' }}>
                                                    {{ $shops->name }}
                                                </option>
                                            @endif 
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label for="fluctuating_stock">在庫</label>
                                        <input class="form-control mx-sm-3" type="number" name="fluctuating_stock" value="">
                                    </div>
                                    <input type="hidden" name="move_shop" value="{{ $inventory->shop->id }}">
                                    <button type="submit" class="btn btn-success mb-1">客注処理</button>
                            </form>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
                @endif
            </table>
        </div>
    </div>
</div>
</div>


<script>
    function formSwitch() {
        var status = document.getElementsByName('type');
        if (status[2].checked) {
            // ウェアが選択されたら下記を実行します
            document.getElementById('wearSize').style.display = "";
        } else {
            // ウェアが選択されていない場合は非表示にします
            document.getElementById('wearSize').style.display = "none";
        }
    }

    // ページ読み込み時に実行
    window.addEventListener('load', function() {
        // 初期状態をチェックして表示・非表示を切り替える
        formSwitch();

        // ラジオボタンが変更された時に表示・非表示を切り替える
        var status = document.getElementsByName('type');
        for (var i = 0; i < status.length; i++) {
            status[i].addEventListener('change', formSwitch);
        }
    });
</script>

@stop

@section('css')
@stop

@section('js')
@stop