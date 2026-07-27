<!----  Content ------>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>ตรวจสอบลงทะเบียนสินค้า <small></small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a href="<?=base_url('admin_product_regis_add');?>" class="btn add-product-cate" target="_blank"  style="color: #466889;"><i class="fa fa-plus"></i> ข้อมูลผลิตภันฑ์</a>
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
                        <!-- <th class="column-title" style="width: 3%;"></th> -->
                        <th class="column-title" style="width: 5%;">หมายเลขบิล</th>
                        <th class="column-title" style="width: 5%;">หมายเลขบัตรประชาชน ลูกค้า</th>
                        <th class="column-title" style="width: 5%;">เบอร์โทร ลูกค้า</th>
                        <th class="column-title" style="width: 5%;">รหัสสินค้า</th>
                        <th class="column-title" style="width: 11%;">สินค้า</th>
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

                // var imgs = (val.thumnal != '')? base_url+val.thumnal+'?random='+Math.random(): base_url+'/uploaded/DocumentTh.png';
                // tr += '<td style="vertical-align: inherit;padding: .2rem;"> <img class="thumnails-premise img-add" src="'+imgs+'" alt="image" style="border: unset; width: 100%;" /></td>';
                var bill_number = (val.bill_number != null)?val.bill_number:"";
                var tel_cus = (val.tel_cus != null)?val.tel_cus:"";
                var tel_idcart = (val.tel_idcart != null)?val.tel_idcart:"";
                tr += '<td style="vertical-align: inherit;">'+bill_number+'</td>';
                tr += '<td style="vertical-align: inherit;">'+tel_cus+'</td>';
                tr += '<td style="vertical-align: inherit;">'+tel_idcart+'</td>';

                tr += '<td style="vertical-align: inherit;">'+val.productcode+'</td>';
                tr += '<td style="vertical-align: inherit;">'+val.name+'</td>';
                tr += '<td class="" style="text-align: center;vertical-align: inherit;">';
                tr += '<ul class="" style="list-style: none; display: inline-flex; margin-bottom: 0rem; min-width: auto; padding-inline: 0px;">';
                tr += '<li><a href="'+base_url+'admin_product_regis_edit/'+val.id+'" class="btn btn-round btn-warning" style="font-size: 11px; padding: 4px 8px;" data-toggle="tooltip" title="แก้ไข"><i class="fa fa-wrench"></i></a></li>';
                tr += '<li><button class="btn btn-round btn-danger" style="font-size: 11px; padding: 4px 8px;" data-toggle="tooltip" title="ลบสินค้า" onclick="delResult('+val.id+')"><i class="fa fa-trash"></i></button></li>';
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
                "aoColumnDefs": [
                    { "bSortable": false, "aTargets": [6] }, 
                    //{ "bSearchable": false, "aTargets": [ 0, 1, 2, 3 ] }
                ]
            });
        }
    }
    function get_results(base_url){
        var res = null;
        $.ajax({
            url: base_url+'admin/Product/get_product_regis', //ทำงานกับไฟล์นี้
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
    function delResult(id){
        if(confirm("คุณต้องการที่จะลบข้อมูลสินค้านี้จริงหรือไม่ ")){
            var res = null;
            console.log();
            $.ajax({
                url: base_url+'/admin/Product/del_regis', //ทำงานกับไฟล์นี้
                data: {
                    "id" : id
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
    