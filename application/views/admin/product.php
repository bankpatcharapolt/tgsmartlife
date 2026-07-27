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
            <h2>สินค้า <small>(สามารถลากเพื่อเรียนตำแหน่งได้)</small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a href="<?=base_url('admin_product_add');?>" class="btn add-product-cate" target="_blank"  style="color: #466889;"><i class="fa fa-plus"></i> สินค้า</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <div class="table-responsive">
                <table id="table" class="table table-striped jambo_table bulk_action sorted_table" style="width:100%; border-spacing: 1px !important;">
                    <thead>
                    <tr class="headings">
                        <th class="column-title" style="width: 1%;">ลำดับ</th>
                        <th class="column-title" style="width: 2%;"></th>
                        <th class="column-title" style="width: 11%;">รหัสสินค้า</th>
                        <th class="column-title" style="width: 11%;">สินค้า</th>
                        <th class="column-title" style="width: 10%;">Sub title</th>
                        <th class="column-title" style="width: 10%;">ราคา</th>
                        <th class="column-title" style="width: 10%;">ราคาที่ลด</th>
                        <th class="column-title" style="width: 10%;">หมวดหมู่ </th>
                        <th class="column-title" style="width: 10%;">หมวดหมู่ย่อย </th>
                        <th class="column-title" style="text-align: center;width: 2%;">สถานะ</th>
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
                tr += '<tr class="even pointer" sort-id="'+val.id+'">';
                tr += '<td class="a-center " style="vertical-align: inherit;">'+no+'</td>';

                var imgs = (val.thumnal != '')? base_url+val.thumnal+'?random='+Math.random(): base_url+'/uploaded/DocumentTh.png';
                tr += '<td style="vertical-align: inherit;padding: .2rem;"> <img class="thumnails-premise img-add" src="'+imgs+'" alt="image" style="border: unset; width: 100%;" /></td>';
                tr += '<td style="vertical-align: inherit;">'+val.productcode+'</td>';
                tr += '<td style="vertical-align: inherit;">'+val.name+'</td>';
                tr += '<td style="vertical-align: inherit;">'+val.subtitle+'</td>';
                tr += '<td style="vertical-align: inherit;">'+val.price+'</td>';
                tr += '<td style="vertical-align: inherit;">'+val.saleprice+'</td>';
                tr += '<td style="vertical-align: inherit;">'+val.cate_name+'</td>';
                let sub_category_name = val?.sub_category_name !== undefined ? val.sub_category_name : '';
                tr += '<td style="vertical-align: inherit;">'+sub_category_name+'</td>';

                var displaystatus = '';
                if(val.active == '1'){ 
                    //displaystatus = 'เปิดใช้งาน';
                    displaystatus = '<button type="button" class="btn btn-round" style="background-color: #0da45f; color: #ffffff; font-size: 13px; padding: 4px 8px; margin-bottom: inherit;margin-right: inherit;"> เปิดใช้งาน</button>';
                }else{
                    displaystatus = '<button type="button" class="btn btn-round" style="background-color: #de5814; color: #ffffff; font-size: 13px; padding: 4px 8px; margin-bottom: inherit;margin-right: inherit;"> ปิดใช้งาน</button>';
                    //displaystatus = 'ปิดใช้งาน';
                }
                tr += '<td style="vertical-align: inherit; text-align: center;">'+displaystatus+'</td>';
                
                tr += '<td class="" style="text-align: center;vertical-align: inherit;">';
                tr += '<ul class="" style="list-style: none; display: inline-flex; margin-bottom: 0rem; min-width: auto; padding-inline: 0px;">';
                tr += '<li><a href="'+base_url+'admin_product_edit/'+val.id+'" class="btn btn-round btn-warning" style="font-size: 11px; padding: 4px 8px;" data-toggle="tooltip" title="แก้ไข"><i class="fa fa-wrench"></i></a></li>';
                tr += '<li><button class="btn btn-round btn-danger" style="font-size: 11px; padding: 4px 8px;" data-toggle="tooltip" title="ลบสินค้า" onclick="delImage('+val.id+')"><i class="fa fa-trash"></i></button></li>';
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
            url: base_url+'admin/Product/get_product', //ทำงานกับไฟล์นี้
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
    function delImage($product_id){
        if(confirm("คุณต้องการที่จะลบสินค้านี้จริงหรือไม่ ")){
            var res = null;
            $.ajax({
                url: base_url+'/admin/Product/del_product', //ทำงานกับไฟล์นี้
                data: {
                    "product_id" : $product_id
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
    
    //#### sort table rows ###//
    $(".sorted_table").sortable({
      containerSelector: 'table',
      itemPath: '> tbody',
      itemSelector: 'tr',
      placeholder: '<tr class="placeholder"/>',
      cursor: "move",
      onDrop: function  ($item, container, _super) {
        $item.closest('table').find('tbody tr').each(function (i, row) {
          var sort_id = $(row).attr("sort-id");
          update_table_sort(base_url, sort_id, i);
          
        });
        var $clonedItem = $('<tr/>').css({height: 0});
        $item.before($clonedItem);
        $clonedItem.animate({'height': $item.height()});

        $item.animate($clonedItem.position(), function  () {
          $clonedItem.detach();
          _super($item, container);
        });

        $('#table').DataTable().destroy();
        drawtable(base_url);
      }
    });
    function update_table_sort(base_url, id, sortable){
        var res = null;
        $.ajax({
            url: base_url+'admin/Product/update_product_sorting', //ทำงานกับไฟล์นี้
            data: {
                'id': id,
                'sortable':sortable,
            },  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {},
            error: function(xhr, status, exception) {}
        });
       // return res;
    }
</script>
    