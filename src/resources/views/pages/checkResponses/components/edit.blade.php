{!! Form::open(['url' => route('checkResponseUpdate', ['id' => $checkResponse->id]), 'method' => 'PUT', 'class' => 'form-horizontal', 'id' => 'mainForm']) !!}
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="form-group">
            <label>หมวดคำตอบ</label>
            {!! Form::select('level', ['กำลังเดินทาง', 'ขยายเวลา', 'กู้ภัย'], $checkResponse->level, ['class' => 'form-control input-level']) !!}
        </div>
        <div class="form-group">
            <label>รายการคำตอบ (TH)</label>
            {!! Form::text('name_th', $checkResponse->name_th, ['class' => 'form-control', 'placeholder' => 'รายการคำตอบ (TH)', 'required']) !!}
        </div>
        <div class="form-group">
            <label>รายการคำตอบ (EN)</label>
            {!! Form::text('name_en', $checkResponse->name_en, ['class' => 'form-control', 'placeholder' => 'รายการคำตอบ (EN)', 'required']) !!}
        </div>
        <div class="form-group skip-time-content" @if($checkResponse->level != 1) style="display: none" @endif>
            <label>เวลาที่ขยาย (นาที)</label>
            {!! Form::select('skip_time', range(0, 120), $checkResponse->skip_time, ['class' => 'form-control input-skip-time']) !!}
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
    $(document).off('change', '.input-level').on('change', '.input-level', e => {
        if(Number($(e.currentTarget).val()) ===  1){
            $('.skip-time-content').show();
        }else{
            $('.skip-time-content').hide();
        }
    });

    $(document).on("click", '#submitForm', (e) => {
        if ($("input[name='name_th']").val() === '') {
            alert.message('โปรดกรอกรายการคำตอบ(TH) ด้วย!', 'error');
        } else if ($("input[name='name_en']").val() === '') {
            alert.message('โปรดกรอกรายการคำตอบ(EN) ด้วย!', 'error');
        } else {
            $('#' + e.target.id).prop('disabled', true);
            $('#mainForm').submit();
        }
    })
</script>
