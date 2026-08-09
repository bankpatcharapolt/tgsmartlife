<!----  Content ------><style>
    /* Sortable */
    
    .dragged {
      cursor: pointer !important;
      position: absolute;
      opacity: 0.5;
      z-index: 2000;
    }

    /* จับ handle ลากได้เท่านั้น (ไม่ใช่ทั้งแถว) — ให้เห็นชัดว่ากดตรงนี้ได้ ขยาย touch target ให้พอกดนิ้วง่าย */
    .drag-handle {
        cursor: grab;
        touch-action: none; /* กันเบราว์เซอร์แย่ง gesture ไปตีความเป็น scroll ตอนลากบน touch */
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        min-height: 40px;
        color: #9ca3af;
    }
    .drag-handle:active { cursor: grabbing; }
    .drag-handle .order-no { color: #374151; font-weight: 500; }

    /* มือถือ/จอแคบ: ซ่อนคอลัมน์รอง เหลือแค่ข้อมูลสำคัญให้ดูง่ายไม่ต้องเลื่อนแนวนอนเยอะ
       (ยังเลื่อนดูคอลัมน์ที่เหลือได้อยู่ผ่าน .table-responsive ถ้าจำเป็น) */
    @media (max-width: 768px) {
        .col-mobile-hide { display: none !important; }
        #table .btn-round { padding: 8px 12px !important; font-size: 13px !important; } /* ปุ่มแก้ไข/ลบใหญ่ขึ้น กดนิ้วง่ายขึ้น */
        #table td, #table th { padding: 8px 6px !important; }
    }
</style>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>สินค้า <small>(สามารถลากเพื่อเรียงตำแหน่งได้)</small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a href="<?=base_url('admin_product_add');?>" class="btn add-product-cate" target="_blank"  style="color: #466889;"><i class="fa fa-plus"></i> สินค้า</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content" style="position: relative;">
            <div id="table-loading-overlay" style="display:none; position:fixed; inset:0; background:rgba(255,255,255,.85); z-index:99999; align-items:center; justify-content:center; flex-direction:column; gap:14px;">
                <div style="width:44px;height:44px;border:4px solid #d7ecdf;border-top-color:#0da45f;border-radius:50%;animation:tg-spin .8s linear infinite;"></div>
                <div style="color:#374151;font-size:15px;font-weight:500;">กำลังบันทึกลำดับ...</div>
            </div>
            <style>@keyframes tg-spin { to { transform: rotate(360deg); } }</style>
            <div class="table-responsive">
                <table id="table" class="table table-striped jambo_table bulk_action sorted_table" style="width:100%; border-spacing: 1px !important;">
                    <thead>
                    <tr class="headings">
                        <th class="column-title" style="width: 4%;">ลำดับ</th>
                        <th class="column-title" style="width: 4%;">รูป</th>
                        <th class="column-title col-mobile-hide" style="width: 9%;">รหัสสินค้า</th>
                        <th class="column-title" style="width: 18%;">สินค้า</th>
                        <th class="column-title col-mobile-hide" style="width: 9%;">Sub title</th>
                        <th class="column-title" style="width: 10%;">ราคา</th>
                        <th class="column-title col-mobile-hide" style="width: 13%;">หมวดหมู่</th>
                        <th class="column-title col-mobile-hide" style="width: 11%;">รอบบริการ</th>
                        <th class="column-title" style="text-align: center;width: 6%;">สถานะ</th>
                        <th class="column-title no-link last"  style="text-align: center;width: 5%;"></th>
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
    function esc(s) { return (s == null ? '' : String(s)).replace(/[&<>"']/g, function(c){ return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]; }); }
    function fmtPrice(n) { n = Number(n) || 0; return n.toLocaleString('th-TH', {maximumFractionDigits: 2}); }
    drawtable(base_url);
    function drawtable(base_url){
        var results = get_results(base_url);
        if(results.datas.length > 0){   
            var tr = '';
            $.each( results.datas, function( key, val ) {
               
                var no = key+1;
                tr += '<tr class="even pointer" sort-id="'+val.id+'">';
                tr += '<td class="drag-handle" title="ลากเพื่อเรียงลำดับ"><i class="fa fa-arrows"></i><span class="order-no">'+no+'</span></td>';

                if (val.thumnal) {
                    var imgs = base_url+val.thumnal+'?random='+Math.random();
                    tr += '<td style="vertical-align: middle;"><img src="'+imgs+'" alt="'+esc(val.name)+'" style="width:48px;height:48px;object-fit:cover;border-radius:8px;border:1px solid #e5e7eb;" /></td>';
                } else {
                    tr += '<td style="vertical-align: middle;"><div style="width:48px;height:48px;border-radius:8px;border:1px dashed #d1d5db;background:#f9fafb;display:flex;align-items:center;justify-content:center;color:#c1c7cd;"><i class="fa fa-image"></i></div></td>';
                }

                tr += '<td class="col-mobile-hide" style="vertical-align: middle;">'+esc(val.productcode)+'</td>';

                var refLine = val.regis_name ? '<div class="text-muted" style="font-size:11px;margin-top:2px;">อ้างอิง: '+esc(val.regis_name)+'</div>' : '';
                tr += '<td style="vertical-align: middle;"><div>'+esc(val.name)+'</div>'+refLine+'</td>';

                tr += '<td class="col-mobile-hide" style="vertical-align: middle;">'+esc(val.subtitle)+'</td>';

                var priceHtml;
                var hasSale = val.saleprice && Number(val.saleprice) > 0 && Number(val.saleprice) < Number(val.price);
                if (hasSale) {
                    priceHtml = '<div style="text-decoration:line-through;color:#9ca3af;font-size:12px;">'+fmtPrice(val.price)+'</div>'
                              + '<div style="color:#de5814;font-weight:600;">'+fmtPrice(val.saleprice)+' ฿</div>';
                } else {
                    priceHtml = '<div>'+fmtPrice(val.price)+' ฿</div>';
                }
                tr += '<td style="vertical-align: middle;">'+priceHtml+'</td>';

                let sub_category_name = val?.sub_category_name !== undefined ? val.sub_category_name : '';
                var cateHtml = esc(val.cate_name);
                if (sub_category_name) { cateHtml += ' <span style="color:#c1c7cd;">›</span> ' + esc(sub_category_name); }
                tr += '<td class="col-mobile-hide" style="vertical-align: middle;">'+cateHtml+'</td>';

                var cycleHtml = '<span class="text-muted">-</span>';
                if (val.service_cycle_value && val.service_cycle_unit) {
                    var unitLabel = (val.service_cycle_unit === 'year') ? 'ปี' : 'เดือน';
                    cycleHtml = '<span class="badge" style="background:#eef2ff;color:#4338ca;font-weight:500;font-size:12px;padding:4px 10px;border-radius:12px;">'
                              + val.service_cycle_value + ' ' + unitLabel + '</span>';
                }
                tr += '<td class="col-mobile-hide" style="vertical-align: middle;">'+cycleHtml+'</td>';

                var displaystatus = '';
                if(val.active == '1'){ 
                    //displaystatus = 'เปิดใช้งาน';
                    displaystatus = '<button type="button" class="btn btn-round" style="background-color: #0da45f; color: #ffffff; font-size: 13px; padding: 4px 8px; margin-bottom: inherit;margin-right: inherit;"> เปิดใช้งาน</button>';
                }else{
                    displaystatus = '<button type="button" class="btn btn-round" style="background-color: #de5814; color: #ffffff; font-size: 13px; padding: 4px 8px; margin-bottom: inherit;margin-right: inherit;"> ปิดใช้งาน</button>';
                    //displaystatus = 'ปิดใช้งาน';
                }
                tr += '<td style="vertical-align: middle; text-align: center;">'+displaystatus+'</td>';
                
                tr += '<td class="no-drag" style="text-align: center;vertical-align: middle;">';
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
                    { "bSortable": false, "aTargets": [9] }, 
                    //{ "bSearchable": false, "aTargets": [ 0, 1, 2, 3 ] }
                ]
            });

            // กันปุ่มแก้ไข/ลบ ในแถวโดน sortable จับเป็นการลาก (กดค้างบนปุ่มแล้วลากได้โดยไม่ตั้งใจ)
            // ผูกตรงกับปุ่มใหม่ทุกครั้งที่วาดตารางใหม่ ไม่ใช้ event delegation เพราะต้องให้
            // ทำงานก่อน listener ของ sortable เสมอ ไม่ว่า sortable จะไปผูกไว้ที่ element ไหน
            $(tableid+' .no-drag').on('mousedown touchstart', function(e){
                e.stopPropagation();
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
    // handle: ลากได้เฉพาะจากไอคอนช่องลำดับเท่านั้น (เดิมลากได้ทั้งแถว) — แก้ปัญหาการลากชนกับปุ่ม
    // แก้ไข/ลบที่โดนอย่างถูกที่สุด และสำคัญกับมือถือมาก เพราะลากทั้งแถวจะไปชนกับการ scroll หน้าปกติ
    // มี handle ชัดเจนแทน กด scroll ที่อื่นในแถวได้ปกติ ลากได้เฉพาะกดที่ไอคอนเท่านั้น
    $(".sorted_table").sortable({
      containerSelector: 'table',
      itemPath: '> tbody',
      itemSelector: 'tr',
      handle: '.drag-handle',
      placeholder: '<tr class="placeholder"/>',
      cursor: "move",
      onDrop: function  ($item, container, _super) {
        // โชว์ overlay ก่อน แล้วค่อยเริ่มบันทึกจริงใน setTimeout ถัดไป (0ms) เพื่อให้เบราว์เซอร์มีโอกาส
        // "วาด" overlay ให้เห็นก่อน เพราะโค้ดบันทึกด้านล่างเป็น AJAX แบบ synchronous (async:false) หลายรอบ
        // ที่บล็อกไม่ให้เบราว์เซอร์ repaint จนกว่าจะเสร็จ — ถ้าไม่หน่วงแบบนี้ overlay จะไม่ทันขึ้นให้เห็นเลย
        $('#table-loading-overlay').css('display', 'flex');

        setTimeout(function() {
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
          $('#table-loading-overlay').hide();
        }, 0);
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
    