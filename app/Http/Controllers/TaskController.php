<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'title' => ['required', Rule::unique('tasks')->where(function ($query) use ($request) {
                return $query->where('title', $request->title)
                    ->where('list_id', $request->list_id);
            }),],
            'list_id' => ['required'],
        ])->validate();

        Task::create($request->all());
        return redirect()->back()
            ->with('message', 'Task Created Successfully.');
    }
    // . ',NULL,id,list_id,' . $request->list_id
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        Validator::make($request->all(), [
            'title' => ['required', Rule::unique('tasks')->where(function ($query) use ($request, $task) {
                return $query->where('title', $request->title)
                    ->where('list_id', $request->list_id)
                    ->where('id', '<>', $task->id);
            }),],
            'list_id' => ['required'],
        ])->validate();

        if ($task) {
            $task->update($request->all());
            return redirect()->back()
                ->with('message', 'Task updated Successfully.');
        }
    }

    public function updateStatus(Request $request, Task $task)
    {
        Validator::make($request->all(), [
            'is_completed' => ['required'],
        ])->validate();

        if ($task) {
            $task->update($request->all());
            return redirect()->back()
                ->with('message', 'Task updated Successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Task $task)
    {
        if ($task) {
            Task::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }
}
