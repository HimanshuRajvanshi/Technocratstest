<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Auth;
Use App\Contact;
use Redirect;



class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function editpage(){
        return view('createpage');
    }


    public function postPermission(){
        $user=Auth::user();
        $role_name=$user->roles->first()->name;
        $permissions=Permission::Get();
        $roles=Role::get();
        return view('createpermission', ['permissions' => $permissions,'roles'=> $roles,'role_name' =>$role_name,'user'=>$user]);
    }

    public function postPermissionSaveData(Request $request){
        $user=Auth::user();
        $role=$user->roles;
        $role->givePermissionTo('Test');
        return "done";
    }


    public function postContact(Request $request){
        $user=Contact::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'subject' => $request->subject,
        ]);

        return Redirect::back()->with('hhhh');

    }

     public function contactList(){
         $user=Auth::user();
         $role_name=$user->roles->first()->name;
         $contacts=Contact::get();
        return view('contactlist',compact('user','role_name','contacts'));
     }
}
