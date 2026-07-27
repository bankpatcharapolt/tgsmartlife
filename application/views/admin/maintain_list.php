<div class="x_panel">
    <div class="x_title">
        <h2>รายการแจ้งซ่อม<small></small></h2>
        <input name="base_url" value="<?= base_url(); ?>" type="hidden">

        <div class="clearfix"></div>
    </div>
    <div class="container mt-5">


        <div class="table-responsive">
            <table id="ma_table" class="table table-striped table-bordered" style="width:100%;">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อ</th>
                        <th>นามสกุล</th>
                        <th>ที่อยู่</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th>E-Mail</th>
                        <th>ประเภทสินค้า</th>
                        <th>รุ่น</th>
                        <th>Serial Number</th>
                        <th>อาการสินค้าเบื้องต้น</th>
                        <th>สถานะ</th>
                        <th>รูปภาพ / วีดีโอที่เกี่ยวข้อง</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($maintains as $maintain) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($maintain['name']); ?></td>
                            <td><?= htmlspecialchars($maintain['lastName']); ?></td>
                            <td><?= htmlspecialchars($maintain['address']); ?></td>
                            <td><?= htmlspecialchars($maintain['phone']); ?></td>
                            <td><?= htmlspecialchars($maintain['email']); ?></td>
                            <td><?= htmlspecialchars($maintain['productType']); ?></td>
                            <td><?= htmlspecialchars($maintain['productModel']); ?></td>
                            <td><?= htmlspecialchars($maintain['machineNumber']); ?></td>
                            <td><?= htmlspecialchars($maintain['issueDescription']); ?></td>
                            <td><?= htmlspecialchars($maintain['status'] == 0 ? "รอการดำเนินการ":"ดำเนินการเรียบร้อย"); ?></td>
              
                            <td>
                                <?php if (!empty($maintain['images'])) : ?>
                                    <?php foreach ($maintain['images'] as $file_path) : ?>
                                        <?php
                                        $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                                        $video_extensions = ['mp4', 'webm', 'ogg']; // เพิ่มประเภทวีดีโอที่รองรับ
                                        ?>

                                        <?php if (in_array($file_extension, $video_extensions)) : ?>
                                            <video controls style="width: 100px; height: auto; margin-right: 5px;">
                                                <source src="<?= $file_path; ?>" type="video/<?= $file_extension; ?>">
                                                Your browser does not support the video tag.
                                            </video>
                                        <?php else : ?>
                                            <img src="<?= $file_path; ?>" alt="Image" style="width: 100px; height: auto; margin-right: 5px;" />
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </td>
                            <td class="" style="text-align: center;vertical-align: inherit;">
                                <ul class="" style="list-style: none; display: inline-flex; margin-bottom: 0rem; min-width: auto; padding-inline: 0px;">
                                    <li><a href="./admin_maintain_edit/<?php echo $maintain['id'];?>" class="btn btn-round btn-warning" style="font-size: 11px; padding: 4px 8px;" data-toggle="tooltip" title="แก้ไข"><i class="fa fa-wrench"></i></a></li>
                                    <li><button class="btn btn-round btn-danger" style="font-size: 11px; padding: 4px 8px;" data-toggle="tooltip" title="ลบข้อมูล" onclick="del_results('<?php echo $maintain['id'];?>')"><i class="fa fa-trash"></i></button></li>
                                </ul>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#ma_table').DataTable();
    });
</script>