<!----  Content ------>
<style>
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
            <h2>Product slider <small>(สามารถลากเพื่อเรียนตำแหน่งได้)</small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a href="<?=base_url('admin_slide_add');?>" class="btn add-product-cate" target="_blank"  style="color: #466889;"><i class="fa fa-plus"></i> Product slider</a>
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
                        <th class="column-title" style="width: 10%;">title</th>
                        <th class="column-title" style="width: 10%;">sub title</th>
                        <th class="column-title" style="width: 10%;">link</th>
                        <th class="column-title" style="width: 5%;">สถานะ</th>
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
                tr += '<tr class="even pointer" banner-id="'+val.id+'">';
                tr += '<td class="a-center " style="vertical-align: inherit;">'+no+'</td>';

                var imgs = (val.path != '')? base_url+val.path+'?random='+Math.random(): base_url+'/uploaded/DocumentTh.png';
                tr += '<td style="vertical-align: inherit;padding: .2rem;"> <img class="thumnails-premise img-add" src="'+imgs+'" alt="image" style="border: unset; width: 100%;" /></td>';
                tr += '<td style="vertical-align: inherit;">'+val.title+'</td>';
                tr += '<td style="vertical-align: inherit;">'+val.sub_title+'</td>';
                tr += '<td style="vertical-align: inherit;">'+val.link+'</td>';

                var displaystatus = '';
                if(val.active == '1'){ 
                    displaystatus = '<button type="button" class="btn btn-round" style="background-color: #0da45f; color: #ffffff; font-size: 11px; padding: 4px 8px; margin-bottom: inherit;margin-right: inherit;"> เปิดใช้งาน</button>';
                }else{
                    displaystatus = '<button type="button" class="btn btn-round" style="background-color: #de5814; color: #ffffff; font-size: 11px; padding: 4px 8px; margin-bottom: inherit;margin-right: inherit;"> ปิดใช้งาน</button>';
                }
                tr += '<td style="vertical-align: inherit; text-align: center; padding: .3rem .75rem !important;">'+displaystatus+'</td>';
                
                tr += '<td class="" style="text-align: center;vertical-align: inherit;">';
                tr += '<ul class="" style="list-style: none; display: inline-flex; margin-bottom: 0rem; min-width: auto; padding-inline: 0px;">';
                tr += '<li><a href="'+base_url+'admin_slide_edit/'+val.id+'" class="btn btn-round btn-warning" style="font-size: 11px; padding: 4px 8px;" data-toggle="tooltip" title="แก้ไข"><i class="fa fa-wrench"></i></a></li>';
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
        if(!results){
            var tableid = '#table';
            $(tableid+' tbody').html(null);
        }
    }
    function get_results(base_url){
        var res = null;
        $.ajax({
            url: base_url+'admin/Product/get_slide', //ทำงานกับไฟล์นี้
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
        if(confirm("คุณต้องการที่จะลบข้อมูลนี้ จริงหรือไม่ ")){
            var res = null;
            $.ajax({
                url: base_url+'/admin/Product/del_slide_result', //ทำงานกับไฟล์นี้
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
    
    //#### sort table rows ###//
    $(".sorted_table").sortable({
      containerSelector: 'table',
      itemPath: '> tbody',
      itemSelector: 'tr',
      placeholder: '<tr class="placeholder"/>',
      cursor: "move",
      onDrop: function  ($item, container, _super) {
        $item.closest('table').find('tbody tr').each(function (i, row) {
          var banner_id = $(row).attr("banner-id");
          update_table_sort(base_url, banner_id, i);
          
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
            url: base_url+'admin/Product/update_slide_sorting', //ทำงานกับไฟล์นี้
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
    