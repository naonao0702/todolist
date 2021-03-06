@extends('layouts.admin')
@section('title', '登録済み予定の一覧')

@section('content')
<div class="container">
  <div class="row">
    <h2>予定完了一覧</h2>
    <a href="{{ action('Admin\TodoController@index') }}">予定一覧へ</a>
    <a href="{{ action('Admin\TodoController@dead_list') }}">期限切れ予定一覧</a>


  </div>
  <div class="row">
    <div class="col-md-4">
      <a href="{{ action('Admin\TodoController@add') }}" role="button" class="btn btn-primary">新規作成</a>
    </div>
    <div class="col-md-8">
      <form action="{{ action('Admin\TodoController@index') }}" method="get">
        <div class="form-group row">
          <div class="col-8">

          </div>
          <div class="col-md-2">
            {{ csrf_field() }}
          </div>


        </div>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="list-news col-md-12 mx-auto">
      <div class="row">
        <table class="table table-dark">
          <thead>
            <tr>
              <th width="10%">ID</th>
              <th width="20%">タイトル</th>
              <th width="50%">本文</th>
            </tr>
          </thead>
          <tbody>
            @foreach($posts as $todo)
            @if($todo->priority == 5)
            <tr class="priority-todo">
              @endif
              <th>{{ $todo->id }}</th>
              <td>{{ str_limit($todo->title, 100) }}</td>
              <td>{{ str_limit($todo->space, 250) }}</td>
              <td>
              <div>
                <a href="{{ action('Admin\TodoController@incomplete', ['id' => $todo->id]) }}">未完了</a>
              </div>

            </td>
          </tr>

        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>
</div>
@endsection
