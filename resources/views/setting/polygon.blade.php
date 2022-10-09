@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('Setting Polygon Area Kantor') }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);">Setting Polygon Area Kantor</a>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ __('Index') }}
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="py-1 d-flex justify-content-between align-items-center">
                                <div>
                                    <p>Panduan :</p>
                                    <ul>
                                        <li>Lakukan click pada map untuk membentuk area/polygon kantor.</li>
                                        <li>Minimal titik adalah 3 titik</li>
                                        <li>Setelah area terbentuk, maka tekan tombol save</li>
                                    </ul>
                                </div>
                                <div>
                                    <button class="btn btn-secondary me-1" id="btn-reset"><i class="fa fa-reload"></i>
                                        Reset</button>
                                    <button class="btn btn-primary" id="btn-save"><i class="fa fa-save"></i>
                                        Save</button>
                                </div>
                            </div>
                            <div id="map"></div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
    #map {
        height: 70vh;
    }
</style>
@endsection


@section('scripts')
<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAdpyPHCn_eT6Ndl3aCwltIcScDOyfMYmw&callback=initMap"></script>
<script>
    $('#btn-reset').on('click', function(e){
        e.preventDefault();
        resetPolygon();
    });

    $('#btn-save').on('click', function(e){
        e.preventDefault();

        $.ajax({
            url: `${baseURL}/setting/polygon/add`,
            type: 'POST',
            data: {
                polygonCoordinates
            },
            success: function(result){
                console.log(result);
                if(result.polygon_points){
                    alert('Polygon Area Kantor Berhasil Di Simpan');
                }
            }
        })

    });

    var map;
    var polygonCoordinates = [
        <?php foreach($polygon_points as $pp): ?>
            {lat: <?php echo $pp->lat ?>, lng: <?php echo $pp->lng ?>},
        <?php endforeach; ?>
    ];
    var polygon;

    

    

    function initMap() {
        map = new google.maps.Map(
            document.getElementById("map"),
            {
                zoom: 20,
                <?php if($polygon_points): ?>
                    center: {lat: <?php echo $polygon_points[0]->lat ?>, lng: <?php echo $polygon_points[0]->lng ?>,},
                <?php else: ?>
                    center: {lat: 5.5258647508209, lng: 95.3042624929427,},
                <?php endif ?>
                
                // mapTypeId: "normal",
            }
        );

        google.maps.event.addListener(map, 'click', function(e) {
            // console.log('clicked', e);
            // console.log('e.latLng.lat', e.latLng.lat());
            // console.log('e.latLng.lng', e.latLng.lng());
            // setPolygon();
            addPolygonPoint(e.latLng.lat(), e.latLng.lng());
        });

        setPolygon();
        // for(var i = 0; i < polygonCoordinates.length; i++){
        //     addMarkerPolygonPoint(polygonCoordinates[i].lat, polygonCoordinates[i].lng);
        // }
    }

    function addPolygonPoint(lat, lng)
    {
        polygonCoordinates.push({lat, lng});
        // addMarkerPolygonPoint(lat, lng);
        if(polygon){
            removePolygon();
        }
        setPolygon();
    }

    function addMarkerPolygonPoint(lat, lng){
        new google.maps.Marker({
            position: {
                lat, lng
            },
            map,
            // title: "Hello World!",
        });
    }

    

    function setPolygon(){
        console.log(polygonCoordinates);
        polygon = new google.maps.Polygon({
            paths: polygonCoordinates,
            strokeColor: "#FF0000",
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: "#FF0000",
            fillOpacity: 0.35,
        });
        polygon.setMap(map);
    }

    function removePolygon(){
        polygon.setMap(null);
    }

    function resetPolygon(){
        polygon.setMap(null);
        polygonCoordinates = [];
        setPolygon();
    }

    window.initMap = initMap;
    window.setPolygon = setPolygon;

</script>
@endsection