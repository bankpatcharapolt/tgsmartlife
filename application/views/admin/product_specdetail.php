 <!----  Content ------>
 <style>
     /* Sortable */
 </style>
 <div class="clearfix"></div>
 <div class="col-md-12 col-sm-12  ">
     <div class="x_panel">
         <div class="x_title">
             <h2>ข้อมูลจำเพาะ</h2>
             <input name="base_url" value="<?= base_url(); ?>" type="hidden">

             <div class="clearfix"></div>
         </div>

         <div class="x_content">
             <div class="table-responsive">
                 <table id="table" class="table table-striped jambo_table bulk_action sorted_table" style="width:100%; border-spacing: 1px !important;">
                     <thead>
                         <tr class="headings">
                             <th class="column-title" style="width: 1%;">ลำดับ</th>
                             <th class="column-title" style="width: 2%;"></th>
                              <th class="column-title" style="width: 11%;">หมวดหมู่</th>
                             <th class="column-title" style="width: 11%;">รหัสสินค้า</th>
                           
                             <th class="column-title" style="width: 11%;">สินค้า</th>
                             <th class="column-title" style="width: 10%;">ข้อมูลจำเพาะ</th>



                             <th class="column-title no-link last" style="text-align: center;width: 2%;"></th>
                         </tr>
                     </thead>
                     <tbody></tbody>
                 </table>
             </div>
         </div>
     </div>
 </div>

 <div class="modal fade" id="editSpecModal" tabindex="-1" role="dialog" aria-labelledby="editSpecModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="editSpecModalLabel">แก้ไข/เพิ่มข้อมูลจำเพาะสินค้า</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
    <form id="productSpecForm">
        <input type="hidden" id="product_id_input" name="product_id"> 

        <div class="form-group">
            <h4>ข้อมูลจำเพาะ</h4>
            
            <div id="specCheckboxes">
                <div class="form-check">
                    <input class="form-check-input spec-item" style="margin-top:0px;" type="checkbox" 
                           value="1" 
                           id="specShowStatus" 
                           name="is_show_specdetail_status"> 
                    <label class="form-check-label" for="specShowStatus">
                        ปิด/เปิดใช้งาน (เพื่อให้แสดงผลในหน้าบ้าน)
                    </label>
                </div>
                
                <h5 class="mt-3">กำหนดหัวข้อหลัก (Group) และรายละเอียด</h5>
                
                <button type="button" class="btn btn-primary mb-3" id="add-group-btn">
                    <i class="fa fa-plus"></i> เพิ่มหมวดหมู่หลัก
                </button>
                
                <div id="dynamic-fields-container">
                    </div>
            </div>
        </div>
    </form>
