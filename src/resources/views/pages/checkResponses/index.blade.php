<div class="row">
    <div class="col-md-12 text-right">
        <a class="btn btn-sm btn-primary text-white"
           href="javascript:custom.lunchModalAndGetPage('{!! route('checkResponseCreate', ['checkRequest_id' => $checkRequest_id]) !!}','เพิ่มรายการคำตอบ');">
            <i class="fa fa-plus"></i> เพิ่มรายการคำตอบ
        </a>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-10 offset-md-1">
        @if(count($checkResponses) > 0)
            <div class="list-group">
                @foreach($checkResponses as $item)
                    @php
                        $color = '';
$label = '';
if ($item->level == 0){
$color = 'list-group-item-success';
$label = 'กำลังเดินทาง';
}elseif($item->level == 1){
$color = 'list-group-item-warning';
$label = 'ขยายเวลา <br/>+'.$item->skip_time.'m';
}else{
$color = 'list-group-item-danger';
$label = 'กู้ภัย';
}

                    @endphp
                    <a class="list-group-item flex-column align-items-start {!! $color !!} d-flex">
                        <div class="d-flex w-100 justify-content-between">
                            <div>
                                <h4 style="margin-bottom: 0">
                            <span class="badge badge-pill badge-light">
{!! $label !!}
                        </span>
                                </h4>
                            </div>
                            <div>
                                <p class="mb-0"><span class="text-success">(TH)</span> {!! $item->name_th !!}</p>
                                <small><span class="text-success">(EN)</span> {!! $item->name_en !!}</small>
                            </div>
                            <div>
                                <button class="btn btn-warning btn-sm text-white" onclick="custom.lunchModalAndGetPage('{!! route('checkResponseEdit', ['id' => $item->id]) !!}','แก้ไขรายการคำตอบ');"
                                        data-toggle="tooltip" data-placement="top" title=""
                                        data-original-title="แก้ไข"
                                ><i class="fa fa-pencil-square-o"
                                    aria-hidden="true"></i></button>
                                <button class="btn btn-danger btn-sm" id="btnDestroy" onclick="alert.destroy('{!! route('checkResponseDestroy', ['id' => $item->id]) !!}');"
                                        data-toggle="tooltip" data-placement="top" title=""
                                        data-original-title="ลบ"
                                ><i class="fa fa-times" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="alert alert-secondary text-center" role="alert">ไม่มีรายการคำตอบ</div>
        @endif
    </div>
</div>
