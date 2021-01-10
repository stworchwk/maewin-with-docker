{!! Form::open(['url' => route('manageLocationCategoryStore'), 'class' => 'form-horizontal', 'id' => 'mainForm', 'files' => true]) !!}
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="form-group">
            <label>ชื่อประเภทสถานที่ท่องเที่ยว</label>
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'ชื่อประเภทสินค้า', 'required']) !!}
        </div>
        <div class="form-group">
            <label>รูปหมวดหมู่</label>
            {!! Form::file('icon', ['class' => 'form-control thumbnail', 'accept' => 'image/*']) !!}
        </div>
    </div>
</div>
<hr/>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="form-group">
            {!! Form::button('<i class="fa fa-save"></i> เพิ่มหมวดหมู่' , ['class' => 'btn btn-primary btn-block', 'type' => 'button', 'id' => 'submitForm']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}

<script>
    $(document).on("click", '#submitForm', (e) => {
        if ($("input[name='name']").val() === '') {
            alert.message('โปรดกรอกชื่อหมวดหมู่สถานที่ท่องเที่ยวด้วย!', 'error');
        } else {
            $('#' + e.target.id).prop('disabled', true);
            $('#mainForm').submit();
        }
    })
</script>
