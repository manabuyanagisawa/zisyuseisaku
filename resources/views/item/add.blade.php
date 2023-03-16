@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>商品登録</h1>
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
                <form method="POST" action="{{ route('item.confirm') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">商品名</label>
                            <input type="text" class="form-control w-50" id="name" name="name" placeholder="商品名" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="price">値段</label>
                            <input type="text" class="form-control w-25" id="price" name="price" placeholder="1000" value="{{ old('price') }}">
                        </div>

                        <div class="form-group">
                            <label for="type">種別</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio01" name="type" value="1" {{ old('type') == '1' ? 'checked' : '' }} checked="checked">
                                <label class="form-check-label" for="inlineRadio01">シューズ</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio02"  name="type" value="2" {{ old('type') == '2' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio02">ボール</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio03"  name="type" value="3" {{ old('type') == '3' ? 'checked' : '' }} onclick="formSwitch()">
                                <label class="form-check-label" for="inlineRadio03">ウェア</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio04"  name="type" value="4" {{ old('type') == '4' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio04">バック</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio05"  name="type" value="5" {{ old('type') == '5' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio05">アクセサリー</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="brand">ブランド</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio01" name="brand" value="1" {{ old('brand') == '1' ? 'checked' : '' }} checked="checked">
                                <label class="form-check-label" for="inlineRadio01">NIKE</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio02"  name="brand" value="2" {{ old('brand') == '2' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio02">asics</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio03"  name="brand" value="3" {{ old('brand') == '3' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio03">adidas</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio04"  name="brand" value="4" {{ old('brand') == '4' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio04">NewBlance</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio05"  name="brand" value="5" {{ old('brand') == '5' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio05">その他</label>
                            </div>
                        </div>

                        <div class="form-group" id="wearSize">
                            <label for="wear_size">サイズ</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio01" name="wear_size" value="1" {{ old('wear_size') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio01">XS</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio02"  name="wear_size" value="2" {{ old('wear_size') == '2' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio02">S</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio03"  name="wear_size" value="3" {{ old('wear_size') == '3' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio03">M</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio04"  name="wear_size" value="4" {{ old('wear_size') == '4' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio04">L</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio05"  name="wear_size" value="5" {{ old('wear_size') == '5' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio05">XL</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="color">カラー</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio01" name="color" value="1" {{ old('color') == '1' ? 'checked' : '' }} checked="checked">
                                <label class="form-check-label" for="inlineRadio01">黒</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio02"  name="color" value="2" {{ old('color') == '2' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio02">赤</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio03"  name="color" value="3" {{ old('color') == '3' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio03">黄</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio04"  name="color" value="4" {{ old('color') == '4' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio04">青</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio05"  name="color" value="5" {{ old('color') == '5' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio05">緑</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio06"  name="color" value="6" {{ old('color') == '6' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio06">白</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio07"  name="color" value="7" {{ old('color') == '7' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio07">その他</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="season">シーズン</label><br>
                            <input class="form-control w-25" type="text" name="season" value="{{ old('season') }}">
                        </div>

                        <div class="form-group">
                            <label for="shop_id">店舗</label><br>
                            <select name="shop_id" class="custom-select w-25">
                            <option value="">選んでください</option>
                            @foreach($shops as $shop)
                            <option value="{{ $shop->id }}" @if($shop->id === (int)old('shop_id')) selected @endif >{{ $shop->name }}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="stock">在庫</label><br>
                            <input class="form-control w-25" type="text" name="stock" value="{{ old('stock') }}">
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">登録内容確認</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ウェアが表示された時のみサイズのラジオボタンが表示される -->
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
