<!-- #BeginEditable "bodytag" -->
        <!-- Breadcrumb Section Begin -->
        <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>TG Smart life Project</h4>
                        <div class="breadcrumb__links">
                            <a href="<?=base_url()?>">หน้าแรก</a>
                            <span>TG Smart life Project</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- About Section Begin -->
    <section class="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about__pic" style="padding-top: 3%;">
						<img src="<?=base_url('assete/theme/img/under-construction.png')?>">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->
	
<!-- #EndEditable -->


<script>
    var base_url = "<?=base_url();?>";
    drawcontens(base_url);
    function drawcontens(base_url){

        //###  ressults ###//
        var results = get_results(base_url);
        var contents = '';
        if(results.datas.length > 0){
            $.each( results.datas, function( key, val ) {
                if(val.detail != '' && val.detail != null){
                    contents += val.detail;
                }else{
                    contents += '<img src="'+base_url+'assete/theme/img/under-construction.png"> ';
                }
            });
            var position = '.about__pic';
            $(position).html(null);
            $(position).html(contents);
        }
    }
    function get_results(base_url){
        var res = null;
        $.ajax({
            url: base_url+'Main/get_tg_project_results', //ทำงานกับไฟล์นี้
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