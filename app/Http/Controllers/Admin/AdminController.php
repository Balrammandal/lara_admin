<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Session\Session;

class AdminController extends Controller
{
    public function index(){
        return view('admin.login');
    }

    public function Check_login(Request $request)
    {
        //dd($request->all());

        $msg = [
            'email.required' => 'Enter Your Email',
            'password.required' => 'Enter Your Password',
        ];
        $this->validate($request, [
            'email' => 'bail|required|email',
            'password' => 'bail|required|alphaNum|min:3'

        ], $msg);
        $remember_me = $request->has('remember_me') ? true : false;
        $email = $request->get('email');
        $pass = $request->get('password');
        if (Auth::attempt(array('email' => $email, 'password' => $pass,'user_type'=>'Admin'), $remember_me)) {
            $check_email = Auth::user()->email;
            $request->session()->put('email', $check_email);
            $user_type = Auth::user()->user_type;
            $request->session()->put('user_type', $user_type);
            if($user_type=='Admin'){
                return redirect(route('admin::dashboard'));
            }
        } else {
            return redirect()->back()->with('error', 'Login Failed !!! Please check Your Email and Password.');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->flush();
        return redirect('/admin')->with('logout','Logout Successfully !!!');
    }

    public function changePassForm()
    {
        return view('admin.password.changePassword');
    }

    public function ChangePass(Request $request)
    {
        $msg = [
            'old_pass.required' => 'Enter Your Old Password',
            'new_pass.required' => 'Enter Your New Password',
            'confirm_pass.required' => 'Enter Your Confirm Pasword',
        ];
        $this->validate($request, [
            'old_pass' => 'required',
            'new_pass' => 'required',
            'confirm_pass' => 'required',
        ], $msg);
        $old_pass=$request->old_pass;
        $new_pass=$request->new_pass;
        $confirm_pass=$request->confirm_pass;
        $id=Auth::user()->id;
        $pass=User::where('id',$id)->value('password');
        if(Hash::check($old_pass,$pass)){
            if($new_pass==$confirm_pass){
                $password=Hash::make($new_pass);
                $changePass=User::where('id',$id)->update([
                    'password' => $password,
                ]);
                if($changePass==true){
                    return redirect()->back()->with('success',"Password Updated Sucessfully !!!" );
                }
            }
            else{
                return redirect()->back()->with('error',"New Password and Confirm Password are Not Matched !!!" );
            }
        }
        else{
            return redirect()->back()->with('error',"Old Password Not Matched !!!" );
        }

    }
    public function profile($id){
        $userById=User::where('id',$id)->first();
        return view('admin.profile.index',compact('userById'));
    }

    public function updateProfile(Request $request){
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

        return redirect()->back()->with('success', 'Profile Updated Successfully !!!');
    }
}
