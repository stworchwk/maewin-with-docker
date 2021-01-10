@foreach($checkRequests as $index => $checkRequest)
    <div class="input-group mb-2">
        <span class="input-group-prepend">
<button class="btn btn-success" type="button">
<i class="fa fa-paper-plane"></i> ส่งข้อความ
</button>
        </span>
        <input class="form-control" type="text" value="{!! $checkRequest->title_th !!}" disabled>
    </div>
@endforeach
