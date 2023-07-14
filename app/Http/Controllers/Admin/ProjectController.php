<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [
            'projects' => Project::all()
        ];

        return view('admin.projects.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'typeArray' => Type::all(),
            'technologyArray' => Technology::all()
        ];

        return view('admin.projects.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        $imgPath = Storage::put('uploads', $data['image']);
        $data['image'] = $imgPath;

        $newProject = new Project();
        $newProject->fill($data);
        $newProject->save();

        $newProject->technology()->attach($data['technology']);

        return to_route('admin.projects.show', $newProject);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {

        $data= [
            'project' => $project
        ];

        return view('admin.projects.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $projectTechnology = $project->technology->pluck('id')->toArray();

        $data = [
            'project' => $project,
            'typeArray' => Type::all(),
            'technologyArray' => Technology::all(),
            'projectTechnology' => $projectTechnology 
        ];

        return view('admin.projects.edit', $data);
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
        $data = $request->validated();

        $imgPath = Storage::put('uploads', $data['image']);
        $data['image'] = $imgPath;

        $project->fill($data);
        $project->update();

        $project->technology()->sync($data['technology']);

        return to_route('admin.projects.show', compact('project'));

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

        return to_route('admin.projects.index');
    }
}
