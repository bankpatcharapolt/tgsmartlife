<!----  Content ------>
<div id="loading-spinner"><div class="cv-spinner"><span class="spinner"></span> </div> </div>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>ประเภท สินค้า <small></small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <form method="post" action="<?//=base_url('admin/Product/product_actions');?>" enctype="multipart/form-data" id="action-form">
                <input type="hidden" name="action" id="action" value="update">
                <input type="hidden" name="id" id="id" value="<?=$id;?>">
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label class="control-label">รูปภาพหน้าปก</label>
                            <div class="" style="vertical-align: middle; width: 100%; height: auto; border: 1px dashed rgba(103, 103, 103, 0.39); padding: 5px; display: inline-block;">
                                <div class="" style="    position: relative; height: 100%; width: 100%; display: flex; align-items: center; justify-content: center; text-align: center;">
                                    <img id="img-th" class="thumnails-premise img-add" src="<?=base_url('/uploads/DocumentTh.png');?>" alt="image" style="border: unset; width: 100%; border-radius: unset;display: inline-block;" />
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top: .5rem;">
                                <input id="thumnal" name="thumnal" type="file" style="display:none;" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 ">
                            <label class="control-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" required >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 ">
                            <label class="control-label">link</label>
                            <input type="text" class="form-control" name="link" id="link" required >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 col-sm-4">
                            <label for="amphurs">สถานะ</label>
                            <select class="form-control" name="active"  id="active" required="required" >
                                <option value="1" class="active">เปิด ใช้งาน</option>
                                <option value="0">ปิด ใช้งาน</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" style="border-top: 1px solid #dee2e6;">
                        <div class="col-12" style="padding: 13px 0;">
                            <a id="back-btn" href="<?=base_url("admin_product_type");?>" class="btn btn-warning text-center" style="" type="button">กลับ</a>
                            <button id="save-btn" class="btn btn-info text-center" style="" type="submit">บันทึก</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!---- End Content ------>
<script>

    var base_url = $('input[name="base_url"]').val();

    //###  FORM ###//
    drawform(base_url);
    function drawform(base_url){
        var results = get_results(base_url);
        if(results.datas.length > 0){
            if(results.datas[0].thumnal != '' && results.datas[0].thumnal != null){
                $('form#action-form #img-th').attr('src',base_url+results.datas[0].thumnal+'?random='+Math.random());
            }
            //$('form#action-form #productcode').val(results.datas[0].productcode);
            $('form#action-form #name').val(results.datas[0].name);
            $('form#action-form #link').val(results.datas[0].link);
            // $('form#action-form #price').val(results.datas[0].price);
            // $('form#action-form #saleprice').val(results.datas[0].saleprice);
            // $('form#action-form #category').val(results.datas[0].category).change();
            // $('form#action-form #detail').val(results.datas[0].detail);
            $('form#action-form #active').val(results.datas[0].active).change();
        }
    }
    function get_results(base_url){
        var res = null;
        $.ajax({
            url: base_url+'/admin/Product/get_product_type_onc', //ทำงานกับไฟล์นี้
            data: {
                "id" : $('form#action-form #id').val()
            },  //ส่งตัวแปร
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

    //### img  ###//
    $('.img-add').click(function () {
        var attr = $(this)['context']['attributes'];
        //var files = 'thumnal';
        $("#thumnal").trigger('click');
        $("#thumnal").change(function(){
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.img-add').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
                //$('form'+form_id).submit();
            }
        });
    });

    //### save form ###//
    $("form#action-form").on("submit",function(e){ // จะทำงานก็ต่อเมื่อกด submit ฟอร์ม
        e.preventDefault(); // ปิดการใช้งาน submit ปกติ เพื่อใช้งานผ่าน ajax
        var fd = new FormData(this); // เตรียมข้อมูล form สำหรับส่งด้วย  FormData Object

        //### thumnal ###//
        // if($('form#action-form #thumnal')[0].files.length > 0 ){
        //     var inputFiles = $('form#action-form #thumnal').files; //เป็นการดึงข้อมูลรูปภาพเพื่อเตรียมเช็คไฟล์ก่อนทำงานส่วน Ajax
        //     fd.append('file',inputFiles); //ใช้ในการแทรกค่าไฟล์รูปภาพใน element
        // }

        $.ajax({
            url:base_url+'admin/Product/type_actions', //ให้ระบุชื่อไฟล์ PHP ที่เราจะส่งค่าไป
            type:'post',
            dataType: 'json',
            data:fd, //ข้อมูลจาก input ที่ส่งเข้าไปที่ PHP
            contentType: false,
            processData: false,
            success:function(response){ //หากทำงานสำเร็จ จะรับค่ามาจาก JSON หลังจากนั้นก็ให้ทำงานตามที่เรากำหนดได้
                window.location.href = response.datas;
                // $("#loading-spinner").hide();
                // if(response.status){
                //     window.location.href = response.datas;
                //     //Swal.fire({ icon: 'success',  text: response.massege });
                // }else{
                //     Swal.fire({ icon: 'warning',  text: response.massege });
                // }
            }
        });
    });

</script>
    