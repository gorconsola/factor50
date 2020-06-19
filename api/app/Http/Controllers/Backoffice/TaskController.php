<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Task;
use App\Http\Resources\Tasks\TaskListingResource;
use App\Http\Requests\Backoffice\TaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $projectId)
    {
        $tasks = Task::where('project_id', $projectId)->get();

        return TaskListingResource::collection($tasks);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request, $projectId)
    {
        $validated = $request->validated();

        Task::create($validated);

        return $this->index($request, $projectId);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, $projectId, $id)
    {
        $validated = $request->validated();
        $task = Task::findOrFail($id);
        $task->fill($validated);
        $task->save();

        return $this->index($request, $projectId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $projectId, $taskId)
    {
        Task::destroy($taskId);

        return $this->index($request, $projectId);
    }
}
