<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Task;

class TaskListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [];
        
        if(\Auth::check()) {
            $user = \Auth::user();
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);
            
            return view('tasklists.index', [
                'tasklists' => $tasks,
            ]);
            
        }
        $data = ['user' => NULL , 'tasks' => NULL];
        return view('welcome', $data);
        
        //$tasklists = Task::paginate(10);
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task;
        
        return view('tasklists.create', [
            'task' => $task,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'content' => 'required|max:255',
            'status' => 'required|max:10',
        ], [
            'content.required' => ':attributeは入力必須です！',
            'content.max'      => ':attributeは255文字以内です！',
            'status.required'  => ':attributeは入力必須です！',
            'status.max'       => ':attributeは255文字以内です！',
        ], [
            'content' => 'タスク',
            'status'   => 'ステータス',
        ]);
        
        $request->user()->tasks()->create([
            'content' => $request->content,
            'status' => $request->status,
        ]);
        
        /*
        $task = new Task;
        $task->content = $request->content;
        $task->status = $request->status;
        $task->save();
        */
        
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        
        //ログインユーザーとタスク登録ユーザーが異なる時はトップへ
        if ($task->user_id != \Auth::user()->id) {
            return redirect('/');
        }
        
        return view('tasklists.show', [
            'task' => $task,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        
        //ログインユーザーとタスク登録ユーザーが異なる時はトップへ
        if ($task->user_id != \Auth::user()->id) {
            return redirect('/');
        }
        
        return view('tasklists.edit', [
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $task = Task::find($id);
        
        //ログインユーザーとタスク登録ユーザーが異なる時はトップへ
        if ($task->user_id != \Auth::user()->id) {
            return redirect('/');
        }
        
        $this->validate($request, [
            'content' => 'required|max:255',
            'status' => 'required|max:10',
        ], [
            'content.required' => ':attributeは入力必須です！',
            'content.max'      => ':attributeは255文字以内です！',
            'status.required'  => ':attributeは入力必須です！',
            'status.max'       => ':attributeは255文字以内です！',
        ], [
            'content' => 'タスク',
            'status'   => 'ステータス',
        ]);
        
        
        
        $task->content = $request->content;
        $task->status = $request->status;
        $task->save();
        
        
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        
        //ログインユーザーとタスク登録ユーザーが異なる時はトップへ
        if ($task->user_id != \Auth::user()->id) {
            return redirect('/');
        }
        
        $task->delete();
        
        return redirect('/');
    }
}
