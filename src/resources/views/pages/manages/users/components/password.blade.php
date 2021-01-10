{!! Form::open(['url' => route('manageUserPasswordUpdate', ['id' => $id]), 'class' => 'form-horizontal', 'id' => 'mainForm']) !!}
<div class="form-group">
    <div class="col-md-8 offset-md-2">
        <label class="control-label">รหัสผ่านใหม่ : </label>
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'required']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-8 offset-md-2">
        <label class="control-label">ยืนยันรหัสผ่านใหม่ : </label>
        {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password', 'required']) !!}
    </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>
<div class="form-group">
    <div class="col-md-8 offset-md-2">
        {!! Form::button('<i class="fa fa-save"></i> Save' , ['class' => 'btn btn-block btn-primary btn-s-md form-control', 'type' => 'button', 'id' => 'submitForm']) !!}
    </div>
</div>
{!! Form::close() !!}

<script>
    $(document).on("click", '#submitForm', (e) => {
        if ($("input[name='password']").val() === '' || $("input[name='password_confirmation']").val() === '') {
            alert.message('กรุณากรอกรหัสผ่าน และยืนยันรหัสผ่านด้วย', 'error');
        } else if ($("input[name='password']").val().length < 6 || $("input[name='password_confirmation']").val().length < 6) {
            alert.message('รหัสผ่าน และยืนยันรหัสผ่าน ควรมีมากกว่า 5 ตัวอักษร', 'error');
        } else if ($("input[name='password']").val() !== $("input[name='password_confirmation']").val()) {
            alert.message('รหัสผ่าน และยืนยันรหัสผ่านไม่เหมือนกัน', 'error');
        } else {
            $('#' + e.target.id).prop('disabled', true);
            $('#mainForm').submit();
        }
    });
</script>