<!----  Content ------>
<style>.validate-text-input{ border: 1px solid #ff9c3e; box-shadow: 0px 0px 3px 0px #ff8819d9; }</style>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>TEAM<small> <?=$team[0]['name']?> </small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form method="post" action="<?//=base_url('admin/Product/product_actions');?>" enctype="multipart/form-data" id="action-form">
                <input type="hidden" name="action" id="action" value="insert">
                <input type="hidden" name="team_id" id="team_id" value="<?=$team_id?>">
                <input type="hidden" name="id" id="id" value="">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label for="amphurs">สินค้า</label>
                            <select class="form-control" name="product_id"  id="product_id" required="required" >
                                <?php foreach($products as $item){ ?>
                                    <option value="<?=$item['id']?>" product-count="<?=$item['counts']?>" class=""><?=$item['counts']?> : <?=$item['name']?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="control-label">จำนวน</label>
                            <input type="number" class="form-control" name="counts" id="counts" required >
                            <label for="" style="color: #d87b24;">จำนวน ต้องไม่เกินจากจำนวนวสินค้าที่มีอยู่ใน stock</label>
                        </div>
                        <div class="col-md-6">
                            <label for="amphurs">สถานะ</label>
                            <select class="form-control" name="active"  id="active" required="required" >
                                <option value="1" class="active">เปิด ใช้งาน</option>
                                <option value="0">ปิด ใช้งาน</option>
                            </select>
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
                    <div class="form-group" style="/*border-top: 1px solid #dee2e6;*/float: right;">
                        <div class="col-12" style="padding: 13px 0;">
                            <a id="back-btn" href="<?=base_url("admin_team");?>" class="btn btn-warning text-center" style="" type="button">กลับ</a>
                            <button id="save-btn" class="btn btn-info text-center" style="" type="button">บันทึก</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- product table -->
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>สินค้า<small></small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="table-responsive">
                <table id="table" class="table table-striped jambo_table bulk_action" style="width:100%; border-spacing: 1px !important;">
                    <thead>
                    <tr class="headings">
                        <th class="column-title" style="width: 1%;">ลำดับ</th>
                        <th class="column-title" style="width: 10%;">สินค้า</th>
                        <th class="column-title" style="width: 10%;">จำนวน</th>
                        <!-- <th class="column-title" style="width: 10%;">รายละเอียด </th> -->
                        <th class="column-title" style="text-align: center;width: 2%;">สถานะการแสดง</th>
                        <th class="column-title no-link last"  style="text-align: center;width: 2%;"></th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="res-action-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" stye="text-align: center;">
      <div class="modal-body" style="text-align: center;"> 
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="top: -10px; right: -10px; position: absolute; background-color: #03bdd8; border-color: #ffffff; border-radius: 50%; padding: 5px 10px; font-size: small;">X</button>
        <h4 class="modal-title" id="exampleModalLongTitle" style="margin-bottom: 1rem; font-weight: 900;">ส่งข้อมูลเพื่อประเมิน เรียบร้อย</h4>
        <!-- <p>พนักงานจะติดต่อกลับโดยเร็วที่สุด</p>  -->
      </div>
    </div>
  </div>
</div>
<!---- End Content ------>
<script>

    var base_url = $('input[name="base_url"]').val();
    //CKEDITOR.replace('detail', {height  : '200px',});

    drawtable(base_url);
    function drawtable(base_url){
        var results = get_results(base_url);
        if(results.datas.length > 0){   
            var tr = '';
            $.each( results.datas, function( key, val ) {
                var no = key+1;
                tr += '<tr class="even pointer">';
                tr += '<td class="a-center " style="vertical-align: inherit;">'+no+'</td>';
                
                tr += '<td style="vertical-align: inherit;">'+val.product_name+'</td>';
                tr += '<td style="vertical-align: inherit;">'+val.counts+'</td>';
                // tr += '<td style="vertical-align: inherit;">'+val.detail+'</td>';
                var active = '';
                if(val.active == '1'){ 
                    //displaystatus = 'เปิดใช้งาน';
                    active = '<button type="button" class="btn btn-round" style="background-color: #0da45f; color: #ffffff; font-size: 13px; padding: 4px 8px; margin-bottom: inherit;margin-right: inherit;"> เปิดใช้งาน</button>';
                }else{
                    active = '<button type="button" class="btn btn-round" style="background-color: #de5814; color: #ffffff; font-size: 13px; padding: 4px 8px; margin-bottom: inherit;margin-right: inherit;"> ปิดใช้งาน</button>';
                    //displaystatus = 'ปิดใช้งาน';
                }
                tr += '<td style="vertical-align: inherit; text-align: center;">'+active+'</td>';
                
                tr += '<td class="" style="text-align: center;vertical-align: inherit;">';
                tr += '<ul class="" style="list-style: none; display: inline-flex; margin-bottom: 0rem; min-width: auto; padding-inline: 0px;">';
                tr += '<li><button class="btn btn-round btn-warning team-product-edit-btn " onclick="editproduct('+val.id+','+val.product_id+','+val.counts+','+val.active+',\''+val.detail+'\')" style="font-size: 11px; padding: 4px 8px;" data-toggle="tooltip" title="แก้ไขสินค้า" ><i class="fa fa-wrench"></i></button></li>';
                // tr += '<li><button class="btn btn-round btn-danger" style="font-size: 11px; padding: 4px 8px;" data-toggle="tooltip" title="ลบข้อมูล" onclick="delResult('+val.id+')"><i class="fa fa-trash"></i></button></li>';
                tr += '</ul>';
                tr += '</td>';
                tr += '</tr>';

            });
            var tableid = '#table';
            $(tableid+' tbody').html(null);
            $(tableid+' tbody').append(tr);
            $(tableid).dataTable({
                destroy: true,
                lengthMenu: [
                    [50, 100], [50, 100],
                ],
                // "aoColumnDefs": [
                //     { "bSortable": false, "aTargets": [6] }, 
                //     //{ "bSearchable": false, "aTargets": [ 0, 1, 2, 3 ] }
                // ]
            });
        }
        
    }
    function get_results(base_url){
        var res = null;
        $.ajax({
            url: base_url+'admin/Teams/get_team_products', //ทำงานกับไฟล์นี้
            data: {'team_id':$('input[name="team_id"]').val()},  //ส่งตัวแปร
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

    //###  Product Select option  ##//
    drawtProductOption(base_url);
    function drawtProductOption(base_url){
        var results = get_product_used(base_url);
        if(results.datas.length > 0){   
            var option = '';
            //option += '<option value="">เลือก SEO</option>';
            $.each( results.datas, function( key, val ) {
                option += '<option value="'+val.id+'" product-count="'+val.counts+'" class="">'+val.counts+' : '+val.name+'</option>';
            });
            var tableid = 'form#action-form #product_id';
            $(tableid).html(null);
            $(tableid).append(option);
        }
    }
    function get_product_used(base_url){
        var res = null;
        $.ajax({
            url: base_url+'admin/Teams/get_team_product_results', //ทำงานกับไฟล์นี้
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
    
    function editproduct(id, product_id, counts, active, detail){
        $('form#action-form #action').val('update');
        $('form#action-form #id').val(id);
        $('form#action-form #product_id').val(product_id).change();
        $('form#action-form #counts').val(counts);
        $('form#action-form #detail').val(detail);
        $('form#action-form #active').val(active).change();
    }

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
         var count = $('form#action-form #counts').val();
        // if(parseInt(count) > parseInt(product_count)){
        //     $('form#action-form #counts').addClass('validate-text-input');
        //     return false;
        // }
        
        $.ajax({
            url:base_url+'admin/Teams/team_product_actions', //ให้ระบุชื่อไฟล์ PHP ที่เราจะส่งค่าไป
            type:'post',
            dataType: 'json',
            data:{
                'action': $('form#action-form #action').val(),
                'team_id': $('form#action-form #team_id').val(),
                'product_count': $('form#action-form #product_count').val(),
                'product_id': $('form#action-form #product_id').find(":selected").val(),
                'id': $('form#action-form #id').val(),
                'counts': count,
                'active': $('form#action-form #active').find(":selected").val(),
                'detail': $('form#action-form #detail').val(),
            },
            async:false,
            success:function(response){ //หากทำงานสำเร็จ จะรับค่ามาจาก JSON หลังจากนั้นก็ให้ทำงานตามที่เรากำหนดได้
                if(response.status){
                    //window.location.href = response.datas;
                    drawtProductOption(base_url);
                    $('form#action-form #action').val('insert');
                    $('form#action-form #counts').val('');
                    $('form#action-form #detail').val('');
                    $('form#action-form #active').val(1).change();
                    $('#table').DataTable().destroy();
                    drawtable(base_url);
                    $('#res-action-modal .modal-body h4').html(response.massege);
                    $('#res-action-modal').modal('show');
                }else{
                    //window.location.href = response.datas;
                    drawtProductOption(base_url);
                    $('form#action-form #action').val('insert');
                    $('form#action-form #counts').val('');
                    $('form#action-form #detail').val('');
                    $('form#action-form #active').val(1).change();
                    $('#table').DataTable().destroy();
                    drawtable(base_url);
                    $('#res-action-modal .modal-body h4').html(response.massege);
                    $('#res-action-modal').modal('show');
                }
            }
        });
    });
</script>
    