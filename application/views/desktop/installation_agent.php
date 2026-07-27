<style type="text/css">
    h2 {
        margin-top: 100px;
        border-bottom: solid 1px #ccc;
    }

    table {
        border-collapse: collapse;
    }

    tr {
        background-color: #fff;
    }

    tr:nth-child(2n) {
        background-color: #f8f8f8;
    }

    th,
    td {
        border: solid 1px #ccc;
        padding: 0.5em;
    }
</style>

<style type="text/css">
    .axgmap {
        /* /* width: 720px; */
        height: 720px;
        border: solid 1px #ccc;
    }
</style>
<!-- #BeginEditable "bodytag" -->
<!-- Map Begin -->
<!-- <div class="map">
    
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3805.668782562869!2d101.7112723155342!3d17.475560104854274!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x72db2777bd4ec00f!2zMTfCsDI4JzMyLjAiTiAxMDHCsDQyJzQ4LjUiRQ!5e0!3m2!1sth!2sth!4v1663832389800!5m2!1sth!2sth" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div> -->
<!-- Map End -->

<!-- Contact Section Begin -->
<!--
    <section class="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    
                    <div class="axgmap" data-latlng="13.736717, 100.523000" data-zoom="14">
                        <div data-latlng="48.860617, 2.337650" data-title="Louvre Museum" data-window-open="true">
                            <h4>Louvre Museum</h4>
                        </div>
                        <div data-latlng="48.865491, 2.321137" data-title="Place de la Concorde">
                            <h4>Place de la Concorde</h4>
                        </div>
                        <div data-latlng="48.871977, 2.331612" data-title="Palais Garnier">
                            <h4>Palais Garnier</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    -->

<!-- <section class="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
         
            </div>
        </div>

    </div>
    
</section> -->

<div id="map"  class="container" style="width:100%; height:100%;"></div>

<!-- prettier-ignore -->

<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>





<script>
    var mapData = "";
    $(document).ready(function() {

        drawcontens(base_url);
        setTimeout(function() {
            initialize_map(mapData);
        }, 1500);
    });

    function returnMapUrl(lat , lng){
        // var point= GLatLngObj || map.getCenter();
        //  window.location =  "http://maps.google.com/?ll="+lat+','+lng;
        window.location =  "http://maps.google.com/maps?z=12&t=m&q=loc:"+lat+"+"+lng+"";
        
    } 
    var base_url = "<?= base_url(); ?>";
    function phoneCall(phone = null){
       //  window.open("tel:+"+phone);
        window.location.href = 'tel://' + phone;
    }

    function initialize_map(results = null) {
        // set defult by first object value
        var map = new google.maps.Map(document.getElementById('map'), {
        	center: {
        		lat: parseFloat(results.datas[0].latitude),
        		lng: parseFloat(results.datas[0].longitude)
        	},
        	zoom: 3,
        	mapTypeId: 'roadmap'
        });
      
        var start, end, pos;
        var marker;
        markerList = [];
        $.each(results.datas, function(index, value) {

            var locationLat = parseFloat(value.latitude);
            var locationLng = parseFloat(value.longitude);


            // google map marker
            var marker = new google.maps.Marker({
                position: {
                    lat: locationLat,
                    lng: locationLng
                },
                map: map,
                draggable: false
            });
            markerList.push(marker); 
            // set google map info
            var iw = new google.maps.InfoWindow({
                content: "<h4>" + value.reg_name + "</hr><br><p>" + value.reg_telephone + "</p><div class='container'><div class='row ' style='display:block;' ><img src='./assete/cluster/map.png' id='markerDirection' style='width:40px;height;40px;cursor:pointer;' onClick='returnMapUrl("+locationLat+","+locationLng+");'/></div>"
            });
            google.maps.event.addListener(marker, "click", function(e) {
              
                iw.open(map, this);
            });

            

  
            // google.maps.event.addListener(marker, "mouseout", function(e) {
            //     iw.close(); 
            // });

            
        });

        var markerCluster = new MarkerClusterer(map, markerList, {
            zoomOnClick: true,
            gridSize: 40,
            maxZoom: 15,
            imagePath: 'assete/cluster/m',
            minimumClusterSize: 2
        });

    }
    function getDir(){
        alert(55);
    }
    function drawcontens(base_url) {
        //###  ressults ###//
        var results = get_results(base_url);
        console.log(results);
        var contents = '';
        if (results.datas.length > 0) {
            mapData = results;
            initialize_map(results);
            // $.each(results.datas, function(key, val) {

            //     //contents += '<div data-latlng="'+val.latitude+', '+val.longitude+'" data-title="'+val.reg_name+'" data-window-open="true">';
            //     contents += '<div data-latlng="' + val.latitude + ', ' + val.longitude + '" data-title="' + val.reg_name + '" >';
            //     contents += '<h4>' + val.reg_name + '</h4>';
            //     //contents += '<p><img src="http://upload.wikimedia.org/wikipedia/en/thumb/4/42/Louvre_Pyramid.jpg/220px-Louvre_Pyramid.jpg" width="150"></p>';
            //     contents += '<p>' + val.reg_telephone + '</p>';
            //     contents += '</div>';

            // });
            // var position = '.axgmap';
            // $(position).html(null);
            // $(position).html(contents);
        }
    }
    // backup old 
    // function drawcontens(base_url) {
    //     //###  ressults ###//
    //     var results = get_results(base_url);
    //     console.log(results);
    //     var contents = '';
    //     if (results.datas.length > 0) {
    //         $.each(results.datas, function(key, val) {

    //             //contents += '<div data-latlng="'+val.latitude+', '+val.longitude+'" data-title="'+val.reg_name+'" data-window-open="true">';
    //             contents += '<div data-latlng="' + val.latitude + ', ' + val.longitude + '" data-title="' + val.reg_name + '" >';
    //             contents += '<h4>' + val.reg_name + '</h4>';
    //             //contents += '<p><img src="http://upload.wikimedia.org/wikipedia/en/thumb/4/42/Louvre_Pyramid.jpg/220px-Louvre_Pyramid.jpg" width="150"></p>';
    //             contents += '<p>' + val.reg_telephone + '</p>';
    //             contents += '</div>';

    //         });
    //         var position = '.axgmap';
    //         $(position).html(null);
    //         $(position).html(contents);
    //     }
    // }

    function get_results(base_url) {
        var res = null;
        $.ajax({
            url: base_url + 'Main/get_installation_agent_results', //ทำงานกับไฟล์นี้
            data: '', //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async: false,
            success: function(data, status) {
                res = data;
            },
            error: function(xhr, status, exception) {
                //console.log(xhr);
            }
        });
        return res;
    }
</script>