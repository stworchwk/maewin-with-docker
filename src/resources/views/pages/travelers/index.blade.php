@extends('layouts.master') @section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">หน้าแรก</li>
        <li class="breadcrumb-item active">ข้อมูลนักท่องเที่ยว</li>
    </ol>
@endsection
<!--Content-->
@section('content')
    <div class="card card-accent-info">
        <div class="card-body">
            <div class="clearfix mb-sm-3" id="page-heading">
                <div class="float-left">
                    <h4><i class="fa fa-users"></i> ข้อมูลนักท่องเที่ยว</h4>
                </div>
                <div class="float-right">
                    <a class="btn btn-sm btn-primary text-white"
                       href="javascript:custom.lunchModalAndGetPage('{!! route('travelerCreate') !!}','เพิ่มข้อมูลนักท่องเที่ยว');">
                        <i class="fa fa-plus"></i> เพิ่มข้อมูลนักท่องเที่ยว
                    </a>
                </div>
            </div>
            <table class="table table-striped table-hover table-responsive-sm" id="datatables">
                <thead>
                <tr>
                    <th>#</th>
                    <th>ชื่อผุ้ใช้</th>
                    <th>ชื่อนามสกุล</th>
                    <th>สัญชาติ</th>
                    <th>รหัสประจำตัว</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>ผูกบัญชี</th>
                    <th>สถานะ</th>
                    <th>จัดการ</th>
                </tr>
                </thead>
                <tbody>
                @foreach($travelers as $index => $item)
                    <tr>
                        <td>{!! ($index + 1) !!}</td>
                        <td>
                            {!! $item->email !!}
                        </td>
                        <td>{!! $item->full_name !!}</td>
                        <td>{!! $item->nationality ? $item->nationality->name_th : 'ไม่มีข้อมูล' !!}</td>
                        <td>{!! $item->id_card ? $item->id_card : 'ไม่มีข้อมูล' !!}</td>
                        <td>{!! $item->prefixPhone ? $item->prefixPhone->prefix.' '.$item->phone_number : 'ไม่มีข้อมูล' !!}</td>
                        <td>
                            @if($item->active == 1)
                                <a href="#"
                                   class="btn btn-sm btn-block btn-google-plus"
                                   data-toggle="tooltip" data-placement="top" title=""
                                   data-original-title="ผูกบัญชี Google">ผูกบัญชี <i class="fa fa-google-plus"></i></a>
                            @endif
                        </td>
                        <td>
                            @if($item->active == 0)
                                <a href="javascript:alert.changeActive('{!! route('travelerActive', ['id' => $item->id]) !!}', '{!! $item->active !!}');"
                                   class="btn btn-danger btn-sm btn-block"
                                   data-toggle="tooltip" data-placement="top" title="" id="btnChangeActive"
                                   data-original-title="เปิดการใช้งาน">ถูกระบบการใช้งาน</a>
                            @else
                                <a href="javascript:alert.changeActive('{!! route('travelerActive', ['id' => $item->id]) !!}', '{!! $item->active !!}');"
                                   class="btn btn-primary btn-sm btn-block"
                                   data-toggle="tooltip" data-placement="top" title="" id="btnChangeActive"
                                   data-original-title="ระงับการใช้งาน">เปิดใช้งานปกติ</a>
                            @endif
                        </td>
                        <td>
                            @if($item->active == 1)
                                <a href="javascript:custom.lunchModalAndGetPage('{!! route('travelerPassword', ['id' => $item->id]) !!}','รีเซ็ทรหัสผ่านนักท่องเที่ยว');"
                                   class="btn btn-primary btn-sm text-white"
                                   data-toggle="tooltip" data-placement="top" title=""
                                   data-original-title="รีเซ็ทรหัสผ่าน"
                                ><i class="fa fa-key"
                                    aria-hidden="true"></i></a>
                                <a href="javascript:custom.lunchModalAndGetPage('{!! route('travelerEdit', ['id' => $item->id]) !!}','แก้ไขข้อมูลนักท่องเที่ยว');"
                                   class="btn btn-warning btn-sm text-white"
                                   data-toggle="tooltip" data-placement="top" title=""
                                   data-original-title="แก้ไข"
                                ><i class="fa fa-pencil-square-o"
                                    aria-hidden="true"></i></a>
                                <a href="javascript:alert.destroy('{!! route('travelerDestroy', ['id' => $item->id]) !!}');"
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
