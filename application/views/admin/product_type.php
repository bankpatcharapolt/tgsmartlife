<!----  Content ------>
<style>
   table#table>tbody>td { padding: .3rem .75rem !important;}
</style>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>ประเภท สินค้า <small></small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a href="<?=base_url('admin_product_type_add');?>" class="btn add-review" target="_blank"  style="color: #466889;"><i class="fa fa-plus"></i> ประเภท สินค้า</a>
                    <!-- <button class="btn add-product-cate" style="color: #466889;"><i class="fa fa-plus"></i> หมวดหมู่สินค้า</button> -->
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
                        <th class="column-title" style="width: 1%;"></th>
                        <th class="column-title" style="width: 11%;">ประเภท สินค้า</th>
                        <!-- <th class="column-title" style="width: 11%;">Background color</th> -->
                        <th class="column-title" style="text-align: center;width: 2%;">สถานะ</th>
                        <!-- <th class="column-title" style="text-align: center;width: 2%;">การจัดเรียง</th> -->
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

    
    //#### sort table rows ###//
    // $("#table>tbody").sortable({
    //     items: "tr",
    //     cursor: 'move',
    //     opacity: 0.6,
    //     start: function (e, ui) {
    //         //ui.item.addClass("selected");
    //     },
    //     stop: function (e, ui) {
    //         $(this).find("tr").each(function (row_id, elm) {
    //             var cate_id = $(elm).attr("category-id");
    //             update_table_sort(base_url, cate_id, row_id);
    //         });
    //         $('#table').DataTable().destroy();
    //         drawtable(base_url);
    //     }
    // });

    // function update_table_sort(base_url, cate_id, sortable){
    //     var res = null;
    //     $.ajax({
    //         url: base_url+'/admin/Product/update_category_table_sort', //ทำงานกับไฟล์นี้
    //         data: {
    //             'cate_id': cate_id,
    //             'sortable':sortable,
    //         },  //ส่งตัวแปร
    //         type: "POST",
    //         dataType: 'json',
    //         async:false,
    //         success: function(data, status) {},
    //         error: function(xhr, status, exception) {}
    //     });
    //    // return res;
    // }

    drawtable(base_url);
    function drawtable(base_url){
        var results = get_results(base_url);
        if(results.datas.length > 0){   
            var tr = '';
            $.each( results.datas, function( key, val ) {
                tr += '<tr>';
                var no = key+1;
                tr += '<td class="a-center " style="vertical-align: inherit; padding: .3rem .75rem !important;">'+no+'</td>';

                var imgs = (val.thumnal != '')? base_url+val.thumnal+'?random='+Math.random(): base_url+'/uploaded/DocumentTh.png';
                tr += '<td style="vertical-align: inherit;padding: .2rem;"> <img class="thumnails-premise img-add" src="'+imgs+'" alt="image" style="border: unset; width: 100%;" /></td>';
                
                tr += '<td style="vertical-align: inherit; padding: .3rem .75rem !important;">'+val.name+'</td>';
                //tr += '<td style="vertical-align: inherit; padding: .3rem .75rem !important;"> <span style="background:'+val.backgroundcolor+';color: #fff; padding: 5px;">'+val.backgroundcolor+'</span></td>';

                var displaystatus = '';
                if(val.active == '1'){ 
                    displaystatus = '<button type="button" class="btn btn-round" style="background-color: #0da45f; color: #ffffff; font-size: 11px; padding: 4px 8px; margin-bottom: inherit;margin-right: inherit;"> เปิดใช้งาน</button>';
                }else{
                    displaystatus = '<button type="button" class="btn btn-round" style="background-color: #de5814; color: #ffffff; font-size: 11px; padding: 4px 8px; margin-bottom: inherit;margin-right: inherit;"> ปิดใช้งาน</button>';
                }
                tr += '<td style="vertical-align: inherit; text-align: center; padding: .3rem .75rem !important;">'+displaystatus+'</td>';
                
                tr += '<td class="" style="text-align: center;vertical-align: inherit; padding: .3rem .75rem !important;">';
                tr += '<ul class="" style="list-style: none; display: inline-flex; margin-bottom: 0rem; min-width: auto; padding-inline: 0px;">';
                tr += '<li><a href="'+base_url+'admin_product_type_edit/'+val.id+'" class="btn btn-round btn-warning" style="font-size: 11px; padding: 4px 8px;" data-toggle="tooltip" title="แก้ไข"><i class="fa fa-wrench"></i></a></li>';
                tr += '<li><button class="btn btn-round btn-danger" style="font-size: 11px; padding: 4px 8px;" data-toggle="tooltip" title="ลบหมวดหมู่สินค้า" onclick="del('+val.id+')"><i class="fa fa-trash"></i></button></li>';
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
                //"aoColumnDefs": [
                    //{ "bSortable": false, "aTargets": [5] }, 
                    //{ "bSearchable": false, "aTargets": [ 0, 1, 2, 3 ] }
                //]
            });
        }
        $('form#action-form #action').val('insert');
        $('form#action-form #id').val('');
        $('form#action-form #name').val('');
        $('#actionModal').modal('hide');
    }
    function get_results(base_url){
        var res = null;
        $.ajax({
            url: base_url+'/admin/Product/get_product_type', //ทำงานกับไฟล์นี้
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
    function del($id){
        if(confirm("คุณต้องการที่จะลบ ประเภท สินค้านี้ จริงหรือไม่ ")){
            var res = null;
            $.ajax({
                url: base_url+'/admin/Product/del_type', //ทำงานกับไฟล์นี้
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
    