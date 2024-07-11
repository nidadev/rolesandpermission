<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{
    //
    public function index()
    {
        $permissions = Permission::orderBy('created_at','DESC')->paginate(4);
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
            return redirect()->route('permissions.edit', $id)->withInput()->withErrors($validator);
        }
        $permission = Permission::findOrFail($id);
        $permission->name = $request->name;

        $permission->save();
        return redirect()->route('permissions.index')->withInput()->with('success','Successfully updated');
    } 

    public function delete(Request $request)
    {
        $id = $request->id;
        //dd($id);
        $permission = Permission::find($id);
        if($permission == null)
        {
            session()->flash('error','Permission not found');
            return response()->json(
                [
                    'status' => false
                ]
                );
            }
                $permission->delete();
                session()->flash('success','Permission deleted successfully');
                //return redirect()->route('permissions.index')->withInput()->with('success','Successfully deleted');

                return response()->json(
                    [
                        'status' => true
                    ]
                    );

    }
}
