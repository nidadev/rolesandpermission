<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    //
    public function index()
    {

    }
    public function create()
    {
        $permission = Permission::orderBy('name','DESC')->get();
   return view('role.create',[
    'permissions' => $permission
   ]);
    }
    public function store(Request $request)
    {
         //dd($request);
         $validator = Validator::make($request->all(),[
            'name' => 'required|min:3|unique:permissions',
        ]);
        if($validator->fails())
        {
            return redirect()->route('role.create')->withInput()->withErrors($validator);
        }

        /*$permission = new Permission();
        $permission->name = $request->name;
        $permission->save();*/
        Role::create(['name' => $request->name]);
        
        return redirect()->route('role.index')->withInput()->with('success','successfully added permission');  
  

    }
}
