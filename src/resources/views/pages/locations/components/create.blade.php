{!! Form::open(['url' => route('locationStore'), 'class' => 'form-horizontal', 'id' => 'mainForm', 'files' => true]) !!}
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="form-group">
            <label>หมวดหมู่สถานที่ท่องเที่ยว</label>
            {!! Form::select('location_category_id', $categories->prepend('ไม่มีข้อมูลหมวดหมู่', 0), 0, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <label>UUID</label>
            {!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'โปรดกรอก UUID ด้วย', 'required']) !!}
        </div>
        <div class="btn-group btn-block" role="group" aria-label="Basic example">
            <button class="btn btn-success select_latlnt" type="button">เลือกตำแหน่งสถานที่</button>
            <button class="btn btn-danger select_des_latlnt" type="button">เลือกตำแหน่งสิ้นสุดเส้นทาง</button>
        </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <label>ตำแหน่งสถานที่</label>
                    {!! Form::text('latitude', null, ['class' => 'form-control form-control-sm input-latitude', 'placeholder' => '#####', 'readonly']) !!}
                    {!! Form::text('longitude', null, ['class' => 'form-control form-control-sm input-longitude', 'placeholder' => '#####', 'readonly']) !!}
                </div>
                <div class="col-md-6">
                    <label>ตำแหน่งสิ้นสุดเส้นทาง</label>
                    {!! Form::text('destination_latitude', null, ['class' => 'form-control form-control-sm input-destination-latitude', 'placeholder' => '#####', 'readonly']) !!}
                    {!! Form::text('destination_longitude', null, ['class' => 'form-control form-control-sm input-destination-longitude', 'placeholder' => '#####', 'readonly']) !!}
                </div>
            </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>ชื่อสถานที่ท่องเที่ยว (TH)</label>
            {!! Form::text('title_th', null, ['class' => 'form-control', 'placeholder' => 'ชื่อสถานที่ท่องเที่ยว (TH)', 'required']) !!}
        </div>
        <div class="form-group">
            <label>ชื่อสถานที่ท่องเที่ยว (EN)</label>
            {!! Form::text('title_en', null, ['class' => 'form-control', 'placeholder' => 'ชื่อสถานที่ท่องเที่ยว (EN)', 'required']) !!}
        </div>
        <div class="form-group">
            <label>ชื่อเจ้าของกิจการ</label>
            {!! Form::text('owner_full_name', null, ['class' => 'form-control', 'placeholder' => 'ชื่อเจ้าของกิจการ']) !!}
        </div>
        <div class="form-group">
            <label>เบอร์โทร์ศัพท์</label>
            {!! Form::text('tel', null, ['class' => 'form-control', 'placeholder' => 'เบอร์โทร์ศัพท์']) !!}
        </div>
        <div class="form-group">
            <label>รูปขนาดย่อ</label>
            {!! Form::file('thumbnail', ['class' => 'form-control thumbnail', 'accept' => 'image/*']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>ชื่อหมู่บ้าน</label>
            {!! Form::text('village_name', null, ['class' => 'form-control', 'placeholder' => 'ชื่อหมู่บ้าน']) !!}
        </div>
        <div class="form-group">
            <label>หมู่บ้านที่</label>
            {!! Form::select('village_no', range(0, 50), 5, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <label>ที่อยู่</label>
            {!! Form::textarea('address', null, ['class' => 'form-control', 'rows' => 3]) !!}
        </div>
        <div class="form-group">
            <label>ค่าใช้จ่ายโดยประมาณ</label>
            {!! Form::number('budget', 200,['class' => 'form-control', 'placeholder' => 'ค่าใช้จ่ายโดยประมาณ']) !!}
        </div>
        <div class="form-group">
            <label>เวลากิจกรรมโดยประมาณ(นาที)</label>
            {!! Form::number('time_spent', 30,['class' => 'form-control', 'placeholder' => 'เวลากิจกรรมโดยประมาณ']) !!}
        </div>
    </div>
</div>
<hr/>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="form-group">
            {!! Form::button('<i class="fa fa-save"></i> เพิ่มสถานที่ท่องเที่ยว' , ['class' => 'btn btn-primary btn-block', 'type' => 'button', 'id' => 'submitForm']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}

<script>
    function isAlphaOrParen(str) {
        console.log(/^[a-zA-Z0-9 ]+$/.test(str))
        return /^[a-zA-Z0-9 ]+$/.test(str);
    }

    $(document).off('click', '.select_latlnt').on('click', '.select_latlnt', e => {
        window.selectFunction = 0;
        $('.map-content').show();
    });

    $(document).off('click', '.select_des_latlnt').on('click', '.select_des_latlnt', e => {
        window.selectFunction = 1;
        $('.map-content').show();
    });

    $('.thumbnail').on('change', function() {
        var image_extension = this.files[0].name.split('.').pop().toUpperCase();
        if (image_extension !== 'PNG' && image_extension !== 'JPG' && image_extension !== 'JPEG') {
            alert.message('รูปภาพต้องเป็น PNG JPG และ JPEG เท่านั้น', 'error');
        } else if (this.files[0].size > 1024000) {
            alert.message('รูปภาพไม่ควรเกิน 1MB', 'error');
        }
    });

    $(document).on("click", '#submitForm', (e) => {
        if ($("input[name='code']").val() === '') {
            alert.message('โปรดกรอก UUID ด้วย', 'error');
        } else if ($("input[name='latitude']").val() === '' || $("input[name='longitude']").val() === '') {
            alert.message('โปรดเลือกตำแหน่งสถานที่ท่องเที่ยวด้วย!', 'error');
        } else if ($("input[name='destination_latitude']").val() === '' || $("input[name='destination_longitude']").val() === '') {
            alert.message('โปรดเลือกตำแหน่งจุดสิ้นสุดถนนของสถานที่ท่องเที่ยวด้วย!', 'error');
        } else if ($("input[name='title_th']").val() === '') {
            alert.message('โปรดกรอกชื่อสถานที่ท่องเที่ยว(TH) ด้วย!', 'error');
        } else if (!isAlphaOrParen($("input[name='title_en']").val() )) {
            alert.message('ชื่อสถานที่ท่องเที่ยว(EN) ควรเป็นภาษาอังกฤษเท่านั้น!', 'error');
        } else if ($("input[name='title_en']").val() === '') {
            alert.message('โปรดกรอกชื่อสถานที่ท่องเที่ยว(EN) ด้วย!', 'error');
        } else {
            $('#' + e.target.id).prop('disabled', true);
            $('#mainForm').submit();
        }
    })
</script>
