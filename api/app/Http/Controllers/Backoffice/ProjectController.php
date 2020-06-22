<?php

namespace App\Http\Controllers\Backoffice;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Filters\ProjectFilters;
use App\Address;
use App\Http\Requests\Backoffice\CreateProjectRequest;
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
    public function store(CreateProjectRequest $request)
    {
        $validated = $request->validated();
        $user = Auth::user();
        $address = Address::create();

        $project = new Project();
        $project->title = $validated['title'];
        $project->user_id = $user->id;
        $project->address_id = $address->id;
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
    public function update(ProjectRequest $request, Project $project)
    {
        $validated = $request->validated();

        $project->title = $validated['title'];
        $project->save();
        
        $project->address->fill($request->except(['id', 'address_id', 'title', 'status']));
        $project->push();

        return new ProjectDetailResource($project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Project::destroy($id);

        return response()->json(['status' => 'success'], 200);
    }
}
