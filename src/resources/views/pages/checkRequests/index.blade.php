@extends('layouts.master') @section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">หน้าแรก</li>
        <li class="breadcrumb-item">จัดการ</li>
        <li class="breadcrumb-item active">ข้อความโต้ตอบ</li>

    </ol>
@endsection
<!--Content-->
@section('content')
    <div class="card card-accent-info">
        <div class="card-body">
            <div class="clearfix mb-sm-3" id="page-heading">
                <div class="float-left">
                    <h4><i class="fa fa-paper-plane"></i> ข้อความโต้ตอบ</h4>
                </div>
                <div class="float-right">
                    <a class="btn btn-sm btn-primary text-white"
                       href="javascript:custom.lunchModalAndGetPage('{!! route('checkRequestCreate') !!}','เพิ่มข้อความโต้ตอบ');">
                        <i class="fa fa-plus"></i> เพิ่มข้อความ
                    </a>
                </div>
            </div>
            <table class="table table-striped table-hover table-responsive-sm" id="datatables">
                <thead>
                <tr>
                    <th>#</th>
                    <th>หัวข้อ(TH)</th>
                    <th>หัวข้อ(EN)</th>
                    <th>รายละเอียด(TH)</th>
                    <th>รายละเอียด(EN)</th>
                    <th>จัดการคำตอบ</th>
                    <th>จัดการ</th>
                </tr>
                </thead>
                <tbody>
                @foreach($checkRequests as $index => $item)
                    <tr>
                        <td>{!! ($index + 1) !!}</td>
                        <td>{!! $item->title_th !!}</td>
                        <td>{!! $item->title_en !!}</td>
                        <td>{!! $item->detail_th !!}</td>
                        <td>{!! $item->detail_en !!}</td>
                        <td>
                            <a href="javascript:custom.lunchModalAndGetPage('{!! route('checkResponses', ['checkRequest_id' => $item->id]) !!}', '#{!! $item->id !!} รายการคำตอบ');"
                               class="btn btn-primary btn-sm text-white"
                               data-toggle="tooltip" data-placement="top" title=""
                               data-original-title="รายการคำตอบ"
                            ><i class="fa fa-reply"
                                aria-hidden="true"></i> รายการคำตอบ</a>
                        </td>
                        <td>
                            <a href="javascript:custom.lunchModalAndGetPage('{!! route('checkRequestEdit', ['id' => $item->id]) !!}','แก้ไขข้อความโต้ตอบ');"
                               class="btn btn-warning btn-sm text-white"
                               data-toggle="tooltip" data-placement="top" title=""
                               data-original-title="แก้ไข"
                            ><i class="fa fa-pencil-square-o"
                                aria-hidden="true"></i></a>
                            @if(Auth::user()->type == 0)
                                <a href="javascript:alert.destroy('{!! route('checkRequestDestroy', ['id' => $item->id]) !!}');"
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
