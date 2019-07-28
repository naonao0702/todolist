<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Todo;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;    #追加してください。





class TodoController extends Controller
{
  public function add()
  {
    return view('admin.todo.create');
  }
  public function create(Request $request)
  {
    // 以下を追記
    // Varidationを行う
    $this->validate($request, Todo::$rules);
    $todo = new Todo;
    $form = $request->all();

    // フォームから送信されてきた_tokenを削除する
    unset($form['_token']);
    $todo->fill($form);
    $todo->is_complete = 0;
    $user = Auth::user();
    $todo->user_id = $user->id;
    // データベースに保存する

    $todo->save();
    return redirect('admin/todo/');
  }
  public function index(Request $request)
  {
    $cond_title = $request->cond_title;
    $todo = new Todo;
    $todo = $todo->all();
    $user = Auth::user();


    if ($cond_title != '') {
      // 検索されたら検索結果を取得する
      $todos = Todo::where('title', 'like' , '%' . $cond_title . '%')->get();
    } else {
      // それ以外はすべてのニュースを取得する
      $todos = Todo::where('is_complete', 0)->where('user_id', $user->id)
      ->orderBy('priority', 'desc')
      ->get();
    }
    $today = Carbon::today();
    //dd($today);
    return view('admin.todo.index', ['todos' => $todos, 'cond_title' => $cond_title, 'today' => $today]);
  }
  public function sort(Request $request)
  {
    $cond_title = $request->cond_title;
    $today = Carbon::today();

    $todos = Todo::where('is_complete',0)
    ->orderBy('priority', 'asc')
    ->get();

    return view('admin.todo.index', ['todos' => $todos, 'cond_title' => $cond_title, 'today' => $today]);
  }
  public function edit(Request $request)
  {
    // News Modelからデータを取得する
    $todo = Todo::find($request->id);
    if (empty($todo)) {
      abort(404);
    }
    return view('admin.todo.edit', ['todo_form' => $todo]);

  }
  public function update(Request $request)
  {
    // Validationをかける
    $this->validate($request, Todo::$rules);
    // News Modelからデータを取得する
    $todo = Todo::find($request->id);
    // 送信されてきたフォームデータを格納する
    $todo_form = $request->all();

    unset($todo_form['_token']);
    unset($todo_form['remove']);

    // 該当するデータを上書きして保存する
    $todo->fill($todo_form)->save();

    return redirect('admin/todo');
  }
  public function complete(Request $request)
  {
    // 該当するNews Modelを取得

    $todo = Todo::find($request->id);
    $todo->is_complete = 1;
    $todo->save();
    //dd($todo->is_complete);


    // 削除する
    return redirect('admin/todo/');
  }
  public function dead_list(Request $request)
  {
    // 該当するNews Modelを取得

    $posts = Todo::where('is_complete', 2)->get();
    //echo dd($posts);

    return view('admin.todo.dead_list', ['posts' => $posts]);
  }

  public function incomplete(Request $request)
  {
    // 該当するNews Modelを取得

    $todo = Todo::find($request->id);
    //dd($todo);

    $todo->is_complete = 0;
    $todo->save();
    //dd($todo->is_complete);


    // 削除する
    return redirect('admin/todo/complete_list');
  }
  public function complete_list(Request $request)
  {


    $posts = Todo::where('is_complete', 1)->get();

    //echo dd($posts);

    return view('admin.todo.complete_list', ['posts' => $posts]);
  }





  public function delete(Request $request)
  {
      // 該当するNews Modelを取得
      $todo = Todo::find($request->id);
      // 削除する
      $todo->delete();
      return redirect('admin/todo/');
  }

}
