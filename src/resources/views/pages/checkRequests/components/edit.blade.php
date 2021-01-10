{!! Form::open(['url' => route('checkRequestUpdate', ['id' => $checkRequest->id]), 'method' => 'PUT', 'class' => 'form-horizontal', 'id' => 'mainForm']) !!}
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="form-group">
            <label>หัวข้อ (TH)</label>
            {!! Form::text('title_th', $checkRequest->title_th, ['class' => 'form-control', 'placeholder' => 'หัวข้อ (TH)', 'required']) !!}
        </div>
        <div class="form-group">
            <label>หัวข้อ (EN)</label>
            {!! Form::text('title_en', $checkRequest->title_en, ['class' => 'form-control', 'placeholder' => 'หัวข้อ (EN)', 'required']) !!}
        </div>
        <div class="form-group">
            <label>รายละเอียด (TH)</label>
            {!! Form::textarea('detail_th', $checkRequest->detail_th, ['class' => 'form-control', 'rows' => 4, 'placeholder' => 'รายละเอียด (TH)', 'required']) !!}
        </div>
        <div class="form-group">
            <label>รายละเอียด (EN)</label>
            {!! Form::textarea('detail_en', $checkRequest->detail_en, ['class' => 'form-control', 'rows' => 4, 'placeholder' => 'รายละเอียด (EN)', 'required']) !!}
        </div>
    </div>
</div>
<hr/>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="form-group">
            {!! Form::button('<i class="fa fa-edit"></i> แก้ไข' , ['class' => 'btn btn-warning btn-block text-white', 'type' => 'button', 'id' => 'submitForm']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}

<script>
    $(document).on("click", '#submitForm', (e) => {
        if ($("input[name='title_th']").val() === '') {
            alert.message('โปรดกรอกหัวข้อ(TH) ด้วย!', 'error');
        } else if ($("input[name='title_en']").val() === '') {
            alert.message('โปรดกรอกหัวข้อ(EN) ด้วย!', 'error');
        } else if ($("input[name='detail_th']").val() === '') {
            alert.message('โปรดกรอกรายละเอียดข้อความโต้ตอบ(EN) ด้วย!', 'error');
        } else if ($("input[name='detail_en']").val() === '') {
            alert.message('โปรดกรอกรายละเอียดข้อความโต้ตอบ(EN) ด้วย!', 'error');
        } else {
            $('#' + e.target.id).prop('disabled', true);
            $('#mainForm').submit();
        }
    })
</script>
