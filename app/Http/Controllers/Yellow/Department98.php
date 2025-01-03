<?php
namespace App\Http\Controllers\Yellow;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class Department98 extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => ['list_departemnt']]);    }

    public function department98(Request $req) //create
    {
        $req->validate([
             'dname' => 'required|string|unique:Departments',
             'dep_id' => 'required|integer|unique:Departments']);

        Department::create(['dname' => $req->dname,'dep_id' => $req->dep_id]);

        return response()->json(['Success' => 'Department Created'], 201);
    }

    public function del_dep98(Request $req){
        $req->validate(['dep_id' => 'required|exists:Departments']);
        Department::where('dep_id', $req->dep_id)->delete();
        return response()->json(['Success'=>"Department deleted"], 201);}

    public function list_departemnt(){
        $dep = Department::all();
        return View::make("Department/main_ds", compact('dep'));
    }}
