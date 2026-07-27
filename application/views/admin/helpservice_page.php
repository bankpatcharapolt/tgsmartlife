<!----  Content ------>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>บริการช่วยเหลือ<small></small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a href="<?=base_url('admin_helpservice_add');?>" class="btn add-blog" style="color: #466889;"><i class="fa fa-plus"></i> บริการช่วยเหลือ</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <div class="table-responsive">
                <table id="table" class="table table-striped jambo_table bulk_action" style="width:100%; border-spacing: 1px !important;">
                    <thead>
                    <tr class="headings">
                        <th class="column-title" style="width: 1%;">ลำดับ</th>
                        <th class="column-title" style="width: 10%;">ชื่อ</th>
                        <th class="column-title" style="width: 11%;">ที่อยู่</th>
                        <th class="column-title" style="width: 11%;">เบอร์โทรศัพท์</th>
                        <th class="column-title" style="width: 10%;">อีเมล์</th>
                        <th class="column-title" style="width: 10%;">latitude</th>
                        <th class="column-title" style="width: 10%;">longitude </th>
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
                tr += '<td style="vertical-align: inherit;">'+val.reg_name+'</td>';
                tr += '<td style="vertical-align: inherit; ">'+val.reg_address+'</td>';
                tr += '<td style="vertical-align: inherit; ">'+val.reg_telephone+'</td>';
                tr += '<td style="vertical-align: inherit; ">'+val.reg_email+'</td>';
                tr += '<td style="vertical-align: inherit; text-align: center;">'+val.latitude+'</td>';
                tr += '<td style="vertical-align: inherit; text-align: center;">'+val.longitude+'</td>';

                var active = '';
                if(val.active == '1'){
                    active = '<button type="button" class="btn btn-round" style="background-color: #0da45f; color: #ffffff; font-size: 13px; padding: 4px 8px; margin-bottom: inherit;margin-right: inherit;"> เปิดใช้งาน</button>';
                }else{
                    active = '<button type="button" class="btn btn-round" style="background-color: #de5814; color: #ffffff; font-size: 13px; padding: 4px 8px; margin-bottom: inherit;margin-right: inherit;"> ปิดใช้งาน</button>';
                }
                tr += '<td style="vertical-align: inherit; text-align: center;">'+active+'</td>';
                
                tr += '<td class="" style="text-align: center;vertical-align: inherit;">';
                tr += '<ul class="" style="list-style: none; display: inline-flex; margin-bottom: 0rem; min-width: auto; padding-inline: 0px;">';
                tr += '<li><a href="'+base_url+'admin_helpservice_edit/'+val.id+'" class="btn btn-round btn-warning" style="font-size: 11px; padding: 4px 8px;" data-toggle="tooltip" title="แก้ไข"><i class="fa fa-wrench"></i></a></li>';
                tr += '<li><button class="btn btn-round btn-danger" style="font-size: 11px; padding: 4px 8px;" data-toggle="tooltip" title="ลบข้อมูล" onclick="delResult('+val.id+')"><i class="fa fa-trash"></i></button></li>';
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
                    [100, 200, 300], [100, 200, 300],
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
            url: base_url+'admin/Helpservice/get_results', //ทำงานกับไฟล์นี้
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
    function delResult($id){
        if(confirm("คุณต้องการที่จะลบ ข้อมูลนี้ จริงหรือไม่ ? ")){
            var res = null;
            $.ajax({
                url: base_url+'/admin/Helpservice/del_result', //ทำงานกับไฟล์นี้
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
    