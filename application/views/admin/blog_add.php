<!----  Content ------>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Blog & Review <small></small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
        <form method="post" action="<?//=base_url('admin/Product/product_actions');?>" enctype="multipart/form-data" id="create-form">
                <input type="hidden" name="method" value="insert">
                <input type="hidden" name="id" value="">
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
                        <div class="col-md-4 ">
                            <label class="control-label">Product Category</label>
                            <select class="form-control" name="product_cate" id="product_cate" required="required" ></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 ">
                            <label class="control-label">Topic</label>
                            <input type="text" class="form-control" name="topic" id="topic" required >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 ">
                            <label class="control-label">Sub header</label>
                            <input type="text" class="form-control" name="sub_header" id="sub_headers" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="control-label" for="first-name">รายละเอียด<span class="required">*</span></label>
                            <textarea class="form-control" rows="5" id="detail" name="detail"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="input-field">
                                <label class="active" style="margin-bottom: 0;">รูปภาพ</label>
                                <div class="images-position" style="padding-top: .5rem;"></div>
                                <input type="file" class="" name="images[]" accept=".jpeg, .jpg, .png" id="images" multiple >
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 col-sm-4">
                            <label for="amphurs">SEO</label>
                            <select class="form-control" name="seo"  id="seo" ></select>
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
                            <a id="back-btn" href="<?=base_url("admin_blog");?>" class="btn btn-warning text-center" style="" type="button">กลับ</a>
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
    CKEDITOR.replace('detail', {height  : '500px',});

    //### draw product category  ###//
    drawtCategoryOption(base_url);
    function drawtCategoryOption(base_url){
        var results = get_product_category(base_url);
        if(results.datas.length > 0){   
            var option = '';
            $.each( results.datas, function( key, val ) {
                option += '<option value="'+val.id+'">'+val.name+'</option>';
            });
            option += '<option value="99999">อื่นๆ</option>';
            var tableid = 'form#create-form #product_cate';
            $(tableid).html(null);
            $(tableid).append(option);
        }
    }
    function get_product_category(base_url){
        var res = null;
        $.ajax({
            url: base_url+'admin/Review/get_product_category_used', //ทำงานกับไฟล์นี้
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

    //###  SEO Select option  ##//
    drawtSeoOption(base_url);
    function drawtSeoOption(base_url){
        var results = get_seo_used(base_url);
        if(results.datas.length > 0){   
            var option = '';
            option += '<option value="">เลือก SEO</option>';
            $.each( results.datas, function( key, val ) {
                option += '<option value="'+val.id+'">'+val.seo_title+'</option>';
            });
            var tableid = 'form#create-form #seo';
            $(tableid).html(null);
            $(tableid).append(option);
        }
    }
    function get_seo_used(base_url){
        var res = null;
        $.ajax({
            url: base_url+'admin/Blog/get_blog_seo_results', //ทำงานกับไฟล์นี้
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

    //### img  ###//
    $('.img-add').click(function () {
        var attr = $(this)['context']['attributes'];
        var files = 'thumnal';
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
    $("form#create-form").on("submit",function(e){ // จะทำงานก็ต่อเมื่อกด submit ฟอร์ม
        e.preventDefault(); // ปิดการใช้งาน submit ปกติ เพื่อใช้งานผ่าน ajax
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        var fd = new FormData(this); // เตรียมข้อมูล form สำหรับส่งด้วย  FormData Object
        var files = $('#thumnal')[0].files; //เป็นการดึงข้อมูลรูปภาพเพื่อเตรียมเช็คไฟล์ก่อนทำงานส่วน Ajax
    
        // เช็คว่ามีไฟล์รูปภาพอยู่หรือไม่
        if(files.length > 0 ){

            //$("#loading-spinner").fadeIn(300);
            //fd.append('file',files[0]); //ใช้ในการแทรกค่าไฟล์รูปภาพใน element 

            //### thumnal ###//
            if($('form#create-form #thumnal').val() != ''){
                var inputFiles = $('form#create-form #thumnal')[0].files; //เป็นการดึงข้อมูลรูปภาพเพื่อเตรียมเช็คไฟล์ก่อนทำงานส่วน Ajax
                fd.append('file',inputFiles); //ใช้ในการแทรกค่าไฟล์รูปภาพใน element
            }
            
            //### Files Images ###//
            if($('form#create-form #images').val() != ''){
                var inputFiles = $('form#create-form #images')[0].files; //เป็นการดึงข้อมูลรูปภาพเพื่อเตรียมเช็คไฟล์ก่อนทำงานส่วน Ajax
                fd.append('file',inputFiles); //ใช้ในการแทรกค่าไฟล์รูปภาพใน element
            }
            $.ajax({
                url:base_url+'admin/Blog/blog_actions', //ให้ระบุชื่อไฟล์ PHP ที่เราจะส่งค่าไป
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
            
            //window.location.href = base_url+'admin/product';
        }else{
            Swal.fire({ icon: 'success',  text: 'กรุณาเลือกรูปภาพ'});
        }
    });
</script>
    