<div class="create-section" style="display: none">
    {!! Form::open(['url' => route('locationAlbumStore', ['id' => $location->id]), 'class' => 'form-horizontal', 'id' => 'mainForm', 'files' => true]) !!}
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="form-group">
                <label>เลือกรูปภาพ</label>
                {!! Form::file('file', ['class' => 'form-control file', 'accept' => 'image/*']) !!}
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>หัวข้อคำอธิบายภาพ(TH)</label>
                        {!! Form::text('title_th', null, ['class' => 'form-control', 'placeholder' => 'หัวข้อคำอธิบายภาพ(TH)']) !!}
                    </div>
                    <div class="form-group">
                        <label>รายละเอียดแบบย่อของคำอธิบายภาพ(TH)</label>
                        {!! Form::textarea('detail_th', null, ['class' => 'form-control', 'rows' => 3]) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>หัวข้อคำอธิบายภาพ(EN)</label>
                        {!! Form::text('title_en', null, ['class' => 'form-control', 'placeholder' => 'หัวข้อคำอธิบายภาพ(EN)']) !!}
                    </div>
                    <div class="form-group">
                        <label>รายละเอียดแบบย่อของคำอธิบายภาพ(EN)</label>
                        {!! Form::textarea('detail_en', null, ['class' => 'form-control', 'rows' => 3]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="form-group">
                {!! Form::button('<i class="fa fa-plus"></i> เพิ่มรูปภาพ' , ['class' => 'btn btn-success btn-block', 'type' => 'button', 'id' => 'submitForm']) !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <hr/>
</div>

<div class="carousel slide" id="carouselExampleControls" data-ride="carousel">
    <a class="btn btn-success btn-sm text-white createShow"
       style="cursor: pointer; position: absolute; left: 0; z-index: 2000"><i class="fa fa-plus"></i> เพิ่มรูป</a>
    <a class="btn btn-danger btn-sm text-white createClose"
       style="display:none; cursor: pointer; position: absolute; left: 0; z-index: 2000"><i class="fa fa-times"></i>
        ปิดเพิ่มรูป</a>
    <div class="carousel-inner">
        @if(count($location->images) > 0)
            @foreach($location->images as $index => $item)
                <div class="carousel-item @if($index == 0) active @endif">
                    <a class="btn btn-danger btn-sm text-white" href="javascript:alert.destroy('{!! route('locationAlbumDestroy', ['image_id' => $item->id]) !!}');"
                       style="cursor: pointer; position: absolute; right: 0; z-index: 2000"><i class="fa fa-trash"></i> ลบรูปภาพ</a>
                    <img class="d-block w-100"
                         src="{!! url($item->path) !!}"
                         data-holder-rendered="true">
                    <div class="carousel-caption d-none d-md-block">
                        @if($item->title_th != '')<span>(TH) {!! $item->title_th !!}</span><br/>@endif
                        @if($item->title_en != '')<small>(TH) {!! $item->title_en !!}</small><br/>@endif
                        @if($item->detail_th != '')<span>(EN) {!! $item->detail_th !!}</span><br/>@endif
                        @if($item->detail_en != '')<small>(EN) {!! $item->detail_en !!}</small>@endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="carousel-item active">
                <img class="d-block w-100"
                     src="{!! url('images/templates/no-image.jpg') !!}"
                     data-holder-rendered="true">
            </div>
        @endif
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"><span
            class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a
        class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"><span
            class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a>
</div>
<script>

    $(document).off('click', '.createShow').on('click', '.createShow', e => {
        $('.create-section').show();
        $('.createClose').show();
        $(e.currentTarget).hide();
    });

    $(document).off('click', '.createClose').on('click', '.createClose', e => {
        $('.create-section').hide();
        $('.createShow').show();
        $(e.currentTarget).hide();
    });

    $('.file').on('change', function () {
        var image_extension = this.files[0].name.split('.').pop().toUpperCase();
        if (image_extension !== 'PNG' && image_extension !== 'JPG' && image_extension !== 'JPEG') {
            alert.message('รูปภาพต้องเป็น PNG JPG และ JPEG เท่านั้น', 'error');
        } else if (this.files[0].size > 1024000) {
            alert.message('รูปภาพไม่ควรเกิน 1MB', 'error');
        }
    });

    $(document).on("click", '#submitForm', (e) => {
        $('#' + e.target.id).prop('disabled', true);
        $('#mainForm').submit();
    })
</script>
