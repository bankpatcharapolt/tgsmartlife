var base_url = $("input[name=base_url]").val();

function clearClass(form_id, cls){
    var elm = $(form_id).serializeArray();
    $.each(elm, function (i, val) {
        var element_input = $("input[name="+val.name+"]").is("input");//true or false
        if(element_input){
            $("input[name="+val.name+"]").removeClass(cls);
        }
        
        var element_select = $("select[name="+val.name+"]").is("select");
        if(element_select){
            $("select[name="+val.name+"]").parent().children('button').removeClass(cls);
        }
    });
}
function manageClassElm(selectName, cls, mode, elm_type){
    if(elm_type == 'input' && mode == 'add'){
        $("input[name="+selectName+"]").addClass(cls);
    }
    if(elm_type == 'input' && mode == 'remove'){
        $("input[name="+selectName+"]").removeClass(cls);
    }

    if(elm_type == 'select' && mode == 'add'){
        $("select[name="+selectName+"]").parent().children('button').addClass(cls);
    }
    if(elm_type == 'select' && mode == 'remove'){
        $("select[name="+selectName+"]").parent().children('button').removeClass(cls);

    }
}
function getTypeElm(elmName){
    var elm_type = 'input';
    var element_input = $("input[name="+elmName+"]").is("input");//true or false
    if(element_input){  elm_type = "input"; }
    
    var element_select = $("select[name="+elmName+"]").is("select");
    if(element_select){  elm_type = "select"; }

    return elm_type;
}
function elmChangeValid(elmName){
    var elmVale = $("input[name="+elmName+"]").val();
    var elm_type = getTypeElm(elmName);

    if((elmVale == '' || elmVale == null )){
        manageClassElm(elmName,"input-valid",'add', elm_type);
    }
    if((elmVale != '' || elmVale != null )){
        manageClassElm(elmName,"input-valid",'remove', elm_type);
    }

    /*if(elm_type == 'select' && (elmVale == '' || elmVale == null )){
        manageClassElm(elmName,"input-valid",'add', elm_type);
    }
    if(elm_type == 'select' && (elmVale != '' || elmVale != null )){
        manageClassElm(elmName,"input-valid",'remove', elm_type);
    }*/

}
//--------------- Addon Contract ----------------------//
function getResContract(contract_code, search){
    var res = null;
    $.ajax({
        url: base_url+"contractaddon/getResContract", //ทำงานกับไฟล์นี้
        data:  {
            'contract_code': contract_code
            },  //ส่งตัวแปร
        type: "POST",
        dataType: 'json',
        async:false,
        success: function(data, status) {
            res = data;
        },
        error: function(xhr, status, exception) { 
            console.log(exception);
        }
    });
    return res;
}
function getResContractAddon(addon_code, contract_code){
    var res = null;
    $.ajax({
        url: base_url+"contractaddon/getResContractAddon", //ทำงานกับไฟล์นี้
        data:  {
            'addon_code': addon_code,
            'contract_code':contract_code
            },  //ส่งตัวแปร
        type: "POST",
        dataType: 'json',
        async:false,
        success: function(data, status) {
            res = data;
        },
        error: function(xhr, status, exception) { 
            console.log(exception);
        }
    });
    return res;
}
function getResProduct(contract_code, product_id){
    var res = null;
    $.ajax({
        url: base_url+"contractaddon/getResProduct", //ทำงานกับไฟล์นี้
        data:  {
            'contract_code': contract_code
            ,'product_id': product_id
            },  //ส่งตัวแปร
        type: "POST",
        dataType: 'json',
        async:false,
        success: function(data, status) {
            res = data;
        },
        error: function(xhr, status, exception) { 
            console.log(exception);
        }
    });
    return res;
}
function setOptionsProduct(resultProducts, product_id){
    var options = "<option value='' disabled>เลือกสินค้า</option>";
    $.each(resultProducts, function(key, value) {
        if((value.product_id == product_id)){
            options += "<option value='"+value.product_id+"' selected>"+value.product_name+"</option>";
        }else{
            options += "<option value='"+value.product_id+"' >"+value.product_name+"</option>";
        }
    });
    return options;
}
function setTableAddon(contractaddon){
    var table = '';
    table += '<div class="row"><div class="col-md-12"><h6>ตาราง ส่วนเสริมสัญญา</h6></div></div>';
    table += '<div class="table-responsive">';
    table += '<table id="contract-table" class="table table-striped jambo_table bulk_action">';
    table += '<thead>';
    table += '<tr class="headings">';
    table += '<th class="column-title">ลำดับ</th>';
    table += '<th class="column-title">รหัสส่วนเสริม </th>';
    table += '<th class="column-title">สินค้า </th>';
    table += '<th class="column-title">จำนวนงวด/เดือน</th>';
    table += '<th class="column-title">ผ่อนต่องวด/เดือน</th>';
    table += '<th class="column-title">เริ่มชำระงวดแรก</th>';
    //table += '<th class="column-title"></th>';
    table += '<th class="column-title"></th>';
    table += '</tr>';
    table += '</thead>';
    table += '<tbody>';
    $.each(contractaddon, function( index, value ) {
        var jsonRes = JSON.stringify(value);
        var rows = index+1;
        table += '<tr>';
        table += '<td style="width:5%;">'+rows+'</td>';
        table += '<td style="width:10%;">'+value.addon_code+'</td>';
        table += '<td style="width:20%;">'+value.product_name+'</td>';
        table += '<td style="width:10%;">'+value.rental_period+'</td>';
        table += '<td style="width:10%;">'+value.monthly_rent+'</td>';
        table += '<td style="width:10%;">'+value.payment_start_date+'</td>';
        //table += '<td style="width:5%;text-align: center;">';
        //table += "<button type='button' class='btn btn-round btn-success AddonContract-btn' data-toggle='modal'   style='font-size: 13px;border-radius: 1%; margin-bottom: inherit;'><i class='fa fa-plus'></i> สินค้า</button>";
        //table += '</td>';
        table += '<td style="width:15%;text-align: center;">';
        table += "<button type='button' class='btn btn-round btn-success addonProduct-btn' data-toggle='modal'   style='font-size: 13px;border-radius: 50%; margin-bottom: inherit;' contract-code='"+value.contract_code+"' contract-addon='"+value.addon_code+"' title='เพิ่มสินค่า'><i class='fa fa-plus'></i></button>";
        
        table += '<a href="'+base_url+'admin/AddonInstallments/'+value.contract_code+'/'+value.addon_code+'" style="padding: 0;" title="การผ่อนชำระ">';
        table += '<button type="button" class="btn btn-info" style="font-size: 13px;border-radius: 50%; margin-bottom: inherit;"><i class="fa fa-money"></i></button>';
        table += '</a>';

        table += "<button type='button' class='btn btn-round btn-danger delAddonContractbtn' style='font-size: 13px;border-radius: 50%; margin-bottom: inherit;'  data-attr='"+jsonRes+"' title='ลบสัญญา'><i class='fa fa-times'></i></button>";
        
        var jsonContractPDF = "{'url':'"+base_url+"admin/contractAddon/contractPDF/', 'id':'"+value.contract_code+"', 'addon_code':'"+value.addon_code+"'}";
        table += '<button type="button" onclick="contractPDF_fn('+jsonContractPDF+')" class="btn btn-round btn-dark" style="font-size: 13px;border-radius: 50%; margin-bottom: inherit;"  data-toggle="tooltip" title="เอกสารสัญญา"><i class="fa fa-print"></i></button>';
                        
        table += '</td>';
        table += '</tr>';
    });
    table += '</tbody>';
    table += '</table>';
    table += '</div>';
    table += '<hr>';
    return new Array(contractaddon.length, table);
}
function clearClassElmChange(form_id, cls){
    var elm = $(form_id).serializeArray();
    $.each(elm, function (i, val) {
        $("input[name="+val.name+"]").removeClass(cls);
    });
}
function DelAddonPContract(data){
    //var res = null;
    $.ajax({
        url: base_url+"contractaddon/delPcontract", //ทำงานกับไฟล์นี้
        data:  {
            'data': data
            },  //ส่งตัวแปร
        type: "POST",
        //dataType: 'json',
        async:false,
        success: function(data, status) {
            location.reload();
        },
        error: function(xhr, status, exception) { 
            console.log(exception);
        }
    });
    //return res;
}
function DelAddonContract(){
    $(".delAddonContractbtn").click(function(){
        var confirms = confirm("ต้องการที่จะลบสัญญานี้ จริงหรือไม่!");
        if (confirms) {
            var res = DelAddonPContract($(this).attr('data-attr'));
            if(res){
                $('#AddonContract-modal').modal('hide');
            }
            $('#AddonContract-modal').modal('hide');
        }
    });
}
function contractPDF_fn(param){
    $('#contractMode .modal-footer #coppy-pdf').attr('href',param.url+'coppy/'+param.id+'/'+param.addon_code);
    $('#contractMode .modal-footer #origin-pdf').attr('href',param.url+'origin/'+param.id+'/'+param.addon_code);
    $('#contractMode').modal();
}


