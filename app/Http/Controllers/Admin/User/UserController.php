<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users=User::get();
        return view('admin.user.index', compact('users'));
    }

    public function addUser(){
        return view('admin.user.add');
    }
    public function saveUser(Request $request)
        {
           // dd($request->all());
            $msg = [
                'f_name.required' => 'Enter Your  First Name',
                'l_name.required' => 'Enter Your Last Name',
                'email.required' => 'Enter Your Email',
            ];
            $this->validate($request, [
                'f_name' => 'required',
                'l_name' => 'required',
                'email' => 'required',
            ], $msg);
            $f_name = $request->get('f_name');
            $l_name = $request->get('l_name');
            $email = $request->get('email');
            User::create([
                'f_name' => $f_name,
                'l_name' => $l_name,
                'email' => $email,
                'password' => bcrypt('123456'),
                'user_type' =>'User',
                'status' => 'Active'
            ]);
            return redirect()->back()->with('success','User Added Successfully !!!');
        }
        public function editUserForm($id){
            $userById = User::where('id', $id)->first();
            return view('admin.user.edit', compact('userById'));
        }

    public function editUser(Request $request)
    {
        $msg = [
            'f_name.required' => 'Enter Your  First Name',
            'l_name.required' => 'Enter Your Last Name',
            'email.required' => 'Enter Your Email',
        ];
        $this->validate($request, [
            'f_name' => 'required',
            'l_name' => 'required',
            'email' => 'required',
        ], $msg);

        $id = $request->get('id');
        $f_name = $request->get('f_name');
        $l_name = $request->get('l_name');
        $email = $request->get('email');
            User:: where('id',$id)->update([
                'f_name' => $f_name,
                'l_name' => $l_name,
                'email' => $email,
            ]);

            return redirect()->back()->with('success', 'User Updated Successfully !!!');
    }

    public function active_inactive_user(Request $request){
        $id = $request->get('id');
        $status = $request->get('status');
        if($status=='Active'){
            User::where('id',$id)->update([
                'status' => 'Inactive',
            ]);
            $st='Inactive';
            $html='<a href="javascript:void(0);" class="btn btn-warning" onclick="active_inactive_user('.$id.','.$st.')"><span class="glyphicon glyphicon-ban-circle"></span></a>&emsp;';
            return json_encode(array('id'=>$id,'html'=>$html));
        }
        else{
            User::where('id',$id)->update([
                'status' => 'Active',
            ]);
            $st='Active';
            $html='<a href="javascript:void(0);" class="btn btn-success" onclick="active_inactive_user('.$id.','.$st.')"><span class="glyphicon glyphicon-ok-circle"></span></a>&emsp;';
            return json_encode(array('id'=>$id,'html'=>$html));
        }

    }

    public function delUser($id)
    {
        User:: where('id', $id)->delete();
        return redirect()->back()->with('success', 'User Deleted Successfully !!!');
    }



}
