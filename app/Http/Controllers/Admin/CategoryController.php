<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
class CategoryController extends Controller
{
    public function index ()
    {
        Session::put('page','categories');
        $categories = Category::get();
        return view('dashboard.categories.index',compact('categories'));
    }

    public function addEditCategory(Request $request,$id = null){
        if ($id==""){
            $title = "اضافة صنف جديد";
        }else {
            $title = "تعديل بيانات صنف صنف ";
        }
        return view('dashboard.categories.add_edit_cat',compact('title'));

    }


    public function updateCatStatus(Request $request)
    {
        if ($request->ajax()){
            $data = $request->all();
            if ($data['status']=="فعال") {
                $status = 0;
            }else {
                $status = 1;
            }
            Category::where('id',$data['cat_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'cat_id'=>$data['cat_id']]);

        }
    }
}
