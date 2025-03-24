@extends('layouts.app')

@section('content_header')
    <h1>ユーザー一覧</h1>
@stop

@section('content_body')
    <div class="container=fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="card-tools">
                            <a class="btn btn-info" href="{{route('users.create')}}">新規作成</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ユーザーID</th>
                                    <th>ユーザー名</th>
                                    <th>年齢</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}} さん</td>
                                        <td>{{$user->age}} 才</td>
                                        <td>
                                            <a href="{{route('users.show', $user)}}" class="btn btn-info">詳細</a>
                                            <a href="{{route('users.edit', $user)}}" class="btn btn-warning">編集</a>
                                            <form action="{{ route('users.destroy', $user) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input class="btn btn-danger" type="submit" value="削除" />
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