clearClassElmChange('#AddonContract-form', "input-valid");
$('#AddonContract-btn').click(function(){
    clearClass('#AddonContract-form', "input-valid"); //clear required
    var contract_code = $("input[name=contract_code]").val();
    var contract = getResContract(contract_code);
    $("#addonmonthly_rent").val(contract[0].monthly_rent);
    $("#addonrental_period").val(contract[0].rental_period);
    
    var currentDate = new Date();
    //currentDate.setYear(currentDate.getFullYear() + 543);
    $("#addon-payment-start-date").datepicker("setDate",currentDate );

    //--- contract addon table ---//
    var contractaddon = getResContractAddon(null, contract_code);
    var table = setTableAddon(contractaddon);
    $('#contract-addon-place').html(null);
    if(table[0] > 0){
        $('#contract-addon-place').append(table[1]);
    }

    //--- product select option ---//
    var product_id = $("#addon-contract-products").attr('data-product');
    var product = getResProduct(null, null);
    $('#addon-contract-products').html('');
    var productsOptions = setOptionsProduct(product, product_id);
    $('#addon-contract-products').append(productsOptions);
    $('#addon-contract-products').selectpicker('refresh'); 

    DelAddonContract(); // del addon contract

    $('#AddonContract-modal').modal();
});
$('#addon-contract-products').change(function() {
    clearClass('#AddonContract-form', "input-valid"); //clear required
    var contract_code = $("input[name=contract_code]").val();
    var select_product_id = $(this).find(':selected').val();
    var product_id = $('#addon-contract-products').attr('data-product');
    //var product = getResProduct(null, select_product_id);
    if(select_product_id == product_id){
        var contract = getResContract(contract_code);
        $("#addonmonthly_rent").val(contract[0].monthly_rent);
        $("#addonrental_period").val(contract[0].rental_period);
    }else{
        $("#addonmonthly_rent").val(null);
        $("#addonrental_period").val(null);
    }
});
$('#AddonContract-form').submit(function() {
    var elm = $(this).serializeArray();
    var valids  = 0;
    $.each(elm, function (i, val) {
        if(val.value == '' || val.value == null ){
            $("input[name="+val.name+"]").addClass("input-valid");
            valids++;
            return false;
        }else{
            $("input[name="+val.name+"]").removeClass("input-valid");
        }
    });
    if(valids == 0){
        return true;
    }else{
        return false;
    }
});


