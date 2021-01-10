{!! Form::open(['url' => route('managePrefixPhoneNumberUpdate', ['id' => $prefixPhoneNumber->id]), 'method' => 'PUT', 'class' => 'form-horizontal', 'id' => 'mainForm']) !!}
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="form-group">
            <label>รหัสโทรศัพท์ประเทศ</label>
            {!! Form::text('prefix', $prefixPhoneNumber->prefix, ['class' => 'form-control', 'placeholder' => 'รหัสโทรศัพท์ประเทศ', 'required']) !!}
        </div>
        <div class="form-group">
            <label>ชื่อประเทศ (TH)</label>
            {!! Form::text('name_th', $prefixPhoneNumber->name_th, ['class' => 'form-control', 'placeholder' => 'ชื่อประเทศ (TH)', 'required']) !!}
        </div>
        <div class="form-group">
            <label>ชื่อประเทศ (EN)</label>
            {!! Form::text('name_en', $prefixPhoneNumber->name_en, ['class' => 'form-control', 'placeholder' => 'ชื่อประเทศ (EN)', 'required']) !!}
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
        if ($("input[name='prefix']").val() === '') {
            alert.message('โปรดกรอกรหัสโทรศัพท์ประเทศด้วย!', 'error');
        } else if ($("input[name='name_th']").val() === '') {
            alert.message('โปรดกรอกชื่อประเทศ(TH) ด้วย!', 'error');
        } else if ($("input[name='name_en']").val() === '') {
            alert.message('โปรดกรอกชื่อประเทศ(EN) ด้วย!', 'error');
        } else {
            $('#' + e.target.id).prop('disabled', true);
            $('#mainForm').submit();
        }
    })
</script>
