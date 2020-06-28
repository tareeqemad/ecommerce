<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Admin;
class AdminController extends Controller
{
   public function dashboard()
   {
       return view('dashboard.admin');
   }

   public function login(Request $request)
   {
      /* $password = Hash::make('tareq123');
       die($password);*/
       if ($request->isMethod('post')){
           $data = $request->all();


           $rules =  [
               'email' => 'required|email|max:255',
               'password'=> 'required'
           ];

           $customMessages = [
               'email.required' => 'البريد الاكتروني مطلوب',
               'email.email' => 'البريد الاكتروني مطلوب',
               'password.required' => 'كلمة المرور مطلوبة',
           ];

           $this->validate($request,$rules,$customMessages);
        if (Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
            return  redirect('admin/dashboard');
        }else {
            Session::flash('error_message','خطأ في كلمة المرور او البريد الاكتروني');
            return redirect()->back();
        }
       }
        return view('auth.login');
   }



   public function settings()
   {
      /* echo "<pre>";
       print_r(Auth::guard('admin')->user());
       die();*/
       $adminDetails = Admin::where('email',Auth::guard('admin')->user()->email)->first();
       return view('dashboard.settings.settings')->with(compact('adminDetails'));
   }


   public function logout(){
       Auth::guard('admin')->logout();
       return redirect('/admin');
   }


   public function chkCurrentPassword(Request $request)
   {
       $data = $request->all();

       if (Hash::check($data['current_pwd'].Auth::guard('admin')->user()->password)){
           echo "true";
       }else {
           echo "false";
       }
   }

}