//-------------- Addon Product -----------------------//
function getResProductCate(contract_code){
    var res = null;
    $.ajax({
        url: base_url+"contractaddon/getResPcate", //ทำงานกับไฟล์นี้
        data:  {
            'contract_code': contract_code
            },  //ส่งตัวแปร
        type: "POST",
        dataType: 'json',
        async:false,
        success: function(data, status) {
            res = data;
        },
        error: function(xhr, status, exception) { 
            console.log(exception);
        }
    });
    return res;
}
function getResContractAddonProduct(addon_product, contract_code){
    var res = null;
    $.ajax({
        url: base_url+"contractaddon/contractAddonProduct", //ทำงานกับไฟล์นี้
        data:  {
            'addon_product': addon_product,
            'contract_code':contract_code
            },  //ส่งตัวแปร
        type: "POST",
        dataType: 'json',
        async:false,
        success: function(data, status) {
            res = data;
        },
        error: function(xhr, status, exception) { 
            console.log(exception);
        }
    });
    return res;
}
function getResProductMaster(productCate){
    var res = [];
    if((productCate != "" && productCate != null )){
        $.ajax({
            url: base_url+"contractaddon/getResPmaster", //ทำงานกับไฟล์นี้
            data:  {
                'productCate': productCate
                },  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                res = data;
            },
            error: function(xhr, status, exception) { 
                console.log(exception);
            }
        });
    }
    return res;
}
function getResStatus(statusCate){
    var res = null;
    $.ajax({
        url: base_url+"contractaddon/getStatus", //ทำงานกับไฟล์นี้
        data:  {
            'statusCate': statusCate
            },  //ส่งตัวแปร
        type: "POST",
        dataType: 'json',
        async:false,
        success: function(data, status) {
            res = data;
        },
        error: function(xhr, status, exception) { 
            console.log(exception);
        }
    });
    return res;
}
function setOptionsProductStatus(result){
    var options = "<option value ='' selected>เลือก ประเภทสินค้า</option>";
    $.each(result, function(key, value) {
        //value.status_code = 0 คือสินค้าหลัก
        if(value.status_code != 0){
            options += "<option value='"+value.id+"'>"+value.label+"</option>";
        }
    });
    return options;
}
function setOptionsProductCate(result){
    var options = "<option value ='' selected>เลือก หมวดหมู่สินค้า</option>";
    $.each(result, function(key, value) {
        options += "<option value='"+value.cate_id+"'>"+value.cate_name+"</option>";
    });
    return options;
}
function setOptionsProductMaster(result){
    var options = "<option value=''>เลือก สินค้า</option>";
    $.each(result, function(key, value) {
        options += "<option value='"+value.product_master_id+"'>"+value.product_master_name+"</option>";
    });
    return options;
}
function setTableAddonProduct(productsAddon){
    var table = '';
    table += '<div class="row"><div class="col-md-12"><h6>ตาราง ส่วนเสริมสินค้า</h6></div></div>';
    table += '<div class="table-responsive">';
    table += '<table id="contract-table" class="table table-striped jambo_table bulk_action">';
    table += '<thead>';
    table += '<tr class="headings">';
    table += '<th class="column-title">ลำดับ</th>';
    table += '<th class="column-title">ID ส่วนเสริมสินค้า</th>';
    table += '<th class="column-title">สินค้า </th>';
    table += '<th class="column-title">หมายเลขเครื่อง </th>';
    table += '<th class="column-title">ประเภท</th>';
    table += '<th class="column-title">จำนวน</th>';
    table += '<th class="column-title"></th>';
    table += '</tr>';
    table += '</thead>';
    table += '<tbody>';
    $.each(productsAddon, function( index, value ) {
        var jsonRes = JSON.stringify(value);
        var rows = index+1;
        var active_serial = (value.active_serial)? 'มี': 'ไม่มี';
        table += '<tr>';
        table += '<td style="width:5%;">'+rows+'</td>';
        table += '<td style="width:15%;">'+value.product_addon_code+'</td>';
        table += '<td style="width:40%;">'+value.product_master_name+'</td>';
        table += '<td style="width:15%;">'+active_serial+'</td>';
        table += '<td style="width:15%;">'+value.status_name+'</td>';
        table += '<td style="width:5%;">'+value.count+'</td>';
        table += '<td style="width:5%;text-align: center;">';
        //table += "<button id='editAddonProductbtn' type='button' class='btn btn-round btn-warning' style='font-size: 13px; padding: 0 8%; margin-bottom: inherit;'  data-attr='"+jsonRes+"' ><i class='fa fa-wrench'></i></button>";
        table += "<button type='button' class='btn btn-round btn-danger delAddonProductbtn' style='font-size: inherit; border-radius: 50%;padding: 0 30%; margin-bottom: inherit;'  data-attr='"+jsonRes+"' ><i class='fa fa-times'></i></button>";
        table += '</td>';
        table += '</tr>';
    });
    table += '</tbody>';
    table += '</table>';
    table += '</div>';
    table += '<hr>';
    return new Array(productsAddon.length, table);
}
function DelAddonPMaster(data){
    //var res = null;
    $.ajax({
        url: base_url+"contractaddon/delPmaster", //ทำงานกับไฟล์นี้
        data:  {
            'data': data,
            },  //ส่งตัวแปร
        type: "POST",
        dataType: 'json',
        async:false,
        success: function(data, status) {
            //res = data;
        },
        error: function(xhr, status, exception) { 
            console.log(exception);
        }
    });
    //return res;
}
function DelAddonProduct(){
    $(".delAddonProductbtn").click(function(){
        var confirms = confirm("ต้องการที่จะลบสินค้านี้ จริงหรือไม่!");
        if (confirms) {
            DelAddonPMaster($(this).attr('data-attr'));
            $('#AddonProduct-modal').modal('hide');
        }
    });
}
function AddAddonProduct(){
    $('.addonProduct-btn').click(function(){
        //clearClass('#AddonProduct-form', "input-valid"); //clear required
        var contract_code = $(this).attr('contract-code');
        var contract_addon = $(this).attr('contract-addon');
    
         console.log(contract_code);
        
        //--- contract addon table ---//
        //var productaddon = getResContractAddonProduct(null, contract_addon);
        var productaddon = getResContractAddonProduct(null, contract_addon,);
        console.log(productaddon);
        var table = setTableAddonProduct(productaddon);
        $('#products-addon-place').html(null);
        if(table[0] > 0){
            $('#products-addon-place').append(table[1]);
        }
    
        //--- Product Cateegory to combo  ---//
        var productCate = getResProductCate();
        $('#addon-pcate').html('');
        var pCateOptions = setOptionsProductCate(productCate);
        $('#addon-pcate').append(pCateOptions);
        $('#addon-pcate').selectpicker('refresh'); 
    
        //--- product master to select option ---//
        $('#addon-pmaster').html('');
        $('#addon-pmaster').append("<option value=''>เลือก สินค้า</option>");
        $('#addon-pmaster').selectpicker('refresh');
    
        //--- Product status  ---//
        var productStatus = getResStatus(211004); //211004 = ประเภทสินค้า
        $('#addon-pstatus').html('');
        var pStatusOptions = setOptionsProductStatus(productStatus);
        $('#addon-pstatus').append(pStatusOptions);
        $('#addon-pstatus').selectpicker('refresh'); 
    
        
        DelAddonProduct(); // del product addon
        $('#contract_addon').val(contract_addon); 
        $('#AddonProduct-modal').modal();
    });
}

