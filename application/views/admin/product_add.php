<!----  Content ------>
<div id="loading-spinner"><div class="cv-spinner"><span class="spinner"></span> </div> </div>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>เพิ่ม สินค้า <small></small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <form method="post" action="<?//=base_url('admin/Product/product_actions');?>" enctype="multipart/form-data" id="action-form">
                <input type="hidden" name="action" value="insert">
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
                            <label class="control-label">Product code</label>
                            <input type="text" class="form-control" name="productcode" id="productcode" placholder="" >
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
                            <label class="control-label">ชื่อสินค้าอ้างอิง (สำหรับหน้าลงทะเบียน/รับประกันสินค้า — ใส่ได้หลายชื่อ)</label>
                            <div id="regis-names-list"></div>
                            <button type="button" class="btn btn-round btn-success" id="btn-add-regis-name" style="font-size: 12px; padding: 5px 12px; margin-top: 4px;">
                                <i class="fa fa-plus"></i> เพิ่มชื่ออ้างอิง
                            </button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 ">
                            <label class="control-label">Sub Title</label>
                            <!-- <input type="text" class="form-control" name="subtitle" id="subtitle" > -->
                            <textarea class="form-control" rows="5" id="subtitle" name="subtitle"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 ">
                            <label class="control-label">จำนวนสินค้า</label>
                            <input type="number" class="form-control" name="counts" id="counts" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 ">
                            <label class="control-label">Price</label>
                            <input type="number" class="form-control" name="price" id="price" required >
                        </div>
                        <div class="col-md-4 ">
                            <label class="control-label">Sale price</label>
                            <input type="number" class="form-control" name="saleprice" id="saleprice" >
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-md-4 ">
                            <label class="control-label">Category</label>
                            <select class="form-control" name="category" id="category" required="required" ></select>
                        </div>
                        <div class="col-md-8 ">
                            <label class="control-label">Product tag</label>
                            <div class="col-md-12 ">
                                <div id="product-tag-position"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4 ">
                            <label class="control-label">Sub Category(หมวดหมู่ย่อย)</label>
                            <select class="form-control" name="sub_category_id" id="sub_category_id" required="required" ></select>
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
                        <div class="col-sm-12">
                            <label class="control-label" for="first-name">รายละเอียด<span class="required">*</span></label>
                            <textarea class="form-control" rows="5" id="detail" name="detail"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="control-label" for="first-name">Warranty<span class="required">*</span></label>
                            <textarea class="form-control" rows="5" id="warranty" name="warranty"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label class="control-label">ระยะเวลารอบบริการ (สำหรับคำนวณนัดบริการ)</label>
                            <input type="number" min="1" step="1" class="form-control" name="service_cycle_value" id="service_cycle_value" placeholder="เช่น 6">
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">หน่วย</label>
                            <select class="form-control" name="service_cycle_unit" id="service_cycle_unit">
                                <option value="month">เดือน</option>
                                <option value="year">ปี</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8 ">
                            <label class="control-label">Saler phone</label>
                            <input type="text" class="form-control" name="salerphone" id="salerphone" >
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
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="input-field">
                                <label class="active" style="margin-bottom: 0;">คู่มือการใช้งาน (pdf file เท่านั้น)</label>
                                <input type="file" class="" name="pdf_files" accept=".pdf,application/pdf" id="pdf_files"  >
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="border-top: 1px solid #dee2e6;">
                        <div class="col-12" style="padding: 13px 0;">
                            <a id="back-btn" href="<?=base_url("admin_product");?>" class="btn btn-warning text-center" style="" type="button">กลับ</a>
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
    CKEDITOR.replace('warranty', {height  : '500px',});

    //###  ชื่อสินค้าอ้างอิง (เพิ่ม/ลบได้หลายชื่อ) ##//
    function addRegisNameRow(value) {
        var row = $('<div>', { class: 'regis-name-row', style: 'display:flex; gap:8px; margin-bottom:6px; align-items:center;' });
        var input = $('<input>', { type: 'text', class: 'form-control', name: 'regis_names[]',
            placeholder: 'ชื่อสินค้าตามที่ใช้ในเอกสารใบเสร็จ/รับประกัน อาจไม่ตรงกับ Name ด้านบน', value: value || '' });
        var btnRemove = $('<button>', { type: 'button', class: 'btn btn-round btn-danger', style: 'font-size: 11px; padding: 4px 8px; flex-shrink:0;' })
            .html('<i class="fa fa-trash"></i>')
            .on('click', function() { row.remove(); });
        row.append(input).append(btnRemove);
        $('#regis-names-list').append(row);
    }
    $('#btn-add-regis-name').on('click', function() { addRegisNameRow(''); });
    addRegisNameRow(''); // เริ่มด้วยช่องว่าง 1 ช่องให้กรอกได้เลย
 
    //###  Product tag ##//
    drawtProductTag(base_url);
    function drawtProductTag(base_url){
        var results = get_product_tag_used(base_url);
        if(results.datas.length > 0){ 
            var tags = '';
            $.each( results.datas, function( key, val ) {
                tags += '<div class="form-check-inline">';
                tags += '<label class="form-check-label">';
                tags += '<input type="checkbox" class="form-check-input" name="tag[]" value="'+val.id+'">'+val.name+'';
                tags += '</label>';
                tags += '</div>';
            });
            $('form#action-form #product-tag-position').html(tags);
        }
    }
    function get_product_tag_used(base_url){
        var res = null;
        $.ajax({
            url: base_url+'admin/Product/get_product_tag_used', //ทำงานกับไฟล์นี้
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

    //###  Select option  ##//
    drawtCategoryOption(base_url);
    function drawtCategoryOption(base_url){
        var results = get_product_category_used(base_url);
        if(results.datas.length > 0){   
            var option = '';
            $.each( results.datas, function( key, val ) {
                option += '<option value="'+val.id+'">'+val.name+'</option>';
            });
            var tableid = 'form#action-form #category';
            $(tableid).html(null);
            $(tableid).append(option);
        }
    }
    function get_product_category_used(base_url){
        var res = null;
        $.ajax({
            url: base_url+'admin/Product/get_product_category_used', //ทำงานกับไฟล์นี้
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
            var tableid = 'form#action-form #seo';
            $(tableid).html(null);
            $(tableid).append(option);
        }
    }
    function get_seo_used(base_url){
        var res = null;
        $.ajax({
            url: base_url+'admin/Product/get_product_seo_results', //ทำงานกับไฟล์นี้
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

$(document).ready(function(){
    
    $('#category').trigger('change');
});


    $('#category').change(function(){
        var selectedCategory = $(this).val();
        $.ajax({
            url:base_url+'admin/Product/getSubcategory', //ให้ระบุชื่อไฟล์ PHP ที่เราจะส่งค่าไป
            type: 'POST',
            data: {category: selectedCategory},
            success: function(response){
                var options = ' <option value="0">กรุณาเลือก</option>';
                var res = JSON.parse(response);
                if(res.status){
                    $.each(res.datas, function(index, item){
                        options += '<option value="' + item.subcategory_id + '">' + item.subcategory_name + '</option>';
                    });
                    $('#sub_category_id').html(options);
                }
            },
            error: function(xhr, status, error){
                console.error(xhr.responseText);
            }
        });
    });
    
    //### save form ###//
    $("form#action-form").on("submit",function(e){ // จะทำงานก็ต่อเมื่อกด submit ฟอร์ม
        e.preventDefault(); // ปิดการใช้งาน submit ปกติ เพื่อใช้งานผ่าน ajax
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        
        var fd = new FormData(this); // เตรียมข้อมูล form สำหรับส่งด้วย  FormData Object
        var files = $('#thumnal')[0].files; //เป็นการดึงข้อมูลรูปภาพเพื่อเตรียมเช็คไฟล์ก่อนทำงานส่วน Ajax
        var subCategoryId = parseInt($("#sub_category_id").val());
        
        // //### pdf File ###//
        //     if($('form#action-form #pdf_files').val() != ''){
        //     var inputFiles = $('form#action-form #pdf_files')[0].files; //เป็นการดึงข้อมูลรูปภาพเพื่อเตรียมเช็คไฟล์ก่อนทำงานส่วน Ajax
        //     fd.append('file',inputFiles); //ใช้ในการแทรกค่าไฟล์รูปภาพใน element
        // }

        // เช็คว่ามีไฟล์รูปภาพอยู่หรือไม่
        if(files.length > 0 && subCategoryId != 0 ){

            //$("#loading-spinner").fadeIn(300);
            //fd.append('file',files[0]); //ใช้ในการแทรกค่าไฟล์รูปภาพใน element 

            //### thumnal ###//
            if($('form#action-form #thumnal').val() != ''){
                var inputFiles = $('form#action-form #thumnal')[0].files; //เป็นการดึงข้อมูลรูปภาพเพื่อเตรียมเช็คไฟล์ก่อนทำงานส่วน Ajax
                fd.append('file',inputFiles); //ใช้ในการแทรกค่าไฟล์รูปภาพใน element
            }
            
            //### Files Images ###//
            if($('form#action-form #images').val() != ''){
                var inputFiles = $('form#action-form #images')[0].files; //เป็นการดึงข้อมูลรูปภาพเพื่อเตรียมเช็คไฟล์ก่อนทำงานส่วน Ajax
                fd.append('file',inputFiles); //ใช้ในการแทรกค่าไฟล์รูปภาพใน element
            }
            $.ajax({
                url:base_url+'admin/Product/product_actions', //ให้ระบุชื่อไฟล์ PHP ที่เราจะส่งค่าไป
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
            if(subCategoryId == 0){
                Swal.fire({ icon: 'warning',  text: 'กรุณาเลือกหมวดหมู่ย่อย' });
            }else{

            Swal.fire({ icon: 'warning',  text: 'กรุณาเลือกรูปภาพ' });
            }
        }
    });

</script>
    