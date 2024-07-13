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
return view('role.list');
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
            'name' => 'required|min:3|unique:roles',
        ]);
        if($validator->fails())
        {
            return redirect()->route('role.create')->withInput()->withErrors($validator);
        }

        $role = Role::create(['name' => $request->name]);
        //dd($request->permission);
        if(!empty($request->permission))
        {
            foreach($request->permission as $name)
            {
                $role->givePermissionTo($name);
            }
        }
        
        return redirect()->route('role.index')->withInput()->with('success','successfully added role');  
  

    }
}
