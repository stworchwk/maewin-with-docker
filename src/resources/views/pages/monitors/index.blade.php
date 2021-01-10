@extends('layouts.master')

<style>
    .locationMarker {
        background-color: #f8a461;
        padding: 5px 10px;
        border-radius: 15px;
        margin-top: 70px;
    }

    .travelerPlanMarker {
        background-color: #6375E9;
        padding: 5px 10px;
        border-radius: 15px;
        margin-top: 70px;
    }

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
<!--Content-->
@section('content')
    <div style="position: absolute; width: calc(100vw - 200px); height: calc(100vh - 55px);">
        <div id="map" style="width: 100%; height: 100%"></div>
    </div>
    <div class="travelerPlanSection border-dark border"
         style="display:none; position: fixed; right: 2.5%; bottom: 2.5%; width: 95%; height: 95%; z-index: 2000">
        <div class="row bg-white m-0" style="width: 100%; height: 100%;">
            <div class="col-md-4">
                <div class="row mt-5">
                    <div class="col-md-7"><h4 class="traveler_full_name"></h4></div>
                    <div class="col-md-5"><h4 class="pull-right travelPlanCode"></h4></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <strong>รหัสประจำตัว : </strong><span class="travelerIdCardNumber"></span><br/>
                        <strong>สัญชาติ : </strong><span class="travelerNationality"></span><br/>
                        <strong>เบอร์โทรศัพท์ : </strong><span class="travelerPhoneNumber"></span>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <h4>แผนการท่องเที่ยว</h4>
                        <div class="travelLocationList" style="overflow-y: auto; height: 65vh"></div>
                    </div>
                </div>
                <button class="btn btn-info btn-block mt-2" type="button"><i
                        class="fa fa-commenting-o"></i> ส่งข้อความตรวจสอบ
                </button>
            </div>
            <div class="col-md-8 p-0">
                <div id="mapTravelerPlan" style="width: 100%; height: 100%;"></div>
            </div>
        </div>
        <button class="btn btn-danger travelerPlanSectionClose" type="button"
                style="position: absolute; right: 0; top: 0"><i
                class="fa fa-times"></i> ปิดหน้าต่าง
        </button>
    </div>
@endsection

