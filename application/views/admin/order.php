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
            <h2>ตรวจสอบสถานะ</h2>
            <input name="base_url" value="<?= base_url(); ?>" type="hidden">

            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <div class="table-responsive">
                <table id="table" class="table table-striped jambo_table bulk_action sorted_table" style="width:100%; border-spacing: 1px !important;">
                    <thead>
                        <tr class="headings">
                            <th class="column-title" style="width: 1%;">ลำดับ</th>
                            <th class="column-title" style="width: 11%;">เลขที่คำสั่งซื้อ</th>
                            <th class="column-title" style="width: 2%;"></th>
                            <th class="column-title" style="width: 11%;">สินค้า</th>
                            <th class="column-title" style="width: 10%;">วันเวลาที่สั่งซื้อ</th>
                            <th class="column-title" style="width: 10%;">ยอดรวม</th>
                            <th class="column-title" style="width: 10%;">สถานะ</th>
                            <th class="column-title no-link last" style="text-align: center;width: 2%;"></th>
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

    function delOrder(order_id) {
        // alert(order_id);
        if (confirm("คุณต้องการที่จะลบรายการคำสั่งซื้อนี้หรือไม่ ")) {
            var res = null;
            $.ajax({
                url: base_url + '/admin/Order/del_order', //ทำงานกับไฟล์นี้
                data: {
                    "order_id": order_id
                }, //ส่งตัวแปร
                type: "POST",
                dataType: 'json',
                async: false,
                success: function(data, status) {
                    var res = data;
                

                    if (res.status == true) {
                        window.location.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: '<span style="font-weight:bold;">ลบข้อมูลไม่สำเร็จ</span>',
                            html: "ลบข้อมูลไม่สำเร็จ กรุณาติดต่อผู้ดูแลระบบ"
                        });
                    }
                },
                error: function(xhr, status, exception) {
                    //console.log(xhr);
                }
            });
            // return res;
        }

    }

    function drawtable(base_url) {
        var results = get_results(base_url);
        console.log(results.datas);
        if (results.datas.length > 0) {
            var tr = '';

            $.each(results.datas, function(key, val) {
                console.log(val);
                var no = key + 1;
                tr += '<tr class="even pointer" sort-id="' + val.order_id + '">';
                tr += '<td class="a-center " style="vertical-align: inherit;">' + no + '</td>';



                var imgs = base_url + val.thumnal + '?random=' + Math.random();
                tr += '<td style="vertical-align: inherit;">' + val.order_id + '</td>';
                tr += '<td style="vertical-align: inherit;padding: .2rem;"> <img class="thumnails-premise img-add" src="' + imgs + '" alt="image" style="border: unset; width: 100%;" /></td>';
                tr += '<td>' + val.productList + '</td>';
                tr += '<td>' + val.created + '</td>';

                let totalwithShip = numberWithCommas(val.total_amount_with_shipping_cost);
                tr += '<td>' + totalwithShip + '</td>';


                let getStatus = getStatusInfo(val.status);
                var status = getStatus.statusText;
                var colorBadge = getStatus.colorBadge;
                var orderId = val.order_id;
               
                tr += '<td style="vertical-align: inherit; text-align: center;color:' + colorBadge + '">' + status + '</td>';
                tr += '<td class="" style="text-align: center;vertical-align: inherit;">';
                tr += '<ul class="" style="list-style: none; display: inline-flex; margin-bottom: 0rem; min-width: auto; padding-inline: 0px;">';
                tr += '<li><a href="' + base_url + 'admin/order/view/' + val.order_id + '" class="btn btn-primary" style="font-size: 11px; padding: 4px 8px;background-color:#005EB8;color:#FFF;" data-toggle="tooltip" title="ดูข้อมูล">ดูข้อมูล</a></li>';
                tr += '<li><button class="btn btn-danger" style="font-size: 11px; padding: 4px 8px;" data-toggle="tooltip" title="ลบคำสั่งซื้อ" onclick="delOrder(\'' + orderId + '\')">ลบ</button></li>';

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

    function numberWithCommas(number) {
        // แปลงตัวแปร number เป็นสตริงและใส่ comma คั่นหลักพัน
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }


    function getStatusInfo(status) {
        let statusText = "";
        let colorBadge = "";

        switch (status) {
            case '0':
                statusText = "รอชำระเงิน";
                colorBadge = "#DC3545";
                break;
            case '1':
                statusText = "ที่ต้องจัดส่ง";
                colorBadge = "#FF902B";
                break;
            case '2':
                statusText = "จัดส่งแล้ว";
                colorBadge = "#0DA45F";
                break;
            default:
                statusText = "สถานะไม่ทราบ";
                colorBadge = "#6C757D"; // เพิ่มสีเทาหรือสีอื่นที่ต้องการสำหรับสถานะที่ไม่ได้กำหนด
                break;
        }

        return {
            statusText,
            colorBadge
        };
    }

    function get_results(base_url) {
        var res = null;
        $.ajax({
            url: base_url + 'admin/Order/get_order', //ทำงานกับไฟล์นี้
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


    //#### sort table rows ###//
    $(".sorted_table").sortable({
        containerSelector: 'table',
        itemPath: '> tbody',
        itemSelector: 'tr',
        placeholder: '<tr class="placeholder"/>',
        cursor: "move",
        onDrop: function($item, container, _super) {
            $item.closest('table').find('tbody tr').each(function(i, row) {
                var sort_id = $(row).attr("sort-id");
                update_table_sort(base_url, sort_id, i);

            });
            var $clonedItem = $('<tr/>').css({
                height: 0
            });
            $item.before($clonedItem);
            $clonedItem.animate({
                'height': $item.height()
            });

            $item.animate($clonedItem.position(), function() {
                $clonedItem.detach();
                _super($item, container);
            });

            $('#table').DataTable().destroy();
            drawtable(base_url);
        }
    });

    function update_table_sort(base_url, id, sortable) {
        var res = null;
        $.ajax({
            url: base_url + 'admin/Product/update_product_sorting', //ทำงานกับไฟล์นี้
            data: {
                'id': id,
                'sortable': sortable,
            }, //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async: false,
            success: function(data, status) {},
            error: function(xhr, status, exception) {}
        });
        // return res;
    }
</script>