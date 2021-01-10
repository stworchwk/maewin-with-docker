@extends('layouts.master') @section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">หน้าแรก</li>
        <li class="breadcrumb-item">จัดการ</li>
        <li class="breadcrumb-item active">ข้อมูลรหัสโทรศัพท์ประเทศ</li>

    </ol>
@endsection
<!--Content-->
@section('content')
    <div class="card card-accent-info">
        <div class="card-body">
            <div class="clearfix mb-sm-3" id="page-heading">
                <div class="float-left">
                    <h4><i class="fa fa-object-group"></i> ข้อมูลรหัสโทรศัพท์ประเทศ</h4>
                </div>
                <div class="float-right">
                    <a class="btn btn-sm btn-primary text-white"
                       href="javascript:custom.lunchModalAndGetPage('{!! route('managePrefixPhoneNumberCreate') !!}','เพิ่มข้อมูลรหัสโทรศัพท์ประเทศ');">
                        <i class="fa fa-plus"></i> เพิ่มข้อมูล
                    </a>
                </div>
            </div>
            <table class="table table-striped table-hover table-responsive-sm" id="datatables">
                <thead>
                <tr>
                    <th>#</th>
                    <th>รหัสโทรศัพท์</th>
                    <th>ชื่อประเทศ (TH)</th>
                    <th>ชื่อประเทศ (EN)</th>
                    <th>จัดการ</th>
                </tr>
                </thead>
                <tbody>
                @foreach($prefixPhoneNumbers as $index => $item)
                    <tr>
                        <td>{!! ($index + 1) !!}</td>
                        <td>{!! $item->prefix !!}</td>
                        <td>{!! $item->name_th !!}</td>
                        <td>{!! $item->name_en !!}</td>
                        <td>
                            <a href="javascript:custom.lunchModalAndGetPage('{!! route('managePrefixPhoneNumberEdit', ['id' => $item->id]) !!}','แก้ไขข้อมูลรหัสโทรศัพท์ประเทศ');"
                               class="btn btn-warning btn-sm text-white"
                               data-toggle="tooltip" data-placement="top" title=""
                               data-original-title="แก้ไข"
                            ><i class="fa fa-pencil-square-o"
                                aria-hidden="true"></i></a>
                            @if(Auth::user()->type == 0)
                                <a href="javascript:alert.destroy('{!! route('managePrefixPhoneNumberDestroy', ['id' => $item->id]) !!}');"
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
