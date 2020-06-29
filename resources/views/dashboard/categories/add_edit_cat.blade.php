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

                <!-- form start -->

                <form class="form">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>معمولی</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <option selected="selected">مازندران</option>
                                    <option>شیراز</option>
                                    <option>گلستان</option>
                                    <option>اردبیل</option>
                                    <option>خوزستان</option>
                                    <option>سیستان و بلوچستان</option>
                                    <option>مشهد</option>
                                </select>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label>غیرفعال</label>
                                <select class="form-control select2" disabled="disabled" style="width: 100%;">
                                    <option selected="selected">مازندران</option>
                                    <option>شیراز</option>
                                    <option>گلستان</option>
                                    <option>اردبیل</option>
                                    <option>خوزستان</option>
                                    <option>سیستان و بلوچستان</option>
                                    <option>مشهد</option>
                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>چند انتخابی</label>
                                <select class="form-control select2"  multiple="multiple" data-placeholder="یک استان انتخاب کنید"
                                        style="width: 100%;text-align: right">
                                    <option>مازندران</option>
                                    <option>شیراز</option>
                                    <option>گلستان</option>
                                    <option>اردبیل</option>
                                    <option>خوزستان</option>
                                    <option>سیستان و بلوچستان</option>
                                    <option>مشهد</option>
                                </select>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label>نتیجه غیرفعال</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <option selected="selected">مازندران</option>
                                    <option>شیراز</option>
                                    <option disabled="disabled">گلستان (غیرفعال)</option>
                                    <option>اردبیل</option>
                                    <option>خوزستان</option>
                                    <option>سیستان و بلوچستان</option>
                                    <option>مشهد</option>
                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">ارسال</button>
                        </div>
                    <!-- /.row -->
                </div>
                </form>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Required datatable js -->
    <script src="{{ asset('dashboard/js/custom/admin_script.js') }}"></script>
@endsection

