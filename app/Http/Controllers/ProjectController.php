<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Resources\ProjectResource;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends BaseController
{

    public $paginate=10;
    public $model;
    public $modelname;
    public $resource;

    public function __construct(Project $model)
    {
        $this->resource = ProjectResource::class;
        $this->model = $model;
        $this->modelname = 'Project';
        $this->authorizeResource(Project::class, 'project');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return new $this->resource ;
        $projects = $this->model->paginate($this->paginate);
        return $this->sendResponse($this->resource::collection($projects)->response()->getData(true),$this->modelname .' sent sussesfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $project = $this->model->create($request->validated());
        return $this->sendResponse(new ProjectResource($project),$this->modelname .' created sussesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return $this->sendResponse(new $this->resource($project),$this->modelname .' shown sussesfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->update($request->validated());
        return $this->sendResponse(new $this->resource($project),$this->modelname .' updated sussesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return $this->sendResponse(new $this->resource($project),$this->modelname .' deleted sussesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  stirng  $keyword
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // $this->authorize('search', $this->model->class);
        $projects = $this->model->where('title','like',"%{$request->keyword}%")// ->get();
        ->paginate($this->paginate);
        return $this->sendResponse($this->resource::collection($projects)->response()->getData(true),$this->modelname .' sent sussesfully');
    }
}
