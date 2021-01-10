{!! Form::open(['url' => route('manageUserStore'), 'class' => 'form-horizontal', 'id' => 'mainForm']) !!}
<div class="row">
    <div class="col-md-5">
        <div class="form-group">
            <label>ชื่อผู้ใช้</label>
            {!! Form::text('username', null, ['class' => 'form-control input-username', 'placeholder' => 'กรอกชื่อผู้ใช้', 'required']) !!}
            <div class="invalid-feedback username-invalid" style="display: none">
                ชื่อผู้ใช้ต้องเป็น a-z A-Z และ 0-9 เท่านั้น
            </div>
        </div>
        <div class="form-group">
            <label>รหัสผ่าน</label>
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'กรอกรหัสผ่าน', 'required']) !!}
        </div>
        <div class="form-group">
            <label>ยืนยันรหัสผ่าน</label>
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'กรอกยืนยันรหัสผ่าน', 'required']) !!}
        </div>
    </div>
    <div class="col-md-7 border-left">
        <div class="form-group">
            <label>ประเภทผู้ใช้</label>
            {!! Form::select('type', ['ผู้ดูแลระบบ', 'ผู้ใช้ทั่วไป'], 1, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <label>ชื่อ-นามสกุล</label>
            {!! Form::text('full_name', null, ['class' => 'form-control', 'placeholder' => 'กรอกชื่อนามสกุล', 'required']) !!}
        </div>
        <div class="form-group">
            <label>ข้อมูลการติดต่อ</label>
            {!! Form::textarea('contact', null, ['class' => 'form-control contact', 'rows' => 3]) !!}
        </div>
    </div>
</div>
<hr/>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="form-group">
            {!! Form::button('<i class="fa fa-save"></i> เพิ่มผู้ใช้' , ['class' => 'btn btn-primary btn-block', 'type' => 'button', 'id' => 'submitForm']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}

<script>
    function isAlphaOrParen(str) {
        return /^[a-zA-Z0-9]+$/.test(str);
    }

    $(document).on("keyup", '.input-username', (e) => {
        if (isAlphaOrParen($("input[name='username']").val())) {
            $('.input-username').removeClass('is-invalid');
            $('.input-username').addClass('is-valid');
            $('.username-invalid').hide();
        } else {
            $('.input-username').addClass('is-invalid');
            $('.username-invalid').show();
        }
    });


    $(document).on("click", '#submitForm', (e) => {
        if ($("input[name='username']").val() === '') {
            alert.message('ควรกรอกชื่อผู้ใช้ด้วยเสมอ', 'error');
        } else if ($("input[name='password']").val() === '' || $("input[name='password_confirmation']").val() === '') {
            alert.message('กรุณากรอกรหัสผ่าน และยืนยันรหัสผ่านด้วย', 'error');
        } else if ($("input[name='password']").val().length < 6 || $("input[name='password_confirmation']").val().length < 6) {
            alert.message('รหัสผ่าน และยืนยันรหัสผ่าน ควรมีมากกว่า 5 ตัวอักษร', 'error');
        } else if ($("input[name='password']").val() !== $("input[name='password_confirmation']").val()) {
            alert.message('รหัสผ่าน และยืนยันรหัสผ่านไม่เหมือนกัน', 'error');
        } else if ($("input[name='full_name']").val() === '') {
            alert.message('โปรดกรอกชื่อ นามสกุลด้วย', 'error');
        } else if ($(".contact").val() === '') {
            alert.message('โปรดกรอกข้อมูลการติดต่อของผู้ใช้ด้วย!', 'error');
        } else {
            $('#' + e.target.id).prop('disabled', true);
            $('#mainForm').submit();
        }
    })

</script>