clearClassElmChange('#AddonProduct-form', "input-valid");
$('#AddonProduct-btn').click(function(){
    clearClass('#AddonProduct-form', "input-valid"); //clear required
    var contract_code = $("input[name=contract_code]").val();

    //--- contract addon table ---//
    var productaddon = getResContractAddonProduct(null, contract_code);
    var table = setTableAddonProduct(productaddon);
    $('#products-addon-place').html(null);
    if(table[0] > 0){
        $('#products-addon-place').append(table[1]);
    }

    //--- Product Cateegory to combo  ---//
    var productCate = getResProductCate();
    $('#addon-pcate').html('');
    var pCateOptions = setOptionsProductCate(productCate);
    $('#addon-pcate').append(pCateOptions);
    $('#addon-pcate').selectpicker('refresh'); 

    //--- product master to select option ---//
    $('#addon-pmaster').html('');
    $('#addon-pmaster').append("<option value=''>เลือก สินค้า</option>");
    $('#addon-pmaster').selectpicker('refresh');

    //--- Product status  ---//
    var productStatus = getResStatus(211004); //211004 = ประเภทสินค้า
    $('#addon-pstatus').html('');
    var pStatusOptions = setOptionsProductStatus(productStatus);
    $('#addon-pstatus').append(pStatusOptions);
    $('#addon-pstatus').selectpicker('refresh'); 

    
    DelAddonProduct(); // del product addon

    $('#AddonProduct-modal').modal();
});
$('#addon-pcate').change(function() {
    clearClass('#AddonProduct-form', "input-valid"); //clear required
    manageClassElm($(this).attr("name"),"input-valid",'remove','select');
    elmChangeValid($(this).attr("name"));
    //var contract_code = $("input[name=contract_code]").val();

    //--- product master to select option ---//
    var select_product_cate = $(this).find(':selected').val();
    var pmaster = getResProductMaster(select_product_cate);
    if(pmaster.length > 0){
        manageClassElm($('#addon-pmaster').attr("name"),"input-valid",'remove','select');
        var toOptions = setOptionsProductMaster(pmaster);
        $('#addon-pmaster').html('');
        $('#addon-pmaster').append(toOptions);
        $('#addon-pmaster').selectpicker('refresh');
    }else{
        $('#addon-pmaster').html('');
        $('#addon-pmaster').append("<option value=''>เลือก สินค้า</option>");
        $('#addon-pmaster').selectpicker('refresh');
    }
});
$('#addon-pmaster').change(function() {
    var select_product_master = $(this).find(':selected').val();
    if(select_product_master != '' && select_product_master != null){
        elmChangeValid($(this).attr("name"));
    }
});
$('#addon-pstatus').change(function() {
    var select_product_master = $(this).find(':selected').val();
    if(select_product_master != '' && select_product_master != null){
        elmChangeValid($(this).attr("name"));
    }
});
$('#addon-pcount').change(function() {
    var pcountVal = $(this).val();
    if(pcountVal != '' && pcountVal != null){
        elmChangeValid($(this).attr("name"));
    }
});
$('#AddonProduct-form').submit(function() {
    var elm = $(this).serializeArray();
    var valids  = 0;
    $.each(elm, function (i, val) {
        var elm_type = getTypeElm(val.name);
        if(val.value == '' || val.value == null ){
            manageClassElm(val.name,"input-valid",'add', elm_type);
            valids++;
            return false;
        }else{
            manageClassElm(val.name,"input-valid",'remove', elm_type);
        }
    });
    if(valids == 0){
        return true;
    }else{
        return false;
    }
});


