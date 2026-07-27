<!----  Content ------>
<div id="loading-spinner"><div class="cv-spinner"><span class="spinner"></span> </div> </div>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>เพิ่ม ประวัติการขายสินค้า <small></small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <form method="post" action="<?//=base_url('admin/Product/product_actions');?>" enctype="multipart/form-data" id="action-form">
                <input type="hidden" name="action" id="action" value="insert">
                <input type="hidden" name="id" id="id" value="">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-12 ">
                            <label class="control-label">สินค้า</label>
                            <select class="form-control" name="product_id" id="product_id" required="required" ></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 ">
                            <label class="control-label">วันที่ขายสินค้า</label>
                            <div class='input-group date' id='sold_out_date_picker'>
                                <input type='text' class="form-control" id="sold_out_date" name="sold_out_date"/>
                                <span class="input-group-addon" style="padding: 11px 12px;">
                                <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">จำนวนสินค้า</label>
                            <input type="number" class="form-control" name="counts" id="counts" >
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="control-label" for="first-name">รายละเอียด<span class="required">*</span></label>
                            <textarea class="form-control" rows="5" id="detail" name="detail"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group" style="border-top: 1px solid #dee2e6;">
                        <div class="col-12" style="padding: 13px 0;">
                            <a id="back-btn" href="<?=base_url("teamsale/product_sold_out");?>" class="btn btn-warning text-center" style="" type="button">กลับ</a>
                            <button id="save-btn" class="btn btn-info text-center" style="" type="button">บันทึก</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="res-action-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" stye="text-align: center;">
      <div class="modal-body" style="text-align: center;"> 
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="top: -10px; right: -10px; position: absolute; background-color: #03bdd8; border-color: #ffffff; border-radius: 50%; padding: 5px 10px; font-size: small;">X</button>
        <h4 class="modal-title" id="exampleModalLongTitle" style="margin-bottom: 1rem; font-weight: 900;"></h4>
        <p></p> 
      </div>
    </div>
  </div>
</div>
<!---- End Content ------>
<script>

    var base_url = $('input[name="base_url"]').val();
    // CKEDITOR.replace('detail', {height  : '500px',});
    
    //###  Product ##//
    drawtProduc(base_url);
    function drawtProduc(base_url){
        var results = get_product_sold_out(base_url);
        if(results.datas.length > 0){   
            var option = '';
            $.each( results.datas, function( key, val ) {
                option += '<option value="'+val.id+'">'+val.team_product_count+' : '+val.name+'</option>';
            });
            var tableid = 'form#action-form #product_id';
            $(tableid).html(null);
            $(tableid).append(option);
        }
    }
    function get_product_sold_out(base_url){
        var res = null;
        $.ajax({
            url: base_url+'teamsale/Teamsale/get_product', //ทำงานกับไฟล์นี้
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

    //### save form ###//
    
    input_keyup();
    function input_keyup() {
        $("form#action-form #counts").keyup(function(e){
            var value = this.value; 
            if(value != ''){
                $('form#action-form #counts').removeClass('validate-text-input');
            }
        });
    }
    $('form#action-form #save-btn').click(function(){
        if($('form#action-form #counts').val() == ''){
            $('form#action-form #counts').addClass('validate-text-input');
            return false;
        }
        // var product_count = $('form#action-form #product_id').find(":selected").attr('product-count');
        //  var count = $('form#action-form #counts').val();
        // if(parseInt(count) > parseInt(product_count)){
        //     $('form#action-form #counts').addClass('validate-text-input');
        //     return false;
        // }
        
        $.ajax({
            url:base_url+'teamsale/Teamsale/team_product_actions', //ให้ระบุชื่อไฟล์ PHP ที่เราจะส่งค่าไป
            type:'post',
            dataType: 'json',
            data:{
                'action': $('form#action-form #action').val(),
                //'team_id': $('form#action-form #team_id').val(),
                'counts': $('form#action-form #counts').val(),
                'product_id': $('form#action-form #product_id').find(":selected").val(),
                'id'    : $('form#action-form #id').val(),
                'counts': $('form#action-form #counts').val(),
                'sold_out_date': $('form#action-form #sold_out_date').val(),
                'detail': $('form#action-form #detail').val(),
            },
            async:false,
            success:function(response){ //หากทำงานสำเร็จ จะรับค่ามาจาก JSON หลังจากนั้นก็ให้ทำงานตามที่เรากำหนดได้
                if(response.status){
                    window.location.href = response.datas;
                    // drawtProductOption(base_url);
                    // $('form#action-form #action').val('insert');
                    // $('form#action-form #counts').val('');
                    // $('form#action-form #detail').val('');
                    // $('form#action-form #active').val(1).change();
                    // $('#table').DataTable().destroy();
                    // drawtable(base_url);
                    // $('#res-action-modal .modal-body h4').html(response.massege);
                    // $('#res-action-modal').modal('show');
                }else{ 
                    $('#res-action-modal .modal-body h4').html(response.massege);
                    $('#res-action-modal .modal-body p').html(response.text);
                    $('#res-action-modal').modal('show');
                    //window.location.href = response.datas;
                    
                }
            }
        });
    });

</script>
    