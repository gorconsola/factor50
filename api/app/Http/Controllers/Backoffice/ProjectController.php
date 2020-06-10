<?php

namespace App\Http\Controllers\Backoffice;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Filters\ProjectFilters;
use App\Http\Resources\Projects\ProjectListingResourceCollection;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ProjectFilters $filters)
    {
        $query = Project::with('user.userRole', 'tasks', 'address')
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
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
        //
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
