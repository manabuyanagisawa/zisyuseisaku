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
                            <input type="text" class="form-control" id="name" name="name" placeholder="商品名" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="price">値段</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="1000" value="{{ old('price') }}">
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
                                <input class="form-check-input" type="radio" id="inlineRadio03"  name="type" value="3" {{ old('type') == '3' ? 'checked' : '' }}>
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
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">登録内容確認</button>
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
