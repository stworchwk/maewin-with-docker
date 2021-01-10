@extends('layouts.master') @section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">หน้าแรก</li>
        <li class="breadcrumb-item active">แผนการท่องเที่ยว</li>
    </ol>
@endsection
<!--Content-->
@section('content')
    <style>
        .travelerPlanLocationMarkerStatusZero {
            background-color: #7a7477;
            padding: 5px 10px;
            border-radius: 15px;
            margin-top: 70px;
            font-weight: bold;
        }

        .travelerPlanLocationMarkerStatusOne {
            background-color: #ffc107;
            padding: 5px 10px;
            border-radius: 15px;
            margin-top: 70px;
            font-weight: bold;
        }

        .travelerPlanLocationMarkerStatusTwo {
            background-color: #26ff00;
            padding: 5px 10px;
            border-radius: 15px;
            margin-top: 70px;
            font-weight: bold;
        }
    </style>
    <div class="card card-accent-info">
        <div class="card-body">
            <div class="clearfix mb-sm-3" id="page-heading">
                <div class="float-left">
                    <h4><i class="fa fa-map"></i> แผนการท่องเที่ยว</h4>
                </div>
            </div>
            <table class="table table-striped table-hover table-responsive-sm" id="datatables">
                <thead>
                <tr>
                    <th>#</th>
                    <th>ชื่อนามสกุล</th>
                    <th>สัญชาติ</th>
                    <th>สถานะ</th>
                    <th>การติดต่อ</th>
                    <th>ความสำเร็จ</th>
                    <th>แผนที่</th>
                    <th>ประวัติ</th>
                </tr>
                </thead>
                <tbody>
                @foreach($plans as $index => $item)
                    <tr>
                        <td>{!! $item->code !!}</td>
                        <td>{!! $item->traveler->full_name !!}</td>
                        <td>{!! $item->traveler->nationality ? $item->traveler->nationality->name_th : 'ไม่มีข้อมูล' !!}</td>
                        <td>
                            @if($item->plan_status == 0)
                                <a class="btn btn-sm btn-secondary disabled">วางแผนการเที่ยว</a>
                            @elseif($item->plan_status == 1)
                                <a class="btn btn-sm btn-warning disabled"><i class="fa fa-play"></i>
                                    กำลังท่องเที่ยว</a>
                            @else
                                <a class="btn btn-sm btn-success disabled"><i class="fa fa-check"></i>
                                    ท่องเที่ยวเสร็จสิ้น</a>
                            @endif
                        </td>
                        <td>
                            @if($item->traveler->prefixPhone)
                                <a class="btn btn-warning btn-sm text-white" style="pointer-events: none"
                                ><i class="fa fa-phone"
                                    aria-hidden="true"></i> {!! $item->traveler->prefixPhone->prefix.' '.$item->traveler->phone_number !!}
                                </a>
                            @endif
                            <a href="javascript:custom.lunchModalAndGetPage('{!! route('travelerPlanMessages', ['id' => $item->id]) !!}', '{!! $item->code !!} ส่งข้อความตรวจสอบการท่องเที่ยว');"
                               class="btn btn-warning btn-sm text-white"
                               data-toggle="tooltip" data-placement="top" title=""
                               data-original-title="ส่งข้อความ"
                            ><i class="fa fa-paper-plane"
                                aria-hidden="true"></i> ส่งข้อความ</a>
                        </td>
                        <td>
                            <a href="javascript:custom.lunchModalAndGetPage('{!! route('travelerPlanAchievement', ['id' => $item->id]) !!}', '{!! $item->code !!} ความสำเร็จ');"
                               class="btn btn-primary btn-sm text-white"
                               data-toggle="tooltip" data-placement="top" title=""
                               data-original-title="ความสำเร็จ"
                            ><i class="fa fa-graduation-cap"
                                aria-hidden="true"></i> ความสำเร็จ</a>
                        </td>
                        <td>
                            <a class="btn btn-danger btn-sm text-white showPlanLocation" data-id="{!! $item->id !!}"
                               style="cursor:pointer;"
                               data-toggle="tooltip" data-placement="top" title=""
                               data-original-title="แผนที่"
                            ><i class="fa fa-map-marker"
                                aria-hidden="true"></i> แผนที่</a>
                        </td>
                        <td>
                            <a href="javascript:custom.lunchModalAndGetPage('{!! route('travelerPlanLogs', ['id' => $item->id]) !!}', '{!! $item->code !!} ประวัติการดำเนินการการท่องเที่ยว');"
                               class="btn btn-secondary btn-sm"
                               data-toggle="tooltip" data-placement="top" title=""
                               data-original-title="ความสำเร็จ"
                            ><i class="fa fa-history"
                                aria-hidden="true"></i> ประวัติ</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/Content-->
    <div class="planLocation border-dark border"
         style="display:none; position: fixed; right: 10px; bottom: 10px; width: 80%; height: 80%; z-index: 2000">
        <div id="mapShowLocation" style="width: 100%; height: 100%;"></div>
        <button class="btn btn-danger planLocationClose" type="button"
                style="position: absolute; left: 0; bottom: 0"><i
                class="fa fa-times"></i> ปิดหน้าต่าง
        </button>
    </div>
