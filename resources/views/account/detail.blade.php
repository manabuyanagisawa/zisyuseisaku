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
                <form method="POST" action="{{ route('account.update', ['id' => $registered_user->id]) }}" onsubmit="return confirm('本当に更新しますか？')">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">名前</label><br>
                            <input type="text" name="name" value="{{ $registered_user->name }}" class="form-control w-50">
                        </div>

                        <div class="form-group">
                            <label for="email">アドレス</label><br>
                            <input type="text" name="email" value="{{ $registered_user->email }}" class="form-control w-50">
                        </div>

                        <div class="form-group">
                            <label for="role">権限</label><br>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio01">{{ App\Models\User::getRoleName(1);}}</label>
                            <input type="radio" name="role" value="1" @if($registered_user->role === 1)checked="checked"@endif>
                            </div>
                            <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineRadio02">{{ App\Models\User::getRoleName(2);}}</label>
                            <input type="radio" name="role" value="2" @if($registered_user->role === 2)checked="checked"@endif>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">更新</button>
                    </div>
                </form>
                <div class="card-footer">
                        <form method="POST" action="{{ route('account.delete', ['id' => $registered_user->id]) }}" onsubmit="return confirm('本当に削除しますか？')">
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
