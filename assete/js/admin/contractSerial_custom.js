$('.serial-edit-btn').click(function(){
    const data = JSON.parse($(this).attr('attr-data'));
    $('#serial-products').html('');
    $('#serial-products').append(data.product_master_name);
    $('#serial-products-type').html('');
    $('#serial-products-type').append(data.label);

    $('#serial-number').val(data.serial_number);
    $('#serial-remark').val(data.remark);
    $('#serial_product_id').val(data.product_id);
    $('#serial_id').val(data.id);
    $('#product_sub_id').val(data.product_sub_id);
    $('#product_no').val(data.no);

    $('#SerialEdit-modal').modal();
});