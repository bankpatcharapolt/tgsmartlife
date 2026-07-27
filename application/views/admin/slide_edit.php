<!----  Content ------>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Product slider  <small></small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
        <form method="post" action="<?//=base_url('admin/Product/product_actions');?>" enctype="multipart/form-data" id="action-form">
                <input type="hidden" name="action" name="action" value="update">
                <input type="hidden" name="id" id="id" value="<?=$id;?>">
                <div class="col-md-12">

                    <!-- <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="active" style="margin-bottom: 0;">Image</label>
                            <div class="images-position" style="padding-top: .5rem;"></div>
                            <input type="file" class="" name="image" accept=".jpeg, .jpg, .png" id="image" >
                        </div>
                    </div> -->
                    
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label class="control-label">รูปภาพ</label>
                            <div class="" style="vertical-align: middle; width: 100%; height: auto; border: 1px dashed rgba(103, 103, 103, 0.39); padding: 5px; display: inline-block;">
                                <div class="" style="    position: relative; height: 100%; width: 100%; display: flex; align-items: center; justify-content: center; text-align: center;">
                                    <img id="img-th" class="thumnails-premise img-add" src="<?=base_url('/uploads/DocumentTh.png');?>" alt="image" style="border: unset; width: 100%; border-radius: unset;display: inline-block;" />
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top: .5rem;">
                                <input id="image" name="image" type="file" accept=".jpeg, .jpg, .png" style="display:none;" >
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 ">
                            <label class="control-label">title</label>
                            <input type="text" class="form-control" name="title" id="title" >
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="control-label">Sub title</label>
                            <input type="text" class="form-control" name="sub_title" id="sub_title" >
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-md-12 ">
                            <label class="control-label">Link</label>
                            <textarea class="form-control" rows="3" id="link" name="link"></textarea>
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
                            <a id="back-btn" href="<?=base_url("admin_slide");?>" class="btn btn-warning text-center" style="" type="button">กลับ</a>
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
        if(results){
            //$('form#action-form #id').val(results.datas[0].id);
            
            if(results.datas[0].path != '' && results.datas[0].path != null){
                $('form#action-form #img-th').attr('src',base_url+results.datas[0].path+'?random='+Math.random());
            }
            $('form#action-form #title').val(results.datas[0].title);
            $('form#action-form #sub_title').val(results.datas[0].sub_title);
            $('form#action-form #link').val(results.datas[0].link);
            $('form#action-form #active').val(results.datas[0].active).change();

            // if(results.datas[0].path != '' && results.datas[0].path != null){
            //     $('.images-position').html('');
            //     var str = ""; 
            //     str += '<div class="row">';
            //     str += '<div class="x_content">';
            //     var path = base_url+'/'+results.datas[0].path+'?random='+Math.random();
            //     str += '<div class="col-md-2" style="position:relative; text-align: center; width: 100%; margin-top: 3px;" >';
            //     str += '<button style="position: absolute; right: 0px; color: white; background-color: #ff9500; border: 1px solid #ff9500; border-radius: 3px; right: 8px;top: 2px;" onclick="delPDF('+results.datas[0].id+')">X</button>';
            //     str += '<div style="border: 1px solid #d7d7d7; border-radius: 4px; padding: 4px;">';
            //     str += '<img src="'+path+'" style="width: 100%; height: 6rem; object-fit: contain;">';
            //     str += '</div>';
            //     str += '</div>';
            //     str += '</div>';
            //     str += '</div>';
            //     $('.images-position').append(str);
            // }
        }
    }
    function get_results(base_url){
        var res = null;
        $.ajax({
            url: base_url+'/admin/Product/get_slide_onc', //ทำงานกับไฟล์นี้
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

    //### save form ###//
    $("form#action-form").on("submit",function(e){ // จะทำงานก็ต่อเมื่อกด submit ฟอร์ม
        e.preventDefault(); // ปิดการใช้งาน submit ปกติ เพื่อใช้งานผ่าน ajax
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        var fd = new FormData(this); // เตรียมข้อมูล form สำหรับส่งด้วย  FormData Object
        
        //### pdf File ###//
        if($('form#action-form #image').val() != ''){
            var inputFiles = $('form#action-form #image')[0].files; //เป็นการดึงข้อมูลรูปภาพเพื่อเตรียมเช็คไฟล์ก่อนทำงานส่วน Ajax
            fd.append('file',inputFiles); //ใช้ในการแทรกค่าไฟล์รูปภาพใน element
        }
        
        $.ajax({
            url:base_url+'admin/Product/slide_actions', //ให้ระบุชื่อไฟล์ PHP ที่เราจะส่งค่าไป
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

    
    //### img  ###//
    $('.img-add').click(function () {
        var attr = $(this)['context']['attributes'];
        //var files = 'thumnal';
        $("#image").trigger('click');
        $("#image").change(function(){
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

</script>
    