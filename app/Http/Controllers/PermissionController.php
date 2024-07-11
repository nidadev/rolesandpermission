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
        $permissions = Permission::orderBy('created_at','DESC')->paginate(10);
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
    public function edit()
    {
        return view('');
    }

    public function update()
    {
        return view('');
    } 

    public function delete()
    {
        return view('');
    }
}
