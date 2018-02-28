<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    public function getDashboard(){
        return view('admin.dashboard');
    }
    public function getProfile(){
        $user=Auth::User();
        return view('admin.profile')->with(['user'=>$user]);
    }
    public function postUserImage(Request $request){
        $image_name=Auth::User()->name;
        $image_file=$request->file('user_image');
        $this->validate($request,[
            'user_image'=>'required|mimes:jpg,jpeg',
        ]);
        Storage::disk('user_image')->put($image_name,file::get($image_file));
        return redirect()->back();
    }
    public function getUserImage($file_name){
        $file=Storage::disk('user_image')->get($file_name);
        return response($file,200);
    }
    public function getEmployees(){
        $users=User::all();
        $roles=Role::all();
        return view('admin.employees')->with(['users'=>$users])->with(['roles'=>$roles]);
    }
    public function postUpdateUserRole(Request $request){
        $id=$request['id'];
        $user_role=$request['user_role'];
        $up=User::where('id',$id)->first();
        $up->syncRoles($user_role);
        return redirect()->back();
    }
    public function removeUser(Request $request){
        $id=$request['id'];
        $user=User::find($id);
        $user->delete();
        return redirect()->back();
    }
    public function changePassword(Request $request){
        $id=$request['id'];
        $password=$request['password'];
        $confirm_password=$request['confirm_password'];
        if($password==$confirm_password){
            $ch=User::where('id',$id)->first();
            $ch->password=bcrypt($password);
            $ch->update();
            return redirect()->back();
        }
    }
}
