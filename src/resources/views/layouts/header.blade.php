<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <button class="navbar-toggler sidebar-toggler d-lg-none" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <span class="h4 m-auto">ระบบเฝ้าระวังและกู้ภัย ตำบลแม่วิน</span>
    <ul class="nav navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
               aria-expanded="false">
                <img class="img-avatar"
                     src="{!! url('images/templates/logo.png') !!}"
                     alt="{!! Auth::user()->full_name !!}">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>{!! Auth::user()->full_name !!}</strong>
                </div>
                <a class="dropdown-item"
                   href="javascript:custom.lunchModalAndGetPage('{!! route('authProfile') !!}','ข้อมูลส่วนตัว');">
                    <i class="fa fa-user"></i> ข้อมูลส่วนตัว</a>
                <a class="dropdown-item"
                   href="javascript:custom.lunchModalAndGetPage('{!! route('authPassword') !!}','เปลี่ยนแปลงรหัสผ่าน');">
                    <i class="fa fa-wrench"></i> เปลี่ยนแปลงรหัสผ่าน</a>
                <div class="divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="fa fa-lock"></i> ออกจากระบบ</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</header>
