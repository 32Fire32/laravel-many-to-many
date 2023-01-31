<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Type;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();

        return view('admin.projects.create', compact('types'));

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

        $new_projects = new Project();

        $new_projects->fill($data);

        $new_projects->slug = Str::slug($new_projects->name_project);

        if(isset($data['project_logo_img'])){
            $new_projects->project_logo_img = Storage::disk('public')->put('uploads', $data['project_logo_img']);
        }

        if(isset($data['doc_project'])){
            $new_projects->doc_project = Storage::disk('public')->put('uploads', $data['doc_project']);
        }

        $new_projects->save();

        return redirect()->route('admin.projects.index')->with('message', "$new_projects->name_project creato con successo!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types'));

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

        $project->slug = Str::slug($data['name_project']);

        if(isset($data['project_logo_img'])){
            if($project->project_logo_img){
              Storage::disk('public')->delete($project->project_logo_img);
            }
            $data['project_logo_img'] = Storage::disk('public')->put('uploads', $data['project_logo_img']);
        }

        if(isset($data['no_image']) && $project->project_logo_img){
            Storage::disk('public')->delete($project->project_logo_img);
            $project->project_logo_img = null;
        }

        $project->update($data);
        
        return redirect()->route('admin.projects.index')->with('message', "$project->name_project aggiornato con successo!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $old_title = $project->name_project;

        if($project->project_logo_img){
            Storage::disk('public')->delete($project->project_logo_img);
        }

        if($project->doc_project){
            Storage::disk('public')->delete($project->doc_project);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('message', "$old_title eliminato con successo!");;
    }
}
