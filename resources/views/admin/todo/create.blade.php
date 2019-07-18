@extends('layouts.admin')
@section('title', 'todoの新規作成')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>todo新規作成</h2>
                <a href="{{ action('Admin\TodoController@complete_list') }}">完了リスト</a>

                <form action="{{ action('Admin\TodoController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="title">タイトル</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="space">場所</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="space" value="{{ old('space') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="deadline">期限</label>
                        <div class="col-md-10">
                            <input type="datetime-local" class="form-control" name="deadline" value="{{ old('deadline') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="priority">重要度</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="priority" value="{{ old('priority') }}">
                        </div>
                    </div>


                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
        </div>
    </div>
@endsection
