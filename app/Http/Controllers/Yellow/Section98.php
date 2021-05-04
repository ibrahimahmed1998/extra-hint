<?php
namespace App\Http\Controllers\Yellow;
use App\Http\Controllers\Controller;
use App\Http\Requests\Section_;
use App\Models\Section;
use Illuminate\Http\Request;

class Section98 extends Controller
{
    public function __construct() {         $this->middleware('auth:api', ['except' => []]);    }
  
    
    public function section98(Section_ $req) //create 
    {
       Section::create(['Sec_id' => $req->Sec_id, 'dep_id' => $req->dep_id, 'sec_name' => $req->sec_name]);     
       return response()->json(['Success' => 'Section Created'], 201);
    }

    public function delete_section(Request $req)
    {
        $req->validate(['sec_id' => 'required|integer|exists:Sections','dep_id' => 'required|exists:Departments']);
        Section::where('sec_id', $req->sec_id)->where('dep_id',$req->dep_id)->delete();
        return response()->json(['Success'=>"Section deleted"], 201);
    }

}