@extends('layouts.dashboard.app')
@section('title')
 تغير كلمة المرور
@endsection
@section('content-header-title')
    تغير كلمة المرور
@endsection
@section('content-header')
    الصفحة الرئيسية
@endsection
@section('content-active')
    تغير كلمة المرور
@endsection
@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">تعديل كلمة مرور المدير</h3>
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
                <!-- form start -->
                <form role="form" method="post" action="{{url('/admin/update-current-pwd')}}" name="updatePasswordForm" id="updatePasswordForm">
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
                            <label for="exampleInputCurr">كلمة المرور الحالية</label>
                            <input type="password" class="form-control" value=""  id="current_pwd"  name="current_pwd">
                            <span id="chkCurretPwd"></span>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputnewpwd">كلمة المرور الجديدة</label>
                            <input type="password" class="form-control" value=""  name="new_pwd" id="new_pwd" >
                        </div>

                        <div class="form-group">
                            <label for="exampleInputconfirm">تأكيد كلمة المرور</label>
                            <input type="password" class="form-control" value=""  id="confirm_pwd" name="confirm_pwd" >
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