@endsection

@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfdYV2wYFS0RQqGewp2hlJECZmbZ0IHSE&callback=initMap"
            async defer></script>
    <script>
        var x = document.getElementById("demo");
        var mapShowLocation;
        var mapShowLocationMarker = [];
        var mapShowTrackingMarker = [];
        var lat = 18.666565;
        var lng = 98.637492;
        var directionsDisplay;
        var directionsDisplayTracking;
        var directionsService;
        var directionsServiceTracking;

        function initMap() {
            directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true});
            directionsDisplayTracking = new google.maps.DirectionsRenderer({
                polylineOptions: {
                    strokeColor: "red"
                }, suppressMarkers: true
            });
            directionsService = new google.maps.DirectionsService();
            directionsServiceTracking = new google.maps.DirectionsService();
            mapShowLocation = new google.maps.Map(document.getElementById('mapShowLocation'), {
                center: {lat: window.lat, lng: window.lng},
                zoom: 14
            });
            directionsDisplay.setMap(mapShowLocation);
            directionsDisplayTracking.setMap(mapShowLocation);
        }

        function calculateAndDisplayRoute(locations, isPlanLocation) {
            var newPoints = locations.slice(1, -1);
            var firstPoint = locations[0];
            var lastPoint = locations[locations.length - 1];
            var waypts = [];

            for (let i = 0; i < newPoints.length; i++) {
                waypts.push({
                    location: new google.maps.LatLng(Number(newPoints[i].lat), Number(newPoints[i].lnt)),
                    stopover: true,
                });
            }
            var request = {
                origin: new google.maps.LatLng(Number(firstPoint.lat), Number(firstPoint.lnt)),
                destination: new google.maps.LatLng(Number(lastPoint.lat), Number(lastPoint.lnt)),
                waypoints: waypts,
                optimizeWaypoints: true,
                travelMode: 'DRIVING'
            };

            if (isPlanLocation) {
                window.directionsService.route(request, function (response, status) {
                    if (status === 'OK') {
                        window.directionsDisplay.setDirections(response);
                    }
                });
            } else {
                window.directionsServiceTracking.route(request, function (response, status) {
                    if (status === 'OK') {
                        window.directionsDisplayTracking.setDirections(response);
                    }
                });
            }
        }

        function callPlanLocations(plan_id) {
            $.ajax({
                type: 'GET',
                url: "{!! url('travelerPlans/callPlanLocations') !!}-" + plan_id,
                success: function (element) {
                    //window.mapShowLocation.setCenter(new google.maps.LatLng(Number(element[0].location.latitude), Number(element[0].location.longitude)));
                    for (i = 0; i < window.mapShowLocationMarker.length; i++) {
                        window.mapShowLocationMarker[i].setMap(null);
                    }
                    var locations = [];

                    element.forEach(function (e, index) {
                        var locationNumber = 'จุดที่ ' + (index + 1).toString();
                        var icon = null;
                        if (e.location) {
                            if (e.location.category) {
                                icon = {
                                    url: e.location.category.icon_url, // url
                                    scaledSize: new google.maps.Size(40, 40), // scaled size
                                    origin: new google.maps.Point(0, 0), // origin
                                    anchor: new google.maps.Point(20, 20) // anchor
                                };
                            }
                        }
                        var locationStatusClassName;
                        var locationStatusText;
                        switch (e.status) {
                            case 0:
                                locationStatusClassName = 'travelerPlanLocationMarkerStatusZero';
                                locationStatusText = "(ยังไม่เริ่ม)";
                                break;
                            case 1:
                                locationStatusClassName = 'travelerPlanLocationMarkerStatusOne';
                                locationStatusText = "(กำลังร่วมกิจกรรม)";
                                break;
                            case 2:
                                locationStatusClassName = 'travelerPlanLocationMarkerStatusTwo';
                                locationStatusText = "(เสร็จสิ้น)";
                                break;
                            default:
                                locationStatusClassName = null;
                                locationStatusText = null;
                        }
                        var marker = new google.maps.Marker({
                            position: {
                                lat: Number(e.location.latitude),
                                lng: Number(e.location.longitude)
                            },
                            icon: icon,
                            label: {
                                text: locationNumber + ' ' + locationStatusText,
                                color: '#FFFFFF',
                                className: locationStatusClassName
                            },
                            map: mapShowLocation,
                        });
                        var iw = new google.maps.InfoWindow({
                            content: locationNumber + ' ' + e.location.title_th
                        });
                        google.maps.event.addListener(marker, "click", function (e) {
                            iw.open(mapShowLocation, this);
                        });
                        mapShowLocationMarker.push(marker);

                        locations.push({
                            'lat': Number(e.location.latitude),
                            'lnt': Number(e.location.longitude)
                        });
                    });
                    calculateAndDisplayRoute(locations, true);

                }
            });
        }

        function callPlanTracking(plan_id) {
            $.ajax({
                type: 'GET',
                url: "{!! url('travelerPlans/callPlanTracking') !!}-" + plan_id,
                success: function (element) {
                    for (i = 0; i < window.mapShowTrackingMarker.length; i++) {
                        window.mapShowTrackingMarker[i].setMap(null);
                    }
                    var locations = [];
                    element.forEach(function (e, index) {
                        var icon = {
                            url: "{!! url('images/templates/reddot.png') !!}",
                            scaledSize: new google.maps.Size(10, 10), // scaled size
                            origin: new google.maps.Point(0, 0), // origin
                            anchor: new google.maps.Point(5, 5) // anchor
                        };
                        var iconCurrent = {
                            url: "{!! url('images/templates/bike.png') !!}",
                            scaledSize: new google.maps.Size(70, 70), // scaled size
                            origin: new google.maps.Point(0, 0), // origin
                            anchor: new google.maps.Point(35, 35) // anchor
                        };
                        var markerTracking = new google.maps.Marker({
                            position: {
                                lat: Number(e.latitude),
                                lng: Number(e.longitude)
                            },
                            icon: index === 0 ? iconCurrent : icon,
                            map: mapShowLocation,
                        });
                        var trackingTime = moment(e.tracking_date_time).locale('th');
                        var iw = new google.maps.InfoWindow({
                            content: 'เมื่อ ' + trackingTime.fromNow() + ' เวลา (' + trackingTime.format('D/M/YYYY H:m:ss') + ')'
                        });
                        google.maps.event.addListener(markerTracking, "click", function (e) {
                            iw.open(mapShowLocation, this);
                        });
                        mapShowTrackingMarker.push(markerTracking);

                        locations.push({
                            'lat': Number(e.latitude),
                            'lnt': Number(e.longitude)
                        });
                    });
                    calculateAndDisplayRoute(locations, false);
                }
            });
        }

        $(document).ready(function () {
            $('#datatables').DataTable();
        });

        $(document).off('click', '.showPlanLocation').on('click', '.showPlanLocation', e => {
            callPlanLocations($(e.currentTarget).attr('data-id'));
            callPlanTracking($(e.currentTarget).attr('data-id'));

            $('.planLocation').show();
        });

        $(document).off('click', '.planLocationClose').on('click', '.planLocationClose', e => {
            $('.planLocation').hide();
        });

    </script>
@endsection
