<?php

namespace App\Http\Controllers\Backoffice;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Filters\ProjectFilters;
use App\Http\Requests\Backoffice\ProjectRequest;
use App\Http\Resources\Projects\ProjectListingResourceCollection;
use App\Http\Resources\Projects\ProjectDetailResource;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ProjectFilters $filters)
    {
        $query = Project::complete()
            ->filter($filters);
        
        $perPage = 15;

        if ($request->has('per_page')) {
            $perPage = $request->per_page;
        }

        $projects = $query->paginate($perPage);
        
        return new ProjectListingResourceCollection($projects);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $validated = $request->validated();
        $user = Auth::user();

        $project = new Project();
        $project->name = $validated['name'];
        $project->user_id = $user->id;
        $project->save();

        return new ProjectDetailResource($project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::complete()->findOrFail($id);

        return new ProjectDetailResource($project);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
