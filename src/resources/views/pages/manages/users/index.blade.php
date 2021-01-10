@extends('layouts.master') @section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">หน้าแรก</li>
        <li class="breadcrumb-item">จัดการ</li>
        <li class="breadcrumb-item active">ข้อมูลผู้ใช้</li>
    </ol>
@endsection
<!--Content-->
@section('content')
    <div class="card card-accent-info">
        <div class="card-body">
            <div class="clearfix mb-sm-3" id="page-heading">
                <div class="float-left">
                    <h4><i class="fa fa-users"></i> ข้อมูลผู้ใช้</h4>
                </div>
                <div class="float-right">
                    <a class="btn btn-sm btn-primary text-white"
                       href="javascript:custom.lunchModalAndGetPage('{!! route('manageUserCreate') !!}','เพิ่มข้อมูลผู้ใช้');">
                        <i class="fa fa-plus"></i> เพิ่มข้อมูล
                    </a>
                </div>
            </div>
            <table class="table table-striped table-hover table-responsive-sm" id="datatables">
                <thead>
                <tr>
                    <th>#</th>
                    <th>ชื่อผุ้ใช้</th>
                    <th>ชื่อนามสกุล</th>
                    <th>สถานะ</th>
                    <th>จัดการ</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $index => $item)
                    <tr>
                        <td>{!! ($index + 1) !!}</td>
                        <td>
                            {!! $item->username !!}
                            {!! $item->type == 0 ? '<span class="badge badge-warning">ผู้ดูแลระบบ</span>' : '<span class="badge badge-info">ผู้ใช้ทั่วไป</span>' !!}
                        </td>
                        <td>{!! $item->full_name !!}</td>
                        <td>
                            @if($item->active == 0)
                                <a href="javascript:alert.changeActive('{!! route('manageUserActive', ['id' => $item->id]) !!}', '{!! $item->active !!}');"
                                   class="btn btn-danger btn-sm btn-block"
                                   data-toggle="tooltip" data-placement="top" title="" id="btnChangeActive"
                                   data-original-title="เปิดการใช้งาน">ถูกระบบการใช้งาน</a>
                            @else
                                <a href="javascript:alert.changeActive('{!! route('manageUserActive', ['id' => $item->id]) !!}', '{!! $item->active !!}');"
                                   class="btn btn-primary btn-sm btn-block"
                                   data-toggle="tooltip" data-placement="top" title="" id="btnChangeActive"
                                   data-original-title="ระงับการใช้งาน">เปิดใช้งานปกติ</a>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm text-white" data-container="body" data-toggle="popover"
                               data-placement="left" data-content="{!! $item->contact !!}." data-original-title=""
                               title="">
                                <i class="fa fa-phone"></i>
                            </a>
                            @if($item->active == 1)
                                <a href="javascript:custom.lunchModalAndGetPage('{!! route('manageUserPassword', ['id' => $item->id]) !!}','รีเซ็ทรหัสผ่านของผู้ใช้');"
                                   class="btn btn-primary btn-sm text-white"
                                   data-toggle="tooltip" data-placement="top" title=""
                                   data-original-title="รีเซ็ทรหัสผ่าน"
                                ><i class="fa fa-key"
                                    aria-hidden="true"></i></a>
                                <a href="javascript:custom.lunchModalAndGetPage('{!! route('manageUserEdit', ['id' => $item->id]) !!}','แก้ไขข้อมูลผู้ใช้');"
                                   class="btn btn-warning btn-sm text-white"
                                   data-toggle="tooltip" data-placement="top" title=""
                                   data-original-title="แก้ไข"
                                ><i class="fa fa-pencil-square-o"
                                    aria-hidden="true"></i></a>
                                <a href="javascript:alert.destroy('{!! route('manageUserDestroy', ['id' => $item->id]) !!}');"
                                   class="btn btn-danger btn-sm" id="btnDestroy"
                                   data-toggle="tooltip" data-placement="top" title=""
                                   data-original-title="ลบ"
                                ><i class="fa fa-times" aria-hidden="true"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/Content-->
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#datatables').DataTable();
        });
    </script>
@endsection
