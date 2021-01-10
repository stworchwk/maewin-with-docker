{!! Form::open(['url' => route('manageUserUpdate', ['id' => $user->id]), 'method' => 'PUT', 'class' => 'form-horizontal', 'id' => 'mainForm']) !!}
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="form-group">
            <label>ประเภทผู้ใช้</label>
            {!! Form::select('type', ['ผู้ดูแลระบบ', 'ผู้ใช้ทั่วไป'], $user->type, ['class' => 'form-control']) !!}
        </div>
        <hr>
        <div class="form-group">
            <label>ชื่อ-นามสกุล</label>
            {!! Form::text('full_name', $user->full_name, ['class' => 'form-control', 'placeholder' => 'กรอกชื่อนามสกุล', 'required']) !!}
        </div>
        <div class="form-group">
            <label>ข้อมูลการติดต่อ</label>
            {!! Form::textarea('contact', $user->contact, ['class' => 'form-control contact', 'rows' => 3]) !!}
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
        if ($("input[name='full_name']").val() === '') {
            alert.message('โปรดกรอกชื่อ นามสกุลด้วย', 'error');
        } else if ($(".contact").val() === '') {
            alert.message('โปรดกรอกข้อมูลการติดต่อของผู้ใช้ด้วย!', 'error');
        } else {
            $('#' + e.target.id).prop('disabled', true);
            $('#mainForm').submit();
        }
    })
</script>
