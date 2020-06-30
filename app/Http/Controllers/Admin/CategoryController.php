<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Section;
use Illuminate\Http\Request;
use Session;
use  Image;
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
            $category = new Category ;
        }else {
            $title = "تعديل بيانات صنف صنف ";
        }
        if ($request->isMethod('post')){
            $data = $request->all();

                $rules = [
                    'category_name'=>'required|string',
                    'section_id'=>'required',
                    'url'=>'required',
                    'category_image'=>'image',
                ];
            $customMessages = [
                'category_name.required' => 'اسم الصنف مطلوب',
                'section_id.email' => 'القسم مطلوب',
                'url.required' => 'رابط الصنف مطلوب',
            ];

            $this->validate($request,$rules,$customMessages);
            //upload image
            if ($request->hasFile('category_image')){
                $image_tmp = $request->file('category_image');
                if ($image_tmp->isValid()){
                    //get image extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    //generate new image name
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'image/category_images/cat_photo/'.$imageName;
                    //upload Imaage
                    Image::make($image_tmp)->save($imagePath);
                    //save Cat image
                    $category->category_image = $imageName;
                }
            }
            if (empty($data['description'])){
                $data['description'] = "";
            }
            if (empty($data['url'])){
                $data['url'] = "";
            }
            if (empty($data['meta_title'])){
                $data['meta_title'] = "";
            }
            if (empty($data['meta_description'])){
                $data['meta_description'] = "";
            }
            if (empty($data['meta_keywords'])){
                $data['meta_keywords'] = "";
            }
            $category->parent_id = $data['parent_id'];
            $category->section_id = $data['section_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status = 1;
            $category->save();
            session::flash('success_message','تم اضافة الصنف بنجاح');
            return  redirect('admin/categories');
        }
        $getSections = Section::get();
        return view('dashboard.categories.add_edit_cat',compact('title','getSections'));

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
