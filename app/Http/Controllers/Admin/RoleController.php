<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RolesRequest;
use App\Models\Backend\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{




    public function index()
    {
        $roles = Role::orderBy('id','DESC')->paginate(10);
        return view('pages.admin.roles.index',compact('roles'));

    }


    public function create()
    {

        return view('pages.admin.roles.create');
    }


    public function store(RolesRequest $request)
    {

        try {

            $role = $this->process(new Role, $request);


            if ($role){
                return redirect()->route('admin.roles.index');
            }else{

                return redirect()->route('admin.roles.index');
            }

        }catch (\Exception $ex){

            return redirect()->route('admin.roles.index');

        }
    }

    protected function process(Role $role, Request $r)
    {
         $role->name = $r->name;
         $role->permissions = json_encode($r->permissions);
         $role->save();
         return $role;
    }



    public function edit($id)
    {
        $role = Role::findOrFail($id);

        return view('pages.admin.roles.edit',compact('role'));
    }


    public function update(Request $request)
    {
        try {

            $role = Role::findOrFail($request->role_id);

            $role = $this->process($role, $request);
            if ($role){
                return redirect()->route('admin.roles.index');
            }else{

                return redirect()->route('admin.roles.index');
            }

        }catch (\Exception $ex){

            return redirect()->route('admin.roles.index');

        }
    }
//
    public function destroy(Request $request)
    {
        $role = Role::findOrFail($request->role_id);
        $role->delete();
        return redirect()->back();
    }
}
