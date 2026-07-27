

<style type="text/css">

h2{margin-top:100px; border-bottom:solid 1px #ccc;} 
table{border-collapse: collapse;}
tr{background-color:#fff;} tr:nth-child(2n){background-color: #f8f8f8;} th,td{border:solid 1px #ccc; padding:0.5em;}
</style>

<style type="text/css">
.axgmap{
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
    <section class="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="axgmap" data-latlng="13.736717, 100.523000" data-zoom="13">
                        <div data-latlng="48.860617, 2.337650" data-title="Louvre Museum" data-window-open="true">
                            <h4>Louvre Museum</h4>
                            <!-- <p><img src="http://upload.wikimedia.org/wikipedia/en/thumb/4/42/Louvre_Pyramid.jpg/220px-Louvre_Pyramid.jpg" width="150"></p>
                            <p><a href="http://en.wikipedia.org/wiki/Louvre">[Wikipedia]</a></p> -->
                        </div>
                        <div data-latlng="48.865491, 2.321137" data-title="Place de la Concorde">
                            <h4>Place de la Concorde</h4>
                            <!-- <p><img src="http://upload.wikimedia.org/wikipedia/commons/thumb/4/41/Place_de_la_concorde.jpg/230px-Place_de_la_concorde.jpg" width="150"></p>
                            <p><a href="http://en.wikipedia.org/wiki/Place_de_la_Concorde">[Wikipedia]</a></p> -->
                        </div>
                        <div data-latlng="48.871977, 2.331612" data-title="Palais Garnier">
                            <h4>Palais Garnier</h4>
                            <!-- <p><img src="http://upload.wikimedia.org/wikipedia/commons/thumb/d/dc/Paris_Opera_full_frontal_architecture%2C_May_2009.jpg/300px-Paris_Opera_full_frontal_architecture%2C_May_2009.jpg" width="150"></p>
                            <p><a href="http://en.wikipedia.org/wiki/Palais_Garnier">[Wikipedia]</a></p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<script>
     var base_url = "<?=base_url();?>";
     
    drawcontens(base_url);
    function drawcontens(base_url){
        //###  ressults ###//
        var results = get_results(base_url);
        var contents = '';
        if(results.datas.length > 0){
            $.each( results.datas, function( key, val ) {

                //contents += '<div data-latlng="'+val.latitude+', '+val.longitude+'" data-title="'+val.reg_name+'" data-window-open="true">';
                contents += '<div data-latlng="'+val.latitude+', '+val.longitude+'" data-title="'+val.reg_name+'">';
                contents += '<h4>'+val.reg_name+'</h4>';
                //contents += '<p><img src="http://upload.wikimedia.org/wikipedia/en/thumb/4/42/Louvre_Pyramid.jpg/220px-Louvre_Pyramid.jpg" width="150"></p>';
                contents += '<p>'+val.reg_telephone+'</p>';
                contents += '</div>';

            });
            var position = '.axgmap';
            $(position).html(null);
            $(position).html(contents);
        }
    }
    function get_results(base_url){
        var res = null;
        $.ajax({
            url: base_url+'Main/get_installation_agent_results', //ทำงานกับไฟล์นี้
            data: '',  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
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
    
















