@extends('layouts.app')

@section('content_header')
<h1>タスク詳細</h1>
@stop

@section('content_body')
    <div class="container=fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="card-tools">
                            <a class="btn btn-default" href="{{route('tasks.index')}}">戻る</a>
                            <a class="btn btn-warning" href="{{route('tasks.edit', $task)}}">編集</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="post">
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
                                    <th>タスクID</th>
                                    <td>{{$task->id}}</td>
                                </tr>
                                <tr>
                                    <th>タイトル</th>
                                    <td>{{$task->title}}</td>
                                </tr>
                                <tr>
                                    <th>内容</th>
                                    <td>{{$task->description}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop