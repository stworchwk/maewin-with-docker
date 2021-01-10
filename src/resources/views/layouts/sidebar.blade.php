<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link bg-primary" href="{!! route('monitor') !!}">
                    <i class="nav-icon fa fa-desktop text-white"></i> หน้าต่างเฝ้าระวัง
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{!! route('travelerPlans') !!}">
                    <i class="nav-icon fa fa-map text-secondary"></i> แผนการท่องเที่ยว
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{!! route('locations', ['filter' => 'all']) !!}">
                    <i class="nav-icon fa fa-map-marker text-secondary"></i> สถานที่ท่องเที่ยว
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{!! route('checkRequests') !!}">
                    <i class="nav-icon fa fa-paper-plane text-secondary"></i> ข้อความโต้ตอบ
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{!! route('travelers') !!}">
                    <i class="nav-icon fa fa-users text-secondary"></i> ข้อมูลนักท่องเที่ยว
                </a>
            </li>
            <li class="divider"></li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon fa fa-cog text-secondary"></i> จัดการข้อมูล</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{!! route('manageUsers') !!}" target="_top">
                            <i class="fa fa-caret-right"></i> ข้อมูลผู้ใช้
                            <span class="badge badge-warning">แอดมิน</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{!! route('manageLocationCategories') !!}" target="_top">
                            <i class="fa fa-caret-right"></i> ข้อมูลประเภทสถานที่ท่องเที่ยว
                            <span class="badge badge-warning">แอดมิน</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{!! route('managePrefixPhoneNumbers') !!}" target="_top">
                            <i class="fa fa-caret-right"></i> ข้อมูลรหัสโทรศัพท์ประเทศ
                            <span class="badge badge-warning">แอดมิน</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{!! route('manageNationalities') !!}" target="_top">
                            <i class="fa fa-caret-right"></i> ข้อมูลสัญชาติ
                            <span class="badge badge-warning">แอดมิน</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