@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfdYV2wYFS0RQqGewp2hlJECZmbZ0IHSE&callback=initMap"
            async defer></script>
    <script>
        var x = document.getElementById("demo");
        var map;
        var lat = 18.66891749018513;
        var lng = 98.63741398956991;
        var locationMarker = [];
        var travelerPlanMarker = [];

        //TravelerPlanSection
        var travelerId = 0;
        var mapTravelerPlan;
        var mapShowTravelerLocationMarker = [];
        var mapShowTravelerTrackingMarker = [];
        var directionsDisplay;
        var directionsDisplayTracking;
        var directionsServicePlanLocation;
        var directionsServiceTrackingLocation;

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
        }

        function removeTravelPlansMarkers() {
            for (var i = 0; i < travelerPlanMarker.length; i++) {
                travelerPlanMarker[i].setMap(null);
            }
        }

        function callTravelerPlans() {
            $.ajax({
                method: "get",
                url: '{!! route('monitorAPICallTravelerPlans') !!}',
                cache: false,
            }).done(function (res) {
                if (res) {
                    removeTravelPlansMarkers();
                    res.forEach(function (e) {
                        var image_url = "{!! url('images/templates/tourist-level-1.png') !!}";
                        switch (parseInt(e.tracking_status)) {
                            case 1:
                                image_url = "{!! url('images/templates/tourist-level-1.png') !!}";
                                break;
                            case 2:
                                image_url = "{!! url('images/templates/tourist-level-2.png') !!}";
                                break;
                            case 3:
                                image_url = "{!! url('images/templates/tourist-level-3.png') !!}";
                                break;
                        }
                        var icon = {
                            url: image_url,
                            scaledSize: new google.maps.Size(40, 40), // scaled size
                            origin: new google.maps.Point(0, 0), // origin
                            anchor: new google.maps.Point(20, 20) // anchor
                        };
                        var markerTravelerPlan = new google.maps.Marker({
                            position: {lat: parseFloat(e.latitude), lng: parseFloat(e.longitude)},
                            map: map,
                            label: {
                                text: '#' + e.code,
                                color: "#FFFFFF",
                                className: "travelerPlanMarker"
                            },
                            icon: icon
                        });
                        var travelerPlanId = e.id;
                        google.maps.event.addListener(markerTravelerPlan, "click", function (e) {
                            callTravelerPlan(travelerPlanId);
                        });
                        travelerPlanMarker.push(markerTravelerPlan);

                        $('.travelPlanCode').html(e.code);
                        $('.traveler_full_name').html(e.traveler_full_name);
                        $('.travelerIdCardNumber').html(e.traveler_id_card);
                        $('.travelerNationality').html(e.traveler_nationality);
                        $('.travelerPhoneNumber').html(e.traveler_phone_number);
                    });
                }
            });

            setTimeout(function () {
                callTravelerPlans();
                if (window.travelerId !== 0) {
                    //callTravelerPlanLocations();
                    //callTravelerPlanTracking();
                }
            }, 5000);
        }

        function callTravelerPlan(id) {
            window.travelerId = id;
            callTravelerPlanLocations();
            callTravelerPlanTracking();

            $('.travelerPlanSection').show();
        }

        function callLocations() {
            $.ajax({
                method: "get",
                url: '{!! route('monitorAPICallLocations') !!}',
                cache: false,
            }).done(function (res) {
                if (res) {
                    res.forEach(function (e) {
                        var icon = {
                            url: e.category.icon_url,
                            scaledSize: new google.maps.Size(40, 40), // scaled size
                            origin: new google.maps.Point(0, 0), // origin
                            anchor: new google.maps.Point(20, 20) // anchor
                        };
                        var marker = new google.maps.Marker({
                            position: {lat: parseFloat(e.latitude), lng: parseFloat(e.longitude)},
                            map: map,
                            icon: icon,
                            label: {
                                text: e.title_th,
                                color: "#FFFFFF",
                                className: "locationMarker"
                            },
                        });
                        locationMarker.push(marker)
                    });
                }
            });
        }

        function initMap() {
            getLocationInitial();
            window.map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: window.lat, lng: window.lng},
                zoom: 14
            });
            callLocations();
            callTravelerPlans();

            //TravelerPlanSection
            directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true});
            directionsDisplayTracking = new google.maps.DirectionsRenderer({
                polylineOptions: {
                    strokeColor: "red"
                }, suppressMarkers: true
            });
            directionsServicePlanLocation = new google.maps.DirectionsService();
            directionsServiceTrackingLocation = new google.maps.DirectionsService();
            mapTravelerPlan = new google.maps.Map(document.getElementById('mapTravelerPlan'), {
                center: {lat: window.lat, lng: window.lng},
                zoom: 16
            });
            directionsDisplay.setMap(mapTravelerPlan);
            directionsDisplayTracking.setMap(mapTravelerPlan);
        }

        //TravelerPlanSection

        $(document).off('click', '.travelerPlanSectionClose').on('click', '.travelerPlanSectionClose', e => {
            window.travelerId = 0;
            $('.travelerPlanSection').hide();
        });

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
                window.directionsServicePlanLocation.route(request, function (response, status) {
                    if (status === 'OK') {
                        window.directionsDisplay.setDirections(response);
                    }
                });
            } else {
                window.directionsServiceTrackingLocation.route(request, function (response, status) {
                    if (status === 'OK') {
                        window.directionsDisplayTracking.setDirections(response);
                    }
                });
            }
        }

        function callTravelerPlanLocations() {
            $.ajax({
                type: 'GET',
                url: "{!! url('travelerPlans/callPlanLocations') !!}-" + window.travelerId,
                success: function (element) {
                    // window.mapTravelerPlan.setCenter(new google.maps.LatLng(Number(element[0].location.latitude), Number(element[0].location.longitude)));
                    for (var i = 0; i < window.mapShowTravelerLocationMarker.length; i++) {
                        window.mapShowTravelerLocationMarker[i].setMap(null);
                    }
                    var locations = [];
                    var leftContent = '';

                    console.log(element)

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
                        var locationStatusText;
                        var locationStatusClassName;
                        var locationStatusTextForLeftContent;
                        var locationActivityTimeTextForLeftContent;
                        switch (e.status) {
                            case 0:
                                locationStatusClassName = 'travelerPlanLocationMarkerStatusZero';
                                locationStatusText = "(ยังไม่เริ่ม)";
                                locationStatusTextForLeftContent = "<a class='btn btn-secondary pull-right' style='pointer-events: none'>ยังไม่เริ่ม</a>";
                                locationActivityTimeTextForLeftContent = '';
                                break;
                            case 1:
                                locationStatusClassName = 'travelerPlanLocationMarkerStatusOne';
                                locationStatusText = "(กำลังร่วมกิจกรรม)";
                                locationStatusTextForLeftContent = "<a class='btn btn-warning pull-right' style='pointer-events: none'><i class='fa fa-gamepad'></i> กำลังร่วมกิจกรรม</a>";
                                locationActivityTimeTextForLeftContent = 'เริ่ม ' + moment(e.activity_start).local('th').format('D/M/YYYY H:m:ss') +  '<br />ใช้เวลาไปแล้ว ' +  moment(e.activity_start).locale('th').fromNow(true);
                                break;
                            case 2:
                                locationStatusClassName = 'travelerPlanLocationMarkerStatusTwo';
                                locationStatusText = "(เสร็จสิ้น)";
                                locationStatusTextForLeftContent = "<a class='btn btn-success pull-right' style='pointer-events: none'><i class='fa fa-check'></i> เสร็จสิ้น</a>";
                                locationActivityTimeTextForLeftContent = 'เริ่ม ' + moment(e.activity_start).local('th').format('D/M/YYYY H:m:ss') +  '<br />เสร็จสิ้น ' + moment(e.activity_end).local('th').format('D/M/YYYY H:m:ss');
                                break;
                            default:
                                locationStatusClassName = '';
                                locationStatusText = '';
                                locationStatusTextForLeftContent = '';
                                locationActivityTimeTextForLeftContent = ''
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
                            map: mapTravelerPlan,
                        });
                        var iw = new google.maps.InfoWindow({
                            content: locationNumber + ' ' + e.location.title_th
                        });
                        google.maps.event.addListener(marker, "click", function (e) {
                            iw.open(mapTravelerPlan, this);
                        });
                        mapShowTravelerLocationMarker.push(marker);

                        locations.push({
                            'lat': Number(e.location.latitude),
                            'lnt': Number(e.location.longitude)
                        });

                        //left content
                        leftContent += '<div class="row ml-2 mb-2"><div class="col-md-7"><strong>' + locationNumber + ' ' + e.location.title_th + '</strong><br />' + locationActivityTimeTextForLeftContent + '</div><div class="col-md-5">' + locationStatusTextForLeftContent + '</div></div>';
                    });
                    calculateAndDisplayRoute(locations, true);
                    $('.travelLocationList').html(leftContent);
                }
            });
        }

        function callTravelerPlanTracking() {
            $.ajax({
                type: 'GET',
                url: "{!! url('travelerPlans/callPlanTracking') !!}-" + window.travelerId,
                success: function (element) {
                    for (var i = 0; i < window.mapShowTravelerTrackingMarker.length; i++) {
                        window.mapShowTravelerTrackingMarker[i].setMap(null);
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
                            map: mapTravelerPlan,
                        });
                        var trackingTime = moment(e.tracking_date_time).locale('th');
                        var iw = new google.maps.InfoWindow({
                            content: 'เมื่อ ' + trackingTime.fromNow() + ' เวลา (' + trackingTime.format('D/M/YYYY H:m:ss') + ')'
                        });
                        google.maps.event.addListener(markerTracking, "click", function (e) {
                            iw.open(mapTravelerPlan, this);
                        });
                        mapShowTravelerTrackingMarker.push(markerTracking);

                        locations.push({
                            'lat': Number(e.latitude),
                            'lnt': Number(e.longitude)
                        });
                    });
                    calculateAndDisplayRoute(locations, false);
                }
            });
        }
    </script>
@endsection