//-------------- Addon Serial -----------------------//

function setTableEditSerial(res){
    var table = '';
    //table += '<div class="row"><div class="col-md-12"><h6>ตาราง ส่วนเสริมสินค้า</h6></div></div>';
    table += '<div class="table-responsive">';
    table += '<table class="table table-striped jambo_table bulk_action">';
    table += '<thead>';
    table += '<tr class="headings">';
    table += '<th class="column-title">ลำดับ</th>';
    table += '<th class="column-title">Serial number</th>';
    table += '<th class="column-title">หมายเหตุ</th>';
    table += '<th class="column-title"></th>';
    table += '</tr>';
    table += '</thead>';
    table += '<tbody>';
    $.each(res, function( index, value ) {
        var jsonRes = JSON.stringify(value);
        var serils = (value.serial_number == null)?'':value.serial_number;
        var remarks = (value.remark == null)?'':value.remark;
        var rows = index+1;
        table += '<tr>';
        table += '<td style="width:5%;text-align: center;">'+rows+'</td>';
        table += '<td style="width:20%;"><input id="serial'+value.id+'" name="serial'+value.id+'" type="text" class="form-control serials-res" placeholder="..." value="'+serils+'"></td>';
        table += '<td style="width:40%;"><input id="remark'+value.id+'" name="remark'+value.id+'" type="text" class="form-control remark-res" placeholder="..." value="'+remarks+'"></td>';
        table += '<td style="width:5%;text-align: center;">';
        //table += "<button id='editAddonProductbtn' type='button' class='btn btn-round btn-warning' style='font-size: 13px; padding: 0 8%; margin-bottom: inherit;'  data-attr='"+jsonRes+"' ><i class='fa fa-wrench'></i></button>";
        table += "<button type='button' class='btn btn-round btn-info update-serial-btn' style='font-size: inherit; border-radius: 50%;width: 2rem;height: 2rem; margin-bottom: inherit;'  data-attr='"+jsonRes+"' ><i class='fa fa-save'></i></button>";
        table += '</td>';
        table += '</tr>';
    });
    table += '</tbody>';
    table += '</table>';
    table += '</div>';
    table += '<hr>';
    //return new Array(productsAddon.length, table);
    return table;
}
function getResSerials(contract_code, datas){
    var res = null;
    $.ajax({
        url: base_url+"contractaddon/getResSerials", //ทำงานกับไฟล์นี้
        data:  {
            'contract_code': contract_code,
            'data': datas
            },  //ส่งตัวแปร
        type: "POST",
        dataType: 'json',
        async:false,
        success: function(data, status) {
            res = data;
        },
        error: function(xhr, status, exception) { 
            console.log(exception);
        }
    });
    return res;
   
}
function UpdateSerialNumber(result, serials_res, remark_res){
    var res = null;
    $.ajax({
        url: base_url+"contractaddon/UpdateSerials", //ทำงานกับไฟล์นี้
        data:  {
            'result': result,
            'serial': serials_res,
            'remark': remark_res
            },  //ส่งตัวแปร
        type: "POST",
        dataType: 'json',
        async:false,
        success: function(data, status) {
            if(data){
                $('#EditSerial-modal').modal('hide');
            }
            res = data;
        },
        error: function(xhr, status, exception) { 
            console.log(exception);
        }
    });
    return res;
   
}
function UpdateSerials(getRes){
    $('.update-serial-btn').click(function(){
        var resArr = JSON.parse($(this).attr('data-attr'));
        var res = $(this).attr('data-attr');
        var serials_res =  $('#serial'+resArr.id).val();
        var remark_res = $('#remark'+resArr.id).val();
        
        var updates = UpdateSerialNumber(res, serials_res, remark_res);
    });
}
$('.serial-edt-btn').click(function(){
    var contract_code = $(this).attr('data-contractCode');
    var res = $(this).attr('data-attr');
    //--- contract addon table ---//
    var getRes = getResSerials(contract_code, res);
    var table = setTableEditSerial(getRes);

    $('#serial-place').html(null);
    $('#serial-place').append(table);

    // fution update update serial
    UpdateSerials(getRes);
    $('#EditSerial-modal').modal();
});


