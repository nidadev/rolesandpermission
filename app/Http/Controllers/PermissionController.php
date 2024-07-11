<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    //
    public function index()
    {
        $permissions = Permission::orderBy('created_at','DESC')->paginate(2);
        return view('permissions.list',[
            'permissions' => $permissions
        ]);
    }

    public function create()
    {
        return view('permissions.create');
    }
    public function store(Request $request)
    {
        //dd($request);
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3|unique:permissions',
        ]);
        if($validator->fails())
        {
            return redirect()->route('permissions.create')->withInput()->withErrors($validator);
        }

        /*$permission = new Permission();
        $permission->name = $request->name;
        $permission->save();*/
        Permission::create(['name' => $request->name]);
        
        return redirect()->route('permissions.index')->withInput()->with('success','successfully added permission');  
      }
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.edit',[
            'permission' => $permission
        ]);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3|unique:permissions,name,'.$id.',id',
        ]);
        if($validator->fails())
        {
            return redirect()->route('permissions.edit')->withInput()->withErrors($validator);
        }
        $permission = Permission::findOrFail($id);
        $permission->name = $request->name;

        $permission->save();
        return redirect()->route('permissions.index')->withInput()->with('success','Successfully updated');
    } 

    public function delete()
    {
        return view('');
    }
}
