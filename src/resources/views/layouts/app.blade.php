@extends('adminlte::page')

@section('content_top_nav_right')
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            @if(Auth::check())
                <!-- ログアウトフォーム -->
                <form id="logout-form" action="{{ route('login.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <a class="nav-link" href="#" onclick="document.getElementById('logout-form').submit();">
                        ログアウト
                    </a>
                </form>
            @else
                <a class="nav-link" href="{{ route('login.create') }}">ログイン</a>
            @endif
        </li>
    </ul>
@stop

@section('title', 'Dashboard')

@section('content_header')
    <h1>ダッシュボード</h1>
@stop

@section('content')
    <p>最初のページ</p>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @yield('content_body')
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
