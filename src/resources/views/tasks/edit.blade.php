@extends('layouts.app')
@section('content_header')
    <h1>タスク編集</h1>
@stop

@section('content_body')
    <div class="container=fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="card-tools">
                            <a class="btn btn-default" href="{{route('tasks.show', $task)}}">戻る</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="callout callout-warning">
                            <h5>タスクの登録に失敗しました</h5>
                            @if ($errors->has('title'))
                                <p>{{ $errors->first('title') }}</p>
                            @endif
                            @if ($errors->has('description'))
                                <p>{{ $errors->first('description') }}</p>
                            @endif
                        </div>
                        @endif

                        <form action="{{route('tasks.update', $task)}}" method="post">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="title">タイトル</label>
                                <input type="text" name="title" class="form-control" value="{{old('title', $task->title)}}" placeholder="Laravelを勉強する">
                            </div>
                            <div class="form-group">
                                <label for="description">内容</label>
                                <textarea name="description" class="form-control" placeholder="入門ステップを完了してLaravelを学ぶ">{{old('description', $task->description)}}</textarea>
                            </div>
                            <input type="submit" value="更新" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop