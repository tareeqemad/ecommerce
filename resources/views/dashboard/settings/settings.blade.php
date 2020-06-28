@extends('layouts.dashboard.app')
@section('title')
  اعدادات الحساب
@endsection
@section('content-header-title')
    اعدادات الحساب
@endsection
@section('content-header')
    الصفحة الرئيسية
@endsection
@section('content-active')
    اعدادات الحساب
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
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{url('/admin/update-pwd')}}" name="updatePasswordForm" id="updatePasswordForm">
                   @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم المدير</label>
                            <input type="email" class="form-control" value="{{Auth::guard('admin')->user()->name }}" id="admin_name" name="admin_name">
                        </div>

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
                            <input type="text" class="form-control" value=""  id="current_pwd"  name="current_pwd">
                            <span id="chkCurretPwd"></span>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputCurr">كلمة المرور الجديدة</label>
                            <input type="text" class="form-control" value=""  name="new_pwd" id="new_pwd" >
                        </div>

                        <div class="form-group">
                            <label for="exampleInputCurr">تأكيد كلمة المرور</label>
                            <input type="text" class="form-control" value=""  id="confirm_pwd" name="confirm_pwd" >
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus"></i>
                            اضافة
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

