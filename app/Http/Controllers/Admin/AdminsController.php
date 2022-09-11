<?php

namespace App\Http\Controllers\Admin;

use App\Models\Backend\Admin;
use App\Models\Backend\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class AdminsController extends Controller
{


    public function storeImage(Request $request)
    {

          if ($request->hasFile('upload')){
              $originalName = $request->file('upload')->getClientOriginalName();
              $fileName = pathinfo($originalName, PATHINFO_FILENAME);
              $extension = $request->file('upload')->getClientOriginalExtension();
              $fileName = $fileName . '_' . time() . '-' . $extension;

              $request->file('upload')->move(public_path('media'), $fileName);
              $url = asset('media/' . $fileName);

              return response()->json([
                  'fileName' => $fileName, 'uploaded' => 1, 'url' => $url
              ]);
          }

    }

    public function index(Request $request)
    {
//        $data = Admin::orderBy('id','DESC')->paginate(5);
        return view('pages.admin.admins.index');
//            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('pages.admin.admins.create',compact('roles'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = Admin::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('admins.index')
            ->with('success','User created successfully');
    }


    public function show($id)
    {
        $admin = Admin::find($id);
        return view('pages.admin.admins.show',compact('admin'));
    }


    public function edit($id)
    {
        $admin = Admin::find($id);
        $roles = Role::pluck('name','name')->all();
        $adminRole = $admin->roles->pluck('name','name')->all();

        return view('pages.admin.admins.edit',compact('admin','roles','adminRole'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $admin = Admin::find($id);
        $admin->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $admin->assignRole($request->input('roles'));

        return redirect()->route('admins.index')
            ->with('success','User updated successfully');
    }


    public function destroy($id)
    {
        Admin::find($id)->delete();
        return redirect()->route('admins.index')
            ->with('success','User deleted successfully');
    }

    public function account_settings()
    {

        return view('pages.admin.profile.profile');
    }
}
