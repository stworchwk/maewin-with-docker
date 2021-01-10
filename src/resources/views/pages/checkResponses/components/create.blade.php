{!! Form::open(['url' => route('checkResponseStore', ['checkRequest_id' => $checkRequest_id]), 'class' => 'form-horizontal', 'id' => 'mainForm']) !!}
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="form-group">
            <label>หมวดคำตอบ</label>
            {!! Form::select('level', ['กำลังเดินทาง', 'ขยายเวลา', 'กู้ภัย'], 0, ['class' => 'form-control input-level']) !!}
        </div>
        <div class="form-group">
            <label>รายการคำตอบ (TH)</label>
            {!! Form::text('name_th', null, ['class' => 'form-control', 'placeholder' => 'รายการคำตอบ (TH)', 'required']) !!}
        </div>
        <div class="form-group">
            <label>รายการคำตอบ (EN)</label>
            {!! Form::text('name_en', null, ['class' => 'form-control', 'placeholder' => 'รายการคำตอบ (EN)', 'required']) !!}
        </div>
        <div class="form-group skip-time-content" style="display: none">
            <label>เวลาที่ขยาย (นาที)</label>
            {!! Form::select('skip_time', range(0, 120), 20, ['class' => 'form-control input-skip-time']) !!}
        </div>
    </div>
</div>
<hr/>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="form-group">
            {!! Form::button('<i class="fa fa-save"></i> เพิ่มคำตอบ' , ['class' => 'btn btn-primary btn-block', 'type' => 'button', 'id' => 'submitForm']) !!}
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

