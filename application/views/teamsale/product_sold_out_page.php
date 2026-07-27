<!----  Content ------><style>
    /* Sortable */
    
    .dragged {
      cursor: pointer !important;
      position: absolute;
      opacity: 0.5;
      z-index: 2000;
    }

</style>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>ประวัติการขายสินค้า <small></small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a href="<?=base_url('teamsale/product_sold_out_add');?>" class="btn add-product-cate" style="color: #466889;"><i class="fa fa-plus"></i> ประวัติการขายสินค้า</a>
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
                        <th class="column-title" style="width: 2%;"></th>
                        <th class="column-title" style="width: 11%;">รหัสสินค้า</th>
                        <!-- <th class="column-title" style="width: 11%;">สินค้า</th> -->
                        <!-- <th class="column-title" style="width: 10%;">Sub title</th> -->
                        <th class="column-title" style="width: 3%;">ราคา</th>
                        <th class="column-title" style="width: 3%;">ราคาที่ลด</th>
                        <th class="column-title" style="width: 4%;">จำนวนที่ขาย </th>
                        <th class="column-title" style="text-align: center;width: 5%;">วันที่ขาย</th>
                        <th class="column-title" style="text-align: center;width: 7%;">วันที่สร้างรายการ</th>
                        <th class="column-title" style="text-align: center;width: 10%;">รายละเอียด</th>
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

                var imgs = (val.thumnal != '')? base_url+val.thumnal+'?random='+Math.random(): base_url+'/uploaded/DocumentTh.png';
                tr += '<td style="vertical-align: inherit;padding: .2rem;"> <img class="thumnails-premise img-add" src="'+imgs+'" alt="image" style="border: unset; width: 100%;" /></td>';
                tr += '<td style="vertical-align: inherit;">'+val.productcode+'</td>';
                // tr += '<td style="vertical-align: inherit;">'+val.name+'</td>';
                // tr += '<td style="vertical-align: inherit;">'+val.subtitle+'</td>';
                tr += '<td style="vertical-align: inherit;">'+val.price+'</td>';
                tr += '<td style="vertical-align: inherit;">'+val.saleprice+'</td>';
                tr += '<td style="vertical-align: inherit;">'+val.counts+'</td>';
                
                // var displaystatus = '';
                // if(val.team_product_active == '1'){ 
                //     //displaystatus = 'เปิดใช้งาน';
                //     displaystatus = '<button type="button" class="btn btn-round" style="background-color: #0da45f; color: #ffffff; font-size: 13px; padding: 4px 8px; margin-bottom: inherit;margin-right: inherit;"> เปิดใช้งาน</button>';
                // }else{
                //     displaystatus = '<button type="button" class="btn btn-round" style="background-color: #de5814; color: #ffffff; font-size: 13px; padding: 4px 8px; margin-bottom: inherit;margin-right: inherit;"> ปิดใช้งาน</button>';
                //     //displaystatus = 'ปิดใช้งาน';
                // }
                // tr += '<td style="vertical-align: inherit; text-align: center;">'+displaystatus+'</td>';
                
                // tr += '<td class="" style="text-align: center;vertical-align: inherit;">';
                // tr += '<ul class="" style="list-style: none; display: inline-flex; margin-bottom: 0rem; min-width: auto; padding-inline: 0px;">';
                // tr += '<li><a href="'+base_url+'admin_product_edit/'+val.id+'" class="btn btn-round btn-warning" style="font-size: 11px; padding: 4px 8px;" data-toggle="tooltip" title="แก้ไข"><i class="fa fa-wrench"></i></a></li>';
                // tr += '<li><button class="btn btn-round btn-danger" style="font-size: 11px; padding: 4px 8px;" data-toggle="tooltip" title="ลบสินค้า" onclick="delImage('+val.id+')"><i class="fa fa-trash"></i></button></li>';
                // tr += '</ul>';
                // tr += '</td>';

                tr += '<td style="vertical-align: inherit;">'+val.sold_out_date+'</td>';
                tr += '<td style="vertical-align: inherit;">'+val.created+'</td>';
                tr += '<td style="vertical-align: inherit;">'+val.detail+'</td>';
                
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
            url: base_url+'teamsale/Teamsale/get_product_sold_out', //ทำงานกับไฟล์นี้
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
    