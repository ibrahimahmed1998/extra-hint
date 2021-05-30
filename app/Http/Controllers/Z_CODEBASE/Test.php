<?php
namespace App\Http\Controllers\Z_CODEBASE;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Test extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => ['test']]); }

    public function test(Request $req)
    {
            User::query()->update(['password' => Hash::make($req->value) ]);

            return response()->json(['success'=>$req->value]);
    }

}