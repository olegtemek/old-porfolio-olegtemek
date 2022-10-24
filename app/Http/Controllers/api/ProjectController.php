<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class ProjectController extends Controller
{
    public function getAll()
    {
        return response()->json([
            'status' => 200,
            'projects' => Project::all()
        ]);
    }
    public function save(Request $req)
    {

        $data = $req->validate([
            'title' => 'required',
            'stacks' => 'required',
            'link' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg',
        ]);
        $array = explode(',', $req->stacks);
        if ($req->image) {
            $file_name = time() . '_' . $req->image->getClientOriginalName();
            $file_path = $req->file('image')->storeAs('images', $file_name, 'public');
        }
        $project = new Project();
        $project->title = $req->title;
        $project->stack = json_encode($array);
        $project->image = $file_name;
        $project->link = $req->link;

        if ($project->save()) {
            return response()->json([
                'status' => 200,
                'projects' => Project::all()
            ]);
        }
    }

    public function delete(Request $req)
    {
        Project::destroy($req->id);
        return response()->json([
            'status' => 200,
            'projects' => Project::all()
        ]);
    }
}
