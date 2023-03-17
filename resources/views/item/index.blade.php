@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                <div class="row">
                <div class="col-md-1">
                    <h3 class="card-title">商品一覧<span class="text-success">@if($user_role === 2):管理者@endif</span></h3>
                </div>
                <div class="col-md-1">
                    <div class="input-group-append">
                    @if($user_role === 2)
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-primary">商品登録</a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                </div>
                </div><br>
                    <form action="{{ route('item.index') }}" method="GET">
                    <div class="justify-content-center row">
                        <div class="col-md-2">
                            <div class="input-group input-group-sm">
                            <input type="text" name="keyword" value="{{ $keyword }}" placeholder="商品名検索" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="input-group input-group-sm">
                            <select name="type" value="{{ $type }}" data-toggle="select" class="custom-select">
                                <option value="">アイテム</option>
                                <option value="1">シューズ</option>
                                <option value="2">ボール</option>
                                <option value="3">ウェア</option>
                                <option value="4">バッグ</option>
                                <option value="5">アクセサリー</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="input-group input-group-sm">
                            <select name="brand" value="{{ $brand }}" data-toggle="select" class="custom-select">
                                <option value="">ブランド</option>
                                <option value="1">NIKE</option>
                                <option value="2">asics</option>
                                <option value="3">adidas</option>
                                <option value="4">NewBlance</option>
                                <option value="5">その他</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="input-group input-group-sm">
                            <select name="season" data-toggle="select" class="custom-select">
                                <option value="">シーズン</option>
                                <!-- 重複した内容は非表示 -->
                                @foreach($items->pluck('season')->unique() as $season)
                                <option value="{{ $season }}">{{ $season }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="input-group input-group-sm">
                            <select name="shop_id" data-toggle="select" class="custom-select">
                                <option value="">店舗</option>
                                <!-- 重複した内容は非表示 -->
                                @foreach($items->pluck('shop_id')->unique() as $shop_id)
                                <option value="{{ $shop_id }}">{{ $shop_names[$shop_id] ?? '-' }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="input-group input-group-sm">
                            <select name="stock" data-toggle="select" class="custom-select">
                                <option value="">在庫</option>
                                <option value="true">在庫あり</option>
                                <option value="0">欠品中</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="input-group">
                            <button type="submit" class="btn btn-sm btn-default" name="search_button">検索</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        @if(count($search_items) === 0)
                        <p class="text-center pt-5">該当する商品はありません。</p>
                        @else
                            <tr>
                                <th>ID</th>
                                <th>商品名</th>
                                <th>値段</th>
                                <th>アイテム</th>
                                <th>ブランド</th>
                                <th>サイズ</th>
                                <th>カラー</th>
                                <th>シーズン</th>
                                <th>店舗</th>
                                <th>在庫</th>
                                @if($user_role === 2)<th>更新</th>@endif 
                                <th>客注処理</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($search_items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>¥{{ number_format($item->price) }}</td>
                                    <td>{{ App\Models\Item::getTypeName($item->type);}}</td>
                                    <td>{{ App\Models\Item::getBrandName($item->brand);}}</td>
                                    <td>@if(!empty($item->wear_size)){{ App\Models\Item::getSizeName($item->wear_size);}}@else - @endif</td>
                                    <td>{{ App\Models\Item::getColorName($item->color);}}</td>
                                    <td>{{ $item->season }}</td>
                                    <td>{{ $shop_names[$item->shop_id] ?? '-' }}</td>
                                    <td>@if(!empty($item->stock))在庫あり@else<div style="color:#ff0000">欠品中</div>@endif</td>
                                    @if($user_role === 2)<td><a href="{{ route('item.detail', ['id'=>$item->id]) }}" class="btn-sm btn-dark">更新</a></td>@endif
                                    <td>@if(!empty($item->stock))<a href="{{ route('order.add', ['id'=>$item->id]) }}" class="btn-sm btn-success">客注</a>@else - @endif</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <br>
                    <div class="d-flex justify-content-center">{{ $search_items->links('pagination::bootstrap-4') }}</div>
                </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
