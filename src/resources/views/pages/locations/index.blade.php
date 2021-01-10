@extends('layouts.master') @section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">หน้าแรก</li>
        <li class="breadcrumb-item active">สถานที่ท่องเที่ยว
    </ol>
@endsection
<!--Content-->
@section('content')
    <div class="card card-accent-info">
        <div class="card-body">
            <div class="clearfix mb-sm-3" id="page-heading">
                <div class="float-left">
                    <h4><i class="fa fa-map-marker"></i> สถานที่ท่องเที่ยว</h4>
                    {!! Form::select('category_id', $categories->prepend('เลือกทั้งหมด', 0), $select_filter, ['class' => 'form-control selectCategory mt-3 mb-2']) !!}
                </div>
                <div class="float-right">
                    <a class="btn btn-sm btn-primary text-white"
                       href="javascript:custom.lunchModalAndGetPage('{!! route('locationCreate') !!}','เพิ่มสถานที่ท่องเที่ยว');">
                        <i class="fa fa-plus"></i> เพิ่มสถานที่ท่องเที่ยว
                    </a>
                </div>
            </div>
            <table class="table table-striped table-hover table-responsive-sm" id="datatables">
                <thead>
                <tr>
                    <th>#</th>
                    <th>หมวดหมู่</th>
                    <th>รหัส</th>
                    <th>รูปขนาดย่อ</th>
                    <th>ชื่อ</th>
                    <th>ตำแหน่ง</th>
                    <th>ค่าใช้จ่าย</th>
                    <th>เวลากิจกรรม</th>
                    <th>เพิ่มเติม</th>
                    <th>สถานะ</th>
                    <th>จัดการ</th>
                </tr>
                </thead>
                <tbody>
                @foreach($locations as $index => $item)
                    <tr>
                        <td>{!! ($index + 1) !!}</td>
                        <td>
                            @if($item->location_category_id == 0)
                                <span class="text-danger">ไม่มีประเภท</span>
                            @else
                                <span class="text-success">{!! $item->category->name !!}</span>
                            @endif
                        </td>
                        <td>{!! $item->code !!}</td>
                        <td>
                            <img
                                src="{!! $item->thumbnail == '' ? '//via.placeholder.com/300x300' : url($item->thumbnail) !!}"
                                class="mouse-over-event" width="50px"
                                style="border-radius: 5px">
                        </td>
                        <td>{!! $item->title_th !!}<br/><small>{!! $item->title_en !!}</small></td>
                        <td>
                            <a class="btn btn-success btn-sm btn-block text-white showLocation" style="cursor:pointer;"
                               data-lat="{!! $item->latitude !!}" data-lnt="{!! $item->longitude !!}"><i
                                    class="fa fa-map-marker"></i> ตำแหน่งสถานที่</a>
                            <a class="btn btn-danger btn-sm btn-block text-white showLocation mt-1" style="cursor:pointer;"
                               data-lat="{!! $item->destination_latitude !!}"
                               data-lnt="{!! $item->destination_longitude !!}"><i class="fa fa-map-marker"></i>
                                ตำแหน่งสิ้นสุดทางถนน</a>
                        </td>
                        <td>{!! $item->budget !!}</td>
                        <td>{!! $item->time_spent !!}</td>
                        <td>
                            <a href="javascript:custom.lunchModalAndGetPage('{!! route('locationShowWebView', ['id' => $item->id]) !!}','บทความของสถานที่ท่องเที่ยว');"
                               class="btn btn-primary btn-sm btn-block text-white"
                               data-toggle="tooltip" data-placement="top" title=""
                               data-original-title="บทความ"
                            ><i class="fa fa-book"></i> บทความ</a>
                            <a href="javascript:custom.lunchModalAndGetPage('{!! route('locationShowAlbums', ['id' => $item->id]) !!}','อัลบั้มสถานที่ท่องเที่ยว');"
                               class="btn btn-primary btn-sm btn-block text-white"
                               data-toggle="tooltip" data-placement="top" title=""
                               data-original-title="อัลบั้ม"
                            ><i class="fa fa-picture-o"></i> อัลบั้ม</a>
                            <a href="javascript:showData('{!! '<h4>'.($item->village_name == '' ? '' : $item->village_name.'<br />').($item->village_no == '' ? '' : $item->village_no.'<br />').($item->address == '' ? '' : $item->address.'<h4>') !!}')"
                               class="btn btn-primary btn-sm btn-block text-white mt-1"
                               data-toggle="tooltip" data-placement="top" title=""
                               data-original-title="ข้อมูลที่อยู่"
                            ><i class="fa fa-map"></i> ข้อมูลที่อยู่</a>
                            <a href="javascript:showData('{!! '<h4>'.($item->owner_full_name == '' ? '' : $item->owner_full_name.'<br />').$item->tel.'</h4>' !!}')"
                               class="btn btn-primary btn-sm btn-block text-white mt-1"
                               data-toggle="tooltip" data-placement="top" title=""
                               data-original-title="ข้อมูลการติดต่อ"
                            ><i class="fa fa-phone"></i> ข้อมูลการติดต่อ</a>
                        </td>
                        <td>
                            @if($item->active == 0)
                                <a href="javascript:alert.changeActive('{!! route('locationActive', ['id' => $item->id]) !!}', '{!! $item->active !!}');"
                                   class="btn btn-danger btn-sm btn-block"
                                   data-toggle="tooltip" data-placement="top" title="" id="btnChangeActive"
                                   data-original-title="เปิดการใช้งาน">ถูกปิดการใช้งาน</a>
                            @else
                                <a href="javascript:alert.changeActive('{!! route('locationActive', ['id' => $item->id]) !!}', '{!! $item->active !!}');"
                                   class="btn btn-primary btn-sm btn-block"
                                   data-toggle="tooltip" data-placement="top" title="" id="btnChangeActive"
                                   data-original-title="ระงับการใช้งาน">เปิดใช้งานปกติ</a>
                            @endif
                        </td>
                        <td>
                            @if($item->active == 1)
                                <a href="javascript:custom.lunchModalAndGetPage('{!! route('locationEdit', ['id' => $item->id]) !!}','แก้ไขข้อมูลสถานที่ท่องเที่ยว');"
                                   class="btn btn-warning btn-sm text-white"
                                   data-toggle="tooltip" data-placement="top" title=""
                                   data-original-title="แก้ไข"
                                ><i class="fa fa-pencil-square-o"
                                    aria-hidden="true"></i></a>
                                <a href="javascript:alert.destroy('{!! route('locationDestroy', ['id' => $item->id]) !!}');"
                                   class="btn btn-danger btn-sm" id="btnClose"
                                   data-toggle="tooltip" data-placement="top" title=""
                                   data-original-title="ลบ"
                                ><i class="fa fa-times" aria-hidden="true"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/Content-->
    <div class="map-content border-dark border"
         style="display:none; position: fixed; right: 10px; bottom: 10px; width: 50%; height: 50%; z-index: 2000">
        <div id="map" style="width: 100%; height: 100%;"></div>
        <div class="btn-group" role="group" aria-label="Basic example" style="position: absolute; left: 0; bottom: 0">
            <button class="btn btn-danger close-map" type="button"><i class="fa fa-times"></i> ปิดหน้าต่าง</button>
            <button class="btn btn-primary select-map" type="button"><i class="fa fa-check"></i> เลือกตำแหน่ง</button>
            <button class="btn btn-secondary currentLatLnt" type="button" style="pointer-events: none">#####, #####
            </button>
        </div>
    </div>
    <div class="location-show border-dark border"
         style="display:none; position: fixed; right: 10px; bottom: 10px; width: 50%; height: 50%; z-index: 2000">
        <div id="mapShowLocation" style="width: 100%; height: 100%;"></div>
        <button class="btn btn-danger location-show-close-map" type="button"
                style="position: absolute; left: 0; bottom: 0"><i
                class="fa fa-times"></i> ปิดหน้าต่าง
        </button>
    </div>
    <div class="modal fade" id="showData" role="dialog" aria-labelledby="showDataContentLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" id="modalMobileWidth">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-center" id="showDataContent">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfdYV2wYFS0RQqGewp2hlJECZmbZ0IHSE&callback=initMap"
            async defer></script>
    <script>
        var x = document.getElementById("demo");
        var map;
        var mapShowLocation;
        var mapShowLocationMarker = [];
        var lat = 18.790543;
        var lng = 98.984741;
        var selectFunction = 0;

        function showData(content) {
            $('#showDataContent').html(content);
            $("#showData").modal("show");
        }

        $(document).off('click', '.close-map').on('click', '.close-map', e => {
            $('.map-content').hide();
        });

        $(document).off('click', '.showLocation').on('click', '.showLocation', e => {
            window.mapShowLocation.setCenter(new google.maps.LatLng(Number($(e.currentTarget).attr('data-lat')), Number($(e.currentTarget).attr('data-lnt'))));
            for (i = 0; i < window.mapShowLocationMarker.length; i++) {
                window.mapShowLocationMarker[i].setMap(null);
            }
            var marker = new google.maps.Marker({
                position: {
                    lat: Number($(e.currentTarget).attr('data-lat')),
                    lng: Number($(e.currentTarget).attr('data-lnt'))
                },
                map: mapShowLocation,
            });
            mapShowLocationMarker.push(marker);
            $('.location-show').show();
        });

        function removeMarkers() {
            for (i = 0; i < gmarkers.length; i++) {
                gmarkers[i].setMap(null);
            }
        }

        $(document).off('click', '.location-show-close-map').on('click', '.location-show-close-map', e => {
            $('.location-show').hide();
        });

        $(document).off('click', '.select-map').on('click', '.select-map', e => {
            $('.map-content').hide();
            if (window.selectFunction === 0) {
                $('.input-latitude').val(window.lat);
                $('.input-longitude').val(window.lng);
                $('.input-destination-latitude').val(window.lat);
                $('.input-destination-longitude').val(window.lng);
            } else {
                $('.input-destination-latitude').val(window.lat);
                $('.input-destination-longitude').val(window.lng);
            }
        });

        $(document).ready(function () {
            $('#datatables').DataTable();
        });

        function getLocationInitial() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(changeValueInitial);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function changeValueInitial(position) {
            window.lat = position.coords.latitude;
            window.lng = position.coords.longitude;
            $('.currentLatLnt').html(position.coords.latitude + ', ' + position.coords.longitude)
        }

        function initMap() {
            getLocationInitial();
            window.map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: window.lat, lng: window.lng},
                zoom: 14
            });

            window.mapShowLocation = new google.maps.Map(document.getElementById('mapShowLocation'), {
                center: {lat: window.lat, lng: window.lng},
                zoom: 14
            });

            var marker = new google.maps.Marker({
                position: {lat: window.lat, lng: window.lng},
                map: map,
                label: 'ตำแหน่งที่ต้องการเลือก',
                draggable: true,
                zIndex: 1000
            });
            marker.addListener('dragend', handleEvent);
        }

        function handleEvent(event) {
            window.lat = event.latLng.lat();
            window.lng = event.latLng.lng();
            $('.currentLatLnt').html(event.latLng.lat() + ', ' + event.latLng.lng())
        }

        $(document).off('change', '.selectCategory').on('change', '.selectCategory', e => {
            if (Number($(e.currentTarget).val()) === 0) {
                window.location.href = "{!! url('locations') !!}/-all";
            } else {
                window.location.href = "{!! url('locations') !!}/-" + $(e.currentTarget).val();
            }
        });
    </script>
@endsection
