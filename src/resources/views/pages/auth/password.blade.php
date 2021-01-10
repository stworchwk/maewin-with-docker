{!! Form::open(['url' => route('authPasswordUpdate'), 'class' => 'form-horizontal', 'id' => 'mainForm']) !!}
<div class="row">
    <div class="col-md-8 offset-2">
        <div class="form-group">
            <label>รหัสผ่านเดิม</label>
            {!! Form::password('old_password', ['class' => 'form-control', 'placeholder' => 'รหัสผ่านเดิม', 'required' => true, 'autofocus' => true]) !!}
        </div>
        <hr>
        <div class="form-group">
            <label>รหัสผ่านใหม่</label>
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'รหัสผ่านใหม่', 'required']) !!}
        </div>
        <div class="form-group">
            <label>ยืนยันรหัสผ่านใหม่</label>
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'ยืนยันรหัสผ่านใหม่', 'required']) !!}
        </div>
    </div>
</div>
<hr/>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="form-group">
            {!! Form::button('<i class="fa fa-save"></i> เปลี่ยนแปลง' , ['class' => 'btn btn-primary btn-block', 'type' => 'submit', 'id' => 'submitForm']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}

<script>
    $(document).on("click", '#submitForm', (e) => {
        if ($("input[name='old_password']").val() && $("input[name='password']").val() && $("input[name='password_confirmation']").val()) {
            $('#' + e.target.id).prop('disabled', true);
            $('#mainForm').submit();
        }
    })
</script>