<!----  Content ------>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>แก้ไขสถานะ<small></small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <div class="clearfix"></div>
        </div>  

        <div class="x_content">
        ข้อมูลการแจ้งซ่อมเบื้องต้น
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ชื่อ</th>
                    <th>สกุล</th>
                    <th>ที่อยู่</th>
                    <th>เบอร์</th>
                    <th>Email</th>
                    <th>ประเภท</th>
                    <th>รุ่น</th>
                    <th>Serial Number</th>
                    <th>ปัญหา</th>
                    <th>เวลาที่สร้าง</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($issues as $issue): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($issue['name']); ?></td>
                        <td><?php echo htmlspecialchars($issue['lastName']); ?></td>
                        <td><?php echo htmlspecialchars($issue['address']); ?></td>
                        <td><?php echo htmlspecialchars($issue['phone']); ?></td>
                        <td><?php echo htmlspecialchars($issue['email']); ?></td>
                        <td><?php echo htmlspecialchars($issue['productType']); ?></td>
                        <td><?php echo htmlspecialchars($issue['productModel']); ?></td>
                        <td><?php echo htmlspecialchars($issue['machineNumber']); ?></td>
                        <td><?php echo htmlspecialchars($issue['issueDescription']); ?></td>
                        <td><?php echo htmlspecialchars($issue['created_at']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        <form method="post" action="<?//=base_url('admin/Product/product_actions');?>" enctype="multipart/form-data" id="edit-form">
                <input type="hidden" name="method" value="update">
                <input type="hidden" name="id" value="<?php echo $issues[0]['id']?>">
                <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="control-label" for="status">สถานะ<span class="required">*</span></label>
                            <select class="form-control" name="status"  id="status" >
                            <option value="0" <?php echo $issues[0]['status'] == 0 ? "selected" : ""?>>รอดำเนินการ</option>
                            <option value="1" <?php echo $issues[0]['status'] == 1 ? "selected" : ""?>>ดำเนินการเรียบร้อยแล้ว</option>
                            </select>
                        </div>
                    </div>
                    
                
                    <div class="form-group" style="border-top: 1px solid #dee2e6;">
                        <div class="col-12" style="padding: 13px 0;">
                            <a id="back-btn" href="<?=base_url("admin_maintain");?>" class="btn btn-warning text-center" style="" type="button">กลับ</a>
                            <button id="save-btn" class="btn btn-info text-center" style="" type="submit">บันทึก</button>
                        </div>
                    </div>
               
            </form>
        </div>
    </div>
</div>
<!---- End Content ------>
<script>
  
    var base_url = $('input[name="base_url"]').val();
  
     


    $("form#edit-form").on("submit",function(e){ // จะทำงานก็ต่อเมื่อกด submit ฟอร์ม
        e.preventDefault(); // ปิดการใช้งาน submit ปกติ เพื่อใช้งานผ่าน ajax
   
        var fd = new FormData(this); // เตรียมข้อมูล form สำหรับส่งด้วย  FormData Object
        $.ajax({
            url:base_url+'admin/admin_maintain/ma_actions', //ให้ระบุชื่อไฟล์ PHP ที่เราจะส่งค่าไป
            type:'post',
            dataType: 'json',
            data:fd, //ข้อมูลจาก input ที่ส่งเข้าไปที่ PHP
            contentType: false,
            processData: false,
            success:function(response){ //หากทำงานสำเร็จ จะรับค่ามาจาก JSON หลังจากนั้นก็ให้ทำงานตามที่เรากำหนดได้
                window.location.reload();
               
            }
        });
    });
</script>
    