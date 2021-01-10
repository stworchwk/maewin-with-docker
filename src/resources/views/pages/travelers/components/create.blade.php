{!! Form::open(['url' => route('travelerStore'), 'class' => 'form-horizontal', 'id' => 'mainForm']) !!}
<div class="row">
    <div class="col-md-5">
        <div class="form-group">
            <label>อีเมล</label>
            {!! Form::email('email', null, ['class' => 'form-control input-username', 'placeholder' => 'กรอกอีเมล', 'required']) !!}
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
            <label>ชื่อ-นามสกุล</label>
            {!! Form::text('full_name', null, ['class' => 'form-control', 'placeholder' => 'กรอกชื่อนามสกุล', 'required']) !!}
        </div>
        <div class="form-group">
            <label>สัญชาติ</label>
            {!! Form::select('nationality_id', $nationalities, null, ['class' => 'form-control', 'placeholder' => 'เลือกสัญชาติของนักท่องเที่ยว']) !!}
        </div>
        <div class="form-group">
            <label>ID Card</label>
            {!! Form::text('id_card', null, ['class' => 'form-control', 'placeholder' => 'กรอก ID Card', 'required']) !!}
        </div>
        <div class="form-group">
            <label>เบอร์โทรศัพท์</label>
            <div class="row">
                <div class="col-md-4">
                    {!! Form::select('prefix_phone_number_id', $prefixPhoneNumbers, null, ['class' => 'form-control input-prefix-phone-number', 'placeholder' => 'เลือกรหัสโทรศัพท์ประเทศด้วย']) !!}
                </div>
                <div class="col-md-8">
                    {!! Form::number('phone_number', null, ['class' => 'form-control input-phone-number', 'placeholder' => 'กรอกเบอร์โทรศัพท์']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<hr/>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="form-group">
            {!! Form::button('<i class="fa fa-save"></i> เพิ่มข้อมูลนักท่องเที่ยว' , ['class' => 'btn btn-primary btn-block', 'type' => 'button', 'id' => 'submitForm']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}

<script>
    $(document).on("click", '#submitForm', (e) => {
        if ($("input[name='email']").val() === '') {
            alert.message('โปรดกรอกอีเมลด้วย', 'error');
        } else if ($("input[name='password']").val() === '' || $("input[name='password_confirmation']").val() === '') {
            alert.message('กรุณากรอกรหัสผ่าน และยืนยันรหัสผ่านด้วย', 'error');
        } else if ($("input[name='password']").val().length < 6 || $("input[name='password_confirmation']").val().length < 6) {
            alert.message('รหัสผ่าน และยืนยันรหัสผ่าน ควรมีมากกว่า 5 ตัวอักษร', 'error');
        } else if ($("input[name='password']").val() !== $("input[name='password_confirmation']").val()) {
            alert.message('รหัสผ่าน และยืนยันรหัสผ่านไม่เหมือนกัน', 'error');
        } else if ($("input[name='full_name']").val() === '') {
            alert.message('โปรดกรอกชื่อ นามสกุลด้วย', 'error');
        } else if ($("input[name='id_card']").val() === '') {
            alert.message('โปรดกรอกรหัสประจำตัวนักท่องเที่ยวด้วย', 'error');
        } else if ($(".input-prefix-phone-number").val() === null) {
            alert.message('โปรดเลือกรหัสโทรศัพท์ประเทศด้วย!', 'error');
        }  else if ($(".input-phone-number").val() === '') {
            alert.message('โปรดกรอกเบอร์โทรศัพท์ด้วย!', 'error');
        } else {
            $('#' + e.target.id).prop('disabled', true);
            $('#mainForm').submit();
        }
    })

</script>
