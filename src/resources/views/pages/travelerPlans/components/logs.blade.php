<table class="table table-striped table-hover table-responsive-sm" id="datatables-plan-log">
    <thead>
    <tr>
        <th>วันที่/เวลา</th>
        <th>ประเภท</th>
        <th>หัวข้อ</th>
        <th>รายละเอียด</th>
        <th>ตำแหน่ง</th>
    </tr>
    </thead>
    <tbody>
    @foreach($plan->logs as $index => $item)
        <tr>
            <td>{!! \Carbon\Carbon::parse($item->date_time)->format('d/m/Y H:i:s') !!}</td>
            <td>
                @if($item->type == 0)
                    เช็คอิน/เช็คเอาท์
                @elseif($item->type == 1)
                    ระบบตรวจสอบ
                @else
                    ทั่วไป
                @endif
            </td>
            <td>{!! $item->title !!}</td>
            <td>{!! $item->detail !!}</td>
            <td>{!! $item->latitude.', '.$item->longitude !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function () {
        $('#datatables-plan-log').DataTable();
    });
</script>
