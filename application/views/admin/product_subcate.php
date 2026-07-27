<!----  Content ------>
<style>
   table#table>tbody>td { padding: .3rem .75rem !important;}
</style>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>หมวดหมู่สินค้าย่อย<small></small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a href="<?=base_url('admin_product_subcate_add');?>" class="btn add-review" target="_blank"  style="color: #466889;"><i class="fa fa-plus"></i> หมวดหมู่สินค้าย่อย</a>
       
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
                        <th class="column-title" style="width: 11%;">หมวดหมู่หลัก</th>
                        <th class="column-title" style="width: 11%;">หมวดหมู่ย่อย</th>
                
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
                tr += '<td style="vertical-align: inherit; padding: .3rem .75rem !important;">'+val.name+'</td>';
                tr += '<td style="vertical-align: inherit; padding: .3rem .75rem !important;">'+val.subcategory_name+'</td>';

          
                tr += '<td class="" style="text-align: center;vertical-align: inherit; padding: .3rem .75rem !important;">';
                tr += '<ul class="" style="list-style: none; display: inline-flex; margin-bottom: 0rem; min-width: auto; padding-inline: 0px;">';
                tr += '<li><a href="'+base_url+'admin_product_subcate_edit/'+val.id+'" class="btn btn-round btn-warning" style="font-size: 11px; padding: 4px 8px;" data-toggle="tooltip" title="แก้ไข"><i class="fa fa-wrench"></i></a></li>';
                tr += '<li><button class="btn btn-round btn-danger" style="font-size: 11px; padding: 4px 8px;" data-toggle="tooltip" title="ลบหมวดหมู่สินค้าย่อย" onclick="del('+val.id+')"><i class="fa fa-trash"></i></button></li>';
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
            url: base_url+'/admin/Product/get_product_subcategory', //ทำงานกับไฟล์นี้
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

        $.ajax({
                url: base_url+'/admin/Product/check_product_rel', //ทำงานกับไฟล์นี้
                data: {
                    "id" : $id
                },  //ส่งตัวแปร
                type: "POST",
                dataType: 'json',
                async:false,
                success: function(data, status) {
                    var res = data;
                    if(res.datas != false){
                        var html = "";
                        $.each(res.datas, function(key, val) {
                            if(html != ""){
                                html += ",";
                            }
                            html += "\n" + val.name + "\n";
                        });
                        Swal.fire({ icon: 'warning', text: 'ไม่สามารถลบหมวดหมู่ย่อยนี้ได้เนื่องจากมีสินค้าที่เพิ่มหมวดหมู่นี้อยู่ รายชื่อสินค้าดังนี้\n' + html });

                    }else{
                        if(confirm("คุณต้องการที่จะลบหมวดหมู่สินค้าย่อยนี้ จริงหรือไม่ ")){
                                        var res = null;
                                        $.ajax({
                                            url: base_url+'/admin/Product/del_subcategory', //ทำงานกับไฟล์นี้
                                            data: {
                                                "id" : $id
                                            },  //ส่งตัวแปร
                                            type: "POST",
                                            dataType: 'json',
                                            async:false,
                                            success: function(data, status) {
                                                if(data.status){
                                                    Swal.fire({ icon: 'success', text: 'ลบข้อมูลสำเร็จ\n' });
                                                
                                                    setTimeout(function() {
                                                        location.reload();
                                                    }, 1000); 


                                                }
                                            },
                                            error: function(xhr, status, exception) { 
                                                //console.log(xhr);
                                            }
                                        });
                            }
                    }
                },
                error: function(xhr, status, exception) { 
                    //console.log(xhr);
                }
            });

       
    }
</script>
    