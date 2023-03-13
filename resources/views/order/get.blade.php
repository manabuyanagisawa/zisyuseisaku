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
                            @foreach($shops as $shop)
                            <option value="{{ $shop_names->id }}">{{ $shop_names->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary">移動先選択</button>
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
