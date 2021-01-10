<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ระบบเฝ้าระวังและกู้ภัย ตำบลแม่วิน</title>
    <!-- Main styles for this application-->
    <link href="{!! url('css/app.css') !!}" rel="stylesheet">
    <!-- Include stylesheet -->
    <link href="{!! url('css/quill.snow.css') !!}" rel="stylesheet">
    @yield('link')
    <link rel="icon" href="{!! url('images/templates/favicon.ico') !!}">
    <style>
        @media print {
            .no-break {
                page-break-before: always;
            }
        }
    </style>
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed @if(!isset($widthScreen)) sidebar-lg-show @endif">
<div id="stw-print" style="position: static; width: 100%; height: 0; visibility: hidden; color: black;">
    @yield('print')
</div>
<div id="printViewLoading" class="text-center text-white"
     style="display: none;position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #000000bf; padding: 10px; border-radius: 10px; z-index: 3000">
    <i class="fa fa-spinner fa-spin fa-3x mt-3"></i><br/>
    <p class="h4 mt-3 mb-3">กำลังแสดงหน้าต่างพิมพ์เอกสาร</p>
</div>
<!-- header -->
@include('layouts.header')
<div class="app-body">
    @include('layouts.sidebar')
    <main class="main">
        @yield('breadcrumb')
        <div class="container-fluid" @if(isset($is_monitor)) style="padding: 0;" @else @if(isset($widthScreen)) style="padding: 0 15px;"@endif @endif>
            @if(isset($widthScreen))
                <div class="animated fadeIn">
                    @endif
                    @yield('content')
                    <img class="img-viewer"
                         style="position: fixed; right: 10px; bottom: 10px; border-radius: 10px; z-index: 2000; border: 2px solid rgb(33, 43, 49); display: none;"
                         src="" width="25%" alt="">
                    @if(isset($widthScreen))
                </div>
            @endif
        </div>
    </main>
</div>
@yield('sensitiveModal')
@include('layouts.modal')
@yield('modal')
<!-- Bootstrap and necessary plugins-->
<script src="{!! url('js/app.js') !!}"></script>

<!-- Include the Quill library -->
<script src="{!! url('js/quill.js') !!}"></script>
<script src="{!! url('js/turndown.js') !!}"></script>
<script src="{!! url('js/markdown-it.min.js') !!}"></script>
<script src="{!! url('js/image-resize.min.js') !!}"></script>

@yield('script')
@if(Session::has('success'))
    <script>
        alert.message('{{Session::get('success')}}', 'success');
    </script>
@elseif($errors->any())
    <script>
        alert.message('{!! $errors->first() !!}', 'error');
    </script>
@endif

</body>

</html>
