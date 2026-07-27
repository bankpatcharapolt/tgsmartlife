<!----  Content ------>
<style>.validate-text-input{ border: 1px solid #ff9c3e; box-shadow: 0px 0px 3px 0px #ff8819d9; }</style>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>TEAMS<small></small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <!-- <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a href="<?=base_url('admin_team_add');?>" class="btn add-blog" target="_blank"  style="color: #466889;"><i class="fa fa-plus"></i> TEAM</a>
                </li>
            </ul> -->
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <div class="table-responsive">
                <table id="table" class="table table-striped jambo_table bulk_action" style="width:100%; border-spacing: 1px !important;">
                    <thead>
                    <tr class="headings">
                        <th class="column-title" style="width: 1%;">ลำดับ</th>
                        <th class="column-title" style="width: 10%;">ชื่อ</th>
                        <th class="column-title" style="width: 10%;">รายละเอียด </th>
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
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">User, Pasword  สำหรับ login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="action" id="action" value="insert">
        <input type="hidden" name="id" id="id"value="">
        <input type="hidden" name="ref_id" id="ref_id"value="">
        <div class="form-group">
            <label for="exampleInputEmail1">User</label>
            <input type="text" class="form-control" id="user" placeholder="User">
            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="pasword" class="form-control" id="pass" placeholder="Password">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <button type="button " class="btn btn-primary usersave-btn">บันทึก</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="res-userpass-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
    drawtable(base_url);
    function drawtable(base_url){
        var results = get_results(base_url);
        if(results.datas.length > 0){   
            var tr = '';
            $.each( results.datas, function( key, val ) {
               
                var no = key+1;
                tr += '<tr class="even pointer">';
                tr += '<td class="a-center " style="vertical-align: inherit;">'+no+'</td>';
                
               tr += '<td style="vertical-align: inherit;">'+val.name+'</td>';
                tr += '<td style="vertical-align: inherit;">'+val.detail+'</td>';
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
                tr += '<li><a href="'+base_url+'admin_team_product_action/'+val.id+'"class="btn btn-round btn-warning " style="background-color: #1abb9c; border-color: #1abb9c;font-size: 11px; padding: 4px 8px;" data-toggle="tooltip" title="เพิ่มสินค้า" ><i class="fa fa-plus"></i></a></li>';
                //tr += '<li><a href="'+base_url+'admin_team_product_edit/'+val.id+'" class="btn btn-round btn-warning" style="font-size: 11px; padding: 4px 8px;" data-toggle="tooltip" title="แก้ไขสินค้า"><i class="fa fa-wrench"></i></a></li>';
                //tr += '<li><button class="btn btn-round btn-danger" style="font-size: 11px; padding: 4px 8px;" data-toggle="tooltip" title="ลบข้อมูล" onclick="delResult('+val.id+')"><i class="fa fa-trash"></i></button></li>';
                tr += '</ul>';
                tr += '</td>';

                //onclick="delImage('+element.product_cate+','+element.product_id+','+element.id+')"
                
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
            url: base_url+'admin/Teams/get_results', //ทำงานกับไฟล์นี้
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
    function draw_user_pass(ref_id){
        $('#userModal .modal-body #ref_id').val(ref_id);
        $('#userModal .modal-body #id').val('');
        $('#userModal .modal-body #user').val('');
        $('#userModal .modal-body #pass').val('');
        $('#userModal').modal('show');

        var results = get_user_pass_results(base_url, ref_id);
        if(results.datas.length > 0){ 
            var userpass = results.datas[0];
            $('#userModal .modal-body #action').val('update');
            $('#userModal .modal-body #id').val(userpass.id);
            $('#userModal .modal-body #user').val(userpass.firstname);
            // $('#userModal .modal-body #pass').val(userpass.pass);
        }
        input_keyup();
        save_user_pass();
    }
    function get_user_pass_results(base_url, ref_id){
        var res = null;
        $.ajax({
            url: base_url+'admin/Teams/get_user_pass_results', //ทำงานกับไฟล์นี้
            data: {'ref_id':ref_id},  //ส่งตัวแปร
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
    function input_keyup() {
        $("#userModal .modal-body #user").keyup(function(e){
            var value = this.value; 
            if(value != ''){
                $('#userModal .modal-body #user').removeClass('validate-text-input');
            }
        });
        // $("#userModal .modal-body #pass").keyup(function(e){
        // var value = this.value; 
        // if(value != ''){
        //     $('#userModal .modal-body #pass').removeClass('validate-text-input');
        // }
        // });
    }
    function save_user_pass(){
        $('#userModal .usersave-btn').click(function(){
            
            if($('#userModal .modal-body #user').val() == ''){
            $('#userModal .modal-body #user').addClass('validate-text-input');
                return false;
            }
            // if($('#userModal .modal-body #pass').val() == ''){
            // $('#userModal .modal-body #pass').addClass('validate-text-input');
            //     return false;
            // }

            $.ajax({
                url:base_url+'admin/Teams/userpass_actions', //ให้ระบุชื่อไฟล์ PHP ที่เราจะส่งค่าไป
                type:'post',
                dataType: 'json',
                data:{
                    'action': $('#userModal .modal-body #action').val(),
                    'ref_id': $('#userModal .modal-body #ref_id').val(),
                    'id': $('#userModal .modal-body #id').val(),
                    'user': $('#userModal .modal-body #user').val(),
                    'pass': $('#userModal .modal-body #pass').val()
                }, //ข้อมูลจาก input ที่ส่งเข้าไปที่ PHP
                async:false,
                success:function(response){ //หากทำงานสำเร็จ จะรับค่ามาจาก JSON หลังจากนั้นก็ให้ทำงานตามที่เรากำหนดได้
                if(response.status){
                    $('#res-userpass-modal .modal-body h4').html(response.massege);
                    // $('#res-userpass-modal .modal-body p').html(response.text);
                    $('#userModal').modal('hide');
                    $('#res-userpass-modal').modal('show');
                }else{
                    $('#res-userpass-modal .modal-body h4').html(response.massege);
                    // $('#res-userpass-modal .modal-body p').html(response.text);
                    $('#userModal').modal('hide');
                    $('#res-userpass-modal').modal('show');
                }
                }
            });
        });
    }
    function delResult($id){
        if(confirm("คุณต้องการที่จะลบ ข้อมูลนี้ จริงหรือไม่ ? ")){
            var res = null;
            $.ajax({
                url: base_url+'/admin/Teams/del_result', //ทำงานกับไฟล์นี้
                data: {
                    "id" : $id
                },  //ส่งตัวแปร
                type: "POST",
                dataType: 'json',
                async:false,
                success: function(data, status) {
                    $('#table').DataTable().destroy();
                    drawtable(base_url);
                },
                error: function(xhr, status, exception) { 
                    //console.log(xhr);
                }
            });
        // return res;
        }
    }
</script>
    