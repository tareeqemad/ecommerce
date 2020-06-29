<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Admin;
use Session;

use  Image;
class AdminController extends Controller
{
   public function dashboard()
   {
       Session::put('page','dashboard');
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
       Session::put('page','settings');
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
       if (Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)){
           echo "true";
       }else {
           echo "false";
       }
   }

   public function  updateCurrentPassword(Request $request)
   {
       Session::put('page','update-current-pwd');
       if ($request->isMethod('post')) {
           $data = $request->all();
           if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
            if ($data['new_pwd']==$data['confirm_pwd']){
                Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
                Session::flash('success_message','تم تعديل كلمة المرور بنجاح');
            }else {
                Session::flash('error_message','كلمة المرور المدخلة غير مطابقة');
            }
           }else {
               Session::flash('error_message','كلمة المرور الحالية غير صحيحة');
           }
           return redirect()->back();
       }
   } //end updateCurrentPassword

    public function updateAdminDetails(Request $request)
    {


        Session::put('page','update-admin-details');
        if ($request->isMethod('post')) {
            $data = $request->all();
              //  dd($data);
            $rules = [
                'name'=> 'required|string',
                'mobile' => 'required|numeric',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

            ];
           // 'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',

            $customMessages = [
                'name.required' => 'اسم المستخدم مطلوب',
                'name.alpha' => 'الاسم يجب ان يكون مدخل صحيح ',
                'mobile.required' => 'رقم الجوال مطلوب',
                'mobile.alpha' => 'رقم الجوال يجب ان يكون مدخل صحيح ',
                'image.required' => 'يجب ان تكون صورة',
            ];
            $this->validate($request,$rules,$customMessages);


            //upload image
            if ($request->hasFile('image')){
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()){
                    //get image extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    //generate new image name
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'image/admin_images/admin_photo/'.$imageName;
                    //upload Imaage
                    Image::make($image_tmp)->save($imagePath);
                }else if (!empty($data['current_admin_image'])){
                    $imageName = $data['current_admin_image'];
                }else {
                    $imageName = "";
                }
            }
            //Update Admin Detail
            Admin::where('email',Auth::guard('admin')->user()->email)->update(['name'=>$data['name'],'mobile'=>$data['mobile'],'image'=>$imageName]);
            Session::flash('success_message','تم تعديل البيانات بنجاح');
            return redirect()->back();
        }
        return view('dashboard.settings.updateAdminDetails');
    }
}
