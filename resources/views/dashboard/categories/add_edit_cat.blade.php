@extends('layouts.dashboard.app')
@section('title')
{{$title}}
@endsection
@section('content-header-title')
    {{$title}}
@endsection
@section('content-header')
    الصفحة الرئيسية
@endsection
@section('content-active')
    {{$title}}
@endsection
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <form name="categoryForm" id="categoryForm" action="{{url('admin/add-edit-category')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{$title}}</h3>
                </div>
                @if(Session::has('error_message'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                        {{Session::get('error_message')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(Session::has('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                        {{Session::get('success_message')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
            @endif
            <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category_name">اسم الصنف</label>
                                <input type="text" class="form-control" name="category_name" id="category_name" placeholder="اسم الصنف">
                            </div>
                            <div class="form-group">
                                <label>اختيار مستوى الصنف</label>
                                <select class="form-control select2"  name="parent_id" style="width: 100%;text-align: right">
                                    <option value="0">مستوى أساسي</option>
                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>اختيار القسم</label>
                                <select class="form-control select2" name="section_id" id="section_id"  style="width: 100%;">
                                    <option value="">اختيار</option>
                                    @foreach($getSections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                              <label for="exampleInputFile">صورة الصنف</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="category_image" name="category_image">
                                    <label class="custom-file-label" for="category_image">اختيار الصورة</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">رفع</span>
                                </div>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="category_discount">نسبة الخصم للصنف</label>
                                <input type="text" class="form-control" id="category_discount" name="category_discount" placeholder="نسبة الخصم للصنف">
                            </div>
                            <div class="form-group">
                                <label for="category_discount">وصف الصنف</label>
                                <textarea class="form-control" name="description" id="description" rows="3" placeholder="وصف الصنف"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="category_discount">رابط الصنف</label>
                                <input type="text" class="form-control" id="url" name="url" placeholder="رابط الصنف">
                            </div>

                            <div class="form-group">
                                <label for="category_discount">عنوان الصنف </label>
                                <textarea class="form-control" id="meta_title" name="meta_title" rows="3" placeholder="ادخل"></textarea>

                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="category_discount">وصف ميتا</label>
                                <textarea class="form-control" id="meta_description" name="meta_description"
                                          rows="3" placeholder="وصف ميتا"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="category_discount">كلمات مفتاحية للصنف</label>
                                <textarea class="form-control" id="meta_keywords" name="meta_keywords"
                                          rows="3" placeholder="كلمات مفتاحية للصنف"></textarea>
                            </div>
                        </div>
                    </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">اضافة</button>
                        </div>
                    <!-- /.row -->
                    </div>
                <!-- /.card-body -->
            </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <!-- Required datatable js -->
    <script src="{{ asset('dashboard/js/custom/admin_script.js') }}"></script>

    <script>
        $('.select2').select2();
    </script>
@endsection

