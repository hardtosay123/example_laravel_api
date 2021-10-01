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
        return response()->json($tasks, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }

    public function show(Task $id)
    {
        return response()->json($id, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => ['required', 'string'],
            'description' => ['required', 'string']
        ];
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
        }
        /*
        $addTask = Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description')
        ]);
        */
        
        Task::create($request->all());
        
        return http_response_code(201);
    }

    public function update(Request $request, Task $id)
    {
        $rules = [
            'title' => ['required', 'string'],
            'description' => ['required', 'string']
        ];
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
        }

        $task = $id;

        $task->title = $request->input('title');
        $task->description = $request->input('description');

        $task->save();
        /*
        $addTask = Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description')
        ]);
        */
        
        return http_response_code(200);
    }

    public function destroy(Request $request, Task $id)
    {
        $task = $id;
        $task->delete();

        return http_response_code(204);
    }
}
