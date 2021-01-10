{!! Form::open(['url' => route('manageNationalityUpdate', ['id' => $nationality->id]), 'method' => 'PUT', 'class' => 'form-horizontal', 'id' => 'mainForm']) !!}
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="form-group">
            <label>ชื่อสัญชาติ (TH)</label>
            {!! Form::text('name_th', $nationality->name_th, ['class' => 'form-control', 'placeholder' => 'ชื่อสัญชาติ (TH)', 'required']) !!}
        </div>
        <div class="form-group">
            <label>ชื่อสัญชาติ (EN)</label>
            {!! Form::text('name_en', $nationality->name_en, ['class' => 'form-control', 'placeholder' => 'ชื่อสัญชาติ (EN)', 'required']) !!}
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
        if ($("input[name='name_th']").val() === '') {
            alert.message('โปรดกรอกชื่อสัญชาติ(TH) ด้วย!', 'error');
        } else if ($("input[name='name_en']").val() === '') {
            alert.message('โปรดกรอกชื่อสัญชาติ(EN) ด้วย!', 'error');
        } else {
            $('#' + e.target.id).prop('disabled', true);
            $('#mainForm').submit();
        }
    })
</script>
