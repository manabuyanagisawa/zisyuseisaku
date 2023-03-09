@extends('adminlte::page')

@section('title', '利用者一覧')

@section('content_header')
    <h1>利用者一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                <div class="row">
                <div class="col-md-1">
                    <h3 class="card-title">利用者一覧</h3>
                </div>
                </div><br>
                    <form action="{{ route('account.index') }}" method="GET">
                    <div class="justify-content-center row">
                        <div class="col-md-2">
                            <div class="form-group">
                            <input type="text" name="keyword" value="{{ $keyword }}" placeholder="名前検索" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                            <button type="submit" class="btn btn-default" name="search_button">検索</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        @if(count($search_users) === 0)
                        <p class="text-center pt-5">該当する利用者はいません。</p>
                        @else
                            <tr>
                                <th>ID</th>
                                <th>利用者名</th>
                                <th>アドレス</th>
                                <th>権限</th>
                                <th>更新</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($search_users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ App\Models\User::getRoleName($user->role);}}</td>
                                    <td><a href="{{ route('account.detail', ['id'=>$user->id]) }}" class="btn-sm btn-dark">更新</a></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <br>
                    <div class="d-flex justify-content-center">{{ $search_users->links('pagination::bootstrap-4') }}</div>
                </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
