@extends('layouts.app')

@section('content_header')
<h1>タスク一覧</h1>
@stop

@section('content_body')
    <div class="container=fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="card-tools">
                            <a class="btn btn-info" href="{{route('tasks.create')}}">新規作成</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>タスクID</th>
                                    <th>タイトル</th>
                                    <th>内容</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $task)
                                    <tr>
                                        <td>{{$task->id}}</td>
                                        <td>{{$task->title}}</td>
                                        <td>{{$task->description}}</td>
                                        <td>
                                            <a href="{{route('tasks.show', $task)}}" class="btn btn-info">詳細</a>
                                            <a href="{{route('tasks.edit', $task)}}" class="btn btn-warning">編集</a>
                                            <form action="{{ route('tasks.destroy', $task) }}" method="post">
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