<div class="row">
    <div class="col-md-8 offset-md-2">
        <ul class="list-group">
            <li class="list-group-item active"><span class="h4">{!! $user->full_name !!}</span></li>
            <li class="list-group-item"><strong>ติดต่อ : </strong>{!! ($user->contact == '' ? 'ไม่มีข้อมูล' : $user->contact) !!}</li>
            <li class="list-group-item"><strong>สถานะผู้ใช้ : </strong>{!! ($user->type == 0 ? 'ผู้ดูแลระบบ' : 'ผู้ใช้ทั่วไป') !!}</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <a href="javascript:custom.lunchModalAndGetPage('{!! route('authProfileEdit') !!}','แก้ไขข้อมูลส่วนตัว');" class="btn btn-primary btn-block text-white">แก้ไขข้อมูลส่วนตัว</a>
    </div>
</div>
