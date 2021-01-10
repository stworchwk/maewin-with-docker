{!! Form::open(['url' => route('travelerUpdate', ['id' => $traveler->id]), 'method' => 'PUT', 'class' => 'form-horizontal', 'id' => 'mainForm']) !!}
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="form-group">
            <label>ชื่อ-นามสกุล</label>
            {!! Form::text('full_name', $traveler->full_name, ['class' => 'form-control', 'placeholder' => 'กรอกชื่อนามสกุล', 'required']) !!}
        </div>
        <div class="form-group">
            <label>สัญชาติ</label>
            {!! Form::select('nationality_id', $nationalities, $traveler->nationality_id, ['class' => 'form-control', 'placeholder' => 'เลือกสัญชาติของนักท่องเที่ยว']) !!}
        </div>
        <div class="form-group">
            <label>ID Card</label>
            {!! Form::text('id_card', $traveler->id_card, ['class' => 'form-control', 'placeholder' => 'กรอก ID Card', 'required']) !!}
        </div>
        <div class="form-group">
            <label>เบอร์โทรศัพท์</label>
            <div class="row">
                <div class="col-md-4">
                    {!! Form::select('prefix_phone_number_id', $prefixPhoneNumbers, $traveler->prefix_phone_number_id, ['class' => 'form-control input-prefix-phone-number', 'placeholder' => 'เลือกรหัสโทรศัพท์ประเทศด้วย']) !!}
                </div>
                <div class="col-md-8">
                    {!! Form::number('phone_number', $traveler->phone_number, ['class' => 'form-control input-phone-number', 'placeholder' => 'กรอกเบอร์โทรศัพท์']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<hr/>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="form-group">
            {!! Form::button('<i class="fa fa-edit"></i> แก้ไขข้อมูลนักท่องเที่ยว' , ['class' => 'btn btn-warning btn-block text-white', 'type' => 'button', 'id' => 'submitForm']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}

<script>
    $(document).on("click", '#submitForm', (e) => {
        if ($("input[name='full_name']").val() === '') {
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
