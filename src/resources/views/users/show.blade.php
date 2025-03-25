@extends('layouts.app')

@section('content_header')
    <h1>{{ $show_title }}</h1>
@stop

@section('content_body')
    <div class="container=fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="card-tools">
                            <a class="btn btn-default" href="{{route('users.index')}}">戻る</a>
                            <a class="btn btn-warning" href="{{route('users.edit', $user)}}">編集</a>
                            <form action="{{ route('users.destroy', $user) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="削除" />
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>ユーザーID</th>
                                    <td>{{$user->id}}</td>
                                </tr>
                                <tr>
                                    <th>ユーザー名</th>
                                    <td>{{$user->name}} さん</td>
                                </tr>
                                <tr>
                                    <th>年齢</th>
                                    <td>{{$user->age}} 才</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
