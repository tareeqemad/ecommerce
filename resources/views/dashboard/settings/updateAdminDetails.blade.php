@extends('layouts.dashboard.app')
@section('title')
    تعديل بيانات الحساب
@endsection
@section('content-header-title')
   تعديل بيانات الحساب
@endsection
@section('content-header')
    الصفحة الرئيسية
@endsection
@section('content-active')
    تعديل بيانات الحساب
@endsection
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">   تعديل بيانات الحساب</h3>
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
                @if ($errors->any())
                    <div class="alert alert-danger" style="margin-top: 10px;">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                   @endif

            <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{url('/admin/update-admin-details')}}"
                      enctype="multipart/form-data"
                      name="updateDetailsForm" id="updateDetailsForm">
                    @csrf
                    <div class="card-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">البريد الاكتروني للمدير</label>
                            <input type="email" class="form-control" value="{{Auth::guard('admin')->user()->email }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputType">طبيعة عمل المدير</label>
                            <input type="text" class="form-control" value="{{Auth::guard('admin')->user()->type }}" readonly id="exampleInputType">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم المدير</label>
                            <input type="text" class="form-control"  id="admin_name" name="name" value="{{Auth::guard('admin')->user()->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">رقم الجوال</label>
                            <input type="text" class="form-control" value="{{Auth::guard('admin')->user()->mobile }}" id="admin_mobile" name="mobile"  required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">الصورة</label>
                            <input type="file" class="form-control" value="" id="admin_image" name="image">
                            @if(!empty(Auth::guard('admin')->user()->image))
                                <a target="_blank" href="{{url('image/admin_images/admin_photo/'.Auth::guard('admin')->user()->image)}}">عرض الصورة</a>
                                <input type="hidden" name="current_admin_image" value="{{Auth::guard('admin')->user()->image}}">
                            @endif
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-edit"></i>
                            تعديل
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
@section('script')
    <!-- Required datatable js -->
    <script src="{{ asset('dashboard/js/custom/admin_script.js') }}"></script>
@endsection

