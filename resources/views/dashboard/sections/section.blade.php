@extends('layouts.dashboard.app')
@section('title')
  الأقسام
@endsection
@section('content-header-title')
    الأقسام
@endsection
@section('content-header')
   الصفحة الرئيسية
@endsection
@section('content-active')
    الأقسام
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> الأقسام</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>القسم</th>
                                    <th>الحالة</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sections as $section)
                                <tr>
                                    <td>{{$section->id}}</td>
                                    <td>{{$section->name}}</td>
                                    <td>
                                        @if($section->status == 1)
                                            <a class="updateSectionStatus" id="section-{{$section->id}}" section_id="{{$section->id}}"
                                               href="javasctipt:void(0)"> <span class="badge badge-primary">فعال</span></a>
                                        @else
                                            <a class="updateSectionStatus" id="section-{{$section->id}}" section_id="{{$section->id}}"
                                               href="javasctipt:void(0)"><span class="badge badge-danger">غير فعال</span></a>

                                        @endif
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


        $('.updateSectionStatus').click(function () {
            var status = $(this).text();
            var section_id = $(this).attr('section_id');
            $.ajax({
                type:'post',
                url: '/admin/update-section-status',
                data : {status:status,section_id:section_id},
                success:function (res) {
                    if(res['status']==0){
                        $('#section-'+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)'><span class=\"badge badge-danger\">غير فعال</span></a>")
                    }else if (res['status']==1){
                        $('#section-'+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)'> <span class=\"badge badge-primary\">فعال</span></a>")
                    }
                },
                error:function () {
                    alert("error")
                }
            })
        })
    </script>
 @endsection
