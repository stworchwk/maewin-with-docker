<h3>แผนการท่องเที่ยว</h3>
<div class="list-group">
    @foreach($plan->locations as $index => $item)
        <a class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h4 class="mb-1">{!! ($index + 1).'. '.$item->location->title_th !!}</h4>
                @if($item->status == 0)
                    <small class="btn btn-secondary">ยังไม่ได้เริ่ม</small>
                @elseif($item->status == 1)
                    <small class="btn btn-warning"><i class="fa fa-play"></i> กำลังร่วมกิจกรรม</small>
                @else
                    <small class="btn btn-success"><i class="fa fa-check"></i> เสร็จสิ้น</small>
                @endif
            </div>
            @if($item->status != 0)
                @if($item->status == 1)
                    <p class="mb-1">
                        เริ่ม {!! \Carbon\Carbon::parse($item->activity_start)->format('d/m/Y H:i:s') !!}
                    </p>
                    <p class="mb-1">
                        ใช้เวลาไปแล้ว {!! \Carbon\Carbon::parse($item->activity_end)->diffInMinutes(\Carbon\Carbon::now()) !!}
                        นาที
                    </p>
                @else
                    <p class="mb-1">
                        เริ่ม {!! \Carbon\Carbon::parse($item->activity_start)->format('d/m/Y H:i:s') !!}
                    </p>
                    <p class="mb-1">
                        สิ้นสุด {!! \Carbon\Carbon::parse($item->activity_end)->format('d/m/Y H:i:s') !!}
                    </p>
                @endif
            @endif
        </a>
    @endforeach
</div>