</div>
             <!-- <div class="modal-body">
                 <form id="productSpecForm">
                     <input type="hidden" id="product_id_input" name="product_id">

                     <div class="form-group">
                         <h4>ข้อมูลจำเพาะ</h4>

                         <div id="specCheckboxes">
                             <div class="form-check">
                                 <input class="form-check-input spec-item" style="margin-top:0px;" type="checkbox"
                                     value="1"
                                     id="specShowStatus"
                                     name="is_show_specdetail_status">
                                 <label class="form-check-label" for="specShowStatus">
                                     ปิด/เปิดใช้งาน (เพื่อให้แสดงผลในหน้าบ้าน)
                                 </label>
                             </div>

                             <h5>กำหนดหัวข้อและรายละเอียดข้อมูลจำเพาะ</h5>

                             <div id="dynamic-fields-container">
                                 <div class="form-row input-group mb-2 dynamic-input-row" data-index="0">
                                 </div>
                             </div>


                         </div>
                     </div>
                 </form>
             </div> -->
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                 <button type="button" class="btn btn-primary" id="saveSpecBtn">บันทึกการเปลี่ยนแปลง</button>
             </div>
         </div>
     </div>
 </div>
 <!---- End Content ------>

 <script>
     var base_url = $('input[name="base_url"]').val();
     drawtable(base_url);



     function drawtable(base_url) {
         var results = get_results(base_url);
         if (results.datas.length > 0) {
             var tr = '';
             $.each(results.datas, function(key, val) {

                 var no = key + 1;
                 tr += '<tr class="even pointer" sort-id="' + val.id + '">';
                 tr += '<td class="a-center " style="vertical-align: inherit;">' + no + '</td>';

                 var imgs = (val.thumnal != '') ? base_url + val.thumnal + '?random=' + Math.random() : base_url + '/uploaded/DocumentTh.png';
                 tr += '<td style="vertical-align: inherit;padding: .2rem;"> <img class="thumnails-premise img-add" src="' + imgs + '" alt="image" style="border: unset; width: 100%;" /></td>';
                     tr += '<td style="vertical-align: inherit;">' + val.cate_name + '</td>';
                 tr += '<td style="vertical-align: inherit;">' + val.productcode + '</td>';
                 
                 tr += '<td style="vertical-align: inherit;">' + val.name + '</td>';

                 tr += '<td style="vertical-align: inherit; font-size: 12px;">' + (val.spec_details_html || '-') + '</td>';


                 tr += '<td class="" style="text-align: center;vertical-align: inherit;">';
                 tr += '<ul class="" style="list-style: none; display: inline-flex; margin-bottom: 0rem; min-width: auto; padding-inline: 0px;">';
              
                 tr += '<li><a href="#" class="btn btn-round btn-warning edit-spec-btn" style="font-size: 11px; padding: 4px 8px;" data-toggle="modal" data-target="#editSpecModal" data-id="' + val.id + '" title="แก้ไข"><i class="fa fa-wrench"></i></a></li>';

                 tr += '</ul>';
                 tr += '</td>';
                 tr += '</tr>';
             });
             var tableid = '#table';
             $(tableid + ' tbody').html(null);
             $(tableid + ' tbody').append(tr);
             $(tableid).dataTable({
                 destroy: true,
                 lengthMenu: [
                     [50, 100],
                     [50, 100],
                 ],
                 "aoColumnDefs": [{
                         "bSortable": false,
                         "aTargets": [6]
                     },
                     //{ "bSearchable": false, "aTargets": [ 0, 1, 2, 3 ] }
                 ]
             });
         }
     }

     function get_results(base_url) {
         var res = null;
         $.ajax({
             url: base_url + 'admin/Product/get_product_spec_detail',
             data: '', //ส่งตัวแปร
             type: "POST",
             dataType: 'json',
             async: false,
             success: function(data, status) {
                 res = data;
             },
             error: function(xhr, status, exception) {
                 //console.log(xhr);
             }
         });
         return res;
     }

     function delImage($product_id) {
         if (confirm("คุณต้องการที่จะลบสินค้านี้จริงหรือไม่ ")) {
             var res = null;
             $.ajax({
                 url: base_url + '/admin/Product/del_product',
                 data: {
                     "product_id": $product_id
                 }, //ส่งตัวแปร
                 type: "POST",
                 dataType: 'json',
                 async: false,
                 success: function(data, status) {
                     $('#table').DataTable().destroy();
                     drawtable(base_url);
                 },
                 error: function(xhr, status, exception) {
                     //console.log(xhr);
                 }
             });

         }
     }
 </script>


 <script>
     var fieldIndex = 0; // ตั้งค่าตัวนับเริ่มต้น

     var groupIndex = 0;
     var specIndex = 0;

     // ฟังก์ชันสำหรับสร้าง Input Field ของรายละเอียด (ชั้นที่ 3: ผูกกับชั้น 2)
     function createNewSpecField(group_index, specId = '', title = '', detail = '', removeStyle = '') {
         // ใช้ group_index ที่รับเข้ามา เพื่อผูกชื่อ name ให้ถูกต้อง
         const currentSpecIndex = specIndex++;
         return `
        <div class="form-row input-group mb-1 dynamic-spec-field" data-spec-id="${specId}">
            <input type="hidden" class="spec-id-input" name="specs[${group_index}][items][${currentSpecIndex}][id]" value="${specId}">
            <div class="col-5 offset-1">
                <input type="text" class="form-control spec-title-item" name="specs[${group_index}][items][${currentSpecIndex}][title]" placeholder="หัวข้อย่อย (เช่น สี, ขนาด)" value="${title}">
            </div>
            <div class="col-5">
                <input type="text" class="form-control spec-detail-item" name="specs[${group_index}][items][${currentSpecIndex}][detail]" placeholder="รายละเอียด" value="${detail}">
            </div>
            <div class="col-1 input-group-append">
                <button class="btn btn-danger remove-spec-btn" type="button" ${removeStyle} title="ลบรายละเอียด"><i class="fa fa-minus"></i></button>
            </div>
        </div>
    `;
     }

     function createNewGroupRow(groupId = '', groupTitle = '', specs = []) {
         const currentGroupIndex = groupIndex++;

         let specsHtml = '';
         // หากมีข้อมูล spec เก่า ให้สร้าง input field ของ spec เหล่านั้น
         if (specs.length > 0) {
             specIndex = 0; // รีเซ็ต specIndex ภายใน Group
             $.each(specs, function(i, spec) {
                 specsHtml += createNewSpecField(currentGroupIndex, spec.id, spec.title, spec.detail);
             });
         } else {
             // ถ้าไม่มี spec เก่า ให้เพิ่มรายละเอียดเปล่า 1 แถวเริ่มต้น
             specsHtml += createNewSpecField(currentGroupIndex);
         }

         const removeGroupStyle = $('.dynamic-group-row').length === 0 ? 'style="display:none;"' : '';

         return `
        <div class="card p-3 mb-3 dynamic-group-row" data-group-index="${currentGroupIndex}" data-group-id="${groupId}">
            <input type="hidden" class="group-id-input" name="specs[${currentGroupIndex}][group_id]" value="${groupId}">
            
            <div class="form-row input-group mb-3">
                <div class="col-11">
                    <input type="text" class="form-control group-title-input" name="specs[${currentGroupIndex}][group_title]" placeholder="หัวข้อหลัก/หมวดหมู่ (เช่น ข้อมูลทั่วไป)" value="${groupTitle}">
                </div>
                <div class="col-1 input-group-append">
                    <button class="btn btn-danger remove-group-btn" type="button" ${removeGroupStyle} title="ลบหมวดหมู่"><i class="fa fa-trash"></i></button>
                </div>
            </div>

            <div class="specs-container-in-group" data-group-index="${currentGroupIndex}">
                ${specsHtml}
            </div>

            <div class="form-row mt-2">
                <div class="col-12" style="text-align: right;">
                    <button class="btn btn-info btn-sm add-spec-btn" type="button" data-group-index="${currentGroupIndex}" title="เพิ่มรายละเอียด"><i class="fa fa-plus"></i> เพิ่มรายละเอียด</button>
                </div>
            </div>
        </div>
    `;
     }

     // ฟังก์ชันเสริมสำหรับควบคุมปุ่มลบ Group
     function updateGroupRemoveButtonVisibility() {
         if ($('.dynamic-group-row').length > 1) {
             $('.remove-group-btn').show();
         } else {
             $('.remove-group-btn').hide();
         }
     }
     // ฟังก์ชันสำหรับสร้าง HTML ของ Input Field คู่ใหม่
     function createNewFieldRow(index, specId = '', title = '', detail = '') {
         // เพิ่ม hidden input สำหรับเก็บ spec ID (สำหรับข้อมูลเก่า)
         var isNew = specId === '' ? 'style="display:none;"' : '';
         var removeStyle = $('.dynamic-input-row').length <= 0 ? 'style="display:none;"' : ''; // ซ่อนปุ่มลบเริ่มต้น

         return `
        <div class="form-row input-group mb-2 dynamic-input-row" data-index="${index}" data-spec-id="${specId}">
            <input type="hidden" class="spec-id-input" name="specs[${index}][id]" value="${specId}">
            <div class="col-5">
                <input type="text" class="form-control spec-title" name="specs[${index}][title]" placeholder="หัวข้อ (เช่น สี)" value="${title}">
            </div>
            <div class="col-6">
                <input type="text" class="form-control spec-detail" name="specs[${index}][detail]" placeholder="รายละเอียด (เช่น แดง, น้ำเงิน)" value="${detail}">
            </div>
            <div class="col-1 input-group-append">
                <button class="btn btn-success add-field-btn" type="button"><i class="fa fa-plus"></i></button>
                <button class="btn btn-danger remove-field-btn" type="button" ${removeStyle}><i class="fa fa-trash"></i></button> 
            </div>
        </div>
    `;
     }

     // ฟังก์ชันเสริมสำหรับควบคุมปุ่มลบ
     function updateRemoveButtonVisibility() {
         if ($('.dynamic-input-row').length > 1) {
             $('.remove-field-btn').show();
         } else {
             $('.remove-field-btn').hide();
         }
     }


     function loadAndPopulateSpecs(productId, base_url) {
         // 1. ล้าง Field Index และ Container
         groupIndex = 0;
         $('#dynamic-fields-container').empty();

         // 2. ดึงข้อมูลจากเซิร์ฟเวอร์
         $.ajax({
             url: base_url + 'admin/Product/getProductSpecs', // ต้องสร้าง Endpoint นี้ใน PHP
             data: {
                 "product_id": productId
             },
             type: "POST",
             dataType: 'json',
             success: function(response) {
                 var groupsData = response.groups_data; // สมมติว่า server ส่งเป็น groups_data มา
                 var isChecked = response.is_checked == 1;
                 $('#specShowStatus').prop('checked', isChecked); // กำหนดสถานะ true/false

                 if (groupsData && groupsData.length > 0) {
                     // เติมข้อมูลเก่าเข้าไปในแต่ละ Group
                    $.each(groupsData, function(i, group) {
                        // เรียกใช้ createNewGroupRow ด้วยข้อมูล group_id, group_title, และ items
                        var newGroupRow = createNewGroupRow(group.group_id, group.group_title, group.items); 
                        $('#dynamic-fields-container').append(newGroupRow);
                    });
                 }

                 // 3. เพิ่มแถว Group เปล่า 1 แถวเสมอ สำหรับการเพิ่มข้อมูลใหม่ (ถ้ายังไม่มี)
                 if (groupsData.length === 0) {
                     var emptyGroupRow = createNewGroupRow();
                     $('#dynamic-fields-container').append(emptyGroupRow);
                 }

                 // 4. ควบคุมการแสดงปุ่มลบ
                 updateGroupRemoveButtonVisibility();

             },
             error: function() {
                 alert('ไม่สามารถดึงข้อมูลจำเพาะสินค้าเก่าได้');
                 // ถ้าดึงข้อมูลพลาด ให้แสดงแถว Group เปล่า 1 แถวเริ่มต้น
                 var initialGroupRow = createNewGroupRow();
                 $('#dynamic-fields-container').append(initialGroupRow);
                 updateGroupRemoveButtonVisibility();
             }
         });
     }

     // ... (โค้ด $('#editSpecModal').on('show.bs.modal', function(event) ... เดิม) ...

     // **ใหม่: เพิ่ม Group (ชั้นที่ 2)**
     $(document).on('click', '#add-group-btn', function() {
         var newGroupRow = createNewGroupRow();
         $('#dynamic-fields-container').append(newGroupRow);
         updateGroupRemoveButtonVisibility();
     });

     // **ใหม่: ลบ Group (ชั้นที่ 2)**
     $(document).on('click', '.remove-group-btn', function() {
         $(this).closest('.dynamic-group-row').remove();
         updateGroupRemoveButtonVisibility();
     });

     // **ใหม่: เพิ่ม Spec (ชั้นที่ 3)**
     $(document).on('click', '.add-spec-btn', function() {
         const groupIndex = $(this).data('group-index');
         const newSpecRow = createNewSpecField(groupIndex);
         $(this).closest('.dynamic-group-row').find('.specs-container-in-group').append(newSpecRow);
     });

     // **ใหม่: ลบ Spec (ชั้นที่ 3)**
     $(document).on('click', '.remove-spec-btn', function() {
         $(this).closest('.dynamic-spec-field').remove();
         // ไม่ต้อง updateGroupRemoveButtonVisibility เพราะเป็นปุ่มลบ Spec ไม่ใช่ Group
     });


     // **ปรับปรุง Logic ปุ่ม Save**
     $('#saveSpecBtn').on('click', function() {
         var productId = $('#productSpecForm #product_id_input').val();
         var groupsArray = []; // เปลี่ยนชื่อตัวแปรเป็น groupsArray

         if (!productId || productId.trim() === '') {
             alert('เกิดข้อผิดพลาด: ไม่พบรหัสสินค้า (Product ID) โปรดลองเปิด Modal ใหม่อีกครั้ง');
             return;
         }

         // วนลูปอ่านค่าจากทุก Group (ชั้นที่ 2)
         $('.dynamic-group-row').each(function() {
             var groupTitle = $(this).find('.group-title-input').val();
             var groupId = $(this).data('group-id');
             var groupItems = []; // รายละเอียด Spec (ชั้นที่ 3)

             // วนลูปอ่านค่าจากทุก Spec ภายใต้ Group นี้
             $(this).find('.dynamic-spec-field').each(function() {
                 var title = $(this).find('.spec-title-item').val();
                 var detail = $(this).find('.spec-detail-item').val();
                 var specId = $(this).data('spec-id');

                 // เก็บข้อมูลทุกแถวที่กรอก (ถ้ามี Title หรือ Detail)
                 if (title.trim() !== '' || detail.trim() !== '') {
                     groupItems.push({
                         id: specId,
                         title: title,
                         detail: detail
                     });
                 }
             });

             // เก็บข้อมูล Group ถ้ามีชื่อ Group หรือมีรายละเอียด Spec
             if (groupTitle.trim() !== '' || groupItems.length > 0) {
                 groupsArray.push({
                     id: groupId,
                     group_title: groupTitle,
                     items: groupItems
                 });
             }
         });

         console.log('Product ID:', productId);
         console.log('Groups Data (for AJAX):', groupsArray);

         // 5. ส่งข้อมูล groupsArray ไปยัง AJAX
         var isShowStatus = $('#specShowStatus').is(':checked') ? 1 : 0;

         $.ajax({
             url: base_url + 'admin/Product/save_dynamic_specs', // URL ไปยัง PHP Controller (ต้องรองรับโครงสร้างใหม่)
             data: {
                 "product_id": productId,
                 "groups": groupsArray, // เปลี่ยนชื่อ parameter
                 "is_show_specdetail_status": isShowStatus
             },
             type: "POST",
             dataType: 'json',
             success: function(response) {
                 if (response.status === 'success') {
                     alert('บันทึกข้อมูลจำเพาะสินค้าเรียบร้อย');
                     $('#editSpecModal').modal('hide');
                     drawtable(base_url);
                 } else {
                     alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' + response.message);
                 }
             },
             error: function(xhr, status, error) {
                 console.error("AJAX Error:", error);
                 alert('เกิดข้อผิดพลาดในการเชื่อมต่อเซิร์ฟเวอร์');
             }
         });
     });

     $('#editSpecModal').on('show.bs.modal', function(event) {
         var button = $(event.relatedTarget);
         var productId = button.data('id'); // ดึง Product ID จากปุ่ม
         var modal = $(this);

         // 1. ล้างฟอร์มทั้งหมด และเคลียร์ dynamic container
         $('#productSpecForm')[0].reset();
         $('#dynamic-fields-container').empty();

         // 2. กำหนด Product ID และ Title ใหม่
         modal.find('#product_id_input').val(productId);
         modal.find('.modal-title').text('แก้ไขข้อมูลจำเพาะสำหรับสินค้า ID: ' + productId);

         // 3. โหลดและแสดงข้อมูลเก่า
         loadAndPopulateSpecs(productId, base_url);

         // (Optional: โหลดสถานะ checkbox is_active ถ้ามี)
     });

     // **ปรับปรุง Logic ปุ่ม + (Add Field)**
     // ต้องอัปเดต fieldIndex เมื่อกดปุ่ม + และควบคุมปุ่มลบ
     $(document).on('click', '.add-field-btn', function() {
         var newRow = createNewFieldRow(fieldIndex);
         $('#dynamic-fields-container').append(newRow);
         fieldIndex++;
         updateRemoveButtonVisibility();
     });

     // **ปรับปรุง Logic ปุ่มลบ (Remove Field)**
     $(document).on('click', '.remove-field-btn', function() {
         $(this).closest('.dynamic-input-row').remove();
         // ไม่ต้องอัปเดต fieldIndex เพราะ index ไม่ได้เรียงตามลำดับแล้ว แต่จะส่งทั้งหมดไปให้เซิร์ฟเวอร์จัดการ
         updateRemoveButtonVisibility();
     });
     /*
     $('#saveSpecBtn').on('click', function() {
        var productId = $('#productSpecForm #product_id_input').val(); 
         var specsArray = [];
         
        if (!productId || productId.trim() === '') {
             alert('เกิดข้อผิดพลาด: ไม่พบรหัสสินค้า (Product ID) โปรดลองเปิด Modal ใหม่อีกครั้ง');
             return; // หยุดการทำงานถ้าไม่มี Product ID
         }

         // วนลูปอ่านค่าจากทุกแถว (Title และ Detail)
         $('.dynamic-input-row').each(function() {
             var title = $(this).find('.spec-title').val();
             var detail = $(this).find('.spec-detail').val();

             // เก็บข้อมูลทุกแถวที่กรอก
             if (title.trim() !== '' || detail.trim() !== '') {
                 specsArray.push({
                     title: title,
                     detail: detail
                 });
             }
         });

         console.log('Product ID:', productId);
         console.log('Specifications Data (for AJAX):', specsArray);

         // 5. ส่งข้อมูล specsArray ไปยัง AJAX
         var isShowStatus = $('#specShowStatus').is(':checked') ? 1 : 0;
      
         $.ajax({
             url: base_url + 'admin/Product/save_dynamic_specs', // URL ไปยัง PHP Controller
             data: {
                 "product_id": productId,
                 "specifications": specsArray,
                 "is_show_specdetail_status": isShowStatus
             },
             type: "POST",
             dataType: 'json',
             success: function(response) {
                  if(response.status === 'success') {
                     alert('บันทึกข้อมูลจำเพาะสินค้าเรียบร้อย');
                     $('#editSpecModal').modal('hide');
                     drawtable(base_url);
                     // อาจจะต้องเรียก drawtable(base_url) เพื่ออัปเดตตารางหลัก
                  } else {
                     alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' + response.message);
                  }
             },
             error: function(xhr, status, error) {
                 console.error("AJAX Error:", error);
                 alert('เกิดข้อผิดพลาดในการเชื่อมต่อเซิร์ฟเวอร์');
             }
         });
     });

     */
 </script>