@extends('layouts.dashboard.app')
@section('title')
    الأصناف
@endsection
@section('content-header-title')
    الأصناف
@endsection
@section('content-header')
    الصفحة الرئيسية
@endsection
@section('content-active')
    الأصناف
@endsection
@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables/dataTables.bootstrap4.css') }}">
    <!--end DataTables -->
@endsection
@section('content')
    <!-- Main content -->
    <div class="row">
        <div class="col-12">
            @if(Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                    {{Session::get('success_message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> الأصناف</h3>
                    <a href="{{url('admin/add-edit-category')}}" style="max-width: 150px; float:right;
                    display: inline-block;" class="btn btn-block btn-success">اضافة صنف جديد</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>القسم</th>
                            <th>الصنف الأب  </th>
                            <th>الصنف</th>
                            <th>الرابط </th>
                            <th>الحالة</th>
                            <th>الاجراء</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            @if(!isset($category->parentcategory->category_name))
                                <?php $parent_category = "اساسي"; ?>
                                @else
                                <?php $parent_category = $category->parentcategory->category_name ; ?>
                                   @endif
                                <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->section->name}}</td>
                                <td>{{$parent_category}}</td>
                                <td>
                                    {{$category->category_name }}
                                </td>
                                <td>
                                        {{$category->url }}
                                </td>
                                    <td>
                                    @if($category->status == 1)
                                        <a class="updateCatStatus" id="cat-{{$category->id}}" cat_id="{{$category ->id}}"
                                           href="javasctipt:void(0)"> <span class="badge badge-primary">فعال</span></a>
                                    @else
                                        <a class="updateCatStatus" id="cat-{{$category->id}}" cat_id="{{$category->id}}"
                                           href="javasctipt:void(0)"><span class="badge badge-danger">غير فعال</span></a>

                                    @endif
                                </td>
                                 <td>
                                     <a href="{{url('admin/add-edit-category/'.$category->id)}}" title="تعديل"><i class="fa fa-edit"></i> </a>
                                     <a href="{{url('admin/delete-cat/'.$category->id)}}" title="حذف"><i class="fa fa-trash"></i> </a>

                                 </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

    <!-- DataTables -->
    <script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
    <!-- Required datatable js -->

    <script>
        $('#example2').DataTable({
            "language": {
                "paginate": {
                    "next": "الصفحة التالية",
                    "previous" : "الصفحة السابقة"
                }
            },
            "info" : false,
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "autoWidth": false
        });

        $('.updateCatStatus').click(function () {
            var status = $(this).text();
            var cat_id = $(this).attr('cat_id');
            $.ajax({
                type:'post',
                url: '/admin/update-cat-status',
                data : {status:status,cat_id:cat_id},
                success:function (res) {
                    if(res['status']==0){
                        $('#cat-'+cat_id).html("<a class='updateSectionStatus' href='javascript:void(0)'><span class=\"badge badge-danger\">غير فعال</span></a>")
                    }else if (res['status']==1){
                        $('#cat-'+cat_id).html("<a class='updateSectionStatus' href='javascript:void(0)'> <span class=\"badge badge-primary\">فعال</span></a>")
                    }
                },
                error:function () {
                    alert("error")
                }
            })
        })
    </script>
@endsection
