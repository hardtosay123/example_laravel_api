<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return $this->responseJson($tasks, 200);
    }

    public function show(Task $id)
    {
        return $this->responseJson($id, 200);
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => ['required', 'string'],
            'description' => ['required', 'string']
        ];
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return $this->responseJson($validator->errors(), 400);
        }
        /*
        $addTask = Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description')
        ]);
        */
        
        $addTask = Task::create($request->all());
        return $this->responseJson($addTask, 201);
    }

    public function update(Request $request, Task $id)
    {
        $rules = [
            'title' => ['required', 'string'],
            'description' => ['required', 'string']
        ];
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return $this->responseJson($validator->errors(), 400);
        }

        $task = $id;

        $task->title = $request->input('title');
        $task->description = $request->input('description');

        $task->save();
        
        return $this->responseJson($task, 200);
    }

    public function destroy(Request $request, Task $id)
    {
        $task = $id;
        $task->delete();

        return $this->responseJson([], 204);
    }
}
