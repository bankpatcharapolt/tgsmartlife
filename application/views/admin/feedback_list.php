<div class="x_panel">
        <div class="x_title">
            <h2>ข้อมูลการให้บริการ<small></small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
           
            <div class="clearfix"></div>
        </div>
    <div class="container mt-5">
    <input name="base_url" value="<?=base_url();?>" type="hidden" >

        <div class="table-responsive">
            <table id="feedback_table" class="table table-striped table-bordered" style="width:100%;">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อ</th>
                        <th>นามสกุล</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th>วันที่เข้ารับการบริการ</th>
                        <th>เลขที่ใบสั่งงาน</th>
                        <th>คำติชมการให้บริการ</th>
                        <th>รูปภาพ</th>
                        <th class="column-title no-link last"  style="text-align: center;width: 2%;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($feedbacks as $feedback): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($feedback['name']); ?></td>
                            <td><?= htmlspecialchars($feedback['last_name']); ?></td>
                            <td><?= htmlspecialchars($feedback['phone']); ?></td>
                            <td><?= htmlspecialchars($feedback['service_date']); ?></td>
                            <td><?= htmlspecialchars($feedback['work_order_number']); ?></td>
                            <td><?= htmlspecialchars($feedback['service_feedback']); ?></td>
                            <td>
                                <?php if (!empty($feedback['images'])): ?>
                                    <?php foreach ($feedback['images'] as $image_path): ?>
                                        <img src="<?= $image_path; ?>" alt="Image" style="width: 100px; height: auto; margin-right: 5px;"/>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </td>
                            <td><button class="btn btn-round btn-danger" style="font-size: 11px; padding: 4px 8px;" title="ลบข้อมูล" onclick="delResult('<?php echo $feedback['id'];?>')"><i class="fa fa-trash"></i></button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#feedback_table').DataTable();
        });
        var base_url = $('input[name="base_url"]').val();
        function delResult($id){
        if(confirm("คุณต้องการที่จะลบ ข้อมูลนี้ จริงหรือไม่ ? ")){
            var res = null;
            $.ajax({
                url: base_url+'/admin/Feedback/del_result', //ทำงานกับไฟล์นี้
                data: {
                    "id" : $id
                },  //ส่งตัวแปร
                type: "POST",
                dataType: 'json',
                async:false,
                success: function(data, status) {
                    window.location.reload();
                },
                error: function(xhr, status, exception) { 
                    //console.log(xhr);
                }
            });
        // return res;
        }
    }
    </script>

