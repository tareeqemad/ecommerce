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
       /* $categories = Category::with(['section' =>function($query){
        $query->select('id','name');
    }])->get();*/
        $categories = Category::with(['section','parentcategory'])->get();
        $categories = json_decode(json_encode($categories));
        return view('dashboard.categories.index',compact('categories'));
    }

    public function addEditCategory(Request $request,$id = null){
        if ($id==""){
            $title = "اضافة صنف جديد";
            $category = new Category ;
            $categorydata =     [];
            $getCategories = [];
            $message = "تم اضافة الصنف بنجاح";
            $btn_txt = "اضافة صنف";
            $icon = "plus";
        }else {
            $title = "تعديل بيانات صنف";
            $categorydata = Category::where('id',$id)->first();
            $getCategories = Category::with('subcategories')->where(['parent_id'=>0,'section_id'=>$categorydata['section_id']])->get();
            $category = Category::find($id);
            $message = "تم تعديل الصنف بنجاح";
            $btn_txt = "تعديل صنف";
            $icon = "edit";
            //$categorydata = json_decode(json_encode($categorydata));
            // echo "<pre>"; print_r($categorydata); die();
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
            if (empty($data['category_image'])){
                $data['category_image'] = "";
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
            session::flash('success_message',$message);
            return  redirect('admin/categories');
        }
        $getSections = Section::get();
        return view('dashboard.categories.add_edit_cat',compact('title','getSections','categorydata','getCategories','btn_txt','icon'));

    }


    public function appendCategoryLevel(Request $request)
    {
        if ($request->ajax()){
            $data = $request->all();
            $getCategories = Category::with('subcategories')->where(['section_id'=>$data['section_id'],
                'parent_id' =>0 , 'status'=>1])->get();
            $getCategories =json_decode(json_encode($getCategories),true);
            //echo "<pre>"; print_r($getCategories); die();
            return view('dashboard.categories.append_categories_level')->with(compact('getCategories'));
        }
    }

    public function deleteCatImage($id)
    {
        $catImage = Category::select('category_image')->where('id',$id)->first();

        $cat_img_path = 'image/category_images/cat_photo';

        if (file_exists($cat_img_path.$catImage->category_image)){
            unlink($cat_img_path.$catImage->category_image);
        }

        Category::where('id',$id)->update(['category_image'=>'']);
        $message = 'تم حذف الصورة بنجاح';
        session::flash('success_message',$message);
        return  redirect()->back();
       // return  redirect()->back()->with('flash_message_success','تم حذف الصورة بنجاح');

    }
    public function deleteCat($id)
    {
        Category::where('id',$id)->delete();
        $message = 'تم حذف الصنف بنجاح';
        session::flash('success_message',$message);
        return  redirect()->back();

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
