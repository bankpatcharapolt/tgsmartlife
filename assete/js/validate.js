  
    function getProvince(province_id, url){
        var res = null;
        if( province_id != null  && province_id != "" ){
            $.ajax({
                url: url, //ทำงานกับไฟล์นี้
                data: "province_id=" + province_id,  //ส่งตัวแปร
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
    function getAmphure(province_id, url){
        var res = null;
        if( province_id != null  && province_id != "" ){
            $.ajax({
                url: url, //ทำงานกับไฟล์นี้
                data: "province_cod=" + province_id,  //ส่งตัวแปร
                type: "POST",
                dataType: 'json',
                async:false,
                success: function(data, status) {
                    res = data;
                },
                error: function(xhr, status, exception) { 
                    //console.log(status);
                }
            });
        }
        return res;
    }
    function getDistrict(amphue_id, url){
        var res = null;
        if( amphue_id != null  && amphue_id != "" ){
            $.ajax({
                url: url, //ทำงานกับไฟล์นี้
                data: "amphue_cod=" + amphue_id,  //ส่งตัวแปร
                type: "POST",
                dataType: 'json',
                async:false,
                success: function(data, status) {
                    res = data;
                },
                error: function(xhr, status, exception) { 
                    //console.log(status);
                }
            });
        }
        return res;
    }
    function getZipcode(province,amphue,district, url){
        var res = null;
        $.ajax({
            url: url, //ทำงานกับไฟล์นี้
            data: {
                "province" : province,
                "amphue" : amphue,
                "district":  district
            },  //ส่งตัวแปร
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
    function getCustomerByIdcard(id, url){
        var res = null;
        $.ajax({
            url: url, //ทำงานกับไฟล์นี้
            data: {
                "idcard" : id
            },  //ส่งตัวแปร
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


    function replaceProvince(province_id, url, elm){
        var res_province = getProvince(province_id, url);
        $(elm).html(null);
        var select = "<option value='' selected='false' disabled>จังหวัด</option>";
        $.each(res_province,function(index,json){
            select +="<option value="+json.id+">"+json.province_name+"</option>";
        });
        $(elm).append(select);
    }
    function replaceAmphure(province, url, amphure, district,zipcode){
        var res_amphure = getAmphure(province, url);
        $(amphure).html(null);
        $(district).html(null);
        var select = "<option value='' selected='false' disabled>อำเภอ / เขต</option>";
        $.each(res_amphure,function(index,json){
            select +="<option value="+json.id+">"+json.amphur_name+"</option>";
        });
        $(amphure).append(select);
        $(district).append("<option value='' selected='false' disabled >ตำบล / แขวง</option>");
        $(zipcode).val(null);
    }
    function replaceDistrict(amphue_id, url, district, zipcode){
        var res_district = getDistrict(amphue_id, url);
        $(district).html(null);
        var select = "<option value='' selected='false' disabled >ตำบล / แขวง</option>";
        $.each(res_district,function(index,json){
            select +="<option value="+json.id+">"+json.district_name+"</option>";
        });
        $(district).append(select);
        $(zipcode).val(null);
    }
    function replaceZipcode(province,amphue,district, url, zipcode){
        var res_zipcode = getZipcode(province,amphue,district, url);
    
        var select;
        $(zipcode).append(select);
        $.each(res_zipcode,function(index,json){
            select = json.zipcode
        });
        $(zipcode).val(select);
    }

    //##################### Customer #########################// 
    function getCustomerRes(resObj, searchEle, pageObj){
        var searchJson = SearchJson(searchEle);
        $(resObj["elementTable"]).html(null);
        var res = null;
        $.ajax({
            url: resObj["getRes"], //ทำงานกับไฟล์นี้
            data: { 'Search':searchJson, 'itemStt':pageObj['itemStt'], 'itemEnd':pageObj['itemEnd']},  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                var tr = null;
                if(data.length > 0){
                    var num = 1;
                    $.each(data, function (i, val) {
                        tr += '<tr class=" ">';
                        tr += '<td class=" ">'+val['RowNum']+'</td>';
                        tr += '<td class=" ">'+val['customer_code']+'</td>';
                        tr += '<td class=" ">'+val['firstname']+' '+val['lastname']+'</td>';
                        tr += '<td class=" ">'+val['address']+'</td>';
                        tr += '<td class=" ">'+val['idcard']+'</td>';
                        tr += '<td class=" ">'+val['tel']+'</td>';
                        tr += '<td class=" last"  style="text-align: center;">';
                        tr +=     '<button type="button" class="btn btn-round" style="background-color: '+val['background_color']+'; color: '+val['color']+'; font-size: 13px; padding: 0 15px; margin-bottom: inherit;margin-right: inherit;"> '+val['label']+'</button>';
                        tr += '</td>';
                        tr += '<td class=" last"  style="text-align: center;">';
                        tr +=   '<a href="'+base_url+'admin/customer/edit/'+val['customer_code']+' " data-toggle="tooltip" title="แก้ไข">';
                        tr +=       '<button type="button" class="btn btn-round btn-warning" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-wrench"></i></button>';
                        tr +=   '</a>';
                        tr +=   '<a href="'+base_url+'admin/customer/detail/'+val['customer_code']+' " data-toggle="tooltip" title="รายละเอียด">';
                        tr +=       '<button type="button" class="btn btn-round btn-info" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-file-text-o"></i></button>';
                        tr +=   '</a>';
                        tr +=   '<a href="'+base_url+'admin/customer/premise/'+val['customer_code']+' " data-toggle="tooltip" title="หลักฐาน">';
                        tr +=       '<button type="button" class="btn btn-round btn-success" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-file-image-o"></i></button>';
                        tr +=   '</a>';
                        tr += '</td>';
                        tr += '</tr>';
                        num++;
                    });
                }
                $(resObj["elementTable"]).append(tr);
                
            },
            error: function(xhr, status, exception) { 
                //console.log(xhr);
            }
        });
    }

    // Create view
    //replace ที่อยู่
    function rePlaceAddEle(currentAddId, base_url){
        $.each(currentAddId, function (i, val) {
            var eles  = val.split("-");
            switch(eles[0]){
                case '#province':
                    $(val).change(function(){
                        $(val).removeClass("input-valid");
                        var url = base_url+"admin/customer/getamphoe";
                        var amphue = $(currentAddId[1]).selector;
                        var district = $(currentAddId[2]).selector;
                        var zipcode = $(currentAddId[3]).selector; // 
                        replaceAmphure($(val).val(), url, amphue, district, zipcode);
                    });
                break;
                case '#amphurs':
                    $(val).change(function(){
                        $(val).removeClass("input-valid");
                        var url = base_url+"admin/customer/getdistric";
                        var district = $(currentAddId[2]).selector;
                        var zipcode = $(currentAddId[3]).selector; // 
                        replaceDistrict($(val).val(), url, district, zipcode);
                    });
                break;
                case '#district':
                    $(val).change(function(){ 
                        $(val).removeClass("input-valid");

                        var province = $(currentAddId[0]).val();
                        var amphue = $(currentAddId[1]).val();
                        var district = $(currentAddId[2]).val();
                        var url = base_url+"admin/customer/getzipcode";
                        var zipcode = $(currentAddId[3]).selector; // 
                        replaceZipcode(province,amphue,district, url, zipcode);
                    });
                break;
            }
        });
    }
   
    //replace ที่อยู่ปัจจุบัน by ทีอยู่ตามบัตรประาชน
    function rePlaceAdd(addOfId, base_url, AddById, currentAddId){
        $(addOfId).change(function () {
            var c = 0;
            var addOfIdBtn = $(addOfId).prop('checked');
            //var address = $('#address').val();
            if(addOfIdBtn){
                var address = $(AddById[4]).val();      //if(address == ''){ (c==5)?c=c:c++;}else{ (c==0)?c=c:c--; }
                var province = $(AddById[0]).val();    //if(province == '' || province == null){ (c==5)?c=c:c++;  }else{ (c==0)?c=c:c--; }
                var amphurs = $(AddById[1]).val();      //if(amphurs == ''  || amphurs == null){  (c==5)?c=c:c++; }else{ (c==0)?c=c:c--; }
                var district = $(AddById[2]).val();    //if(district == '' || district == null){  (c==5)?c=c:c++; }else{ (c==0)?c=c:c--; }
                var zipcode = $(AddById[3]).val();      //if(zipcode == ''  || amphurs == null){  (c==5)?c=c:c++; }else{ (c==0)?c=c:c--; }
                
                var replaceAmphureurl = base_url+"admin/customer/getamphoe";
                replaceAmphure(province, replaceAmphureurl, $(currentAddId[1]).selector);

                var replaceDistricturl = base_url+"admin/customer/getdistric";
                replaceDistrict(amphurs, replaceDistricturl, $(currentAddId[2]).selector);

                $(currentAddId[4]).val(address); $(currentAddId[4]).removeClass("input-valid");
                $(currentAddId[0]).val(province); $(currentAddId[0]).removeClass("input-valid");
                $(currentAddId[1]).val(amphurs); $(currentAddId[1]).removeClass("input-valid");
                $(currentAddId[2]).val(district); $(currentAddId[2]).removeClass("input-valid");
                $(currentAddId[3]).val(zipcode); 
                
            }else{
                $(currentAddId[4]).val(null); 
                $(currentAddId[0]).val(null);
                $(currentAddId[1]).html(null);
                $(currentAddId[1]).append("<option value='' selected='false' disabled>อำเภอ / เขต</option>");
                $(currentAddId[2]).val(null);
                $(currentAddId[2]).html(null);
                $(currentAddId[2]).append("<option value='' selected='false' disabled >ตำบล / แขวง</option>");
                $(currentAddId[2]).val(null);
                $(currentAddId[3]).val(null);
            }
        });
    }

    // validate and submit
    function CustomerCreatSubmit(input_id, office_id, submit_id){
        $(submit_id).submit(function() {
            var valids  = 0;
            //################  Validate input #############//
            //address office
            $.each(office_id, function (i, val) {
                var v = $(val).val();
                if($(office_id[0]).val() != '' && (v == '' || v == null)){
                    $(val).addClass("input-valid");
                    valids++;
                }
            });

            $.each(input_id, function (i, val) {
                if($(val).val() == '' || $(val).val() == null ){
                    $(val).addClass("input-valid");
                    valids++;
                }
            });
            if(valids == 0){
                return true;
            }else{
                return false;
            }
        });
    }

    // validate normal element
    function normalValid(element_id, base_url){
        $.each(element_id, function (i, val) {
            switch(val){
                case '#idcard':
                    $(val+"-validat").hide();
                    $(val).change(function(){ 
                        $(val).removeClass("input-valid");
                        var idcard = $(val).val();
                        var num = idcard.split("-");
                        var id ="";
                        for (i = 0; i < num.length; i++) {
                            id += num[i];
                        }
                        
                        if(id != ''){
                            var url = base_url+"admin/customer/getCustomerByIdcard";
                            validateIdcards(id, url, val);
                        }else{
                            $(val).removeClass("input-valid");
                            $(val+"-validat").html(" ");
                            $(val+"-validat").hide();
                        }
                    });
                break;
                case '#tel':
                    $(val+"-validat").hide();
                    $(val).change(function(){ 
                        var tels = $(val).val();
                        if(tels != '' ){
                            if(tels.length != 10){
                                $(val).addClass("input-valid");
                                $(val+"-validat").html("หมายเลขมือถือ ไม่ให้ถูกต้อง");
                                $(val+"-validat").show();

                            }else{
                                $(val+"-validat").html(" ");
                                $(val).removeClass("input-valid");
                                $(val+"-validat").hide();
                            }
                        }else{
                            $(val+"-validat").html(" ");
                            $(val).removeClass("input-valid");
                            $(val+"-validat").hide();
                        }
                    });
                break;
                default:
                    $(val).change(function(){ 
                        $(val).removeClass("input-valid");
                    });
                    break;
            }
        });
    }


    // edit view
    //------------  Validate input ------------//
    function CustomerEditValidate(element_id, base_url){
        $.each(element_id, function (i, val) {
            
            switch(val){
                /*case '#province':
                    $(val).change(function(){
                        $(val).removeClass("input-valid");
                        
                        var province = $(val).val();
                        var url = base_url+"admin/customer/getamphoe";
                        var amphure = $("#amphurs").selector; // 
                        replaceAmphure(province, url, amphure);
                    });
                break;
                case '#amphurs':
                    $(val).change(function(){ 
                        $(val).removeClass("input-valid");

                        var amphurs = $(val).val();
                        var url = base_url+"admin/customer/getdistric";
                        var district = $("#district").selector; // 
                        replaceDistrict(amphurs, url, district);
                    });
                break;
                case '#district':
                    $(val).change(function(){ 
                        $(val).removeClass("input-valid");

                        var province = $("#province").val();
                        var amphue = $("#amphurs").val();
                        var district = $("#district").val();
                        var url = base_url+"admin/customer/getzipcode";
                        var zipcode = $("#zipcode").selector; // 
                        replaceZipcode(province,amphue,district, url, zipcode);
                    });
                break;*/
                case '#idcard':
                    $(val+"-validat").hide();
                    $(val).change(function(){ 
                        $(val).removeClass("input-valid");

                        var idcard = $(val).val();
                        var num = idcard.split("-");
                        var id ="";
                        for (i = 0; i < num.length; i++) {
                            id += num[i];
                        }
                        
                        if(id != ''){
                            var url = base_url+"admin/customer/getCustomerByIdcard";
                            validateIdcards(id, url, val);
                        }else{
                            $(val).removeClass("input-valid");
                            $(val+"-validat").html(" ");
                            $(val+"-validat").hide();
                        }
                        //
                    });
                break;
                case '#tel':
                    $(val+"-validat").hide();
                    $(val).change(function(){ 
                        var tels = $(val).val();
                        if(tels != '' ){
                            if(tels.length != 10){
                                $(val).addClass("input-valid");
                                $(val+"-validat").html("หมายเลขมือถือ ไม่ให้ถูกต้อง");
                                $(val+"-validat").show();

                            }else{
                                $(val+"-validat").html(" ");
                                $(val).removeClass("input-valid");
                                $(val+"-validat").hide();
                            }
                        }else{
                            $(val+"-validat").html(" ");
                            $(val).removeClass("input-valid");
                            $(val+"-validat").hide();
                        }
                    });
                break;
                default:
                    $(val).change(function(){ 
                        $(val).removeClass("input-valid");
                    });
                    break;
            }
        });
    }
    

    // replace Current address
    function CurrentInhabiteds(base_url, customer_code, replacePosition) {
        var ihbRes = getInhabitedByCodes(base_url, customer_code);
        drawIhbtables(ihbRes, replacePosition);
    }

    // get Inhabited By inhabited_code
    function getInhabitedByCodes(base_url, customer_code){
        var res = null;
        $.ajax({
            url: base_url+"admin/customer/getInhabitedByCodes", //ทำงานกับไฟล์นี้
            data: "customer_code=" + customer_code,  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) { res = data;},
            error: function(xhr, status, exception) {  console.log(exception); }
        });
        return res;
    }

    
    // replace Current address
    function CurrentInhabited(base_url, inhabited_code, replacePosition) {
        var ihbRes = getInhabitedByCode(base_url, inhabited_code);
        drawIhbtable(ihbRes, replacePosition);
    }

    // replace address whene change
    function ChangeInhabited(base_url, ele, replacePosition) {
        $(ele).change(function(){
            removeClassed(ele, 'input-valid');
            var ihbRes = getInhabitedByCode(base_url, $(ele).val());
            drawIhbtable(ihbRes, replacePosition);
        });
    }

    // get Inhabited By inhabited_code
    function getInhabitedByCode(base_url, inhabited_code){
        var res = null;
        $.ajax({
            url: base_url+"admin/customer/getInhabitedByCode", //ทำงานกับไฟล์นี้
            data: "inhabited_code=" + inhabited_code,  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) { res = data;},
            error: function(xhr, status, exception) {  console.log(exception); }
        });
        return res;
    }

    // draw Inhabited table
    function drawIhbtables(data, replacePosition){
        $(replacePosition).html(null);
        var srting = '';
        $.each(data, function (i, val) {
            srting += '<tr>';
            srting += '<td>'+val['category']+'</td>';
            srting += '<td>'+val['address']+'</td>';
            srting += '<td>'+val['district_name']+'</td>';
            srting += '<td>'+val['amphur_name']+'</td>';
            srting += '<td>'+val['province_name']+'</td>';
            srting += '<td>'+val['zip_code']+'</td>';
            srting += '</tr>';
        });
        $(replacePosition).append(srting);
    }

    // draw Inhabited table
    function drawIhbtable(data, replacePosition){
        $(replacePosition).html(null);
        var srting = '<tr>';
        srting += '<td>'+data[0]['address']+'</td>';
        srting += '<td>'+data[0]['district_name']+'</td>';
        srting += '<td>'+data[0]['amphur_name']+'</td>';
        srting += '<td>'+data[0]['province_name']+'</td>';
        srting += '<td>'+data[0]['zip_code']+'</td>';
        srting += '</tr>';
        $(replacePosition).append(srting);
    }

    //------------  submit edit form -------------//
    function CustomerEditSubmit(element_id, submit_id){
        $(submit_id).submit(function() {
            // DO STUFF...
            var valids  = 0;
            //################  Validate input #############//
            $.each(element_id, function (i, val) {
                if($(val).val() == '' || $(val).val() == null ){
                    $(val).addClass("input-valid");
                    valids++;
                }
            });
        
            if(valids == 0){
                return true;
            }else{
                return false;
            }
        });
    }

    function validateIdcards(id, url, val){
        var resIdcard =  getCustomerByIdcard(id, url);

        if(resIdcard.length > 0){
        $(val).addClass("input-valid");
        $(val+"-validat").html("หมายเลขบัตรประชาชน มีการใช้งานเเล้ว");
        $(val+"-validat").show();
        }else{
            var sum = 0;
            var total = 0;
            var digi = 13;

            var arr = [];
            for (i = 0; i < id.length; i++) {arr.push(id.charAt(i));}
        
            for(i=0;i<12;i++){
                sum = sum + (arr[i] * digi);
                digi--;
            }

            total = ((11 - (sum % 11)) % 10);
            
            if(total != arr[12]){
                $(val).addClass("input-valid");
                $(val+"-validat").html("หมายเลขบัตรประชาชน ไม่ให้ถูกต้อง");
                $(val+"-validat").show();
            }else{
                $(val).removeClass("input-valid");
                $(val+"-validat").html(" ");
                $(val+"-validat").hide();
            }
        }
    }

    function career(option, replaceId) {
        $(option).change(function() {
            removeClassed(option, 'input-valid');
            removeClassed(replaceId, 'input-valid');
            var options = $("option:selected", this).attr("datas");
            //   6 คือ อื่นๆ จะต้องกรอกเอง
            if(parseInt(this.value) != 6){
                $(replaceId).prop('readonly', true);
                $(replaceId).val(options);
            }else{
                $(replaceId).prop('readonly', false);
                $(replaceId).val(null);
            }
        });
    }

   

    //##################### Inhabited #########################// 
    // list view
    function InhabitedDrawList(resObj, searchEle, pageObj){
        var searchJson = SearchJson(searchEle);

        var res = null;
        $.ajax({
            url: resObj["getRes"], //ทำงานกับไฟล์นี้
            data: {  'Search':searchJson, 'itemStt':pageObj['itemStt'], 'itemEnd':pageObj['itemEnd']},  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                var tr = null;
                $(resObj["elementTable"]).html(null);
                if(data.length > 0){
                    var num = 1;
                    $.each(data, function (i, val) {
                        tr += '<tr class=" ">';
                        tr += '<td class=" ">'+val['RowNum']+'</td>';
                        tr += '<td class=" ">'+val['customer_code']+'</td>';
                        tr += '<td class=" ">'+val['firstname']+' '+val['lastname']+'</td>';
                        tr += '<td class=" ">'+val['category']+'</td>';
                        tr += '<td class=" ">'+val['address']+'</td>';
                        tr += '<td class=" ">'+val['district_name']+'</td>';
                        tr += '<td class=" ">'+val['amphur_name']+'</td>';
                        tr += '<td class=" last"  style="text-align: center;">'+val['province_name']+'</td>';
                        tr += '<td class=" last"  style="text-align: center;">'+val['zip_code']+'</td>';

                        tr += '<td class=" last"  style="text-align: center;">';
                        tr +=   '<a href="'+base_url+'admin/inhabited/edit/'+val['inhabited_code']+' ">';
                        tr +=       '<button type="button" class="btn btn-round btn-warning" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-wrench"></i> แก้ไข</button>';
                        tr +=   '</a>';
                        tr += '</td>';

                        tr += '</tr>';
                        num++;
                    });
                }
                
                $(resObj["elementTable"]).append(tr);
            },
            error: function(xhr, status, exception) { 
                //console.log(xhr);
            }
        });
    }
    // create view
    function InhabitedCreate(base_url, element_id){
        $.each(element_id, function (i, val) {
            switch(val){
                case '#customer':
                    $(val).change(function(){
                        $("#inhabited-create-form .btn-light").removeClass("input-valid");
                    });
                    break;
                case '#province':
                    $(val).change(function(){
                        $(val).removeClass("input-valid");
        
                        var province = $(val).val();
                        var url = base_url+"admin/inhabited/getamphoe";
                        var amphure = $("#amphurs").selector; // 
                        var district = $("#district").selector; // 
                        var zipcode = $("#zipcode").selector; // 
                        replaceAmphure(province, url, amphure, district, zipcode);
                    });
                break;
                case '#amphurs':
                $(val).change(function(){ 
                    $(val).removeClass("input-valid");
        
                    var amphurs = $(val).val();
                    var url = base_url+"admin/inhabited/getdistric";
                    var district = $("#district").selector; // 
                    var zipcode = $("#zipcode").selector; // 
                    replaceDistrict(amphurs, url, district, zipcode);
                });
                break;
                case '#district':
                    $(val).change(function(){ 
                        $(val).removeClass("input-valid");
        
                        var province = $("#province").val();
                        var amphue = $("#amphurs").val();
                        var district = $("#district").val();
                        var url = base_url+"admin/inhabited/getzipcode";
                        var zipcode = $("#zipcode").selector; // 
                        replaceZipcode(province,amphue,district, url, zipcode);
                        $("#zipcode").removeClass("input-valid");
                    });
                break;
                default:
                    $(val).change(function(){ 
                        $(val).removeClass("input-valid");
                    });
                    break;
            }
        });
    }

    function InhabitedCreateSubmit(element_id, submit_id){
        $(submit_id).submit(function() {
            var valids  = 0;
            //################  Validate input #############//
            $.each(element_id, function (i, val) {
                if($(val).val() == '' || $(val).val() == null ){
                    $(val).addClass("input-valid");
                    valids++;
                }else{
                    if(val == '#customer' && $(val).val() == '000000' ){ 
                        $("#inhabited-create-form .btn-light").addClass("input-valid");  
                        valids++;
                    }
                }
            });
            if(valids == 0){
                return true;
            }else{
                return false;
            }
        });
    }

    // edit view
    function InhabitedEdit(base_url, element_id){
        $.each(element_id, function (i, val) {
            switch(val){
                case '#province':
                    $(val).change(function(){
                        $(val).removeClass("input-valid");
        
                        var province = $(val).val();
                        var url = base_url+"admin/inhabited/getamphoe";
                        var amphure = $("#amphurs").selector; // 
                        var district = $("#district").selector; // 
                        var zipcode = $("#zipcode").selector; // 
                        replaceAmphure(province, url, amphure, district, zipcode);
                    });
                break;
                case '#amphurs':
                $(val).change(function(){ 
                    $(val).removeClass("input-valid");
        
                    var amphurs = $(val).val();
                    var url = base_url+"admin/inhabited/getdistric";
                    var district = $("#district").selector; // 
                    var zipcode = $("#zipcode").selector; // 
                    replaceDistrict(amphurs, url, district, zipcode);
                });
                break;
                case '#district':
                    $(val).change(function(){ 
                        $(val).removeClass("input-valid");
        
                        var province = $("#province").val();
                        var amphue = $("#amphurs").val();
                        var district = $("#district").val();
                        var url = base_url+"admin/inhabited/getzipcode";
                        var zipcode = $("#zipcode").selector; // 
                        replaceZipcode(province,amphue,district, url, zipcode);
                        $("#zipcode").removeClass("input-valid");
                    });
                break;
                default:
                    $(val).change(function(){ 
                        $(val).removeClass("input-valid");
                    });
                    break;
            }
        });
    }

    function InhabitedEditSubmit(element_id, submit_id){
        $(submit_id).submit(function() {
            var valids  = 0;
            //################  Validate input #############//
            $.each(element_id, function (i, val) {
                if($(val).val() == '' || $(val).val() == null ){
                    $(val).addClass("input-valid");
                    valids++;
                }
            });
            
            if(valids == 0){
                return true;
            }else{
                return false;
            }
        });
    }


    //##################### Report #########################// 

    
    function getToTeble(url_getRes, searchArray, itemPerPage,itemStt,itemEnd, elementtable){
        var res = getreportRes(url_getRes, searchArray, itemPerPage,itemStt,itemEnd, elementtable);
        var td = null;
        $(elementtable).html(null);
        $.each(res, function (i, val) {
            td += "<tr>";
            td += " <td>"+val.RowNum+"</td>";
            td += " <td>"+val.customer_code+"</td>";
            td += " <td>"+val.firstname+" "+val.lastname+"</td>";
            td += " <td>"+val.temp_code+"</td>";
            td += " <td>"+val.installment_payment+"</td>";
            td += " <td>"+ formatDate(val.payment_duedate,'-')+"</td>";
            var payment_amount = (val.payment_amount == null) ? '' :val.payment_amount;
            td += " <td>"+ payment_amount+"</td>";
            td += " <td>"+ formatDate(val.installment_date,'-')+"</td>";
            td += " <td style='color: #fff; text-align: center;background-color:"+val.background_color+";'>"+val.label+"</td>";
            //td += '<td class=" last"  style="text-align: center;">';
            //tr +=   '<a href="'+base_url+'admin/customer/edit/'+val['customer_code']+' ">';
            //tr +=       '<button type="button" class="btn btn-round btn-warning" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-wrench"></i> Edit</button>';
            //tr +=   '</a>';
            //td +=   '<a href="'+base_url+'admin/customer/detail/'+val['customer_code']+' ">';
            //td +=       '<button type="button" class="btn btn-round btn-info" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-file-text-o"></i> View</button>';
            //td +=   '</a>';
            td += '</td>';

            td += "</tr>";
        });
        $(elementtable).append(td);
    }

    function getreportRes(url_getRes, searchArray, itemPerPage,itemStt,itemEnd, elementtable){
        var res = null;
        $.ajax({
            url: url_getRes, //ทำงานกับไฟล์นี้
            data: {
                "searchArray" :searchArray,
                "itemPerPage" : itemPerPage, 
                "itemStt" : itemStt,
                "itemEnd" : itemEnd
            }, //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                res = data;
            },
            error: function(xhr, status, exception) { 
                //console.log(exception);
            }
        });
        return res;
    };

    function getToExport(url, searchArray, pdfEle, excelEle){
        
        $.ajax({
            url: url, //ทำงานกับไฟล์นี้
            data: {
                "searchArray" :searchArray
            }, //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                var json = JSON.stringify(data);
                $(pdfEle).val(json);
                $(excelEle).val(json);
                //res = data;
            },
            error: function(xhr, status, exception) { 
                //console.log(exception);
            }
        });
        //return res;
    };

    function getreportAll(url_getAll, searchArray, itemPerPage,itemStt,itemEnd){
        $.ajax({
            url: url_getAll, //ทำงานกับไฟล์นี้
            data: { 
                "searchArray" :searchArray,
                "itemPerPage" : itemPerPage, 
                "itemStt" : itemStt,
                "itemEnd" : itemEnd
            },  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                $("#reportAll").val(data[0].allitems); 
            },
            error: function(xhr, status, exception) {  }
        });
    }
    function Reportpagination(location,AllItems,ItemPerPage, page, searchArray){
        $(location).html(null);
        var CAllItem = AllItems;
        var Cpage = Math.ceil(CAllItem/ItemPerPage) //ปัดขึ้น;
        
        //var Cpage = 12 //ปัดขึ้น;
        //-----------html pagination------------//
       
        $(location).html(null);
        var btnPage = '<button id="suspend-left"  type="button" class="btn btn-success btn-paginations" disabled><i class="fa fa-chevron-left"></i></button>';
        for (let index = 1; index <= Cpage; index++) {
            btnPage += '<button id="'+index+'"  type="button" class="btn btn-warning btn-paginations ">'+index+'</button>';
        }
        btnPage += '<button id="suspend-next"  type="button" class="btn btn-success btn-paginations" disabled><i class="fa fa-chevron-right"></i></button>';
        $(location).append(btnPage);
    
        $('#1').addClass('focus-paginations');
        if(Cpage > 1){ $("#suspend-next").removeAttr('disabled');}
    
        //-----------btn click------------//
        $('.btn-paginations').click(function(){
            var paged = parseInt($(page).val());
            switch(this.id){
                case'suspend-left': paged = parseInt(paged)-1; break;
                case'suspend-next':paged = parseInt(paged)+1; break;
                default: paged = parseInt(this.id); break;
            }
    
            if(paged > 1){ $("#suspend-left").removeAttr('disabled');}
            if(paged == 1){ $("#suspend-left").attr('disabled','disabled');}
            if(paged == Cpage){ $("#suspend-next").attr('disabled','disabled');}
            if(paged < Cpage){ $("#suspend-next").removeAttr('disabled');}
    
            $(page).val(paged);
    
            if(paged == parseInt($(page).val())){ $('.btn-paginations').removeClass('focus-paginations'); $('#'+paged).addClass('focus-paginations');}
            
            var itemStt = ((ItemPerPage*paged)-ItemPerPage)+1;
            var itemEnd = ItemPerPage*paged;

            getToTeble(url_getRes, searchArray, ItemPerPage,itemStt,itemEnd, elementtable)
        });
    }


    //##################### Report Over due #########################// 

    function getOverDueToTeble(url_getRes, searchArray, itemPerPage,itemStt,itemEnd, elementtable){
        var res = getOverDueReportRes(url_getRes, searchArray, itemPerPage,itemStt,itemEnd, elementtable);
        
        var td = null;
        $(elementtable).html(null);
        $.each(res, function (i, val) {
            var styles = '';
            switch(val.overdue_code){
                case 10: styles =' style="color: #ec0505;" '; break;
                case 5: styles =' style="color: #ec3e05;" '; break;
                case 4: styles =' style="color: #ec6805;" '; break;
                case 3: styles =' style="color: #ec7e05;" '; break;
                case 2: styles =' style="color: #ec9305;" '; break;
                case 1: styles =' style="color: #dcbb09;" '; break;
                default:styles ='';break;
            }
            
            td += "<tr>";
            td += " <td>"+val.RowNum+"</td>";
            td += " <td>"+val.customer_code+"</td>";
            td += " <td>"+val.firstname+" "+val.lastname+"</td>";
            td += " <td>"+val.temp_code+"</td>";
            td += " <td>"+val.installment_payment+"</td>";
            td += " <td>"+ formatDate(val.payment_duedate,'-')+"</td>";
            td += " <td>"+ formatDate(val.extend_duedate,'-')+"</td>";
            td += " <td  "+styles+">"+val.overdue+"</td>";
            var payment_amount = (val.payment_amount == null) ? '' :val.payment_amount;
            td += " <td>"+ payment_amount+"</td>";
            td += " <td>"+ formatDate(val.installment_date,'-')+"</td>";
            td += " <td style='color: #fff; text-align: center;background-color:"+val.background_color+";'>"+val.label+"</td>";
            //td += '<td class=" last"  style="text-align: center;">';
            //tr +=   '<a href="'+base_url+'admin/customer/edit/'+val['customer_code']+' ">';
            //tr +=       '<button type="button" class="btn btn-round btn-warning" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-wrench"></i> Edit</button>';
            //tr +=   '</a>';
            //td +=   '<a href="'+base_url+'admin/customer/detail/'+val['customer_code']+' ">';
            //td +=       '<button type="button" class="btn btn-round btn-info" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-file-text-o"></i> View</button>';
            //td +=   '</a>';
            td += '</td>';

            td += "</tr>";
        });
        $(elementtable).append(td);  
    }

    function getOverDueReportRes(url_getRes, searchArray, itemPerPage,itemStt,itemEnd, elementtable){
        var res = null;
        $.ajax({
            url: url_getRes, //ทำงานกับไฟล์นี้
            data: {
                "searchArray" :searchArray,
                "itemPerPage" : itemPerPage, 
                "itemStt" : itemStt,
                "itemEnd" : itemEnd
            }, //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                res = data;
            },
            error: function(xhr, status, exception) { 
                //console.log(exception);
            }
        });
        return res;
    };

    function getOverDueToExport(url, searchArray, pdfEle, excelEle){
        
        $.ajax({
            url: url, //ทำงานกับไฟล์นี้
            data: {
                "searchArray" :searchArray
            }, //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                var json = JSON.stringify(data);
                $(pdfEle).val(json);
                $(excelEle).val(json);
                //res = data;
            },
            error: function(xhr, status, exception) { 
                //console.log(exception);
            }
        });
        //return res;
    };

    function getOverDuereportAll(url_getAll, searchArray, itemPerPage,itemStt,itemEnd){
        $.ajax({
            url: url_getAll, //ทำงานกับไฟล์นี้
            data: { 
                "searchArray" :searchArray,
                "itemPerPage" : itemPerPage, 
                "itemStt" : itemStt,
                "itemEnd" : itemEnd
            },  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                $("#reportAll").val(data[0].allitems); 
            },
            error: function(xhr, status, exception) {  }
        });
    }
    
    function OverDuepagination(location,AllItems,ItemPerPage, page, searchArray){
        $(location).html(null);
        var CAllItem = AllItems;
        var Cpage = Math.ceil(CAllItem/ItemPerPage) //ปัดขึ้น;
        
        //var Cpage = 12 //ปัดขึ้น;
        //-----------html pagination------------//
       
        $(location).html(null);
        var btnPage = '<button id="suspend-left"  type="button" class="btn btn-success btn-paginations" disabled><i class="fa fa-chevron-left"></i></button>';
        for (let index = 1; index <= Cpage; index++) {
            btnPage += '<button id="'+index+'"  type="button" class="btn btn-warning btn-paginations ">'+index+'</button>';
        }
        btnPage += '<button id="suspend-next"  type="button" class="btn btn-success btn-paginations" disabled><i class="fa fa-chevron-right"></i></button>';
        $(location).append(btnPage);
    
        $('#1').addClass('focus-paginations');
        if(Cpage > 1){ $("#suspend-next").removeAttr('disabled');}
    
        //-----------btn click------------//
        $('.btn-paginations').click(function(){
            var paged = parseInt($(page).val());
            switch(this.id){
                case'suspend-left': paged = parseInt(paged)-1; break;
                case'suspend-next':paged = parseInt(paged)+1; break;
                default: paged = parseInt(this.id); break;
            }
    
            if(paged > 1){ $("#suspend-left").removeAttr('disabled');}
            if(paged == 1){ $("#suspend-left").attr('disabled','disabled');}
            if(paged == Cpage){ $("#suspend-next").attr('disabled','disabled');}
            if(paged < Cpage){ $("#suspend-next").removeAttr('disabled');}
    
            $(page).val(paged);
    
            if(paged == parseInt($(page).val())){ $('.btn-paginations').removeClass('focus-paginations'); $('#'+paged).addClass('focus-paginations');}
            
            var itemStt = ((ItemPerPage*paged)-ItemPerPage)+1;
            var itemEnd = ItemPerPage*paged;

            getOverDueToTeble(url_getRes, searchArray, ItemPerPage,itemStt,itemEnd, elementtable)
        });
    }


    //##################### Product Category #########################// 

    //## List
    function drawResList(base_url, category, replacePosition){
        var res = getResCategory(base_url, category);
        if(res){ 
            var elements = '';
            $(replacePosition).html(null);
            $.each(res, function (i, val) {
                var no = i+1;

                var agrmt = ["'"+base_url+"', "+val['id']+", '"+val.cate_name+"'"];
                elements += '<tr>';
                elements += '   <td class="">'+no+'</td>';
                elements += '   <td class="">'+val.cate_id+'</td>';
                elements += '   <td class="">'+val.cate_name+'</td>';
                elements += '   <td class="">'+val.cate_detail+'</td>';
                elements += '   <td class="" style="text-align: center;">';
                elements += '       <a href="'+base_url+'admin/productCategory/edit/'+val['id']+' ">';
                elements += '           <button type="button" class="btn btn-round btn-warning" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;">';
                elements += '           <i class="fa fa-wrench"></i> แก้ไข</button>';
                elements += '       </a>';
                //elements += '       <a href="'+base_url+'admin/productCategory/delete/'+val['id']+' ">';
                elements += '           <button type="button" class="btn btn-round btn-danger" onclick="delProductCate('+agrmt+')" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;">';
                elements += '           <i class="fa fa-times"></i> ลบ</button>';
                //elements += '       </a>';
                elements += '   </td>';
                elements += '</tr>';
            });
            $(replacePosition).append(elements);
        }
    };
    function searchList(base_url, category, replacePosition, btn_event){
        $(btn_event).click(function () {
            var res = $(category).val();
            drawResList(base_url, res, replacePosition);
            
        });
    };
    function resetList(base_url, category, replacePosition, btn_event){
        $(btn_event).click(function () {
            $(category).val(null);
            drawResList(base_url, null, replacePosition);
        });
    };
    function getResCategory(base_url, category){
        var res = null;
        $.ajax({
            url: base_url+"admin/productCategory/getResCategory", //ทำงานกับไฟล์นี้
            data:  {
                'Search':category
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
    };
    function delProductCate(base_url, id, cate) {
        if (confirm('คุณต้องการที่จะลบหมวดหมู่ '+cate+' จริงหรือไม่ ?')) {
            delProductCategory(base_url, id);
        } 
    }

    function delProductCategory(base_url, id){
        var res = null;
        $.ajax({
            url: base_url+"admin/productCategory/delProductCategory", //ทำงานกับไฟล์นี้
            data:  {
                'id':id
                },  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                if(data){
                    window.location.href = base_url+"admin/productCategory";
                }
            },
            error: function(xhr, status, exception) { 
                console.log(exception);
            }
        });
        //return res;
    };

    //################################################################// 


    //##################### Brand #########################// 

    function drawBrandList(base_url, brand, replacePosition){
        var res = getResBrand(base_url, brand);
        if(res){ 
            var elements = '';
            $(replacePosition).html(null);
            $.each(res, function (i, val) {
                var no = i+1;

                var agrmt = ["'"+base_url+"', '"+val['brand_id']+"', '"+val.brand_name+"'"];
                elements += '<tr>';
                elements += '   <td class="">'+no+'</td>';
                elements += '   <td class="">'+val.brand_id+'</td>';
                elements += '   <td class="">'+val.brand_name+'</td>';
                elements += '   <td class="">'+val.brand_detail+'</td>';
                elements += '   <td class="" style="text-align: center;">';
                elements += '       <a href="'+base_url+'admin/brand/edit/'+val['brand_id']+' ">';
                elements += '           <button type="button" class="btn btn-round btn-warning" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;">';
                elements += '           <i class="fa fa-wrench"></i> แก้ไข</button>';
                elements += '       </a>';
                //elements += '       <a href="'+base_url+'admin/productCategory/delete/'+val['id']+' ">';
                elements += '           <button type="button" class="btn btn-round btn-danger" onclick="delProductBrand('+agrmt+')" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;">';
                elements += '           <i class="fa fa-times"></i> ลบ</button>';
                //elements += '       </a>';
                elements += '   </td>';
                elements += '</tr>';
            });
            $(replacePosition).append(elements);
        }
    };
    function searchBrandList(base_url, brand, replacePosition, btn_event){
        $(btn_event).click(function () {
            var res = $(brand).val();
            drawBrandList(base_url, res, replacePosition);
            
        });
    };
    function resetBrandList(base_url, brand, replacePosition, btn_event){
        $(btn_event).click(function () {
            $(brand).val(null);
            drawBrandList(base_url, null, replacePosition);
        });
    };
    function getResBrand(base_url, brand){
        var res = null;
        $.ajax({
            url: base_url+"admin/brand/getResBrand", //ทำงานกับไฟล์นี้
            data:  {
                'Search':brand
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
    };
    function delProductBrand(base_url, id, brand) {
        if (confirm('คุณต้องการที่จะลบยี่ห้อ '+brand+' จริงหรือไม่ ?')) {
            deleteProductBrand(base_url, id);
        } 
    }

    function deleteProductBrand(base_url, id){
        var res = null;
        $.ajax({
            url: base_url+"admin/brand/delProductBrand", //ทำงานกับไฟล์นี้
            data:  {
                'id':id
                },  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                if(data){
                    window.location.href = base_url+"admin/brand";
                }
            },
            error: function(xhr, status, exception) { 
                console.log(exception);
            }
        });
        //return res;
    };

    //################################################################// 


    //##################### Prduct #########################// 
    // List
    function DrawProductList(base_url, searchEle, replacePosition){
        var searchJson = SearchJson(searchEle);
        var res = getResProduct(base_url, searchJson);
        if(res){ 
            var elements = '';
            $(replacePosition).html(null);
            $.each(res, function (i, val) {
                var no = i+1;
                var agrmt = ["'"+base_url+"', '"+val.product_id+"'"];
                elements += '<tr>';
                elements += '   <td class="">'+no+'</td>';
                elements += '   <td class="">'+val.product_id+'</td>';
                elements += '   <td class="">'+val.product_name+'</td>';
                elements += '   <td class="">'+val.brand_name+'</td>';
                elements += '   <td class="">'+val.cate_name+'</td>';
                elements += '   <td class="">'+val.product_detail+'</td>';
                elements += '   <td class="" style="text-align: center;">';
                elements += '       <a href="'+base_url+'admin/product/edit/'+val.product_id+' ">';
                elements += '           <button type="button" class="btn btn-round btn-warning" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;">';
                elements += '           <i class="fa fa-wrench"></i> แก้ไข</button>';
                elements += '       </a>';
                //elements += '       <a href="'+base_url+'admin/productCategory/delete/'+val['id']+' ">';
                elements += '           <button type="button" class="btn btn-round btn-danger" onclick="delProduct('+agrmt+')" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;">';
                elements += '           <i class="fa fa-times"></i> ลบ</button>';
                //elements += '       </a>';
                elements += '   </td>';
                elements += '</tr>';
            });
            $(replacePosition).append(elements);
        }
    }

    function SearchProductList(base_url, btn_event, searchEle, replacePosition){
        $(btn_event).click(function () {
            DrawProductList(base_url, searchEle, replacePosition);
        });
    }

    function ResetProductList(base_url, btn_event, searchEle, replacePosition){
        $(btn_event).click(function () {
            DrawProductList(base_url, null, replacePosition);
            $.each(searchEle, function (i, val) {
                $(val).val(null);
            });
        });
    };

    function getResProduct(base_url, search){
        var res = null;
        $.ajax({
            url: base_url+"admin/product/getResProduct", //ทำงานกับไฟล์นี้
            data:  {
                'Search':search
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

    function SearchJson(searchEle){
        search = {};
        $.each(searchEle, function (i, val) {
            var resEle = $(val).val();
            var objKey = $(val).attr('id');
            search[objKey] = resEle;
        });
        return  JSON.stringify(search);
    }

    function delProduct(base_url, id) {
        if (confirm('คุณต้องการที่จะลบสินค้า รหัส '+id+' จริงหรือไม่ ?')) {
            DeleteProduct(base_url, id);
        } 
    }

    function DeleteProduct(base_url, id){
        $.ajax({
            url: base_url+"admin/product/DeleteProduct", //ทำงานกับไฟล์นี้
            data:  {
                'id':id
            },  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                window.location.href = base_url+"admin/product";
                
            },
            error: function(xhr, status, exception) { 
                console.log(exception);
            }
        });
    }

    // Create
    function InstallmentPlus(eventBtn, placeInstall, amountEle){
        $(eventBtn).click(function () {
            var amount = parseInt($(amountEle).val())+1;
            var InstallmentDeletAgrument = "'#installment-format-row-"+amount+"', '"+amountEle+"' ";
            var elem = '<div class="field item form-group" id="installment-format-row-'+amount+'">';
            elem += '<label class="col-form-label col-md-3 col-sm-3  label-align"></label>';
            elem += '<div class="col-md-2 col-sm-2"><input type="number" step="1" min="1" class="form-control" name="installment-amount'+amount+'" id="installment-amount'+amount+'" /></div>';
            elem += '<div class="col-md-2 col-sm-2"><input type="number" step="1" min="1" class="form-control" name="installment-pay'+amount+'" id="installment-pay'+amount+'" /></div>';
            elem += '<div class="col-md-2 col-sm-2">';
            elem += '<label for="province-current"></label>';
            elem += '<div style="position: absolute;bottom: 1px;">';
            elem += '   <button type="button" onclick="InstallmentDelet('+InstallmentDeletAgrument+')" id="installment-delete'+amount+'" class="btn btn-warning" style="margin-bottom: inherit;">';
            elem += '       <i class="fa fa-minus-square-o"></i>';
            elem += '   </button>';
            elem += '</div>';
            elem += '</div>';
            elem += '</div>';
            //elem += '';
           $(amountEle).val(amount);
           $(placeInstall).append(elem);
           InstallmentEleChange(amountEle); 
        });
        
    }
    function InstallmentDelet(placeInstall, amountEle){
        var amount = parseInt($(amountEle).val())-1;
        $(placeInstall).remove();
        $(amountEle).val(amount);
        InstallmentEleChange(amountEle); 
    }
    function ProductCreateSubmit(submitRequireEle, formId){
        $(formId).submit(function() {
            var valids  = 0;
            $.each(submitRequireEle, function (i, val) {
                switch(val){
                    case "#installment-format-amount":
                        var res = $(val).val();
                        for(i = 1; i<= res; i++){

                            var installment_amount_id = '#installment-amount'+i;
                            var installment_amount_val = $(installment_amount_id).val();
                            if(installment_amount_val == '' || installment_amount_val == null){
                                $(installment_amount_id).addClass("input-valid");
                                valids++;
                            }else{
                                $(installment_amount_id).removeClass("input-valid");
                            }

                            var installment_pay_id = '#installment-pay'+i;
                            var installment_pay_val = $(installment_pay_id).val();
                            if(installment_pay_val == ''  || installment_pay_val == null){
                                $(installment_pay_id).addClass("input-valid");
                                valids++;
                            }else{
                                $(installment_pay_id).removeClass("input-valid");
                            }
                        }
                        break;
                    default:
                        if($(val).val() == '' || $(val).val() == null ){
                            $(val).addClass("input-valid");
                            valids++;
                        }
                        break;
                }
            });
        
            if(valids == 0){
                return true;
            }else{
                return false;
            }
            //return false;
        });
    }
    function ProductEleChange(submitRequireEle){
        $.each(submitRequireEle, function (i, val) {
            $(val).change(function() {
                if(this.value != '' || this.value  != null){
                    $(val).removeClass("input-valid");
                }
            });
        });
    }
    function InstallmentEleChange(amount){
        var res = $(amount).val();
        var installment_amount_id = '#installment-amount'+res;
        $(installment_amount_id).change(function() {
            if(this.value  == ''  || this.value  == null){
                $(installment_amount_id).addClass("input-valid");
            }else{
                $(installment_amount_id).removeClass("input-valid");
            }
        });

        var installment_pay_id = '#installment-pay'+res;
        $(installment_pay_id).change(function() {
            if(this.value  == ''  || this.value  == null){
                $(installment_pay_id).addClass("input-valid");
            }else{
                $(installment_pay_id).removeClass("input-valid");
            }
        });
    }

    //Edit
    function ProductEditSubmit(submitRequireEle, formId){
        $(formId).submit(function() {
            var valids  = 0;
            $.each(submitRequireEle, function (i, val) {
                if($(val).val() == ''){
                    $(val).addClass("input-valid");
                    valids++;
                }
            });
        
            if(valids == 0){
                return true;
            }else{
                return false;
            }
            //return false;
        });
    }
    //################################################################// 


    //##################### Master Prduct #########################// 
    function DrawMasterProductList(base_url, searchEle, replacePosition){
        var searchJson = MasterProductSearchJson(searchEle);
        var res = getResMasterProduct(base_url, searchJson);
        if(res){ 
            var elements = '';
            $(replacePosition).html(null);
            $.each(res, function (i, val) {
                var no = i+1;
                var agrmt = ["'"+base_url+"', '"+val.product_master_id+"'"];
                elements += '<tr>';
                elements += '   <td class="">'+no+'</td>';
                elements += '   <td class="">'+val.product_master_id+'</td>';
                elements += '   <td class="">'+val.product_master_name+'</td>';
                elements += '   <td class="">'+val.product_master_price+'</td>';
                elements += '   <td class="">'+val.brand_name+'</td>';
                elements += '   <td class="">'+val.cate_name+'</td>';
                //elements += '   <td class="">'+val.product_master_detail+'</td>';
                elements += '   <td class="" style="text-align: center;">';
                elements += '       <a href="'+base_url+'admin/productMaster/edit/'+val.product_master_id+' ">';
                elements += '           <button type="button" class="btn btn-round btn-warning" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;">';
                elements += '           <i class="fa fa-wrench"></i> แก้ไข</button>';
                elements += '       </a>';
                //elements += '       <a href="'+base_url+'admin/productCategory/delete/'+val['id']+' ">';
                elements += '           <button type="button" class="btn btn-round btn-danger" onclick="delMasterProduct('+agrmt+')" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;">';
                elements += '           <i class="fa fa-times"></i> ลบ</button>';
                //elements += '       </a>';
                elements += '   </td>';
                elements += '</tr>';
            });
            $(replacePosition).append(elements);
        }
    }
    function SearchMasterProductList(base_url, btn_event, searchEle, replacePosition){
        $(btn_event).click(function () {
            DrawMasterProductList(base_url, searchEle, replacePosition);
        });
    }
    function ResetMasterProductList(base_url, btn_event, searchEle, replacePosition){
        $(btn_event).click(function () {
            DrawMasterProductList(base_url, null, replacePosition);
            $.each(searchEle, function (i, val) {
                $(val).val(null);
            });
        });
    };

    function MasterProductSearchJson(searchEle){
        search = {};
        $.each(searchEle, function (i, val) {
            var resEle = $(val).val();
            var objKey = $(val).attr('id');
            search[objKey] = resEle;
        });
        return  JSON.stringify(search);
    }
    function getResMasterProduct(base_url, search){
        var res = null;
        $.ajax({
            url: base_url+"admin/productMaster/getResProduct", //ทำงานกับไฟล์นี้
            data:  {
                'Search':search
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
    
    function delMasterProduct(base_url, id) {
        if (confirm('คุณต้องการที่จะลบสินค้า รหัส '+id+' จริงหรือไม่ ?')) {
            DeleteMasterProduct(base_url, id);
        } 
    }
    function DeleteMasterProduct(base_url, id){
        $.ajax({
            url: base_url+"admin/productMaster/DeleteProduct", //ทำงานกับไฟล์นี้
            data:  {
                'id':id
            },  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                window.location.href = base_url+"admin/productMaster";
                
            },
            error: function(xhr, status, exception) { 
                console.log(exception);
            }
        });
    }

    // Create
    function ProductMasterCreateSubmit(submitRequireEle, formId){
        $(formId).submit(function() {
            var valids  = 0;
            $.each(submitRequireEle, function (i, val) {
                switch(val){
                    case "#installment-format-amount":
                        var res = $(val).val();
                        for(i = 1; i<= res; i++){

                            var installment_amount_id = '#installment-amount'+i;
                            var installment_amount_val = $(installment_amount_id).val();
                            if(installment_amount_val == '' || installment_amount_val == null){
                                $(installment_amount_id).addClass("input-valid");
                                valids++;
                            }else{
                                $(installment_amount_id).removeClass("input-valid");
                            }

                            var installment_pay_id = '#installment-pay'+i;
                            var installment_pay_val = $(installment_pay_id).val();
                            if(installment_pay_val == ''  || installment_pay_val == null){
                                $(installment_pay_id).addClass("input-valid");
                                valids++;
                            }else{
                                $(installment_pay_id).removeClass("input-valid");
                            }
                        }
                        break;
                    default:
                        if($(val).val() == '' || $(val).val() == null ){
                            $(val).addClass("input-valid");
                            valids++;
                        }
                        break;
                }
            });
                    
            if(valids == 0){
                return true;
            }else{
                return false;
            }
            //return false;
        });
    }
    function ProductMasterEleChange(submitRequireEle){
        $.each(submitRequireEle, function (i, val) {
            $(val).change(function() {
                if(this.value != '' || this.value  != null){
                    $(val).removeClass("input-valid");
                }
            });
        });
    }

    //Edit
    function ProductMasterEditSubmit(submitRequireEle, formId){
        $(formId).submit(function() {
            var valids  = 0;
            $.each(submitRequireEle, function (i, val) {
                if($(val).val() == ''){
                    $(val).addClass("input-valid");
                    valids++;
                }
            });
        
            if(valids == 0){
                return true;
            }else{
                return false;
            }
            //return false;
        });
    }
    //######################################################// 





    //##################### Installment Type #########################// 
    // List
    function DrawInstallmentTypeList(base_url, searchEle, replacePosition){
        var res = getResInstallmentType(base_url, $(searchEle[0]).val());
        if(res){
            var elements = '';
            $(replacePosition).html(null);
            $.each(res, function (i, val) {
                var no = i+1;
                var agrmt = ["'"+base_url+"', '"+val.installment_type_id+"'"];
                elements += '<tr>';
                elements += '   <td class="">'+no+'</td>';
                elements += '   <td class="">'+val.installment_type_id+'</td>';
                elements += '   <td class="">'+val.product_id+'</td>';
                elements += '   <td class="">'+val.product_name+'</td>';
                elements += '   <td class="">'+val.amount_installment+'</td>';
                elements += '   <td class="">'+val.pay_per_month+'</td>';
                elements += '   <td class="" style="text-align: center;">';
                elements += '       <a href="'+base_url+'admin/installmentType/edit/'+val.installment_type_id+' ">';
                elements += '           <button type="button" class="btn btn-round btn-warning" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;">';
                elements += '           <i class="fa fa-wrench"></i> แก้ไข</button>';
                elements += '       </a>';
                //elements += '       <a href="'+base_url+'admin/productCategory/delete/'+val['id']+' ">';
                elements += '           <button type="button" class="btn btn-round btn-danger" onclick="delInstallmentType('+agrmt+')" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;">';
                elements += '           <i class="fa fa-times"></i> ลบ</button>';
                //elements += '       </a>';
                elements += '   </td>';
                elements += '</tr>';
            });
            $(replacePosition).append(elements);
        }
    }

    function getResInstallmentType(base_url, search){
        var res = null;
        $.ajax({
            url: base_url+"admin/installmentType/getResInstallmentType", //ทำงานกับไฟล์นี้
            data:  {
                'Search':search
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

    function SearchInstallmentTypeList(base_url, btn_event, searchEle, replacePosition){
        $(btn_event).click(function () {
            DrawInstallmentTypeList(base_url, searchEle, replacePosition);
        });
    }

    function ResetInstallmentTypeList(base_url, btn_event, searchEle, replacePosition){
        $(btn_event).click(function () {
            $(searchEle[0]).val(null);
            DrawInstallmentTypeList(base_url, searchEle, replacePosition);
        });
    };

    function delInstallmentType(base_url, id) {
        if (confirm('คุณต้องการที่จะลบประเภทการผ่อนชำระ รหัส '+id+' จริงหรือไม่ ?')) {
            DeleteInstallmentType(base_url, id);
        } 
    }

    function DeleteInstallmentType(base_url, id){
        $.ajax({
            url: base_url+"admin/installmentType/DeleteInstallmentType", //ทำงานกับไฟล์นี้
            data:  {
                'id':id
            },  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                window.location.href = base_url+"admin/installmentType";
            },
            error: function(xhr, status, exception) { 
                console.log(exception);
            }
        });
    }

    //Create
    function InstallmentTypeCrateEleChange(submitRequireEle){
        $.each(submitRequireEle, function (i, val) {
            $(val).change(function() {
                if(this.value != '' || this.value  != null){
                    if(i == 0){// '#product-id'
                        $(val).parent().children('button').removeClass("input-valid");
                    }else{
                        $(val).removeClass("input-valid");
                    }
                }
            });
        });
    }

    function InstallmentTypeCrateSubmit(submitRequireEle, formId){
        $(formId).submit(function() {
            var valids  = 0;
            $.each(submitRequireEle, function (i, val) {
                if(i == 0){// '#product-id'
                    if($(val).val() == null){
                        $(val).parent().children('button').addClass("input-valid");
                        valids++;
                    }
                }else{
                    if($(val).val() == ''){
                        $(val).addClass("input-valid");
                        valids++;
                    }
                }
            });

            if(valids == 0){
                return true;
            }else{
                return false;
            }
            //return false;
        });
    }

    //Edit
    function InstallmentTypeEleChange(submitRequireEle){
        $.each(submitRequireEle, function (i, val) {
            $(val).change(function() {
                if(this.value != '' || this.value  != null){
                    $(val).removeClass("input-valid");
                }
            });
        });
    }
    function InstallmentTypeEditSubmit(submitRequireEle, formId){
        $(formId).submit(function() {
            var valids  = 0;
            $.each(submitRequireEle, function (i, val) {
                if($(val).val() == ''){
                    $(val).addClass("input-valid");
                    valids++;
                }
            });
        
            if(valids == 0){
                return true;
            }else{
                return false;
            }
            //return false;
        });
    }

    //################################################################// 

    //##################### Product sub #########################// 

    //List
    function DrawProductSubList(base_url, searchEle, replacePosition){
        var searchJson = SearchJson(searchEle);
        var res = getResProductSub(base_url, searchJson);
        if(res){ 
            var elements = '';
            $(replacePosition).html(null);
            $.each(res, function (i, val) {
                var no = i+1;
                var agrmt = ["'"+base_url+"', '"+val.product_sub_id+"'"];
                elements += '<tr>';
                elements += '   <td class="">'+no+'</td>';
                elements += '   <td class="">'+val.product_sub_id+'</td>';
                elements += '   <td class="">'+val.product_sub_name+'</td>';
                elements += '   <td class="">'+val.product_id+'</td>';
                elements += '   <td class="">'+val.product_name+'</td>';
                elements += '   <td class="">'+val.brand_name+'</td>';
                elements += '   <td class="" style="text-align: center;">';
                elements += '       <a href="'+base_url+'admin/productSub/edit/'+val.product_sub_id+' ">';
                elements += '           <button type="button" class="btn btn-round btn-warning" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;">';
                elements += '           <i class="fa fa-wrench"></i> แก้ไข</button>';
                elements += '       </a>';
                //elements += '       <a href="'+base_url+'admin/productCategory/delete/'+val['id']+' ">';
                elements += '           <button type="button" class="btn btn-round btn-danger" onclick="delProductSub('+agrmt+')" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;">';
                elements += '           <i class="fa fa-times"></i> ลบ</button>';
                //elements += '       </a>';
                elements += '   </td>';
                elements += '</tr>';
            });
            $(replacePosition).append(elements);
        }
    }

    function SearchProductSubList(base_url, btn_event, searchEle, replacePosition){
        $(btn_event).click(function () {
            DrawProductSubList(base_url, searchEle, replacePosition);
        });
    }

    function ResetProductSubList(base_url, btn_event, searchEle, replacePosition){
        $(btn_event).click(function () {
            $(searchEle[0]).val(null);
           
            $(searchEle[0]).parent().children('button').children(".filter-option-inner-inner").html(null);
            
            DrawProductSubList(base_url, searchEle, replacePosition);
            $.each(searchEle, function (i, val) {
                $(val).val(null);
            });
        });
    };

    function getResProductSub(base_url, search){
        var res = null;
        $.ajax({
            url: base_url+"admin/productSub/getResProductSub", //ทำงานกับไฟล์นี้
            data:  {
                'Search':search
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

    function delProductSub(base_url, id) {
        if (confirm('คุณต้องการที่จะลบสินค้าย่อย รหัส '+id+' จริงหรือไม่ ?')) {
            DeleteProductSub(base_url, id);
        } 
    }

    function DeleteProductSub(base_url, id){
        $.ajax({
            url: base_url+"admin/productSub/DeleteProductSub", //ทำงานกับไฟล์นี้
            data:  {
                'id':id
            },  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                window.location.href = base_url+"admin/productSub";
                
            },
            error: function(xhr, status, exception) { 
                console.log(exception);
            }
        });
    }

    //Edit
    function ProductSubEditSubmit(submitRequireEle, formId){
        $(formId).submit(function() {
            var valids  = 0;
            $.each(submitRequireEle, function (i, val) {
                if($(val).val() == ''){
                    $(val).addClass("input-valid");
                    valids++;
                }
            });
        
            if(valids == 0){
                return true;
            }else{
                return false;
            }
            //return false;
        });
    }

    //Creat
    function ProductSubCreateSubmit(RequireEle, formId){
        $(formId).submit(function() {
            var valids  = 0;
            $.each(RequireEle, function (i, val) {
                if(i == 0){// '#product-id'
                    if($(val).val() == null){
                        $(val).parent().children('button').addClass("input-valid");
                        valids++;
                    }
                }else{
                    if($(val).val() == ''){
                        $(val).addClass("input-valid");
                        valids++;
                    }
                }
            });
        
            if(valids == 0){
                return true;
            }else{
                return false;
            }
            //return false;
        });
    }

    function ProductSubEleChange(RequireEle){
        $.each(RequireEle, function (i, val) {
            $(val).change(function() {
                if(this.value != '' || this.value  != null){
                    if(i == 0){// '#product-id'
                        $(val).parent().children('button').removeClass("input-valid");
                    }else{
                        $(val).removeClass("input-valid");
                    }
                }
            });
        });
    }


    //################################################################// 
    
    
    function removeClassed(id, cl){
        $(id).removeClass(cl);
    };


    //##################### Temp #########################// 
    
    //# List #//
    function TempDrawList(resObj, searchEle, pageObj){
        var searchJson = SearchJson(searchEle);
        $(resObj["elementTable"]).html(null);
        $.ajax({
            url: resObj["getRes"], //ทำงานกับไฟล์นี้
            data: { 'Search':searchJson, 'itemStt':pageObj['itemStt'], 'itemEnd':pageObj['itemEnd']},  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                var tr = null;
                if(data.length > 0){
                    $.each(data, function (i, val) {
                        var no = i+1;
                        tr += '<tr class="even pointer">';
                        tr += '<td class="a-center ">'+no+'</td>';
                        tr += '<td>'+val['temp_code']+'</td>';
                        tr += '<td>'+val['firstname']+' '+val['lastname']+'</td>';
                        tr += '<td>'+val['tel']+'</td>';
                        tr += '<td>'+val['product_name']+'</td>';
                        tr += '<td>'+val['email']+'</td>';
                        tr += '<td>'+val['product_number']+'</td>';
                        tr += '<td class=" last"  style="text-align: center;">';
                        tr +=     '<button type="button" class="btn btn-round" style="background-color: '+val['background_color']+'; color: '+val['color']+'; font-size: 12px; padding: 0 10px; margin-bottom: inherit;margin-right: inherit;"> '+val['label']+'</button>';
                        tr += '</td>';
                        tr += '<td class=" last"  style="text-align: center;">';
                        tr +=   '<a class=" col-sm-12 col-md-12 col-lg-3" href="'+base_url+'admin/temp/edit/'+val['temp_code']+' " style="padding-right: 3px;padding-left: 3px;" data-toggle="tooltip" title="แก้ไข">';
                        tr +=       '<button type="button" class="btn btn-round btn-warning" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-wrench"></i></button>';
                        tr +=   '</a>';
                        tr +=   '<a class=" col-sm-12 col-md-12 col-lg-3" href="'+base_url+'admin/temp/contractPDF/'+val['temp_code']+' " target="_blank" style="padding-right: 3px;padding-left: 3px;" data-toggle="tooltip" title="PDF">';
                        tr +=       '<button type="button" class="btn btn-round btn-dark" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-print"></i></button>';
                        tr +=   '</a>';
                        tr +=   '<a class=" col-sm-12 col-md-12 col-lg-3" href="'+base_url+'admin/temp/detail/'+val['temp_code']+' " style="padding-right: 3px;padding-left: 3px;" data-toggle="tooltip" title="รายละเอียด">';
                        tr +=       '<button type="button" class="btn btn-round btn-info" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-file-text-o"></i></button>';
                        tr +=   '</a>';
                        tr +=   '<a class=" col-sm-12 col-md-12 col-lg-3" href="'+base_url+'admin/temp/premise/'+val['temp_code']+' " style="padding-right: 3px;padding-left: 3px;" data-toggle="tooltip" title="หลักฐาน">';
                        tr +=       '<button type="button" class="btn btn-round btn-success" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-file-image-o"></i></button>';
                        tr +=   '</a>';
                        tr += '</td>';
                        tr += '</tr>';
                    });
                    $(resObj["elementTable"]).append(tr);
                }
            },
            error: function(xhr, status, exception) { 
                console.log(exception);
            }
        });
    }

    // Create //
    function Temp_CstomerChange(base_url, EventId, Address_concernedID){
        $(EventId).change(function() {
            $(this).parent().children('button').removeClass("input-valid");
            var res = getIhbByCus(base_url, this.value);
            drawIhbComb(res, Address_concernedID[0]); // draw Inhabited
            $(Address_concernedID[1]).html(null);  // replace Inhabited table whene change

        });
    };

    function Temp_SearchComboChange(EventId){
        $(EventId).change(function() {
            $(this).parent().children('button').removeClass("input-valid");
        });
    };

    function drawIhbComb(data, replacePosition){
        removeClassed(replacePosition, "input-valid");
        var srting = '<option selected="false" disabled>ประเภทที่อยู่</option>';
        $(replacePosition).html(null);
        $.each(data, function (i, item) {
            srting += '<option value="'+data[i].inhabited_code+'">'+data[i].category+'</option>';
        });
        $(replacePosition).append(srting);
    };
    function getIhbByCus(base_url, customer_code){
        var res = null;
        $.ajax({
            url: base_url+"admin/temp/getIhbByCus", //ทำงานกับไฟล์นี้
            data: "customer_code=" + customer_code,  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) { res = data;},
            error: function(xhr, status, exception) {  console.log(exception); }
        });
        return res;
    };
    function Temp_ProductCateChange(base_url, EventId, ProductCate_concernedID, Address_concernedID){
        $(EventId).change(function() {
            $(this).parent().children('button').removeClass("input-valid");
            var products = Temp_GetProducts(base_url, this.value);
            Temp_AppendProductComb(ProductCate_concernedID[0], products);
            $(ProductCate_concernedID[1]).val(null); // preoduct brand
            $(ProductCate_concernedID[2]).val(null); // preoduct brand
            $(ProductCate_concernedID[3]).val(null); // product version
            $(ProductCate_concernedID[4]).hide(); // serial number
            $(ProductCate_concernedID[6]).html(null); // installment type table
            $(ProductCate_concernedID[7]).attr("readonly", true); 
        });
    };
    function Temp_GetProducts(base_url, productCateId){
        var res = null;
        $.ajax({
            url: base_url+"admin/temp/GetProducts", //ทำงานกับไฟล์นี้
            data:  {
                'productCateId':productCateId
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
    };
    function Temp_AppendProductComb(ProductID, products){
        // append option to product combobox
        var options = '<option selected="false" disabled>เลือกสินค้า</option>';
        $(ProductID).html(null);
        products.forEach(item => {
            options += "<option value='"+item.product_id+"' res='"+JSON.stringify(item)+"'>"+item.product_name+"</option>";
        });
        $(ProductID).append(options);
        $('.selectpicker').selectpicker('refresh'); // refresh class
    };
    function Temp_ProductChange(base_url,ProductCate_concernedID, Product_count){
        $(ProductCate_concernedID[0]).change(function() {
            $(this).parent().children('button').removeClass("input-valid");
            var Product = JSON.parse($(this).find(':selected').attr('res'));
            $(ProductCate_concernedID[1]).val(Product.brand_name); // preoduct brand
            $(ProductCate_concernedID[2]).val(Product.brand_id); // preoduct brand id
            $(ProductCate_concernedID[3]).val(Product.product_version); // product version
            $(ProductCate_concernedID[7]).val(null); // property number 
            $(ProductCate_concernedID[7]).attr("readonly", false); 
            

            // serial element
            /*var subProduct = Temp_GetSubByProduct(base_url, Product.product_id);
            Temp_DrowSerialEle(subProduct, ProductCate_concernedID, Product_count);*/

            // Installment type table 
            var installmentType = Temp_GetInstallmentTypeByProductID(base_url, Product.product_id);
            Temp_DrowInstallmentTypeTable(installmentType, ProductCate_concernedID);
        });
    };
    function Temp_GetSubByProduct(base_url, product_id){
        var res = null;
        $.ajax({
            url: base_url+"admin/temp/GetSubByProduct", //ทำงานกับไฟล์นี้
            data:  {
                'product_id':product_id
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
    };
    function Temp_DrowSerialEle(subProduct, ProductCate_concernedID, Product_count){
        $(ProductCate_concernedID[4]).show();
        $(ProductCate_concernedID[5]).html(null);
        if(subProduct.length == 0){
            var elements = '';
            elements += '<div class="col-md-4 col-sm-4">';
            elements += '   <label class="col-form-label label-align"></label>';
            elements += '   <input class="form-control" type="text" id="serial" name="serial" />';
            elements += '</div>';
            $(ProductCate_concernedID[5]).append(elements);
        }else{
            var no = $(Product_count).val();
            var elements = '';
            for(var i = 1; i <= no; i++){
                elements += '<div class="col-md-12 col-sm-12">';
                elements += '<div class="col-md-1 col-sm-1">';
                elements += '   <label class="col-form-label label-align"></label>';
                elements += '   <input style="margin-top: 1rem;" class="form-control" type="text" id="serial_no_'+i+'" name="serial_no_'+i+'" value="'+i+'" readonly/>';
                elements += '</div>';
                $.each(subProduct, function (key, val) {
                    elements += '<div class="col-md-4 col-sm-4">';
                    elements += '   <label class="col-form-label label-align">'+val.product_sub_name+'</label>';
                    elements += '   <input class="form-control" type="text" id="serial_'+i+'_'+val.product_sub_id+'" name="serial_'+i+'_'+val.product_sub_id+'" />';
                    elements += '</div>';
                });
                elements += '</div>';
            };
            $(ProductCate_concernedID[5]).append(elements);
        } 
    };
    function Temp_GetInstallmentTypeByProductID(base_url, product_id){
        var res = null;
        $.ajax({
            url: base_url+"admin/temp/GetInstallmentTypeByProductID", //ทำงานกับไฟล์นี้
            data:  {
                'product_id':product_id
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
    };
    function Temp_DrowInstallmentTypeTable(data, ProductCate_concernedID){
        var td = null;
        $(ProductCate_concernedID[6]).html(null);
        $.each(data, function (i, val) {
            //var res =  JSON.stringify({'period': i, 'interest': obj[i]['interest'], 'per_month_price': obj[i]['per_month_price_a'], 'per_month_price_vat': obj[i]['per_month_price_a_vat'],'per_month_price_include_vat': obj[i]['per_month_price_a_vat']});
            var res =  JSON.stringify({'amount_installment': val.amount_installment, 'per_month_price': val.pay_per_month});
            td += "<tr>";
            td += "<td><input class='inhabitedInput' type='radio' name='installmentCheck' id='installmentCheck"+i+"' value='"+res +"' /> </td>";
            td += "<td>"+val.amount_installment+"</td>";
            td += "<td>"+val.pay_per_month+"</td>";
            td += "</tr>";
        });
        $(ProductCate_concernedID[6]).append(td);
    };
    function jsonTechn(value, url){
        var res = null;
        $.ajax({
            url: url, //ทำงานกับไฟล์นี้
            data:  {'val':value},  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                if(!data){
                    //$("#sale-id").val(null);
                    $("#sale-status").removeClass("succ-stat-sale");
                    $("#sale-status").html("ไม่พบ พนักงาน");
                    $("#sale-status").addClass("fail-stat-sale");
                }else{
                    res  = data.AgentCode;
                    $("#sale-id").val(data.AgentCode);
                    $("#sale-status").html(data.AgentName+" "+data.AgentSurName);
                    $("#sale-status").addClass("succ-stat-sale");
                    removeClassed($("#sale-status").selector, "fail-stat-sale");

                    removeClassed($("#sale-id").selector, "input-valid");
                }
            },
            error: function(xhr, status, exception) { 
                console.log(exception);
            }
        });
        return res;
    };
    function tempCreateSubmit(element_id, submit_id, installmentEle, supporterEle){
        $(submit_id).submit(function() {
            var valids  = 0;
            //################  Validate input #############//
            $.each(element_id, function (i, val) {
                if($(val).val() == '' || $(val).val() == null ){
                    switch(val){
                        case '#customer': 
                        case '#product-cate':
                        case '#product': 
                        case "#sale-id":
                        case "#techn-id":
                            $(val).parent().children('button').addClass("input-valid");
                        break;
                        default:             
                            $(val).addClass("input-valid");
                            break;
                    }
                    valids++;
                }
            });

            if($('input[name='+installmentEle[0]+']:checked').val() == undefined ){
                $(installmentEle[1]).addClass("input-valid");
                valids++;
            }else{
                removeClassed($(installmentEle[1]).selector, "input-valid");
            }

            //----   Supporter ----//
            if ($(supporterEle[0]).is(":checked"))
            {
                $.each(supporterEle, function (i, val) {
                    if(i != 0){
                        if($(val).val() == '' || $(val).val() == null ){
                            $(val).addClass("input-valid");
                            valids++;
                        }
                    }
                });
            }
            //-----------------------//

            if(valids == 0){
                return true;
            }else{
                return false;
            }
            //return false;
        });
    };

    //  Edit //
    function tempEditSubmit(element_id, submit_id, supporterEle){
        $(submit_id).submit(function() {
            var valids  = 0;
            $.each(element_id, function (i, val) {
                if($(val).val() == '' || $(val).val() == null ){
                    $(val).addClass("input-valid");
                    valids++;
                }
            });

            //----   Supporter ----//
            if ($(supporterEle[0]).is(":checked"))
            {
                $.each(supporterEle, function (i, val) {
                    if(i != 0){
                        if($(val).val() == '' || $(val).val() == null ){
                            $(val).addClass("input-valid");
                            valids++;
                        }
                    }
                });
            }

            //-----------------------//

            if(valids == 0){
                return true;
            }else{
                return false;
            }
            //return false;
        });
    }
    function Temp_EditSubByProduct(base_url, product_id){
        var res = null;
        $.ajax({
            url: base_url+"admin/temp/GetSubByProduct", //ทำงานกับไฟล์นี้
            data:  {
                'product_id':product_id
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
    };
    //##############################################// 



    //##################### Serial Number #########################// 
    //List
    function DrawSerialList(base_url, searchEle, replacePosition){
        var searchJson = SearchJson(searchEle);
        var res = getResSerial(base_url, searchJson);
        if(res){ 
            var elements = '';
            $(replacePosition).html(null);
            $.each(res, function (i, val) {
                var no = i+1;
                var agrmt = ["'"+base_url+"', '"+val.product_id+"'"];
                elements += '<tr>';
                elements += '   <td class="">'+no+'</td>';
                elements += '   <td class="">'+val.temp_code+'</td>';
                elements += '   <td class="">'+val.firstname+' '+val.lastname+'</td>';
                elements += '   <td class="">'+val.product_name+'</td>';
                elements += '   <td class="">'+val.cate_name+'</td>';
                elements += '   <td class="">'+val.tel+'</td>';
                elements += '   <td class="" style="text-align: center;">';
                elements += '       <a href="'+base_url+'admin/SerialNumber/edit/'+val.temp_code+' ">';
                elements += '           <button type="button" class="btn btn-round btn-warning" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;">';
                elements += '           <i class="fa fa-wrench"></i> แก้ไข</button>';
                elements += '       </a>';
                elements += '       <a href="'+base_url+'admin/SerialNumber/addition/'+val.temp_code+' ">';
                elements += '           <button type="button" class="btn btn-round btn-success" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;">';
                elements += '           <i class="fa fa-plus"></i> เพิ่ม</button>';
                elements += '       </a>';
                ////elements += '       <a href="'+base_url+'admin/productCategory/delete/'+val['id']+' ">';
                //elements += '           <button type="button" class="btn btn-round btn-danger" onclick="delProduct('+agrmt+')" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;">';
                //elements += '           <i class="fa fa-times"></i> ลบ</button>';
                ////elements += '       </a>';
                elements += '   </td>';
                elements += '</tr>';
            });
            $(replacePosition).append(elements);
        }
    }
    function getResSerial(base_url, search){
        var res = null;
        $.ajax({
            url: base_url+"admin/SerialNumber/getResSerial", //ทำงานกับไฟล์นี้
            data:  {
                'Search':search
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
    function SearchSerialList(base_url, btn_event, searchEle, replacePosition){
        $(btn_event).click(function () {
            DrawSerialList(base_url, searchEle, replacePosition);
        });
    }
    function ResetSerialList(base_url, btn_event, searchEle, replacePosition){
        $(btn_event).click(function () {
            $.each(searchEle, function (i, val) {
                $(val).val(null);
            });
            DrawSerialList(base_url, searchEle, replacePosition);
        });
    };
    // Create
    function TempChange(base_url, eventID){
        $(eventID).change(function() {
            // draw serial element
            var Product = JSON.parse($(this).find(':selected').attr('res'));
            var subProduct = Temp_GetSubByProduct(base_url, Product.product_id);
            if(subProduct.length > 0 ){
                $("#productPlace").show();
                $("#serialPlace").show();
                $("#productElePositions").html(null);
                $("#serialElePotions").html(null);

                var porductEle = '';
                porductEle += '<div class="col-md-4 col-sm-4">';
                porductEle += '   <label class="col-form-label label-align">รหัสสินค้า</label>';
                porductEle += '   <input class="form-control" type="text" id="product_id" name="product_id" value="'+Product.product_id+'" readonly/>';
                porductEle += '</div>';
                porductEle += '<div class="col-md-4 col-sm-4">';
                porductEle += '   <label class="col-form-label label-align">สินค้า</label>';
                porductEle += '   <input class="form-control" type="text" id="product_name" name="product_name" value="'+Product.product_name+'" readonly/>';
                porductEle += '</div>';
                $("#productElePositions").append(porductEle);

                var elements = '';
                $.each(subProduct, function (key, val) {
                    elements += '<div class="col-md-4 col-sm-4">';
                    elements += '   <label class="col-form-label label-align">'+val.product_sub_name+'</label>';
                    elements += '   <input class="form-control" type="text" id="serial_'+val.product_sub_id+'" name="serial_'+val.product_sub_id+'" />';
                    elements += '</div>';
                });
                elements += '<div class="col-md-4 col-sm-4">';
                elements += '   <label class="col-form-label label-align">xxxxxx</label>';
                elements += '   <input class="form-control" type="text" id="serial_" name="serial_" />';
                elements += '</div>';
                $("#serialElePotions").append(elements);
            }
        });
    };
    function serialCreateSubmit(element_id, submit_id){
        $(submit_id).submit(function() {
            var valids  = 0;

            if(valids == 0){
                return true;
            }else{
                return false;
            }
            //return false;
        });
    };
    // Edit
    function serialEditSubmit(element_id, submit_id){
        $(submit_id).submit(function() {
            var valids  = 0;
            var subProduct = Temp_GetSubByProduct(base_url, $(element_id[1]).val());
            if(subProduct.length > 0 ){
                $.each(subProduct, function (key, val) {
                    var serialID = "#serial_"+val.product_sub_id;
                    if($(serialID).val() == ''){
                        $(serialID).addClass("input-valid");
                        valids++;
                    }
                });
            }

            if(valids == 0){
                return true;
            }else{
                return false;
            }
            //return false;
        });
    };
    //Additional
    function serialAdditionSubmit(element_id, submit_id){
        $(submit_id).submit(function() {
            var valids  = 0;
            var subProduct = Temp_GetSubByProduct(base_url, $(element_id[1]).val());
            if(subProduct.length > 0 ){
                $.each(subProduct, function (key, val) {
                    var serialID = "#serial_"+val.product_sub_id;
                    if($(serialID).val() == ''){
                        $(serialID).addClass("input-valid");
                        valids++;
                    }
                });
            }

            if(valids == 0){
                return true;
            }else{
                return false;
            }
            //return false;
        });
    };
     //##############################################// 


     //##################### Customer Corperation #########################// 

     function getCorperationRes(resObj, searchEle, pageObj){
        var searchJson = SearchJson(searchEle);
        $(resObj["elementTable"]).html(null);
        var res = null;
        $.ajax({
            url: resObj["getRes"], //ทำงานกับไฟล์นี้
            data: { 'Search':searchJson, 'itemStt':pageObj['itemStt'], 'itemEnd':pageObj['itemEnd']},  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                var tr = null;
                if(data.length > 0){
                    var num = 1;
                    $.each(data, function (i, val) {
                        tr += '<tr class=" ">';
                        tr += '<td class=" ">'+val['RowNum']+'</td>';
                        tr += '<td class=" ">'+val['customer_code']+'</td>';
                        tr += '<td class=" ">'+val['firstname']+'</td>';
                        tr += '<td class=" ">'+val['address']+'</td>';
                        tr += '<td class=" ">'+val['idcard']+'</td>';
                        tr += '<td class=" ">'+val['tel']+'</td>';
                        tr += '<td class=" last"  style="text-align: center;">';
                        tr +=     '<button type="button" class="btn btn-round" style="background-color: '+val['background_color']+'; color: '+val['color']+'; font-size: 13px; padding: 0 15px; margin-bottom: inherit;margin-right: inherit;"> '+val['label']+'</button>';
                        tr += '</td>';
                        tr += '<td class=" last"  style="text-align: center;">';
                        tr +=   '<a class=" col-sm-12 col-md-12 col-lg-4" href="'+base_url+'admin/corperation/edit/'+val['customer_code']+' " data-toggle="tooltip" title="แก้ไข">';
                        tr +=       '<button type="button" class="btn btn-round btn-warning" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-wrench"></i></button>';
                        tr +=   '</a>';
                        tr +=   '<a class=" col-sm-12 col-md-12 col-lg-4" href="'+base_url+'admin/corperation/detail/'+val['customer_code']+' " data-toggle="tooltip" title="รายละเอียด">';
                        tr +=       '<button type="button" class="btn btn-round btn-info" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-file-text-o"></i></button>';
                        tr +=   '</a>';
                        tr +=   '<a class=" col-sm-12 col-md-12 col-lg-4" href="'+base_url+'admin/corperation/premise/'+val['customer_code']+' " data-toggle="tooltip" title="หลักฐาน">';
                        tr +=       '<button type="button" class="btn btn-round btn-success" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-file-image-o"></i></button>';
                        tr +=   '</a>';
                        tr += '</td>';
                        tr += '</tr>';
                        num++;
                    });
                }
                $(resObj["elementTable"]).append(tr);
            },
            error: function(xhr, status, exception) { 
                //console.log(xhr);
            }
        });
    }

    function CorperationUpdateSubmit(input_id, submit_id){
        $(submit_id).submit(function() {
            var valids  = 0;
            //################  Validate input #############//
            $.each(input_id, function (i, val) {
                if($(val).val() == '' || $(val).val() == null ){
                    $(val).addClass("input-valid");
                    valids++;
                }
            });
           
            if(valids == 0){
                return true;
            }else{
                return false;
            }
            //return false;
        });
    }

    function CorperationEditeEleChange(element_id, base_url){
        $.each(element_id, function (i, val) {
            switch(val){
                case '#tel':
                    $(val+"-validat").hide();
                    $(val).change(function(){ 
                        var tels = $(val).val();
                        if(tels != '' ){
                            if(tels.length != 10){
                                $(val).addClass("input-valid");
                                $(val+"-validat").html("หมายเลขมือถือ ไม่ให้ถูกต้อง");
                                $(val+"-validat").show();
    
                            }else{
                                $(val+"-validat").html(" ");
                                $(val).removeClass("input-valid");
                                $(val+"-validat").hide();
                            }
                        }else{
                            $(val+"-validat").html(" ");
                            $(val).removeClass("input-valid");
                            $(val+"-validat").hide();
                        }
                    });
                break;
                default:
                    $(val).change(function(){ 
                        $(val).removeClass("input-valid");
                    });
                    break;
            }
        });
    }

    function CorperationCreatSubmit(input_id, submit_id){
        $(submit_id).submit(function() {
            var valids  = 0;
            //################  Validate input #############//
            $.each(input_id, function (i, val) {
                if($(val).val() == '' || $(val).val() == null ){
                    $(val).addClass("input-valid");
                    valids++;
                }
            });
           
            if(valids == 0){
                return true;
            }else{
                return false;
            }
            //return false;
        });
    }

    function CorperationEleChange(element_id, base_url){
        $.each(element_id, function (i, val) {
            switch(val){
                case '#idcard':
                    $(val+"-validat").hide();
                    $(val).change(function(){ 
                        $(val).removeClass("input-valid");
                        var idcard = $(val).val();
                        var num = idcard.split("-");
                        var id ="";
                        for (i = 0; i < num.length; i++) {
                            id += num[i];
                        }
                        
                        if(id != ''){
                            var url = base_url+"admin/customer/getCustomerByIdcard";
                            validateIdcards(id, url, val);
                        }else{
                            $(val).removeClass("input-valid");
                            $(val+"-validat").html(" ");
                            $(val+"-validat").hide();
                        }
                    });
                break;
                case '#tel':
                    $(val+"-validat").hide();
                    $(val).change(function(){ 
                        var tels = $(val).val();
                        if(tels != '' ){
                            if(tels.length != 10){
                                $(val).addClass("input-valid");
                                $(val+"-validat").html("หมายเลขมือถือ ไม่ให้ถูกต้อง");
                                $(val+"-validat").show();
    
                            }else{
                                $(val+"-validat").html(" ");
                                $(val).removeClass("input-valid");
                                $(val+"-validat").hide();
                            }
                        }else{
                            $(val+"-validat").html(" ");
                            $(val).removeClass("input-valid");
                            $(val+"-validat").hide();
                        }
                    });
                break;
                default:
                    $(val).change(function(){ 
                        $(val).removeClass("input-valid");
                    });
                    break;
            }
        });
    }
     //##############################################// 

     //##################### Mechanic #########################// 

     function getAnddrawCharng(url_getRes, replacePosition, searchJson){
        $(replacePosition).html(null);
        var res = jsonMechanic(url_getRes, searchJson);
        var srting = '';
        $.each(res, function (i, val) {
            var t = i+1;
            srting += '<tr>';
            srting += '<td>'+t+'</td>';
            srting += '<td>'+val['charng_code']+'</td>';
            srting += '<td>'+val['name']+' '+val['sname']+'</td>';
            srting += '<td>'+val['idcard']+'</td>';
            srting += '<td>'+val['tel']+'</td>';
            srting += '<td>'+val['email']+'</td>';
            srting += '<td class=" last"  style="text-align: center;">';
            srting +=   '<a href="'+base_url+'admin/mechanic/edit/'+val['charng_code']+' "  data-toggle="tooltip" title="แก้ไข">';
            srting +=       '<button type="button" class="btn btn-round btn-warning" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-wrench"></i></button>';
            srting +=   '</a>';
            srting +=   '<a href="'+base_url+'admin/mechanic/detail/'+val['charng_code']+' " data-toggle="tooltip" title="รายละเอียด">';
            srting +=       '<button type="button" class="btn btn-round btn-info" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-file-text-o"></i></button>';
            srting +=   '</a>';
            srting +=   '<a href="'+base_url+'admin/mechanic/PDF/'+val['charng_code']+' " target="_blank" style="padding-right: 3px;padding-left: 3px;" data-toggle="tooltip" title="PDF">';
            srting +=       '<button type="button" class="btn btn-round btn-dark" style="width: inherit; font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-print"></i></button>';
            srting +=   '</a>';
            srting += '</td>';
            srting += '</tr>';
        });
        
        $(replacePosition).append(srting);
    }

    function jsonMechanic(url, searchJson){
        var res = null;
        $.ajax({
            url: url, //ทำงานกับไฟล์นี้
            data: {
                'Search':searchJson
                },  
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {  res = data; },
            error: function(xhr, status, exception) { }
        });
        return res;
    };

    function CharngCreatSubmit(input_id, submit_id){
        $(submit_id).submit(function() {
            var valids  = 0;
            //################  Validate input #############//
            
            $.each(input_id, function (i, val) {
                if($(val).val() == '' || $(val).val() == null ){
                    $(val).addClass("input-valid");
                    valids++;
                }
            });
    
            if(valids == 0){
                return true;
            }else{
                return false;
            }
            //return false;
        });
    }

    function IdcardChecked(val, url){
        $(val+"-validat").hide();
        $(val).change(function(){ 
            $(val).removeClass("input-valid");
            var idcard = $(val).val();
            var num = idcard.split("-");
            var id ="";
            for (i = 0; i < num.length; i++) {
                id += num[i];
            }
            
            if(id != ''){
                validateIdcards(id, url, val);
            }else{
                $(val).removeClass("input-valid");
                $(val+"-validat").html(" ");
                $(val+"-validat").hide();
            }
        }); 
    }

    function CharngEditSubmit(input_id, submit_id){
        $(submit_id).submit(function() {
            var valids  = 0;
            //################  Validate input #############//
            
            $.each(input_id, function (i, val) {
                if($(val).val() == '' || $(val).val() == null ){
                    $(val).addClass("input-valid");
                    valids++;
                }
            });
            if(valids == 0){
                return true;
            }else{
                return false;
            }
            //return false;
        });
    }
    
     //##############################################// 


//##################### Agent #########################// 

    function getAnddrawAgent(url_getRes, replacePosition, searchJson){
        $(replacePosition).html(null);
        var res = jsonMechanic(url_getRes, searchJson);
        var srting = '';
        $.each(res, function (i, val) {
            var t = i+1;
            srting += '<tr>';
            srting += '<td>'+t+'</td>';
            srting += '<td>'+val['agent_code']+'</td>';
            srting += '<td>'+val['name']+' '+val['sname']+'</td>';
            srting += '<td>'+val['idcard']+'</td>';
            srting += '<td>'+val['tel']+'</td>';
            srting += '<td>'+val['email']+'</td>';
            srting += '<td class=" last"  style="text-align: center;">';
            srting +=   '<a href="'+base_url+'admin/agent/edit/'+val['agent_code']+' " data-toggle="tooltip" title="แก้ไข" >';
            srting +=       '<button type="button" class="btn btn-round btn-warning" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-wrench"></i></button>';
            srting +=   '</a>';
            srting +=   '<a href="'+base_url+'admin/agent/PDF/'+val['agent_code']+' " target="_blank" style="padding-right: 3px;padding-left: 3px;"  data-toggle="tooltip" title="PDF">';
            srting +=       '<button type="button" class="btn btn-round btn-dark" style="width: inherit; font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-print"></i></button>';
            srting +=   '</a>';
            srting +=   '<a href="'+base_url+'admin/agent/premise/'+val['agent_code']+' " data-toggle="tooltip" title="หลักฐาน">';
            srting +=       '<button type="button" class="btn btn-round btn-info" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-file-image-o"></i></button>';
            srting +=   '</a>';
            srting += '</td>';
            srting += '</tr>';
        });
        
        $(replacePosition).append(srting);
    }

    function AgentCreatSubmit(input_id, submit_id){
        $(submit_id).submit(function() {
            var valids  = 0;
            //################  Validate input #############//
            
            $.each(input_id, function (i, val) {
                if($(val).val() == '' || $(val).val() == null ){
                    $(val).addClass("input-valid");
                    valids++;
                }
            });

            if(valids == 0){
                return true;
            }else{
                return false;
            }
            //return false;
        });
    }

    function AgentEditSubmit(input_id, submit_id){
        $(submit_id).submit(function() {
            var valids  = 0;
            //################  Validate input #############//
            
            $.each(input_id, function (i, val) {
                if($(val).val() == '' || $(val).val() == null ){
                    $(val).addClass("input-valid");
                    valids++;
                }
            });
            if(valids == 0){
                return true;
            }else{
                return false;
            }
            //return false;
        });
    }
     //##############################################// 


//##################### Premise  #########################// 

    function getpremise(url, refcode, replacePosition, insertController, mode){
        var temp = replacePosition.split("-"); // find element id
        var res = getResPremise(url, refcode, temp[1]);
        drawPremise(res, refcode, replacePosition, temp[1], insertController, mode);
    }

    function getResPremise(url, refcode, elementId){
        var res = null;
        $.ajax({
            url: url, //ทำงานกับไฟล์นี้
            data: {
                "ref_code" : refcode,
                "element_id" : elementId
            },  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                res = data;
            },
            error: function(xhr, status, exception) {  console.log(exception); }
        });
        return res;
    }

    function drawPremise(data, refcode, replacePosition, elementId, insertController, mode){
        $(replacePosition).html(null);
        var srting = '';
        var maxItem = data.length+1;
        //var mainUrl = window.location.origin+'/hirepurchase';
        var mainUrl = window.location.origin;

        if(window.location.hostname == 'localhost'){mainUrl = mainUrl+'/evorent'}
    
        $.each(data, function (i, val) {
            var imgPath = mainUrl+'/'+val['path'];
            var imgId = val['ref_code']+'-'+val['element_id']+'-'+val['no'];
            srting += '<div class="col-md-2 col-sm-2 premise-items">';
            srting += '<span id="'+val['premise_code']+'" src="'+val['path']+'" url="'+window.location.href+'"  class="thumnails-premise-del premise-del">X</span>';
            srting += '<img class="thumnails-premise premise-view" id="'+imgId+'" src="'+imgPath+'?random='+Math.random()+'" alt="image" style="border: 1px #08080759 solid;" />';
            srting += '</div>';
        });
        srting += '<div class="col-md-2 col-sm-2 premise-items">';
        srting += '<form id="'+elementId+maxItem+'-form" class="" action="'+insertController+'" method="post"  enctype="multipart/form-data" novalidate>';
        srting += '<input id="refcode" name="refcode" type="hidden" value="'+refcode+'"/>';
        srting += '<input id="mode" name="mode" type="hidden" value="'+mode+'"/>';
        srting += '<input id="no" name="no" type="hidden" value="'+maxItem+'"/>';
        srting += '<input id="elementID" name="elementID" type="hidden" value="'+elementId+'"/>';
        srting += '<img id="'+elementId+maxItem+'" browsid="input-'+elementId+maxItem+'" class="thumnails-premise premise-add" src="'+mainUrl+'/uploaded/DocumentTh.png" alt="image" style="border: 1px #08080759 solid;" />';
        srting += '<input id="input-'+elementId+maxItem+'" name="input-'+elementId+maxItem+'" type="file" required="required"  style="display:none" >';
        srting += '</form>';
        srting += '</div>';

        $(replacePosition).append(srting);
    }

    function browsImgAndInsert(files, place, submit_id){
        $("#"+files).trigger('click');
        $("#"+files).change(function(){
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#'+place).attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
                $(submit_id).submit();
            }
        });
    }

    function AddPremise(premiseAdd){
        $(premiseAdd).click(function () {
            var attr = $(this)['context']['attributes'];
            var files = attr['browsid'].value;
            browsImgAndInsert(files, this.id, '#'+this.id+'-form');
        });
    }
    function viewPremise(premiseView, modelPlace){
        $(premiseView).click(function () {
            $(modelPlace).html(null);
            var id = this.id;
            var path = $('#'+id).attr('src');
            var strModal = ModalPremise(path);
            $(modelPlace).prepend(strModal);
            $('#modal1').modal('show');
        });
    }
    function ModalPremise(path){
        var strModal = '<div class="modal fade premise-modal" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
        strModal += '<div class="modal-dialog modal-lg" role="document">';
        strModal += '<div class="modal-content">';
        strModal += '   <div class="modal-body mb-0 p-0">';
        strModal += '       <img src="'+path+'" alt="Norway" style="width:100%;">';
        strModal += '   </div>';
        strModal += '   <div class="modal-footer justify-content-center">';
        strModal += '       <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>';
        strModal += '   </div>';
        strModal += '</div>';
        strModal += '</div>';
        strModal += '</div>';
        return strModal;
    }
    function delPremise(Delclass, delController){
        $(Delclass).click(function () {
            var id = $('#'+this.id);
           
            var path = id.attr('src');
            var url = id.attr('url');
            var confirmed = window.confirm("Do you want to delete ?");
            if(confirmed){
                $.ajax({
                    url: delController, //ทำงานกับไฟล์นี้
                    data: { 'premise_code':this.id, 'path':path, 'url':url},  //ส่งตัวแปร
                    type: "POST",
                    dataType: 'json',
                    async:false,
                    success: function(data, status) {
                        if(data['status']){
                            window.location=data['path'];
                        }else{
                            window.alert("Delete fail Please try again.");
                        }
                    },
                    error: function(xhr, status, exception) { console.log(xhr); }
                });
            }
        });
    }

//##############################################//

//##################### LOAN #########################// 

 function getLoanRes(resObj, searchEle, pageObj){
    var res = null;
    var searchJson = SearchJson(searchEle);
    $(resObj["elementTable"]).html(null);
    $.ajax({
        url: resObj["getRes"], //ทำงานกับไฟล์นี้
        data: { 'Search':searchJson, 'itemStt':pageObj['itemStt'], 'itemEnd':pageObj['itemEnd']},  //ส่งตัวแปร
        type: "POST",
        dataType: 'json',
        async:false,
        success: function(data, status) {
            //console.log(data);
            
            var tr = null;
            if(data.length > 0){
                $.each(data, function (i, val) {
                    tr += '<tr class="even pointer">';
                    tr += '<td class="a-center ">'+val['RowNum']+'</td>';
                    tr += '<td class=" ">'+val['temp_code']+'</td>';
                    tr += '<td class=" ">'+val['firstname']+' '+val['lastname']+'</td>';
                    tr += '<td class=" ">'+val['product_name']+'</td>';
                    tr += '<td class=" " style="text-align: center;">'+val['rental_period']+'</td>';
                    tr += '<td class=" last"  style="text-align: center;">';
                    tr +=   '<a href="'+base_url+'admin/loan/edit/'+val['temp_code']+' ">';
                    tr +=       '<button type="button" class="btn btn-round btn-warning" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-wrench"></i> Edit</button>';
                    tr +=   '</a>';
                    tr +=   '<a href="'+base_url+'admin/loan/detail/'+val['temp_code']+' ">';
                    tr +=       '<button type="button" class="btn btn-round btn-info" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-file-text-o"></i> View</button>';
                    tr +=   '</a>';
                    tr += '</td>';
                    tr += '</tr>';
                });
            }
            $(resObj["elementTable"]).append(tr);
            
        },
        error: function(xhr, status, exception) { console.log(xhr); }
    });
}

//##############################################//

//##################### Pagination  #########################// 

    function Pagination(allObj, searchEle, pageObj, resObj){
        $(pageObj['pagination']).html(null);
        $(pageObj['pagination']).attr('page', 1);
        var numAll = getNumAll(allObj["getAll"], searchEle);
       
        var AllPage = Math.ceil(numAll/pageObj['ItemPerPage']) //ปัดขึ้น;
        //-----------html pagination------------//
    
        $(pageObj['pagination']).html(null);

        var btnPage = '';
        btnPage += '<div class="row">';
        btnPage += '<div  class="col-8">';
        btnPage += '<button id="suspend-left"  type="button" class="btn btn-success btn-paginations" disabled><i class="fa fa-chevron-left"></i></button>';
        for (let index = 1; index <= AllPage; index++) {
            btnPage += '<button id="'+index+'"  type="button" class="btn btn-warning btn-paginations ">'+index+'</button>';
        }
        btnPage += '<button id="suspend-next"  type="button" class="btn btn-success btn-paginations" disabled><i class="fa fa-chevron-right"></i></button>';
        btnPage += '</div>';
        btnPage += '<div  class="col-4">';
        
        btnPage += '<div  id="currentPage" style="float: right;"> <strong>Page :</strong> 1   <strong style="margin-left: 5px;">Of :</strong> '+AllPage+'  <strong style=" margin-left: 15px;">Item </strong> : '+numAll+'</div>';


        btnPage += '</div>';
        btnPage += '</div>';
        
        $(pageObj['pagination']).append(btnPage);
        if(AllPage > 1){
            $("#suspend-next").removeAttr('disabled');
        }
        $('#1').addClass('focus-paginations');

        //-----------btn click------------//
        $('.btn-paginations').click(function(){
            var paged = parseInt($("#pagination").attr("page"));
            if(paged != this.id){
                switch(this.id){
                    case'suspend-left': paged = parseInt(paged)-1; break;
                    case'suspend-next':paged = parseInt(paged)+1; break;
                    default: paged = parseInt(this.id); break;
                }

                $("#pagination").attr("page",paged);
                
                if(paged == 1 ){
                    $("#suspend-left").attr('disabled','disabled');
                    $("#suspend-next").removeAttr('disabled');
                }

                if( paged > 1 && paged < AllPage){
                    $("#suspend-left").removeAttr('disabled');
                    $("#suspend-next").removeAttr('disabled');
                }

                if( paged == AllPage){
                    $("#suspend-left").removeAttr('disabled');
                    $("#suspend-next").attr('disabled','disabled');
                }

                $('.btn-paginations').removeClass('focus-paginations');
                $('#'+paged).addClass('focus-paginations');

                $('#currentPage').html('<strong>Page :</strong> '+paged+ ' <strong style="margin-left: 5px;">Of :</strong> '+AllPage+ ' <strong style="margin-left: 15px;">Item :</strong> '+numAll);



                pageObj['itemStt'] = ((pageObj['ItemPerPage']*paged)-pageObj['ItemPerPage'])+1;
                pageObj['itemEnd'] = pageObj['ItemPerPage']*paged;

                window[allObj["functionResName"]](resObj, searchEle, pageObj); //call res functions
            }


        });
    }

    function getNumAll(url_getAll, searchEle){
        var numAll = null;
        var searchJson = SearchJson(searchEle);
        $.ajax({
            url: url_getAll, //ทำงานกับไฟล์นี้
            data: {  'Search':searchJson },  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {numAll = data[0].allitems;
            },
            error: function(xhr, status, exception) {  }
        });
        return numAll;
    }

//##############################################//

function ChangeRemoveValidClass(element_id){
    $.each(element_id, function (i, val) {
        $(val).change(function(){ 
            $(val).removeClass("input-valid");
        });
    });
}


//##################### Loan Over due #########################// 

function getLoanOverDueToTeble(url_getRes, searchArray, itemPerPage,itemStt,itemEnd, elementtable){
    var res = getOverDueReportRes(url_getRes, searchArray, itemPerPage,itemStt,itemEnd, elementtable);
    
    var td = null;
    $(elementtable).html(null);
    $.each(res, function (i, val) {
        var styles = '';
        var SMSkeyword = '';
        switch(val.overdue_code){
            case 10: styles =' style="color: #ec0505;" '; SMSkeyword ='บริการแจ้งเตือน '+val.overdue;break;
            case 5: styles =' style="color: #ec3e05;" '; SMSkeyword ='บริการแจ้งยอด ก่อนครบกำหนดชำระ 5 วัน ';break;
            case 4: styles =' style="color: #ec6805;" '; SMSkeyword ='บริการแจ้งยอด ก่อนครบกำหนดชำระ 4 วัน ';break;
            case 3: styles =' style="color: #ec7e05;" '; SMSkeyword ='บริการแจ้งยอด ก่อนครบกำหนดชำระ 3 วัน ';break;
            case 2: styles =' style="color: #ec9305;" '; SMSkeyword ='บริการแจ้งยอด ก่อนครบกำหนดชำระ 2 วัน ';break;
            case 1: styles =' style="color: #dcbb09;" '; SMSkeyword ='บริการแจ้งยอด ก่อนครบกำหนดชำระ 1 วัน ';break;
            case 0: styles =' style="color: #dcbb09;" '; SMSkeyword ='บริการแจ้ง ครบกำหนดชำระ ';break;
            default:styles =''; SMSkeyword = '';break;
        }

        td += "<tr>";
        td += " <td>"+val.RowNum+"</td>";
        td += " <td>"+val.customer_code+"</td>";
        td += " <td>"+val.firstname+" "+val.lastname+"</td>";
        td += " <td>"+val.temp_code+"</td>";
        td += " <td>"+val.installment_payment+"</td>";
        td += " <td>"+ formatDate(val.payment_duedate,'-')+"</td>";
        td += " <td>"+ formatDate(val.extend_duedate,'-')+"</td>";
        td += " <td  "+styles+">"+val.overdue+"</td>";

        var payment_amount = (val.payment_amount == null) ? '' :val.payment_amount;
        td += " <td>"+ payment_amount+"</td>";

        var amount_deff = (val.amount_deff == null || val.amount_deff == 0 ) ? '' :val.amount_deff;
        td += " <td>"+ amount_deff+"</td>";
        td += " <td>"+ formatDate(val.installment_date,'-')+"</td>";

        var remark = (val.remark == null) ? '' :val.remark;
        td += " <td>"+remark+"</td>";
        td += " <td style='color: #fff; text-align: center;background-color:"+val.background_color+";padding-right: .2rem;padding-left: .2rem;'>"+val.label+"</td>";

        td += '<td class=" last"  style="text-align: center;padding-right: .2rem;padding-left: .2rem;">';
        if(val.status_code == 0 && val.installment_payment > 0){
            var jsons = "{'temp_code':'"+val.temp_code+"', 'period':'"+val.period+"', 'payment':'"+val.installment_payment+"'}";
            td += '     <button id="period'+val.RowNum+'" onclick="editModal('+jsons+')" type="button" class="btn btn-round btn-warning edit-button" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;" data-toggle="tooltip" title="แก้ไข">';
            td += '         <i class="fa fa-wrench"></i>';
            td += '     </button>';
        }
       
        var sendsms = (val.sendsms == 1) ? 'disabled' :'';
        if(val.status_code == 0 && val.installment_payment > 0 && val.overdue != ''){
            var jsons = "{ 'customer_code':'"+val.customer_code+"', 'customer':'"+val.firstname+' '+val.lastname+"', 'temp_code':'"+val.temp_code+"', 'period':'"+val.period+"', 'payment':'"+val.installment_payment+"', 'keywords':'"+SMSkeyword+"', 'duedate':'"+formatDateDMY(val.payment_duedate,'/')+"', 'tel':'"+val.tel+"'}";
            td += '     <button '+sendsms+' id="period'+val.RowNum+'" onclick="messageModal('+jsons+')" type="button" class="btn btn-round btn-info edit-button" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;" data-toggle="tooltip" title="ส่ง sms">';
            td += '         <i class="fa fa-send"></i>';
            td += '     </button>';
        }
        td += '</td>';

        
        //td += '<td class=" last"  style="text-align: center;">';
        //td +=   '<a href="'+base_url+'admin/loan/edit/'+val.id+' ">';
        //td +=       '<button type="button" class="btn btn-round btn-warning" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-wrench"></i> Edit</button>';
        //td +=   '</a>';
        //td +=   '<a href="'+base_url+'admin/customer/detail/'+val['customer_code']+' ">';
        //td +=       '<button type="button" class="btn btn-round btn-info" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-file-text-o"></i> View</button>';
        //td +=   '</a>';
        //td += '</td>';

        td += "</tr>";
    });
    $(elementtable).append(td);  
}

function getLoanOverDueReportRes(url_getRes, searchArray, itemPerPage,itemStt,itemEnd, elementtable){
    var res = null;
    $.ajax({
        url: url_getRes, //ทำงานกับไฟล์นี้
        data: {
            "searchArray" :searchArray,
            "itemPerPage" : itemPerPage, 
            "itemStt" : itemStt,
            "itemEnd" : itemEnd
        }, //ส่งตัวแปร
        type: "POST",
        dataType: 'json',
        async:false,
        success: function(data, status) {
            res = data;
        },
        error: function(xhr, status, exception) { 
            //console.log(exception);
        }
    });
    return res;
};

function getLoanOverDueToExport(url, searchArray, pdfEle, excelEle){
    
    $.ajax({
        url: url, //ทำงานกับไฟล์นี้
        data: {
            "searchArray" :searchArray
        }, //ส่งตัวแปร
        type: "POST",
        dataType: 'json',
        async:false,
        success: function(data, status) {
            var json = JSON.stringify(data);
            $(pdfEle).val(json);
            $(excelEle).val(json);
            //res = data;
        },
        error: function(xhr, status, exception) { 
            //console.log(exception);
        }
    });
    //return res;
};

function getLoanOverDuereportAll(url_getAll, searchArray, itemPerPage,itemStt,itemEnd){
    $.ajax({
        url: url_getAll, //ทำงานกับไฟล์นี้
        data: { 
            "searchArray" :searchArray,
            "itemPerPage" : itemPerPage, 
            "itemStt" : itemStt,
            "itemEnd" : itemEnd
        },  //ส่งตัวแปร
        type: "POST",
        dataType: 'json',
        async:false,
        success: function(data, status) {
            $("#reportAll").val(data[0].allitems); 
        },
        error: function(xhr, status, exception) {  }
    });
}

function LoanOverDuepagination(location,AllItems,ItemPerPage, page, searchArray){
    $(location).html(null);
    var CAllItem = AllItems;
    var Cpage = Math.ceil(CAllItem/ItemPerPage) //ปัดขึ้น;
    
    //var Cpage = 12 //ปัดขึ้น;
    //-----------html pagination------------//
   
    $(location).html(null);
    var btnPage = '<button id="suspend-left"  type="button" class="btn btn-success btn-paginations" disabled><i class="fa fa-chevron-left"></i></button>';
    for (let index = 1; index <= Cpage; index++) {
        btnPage += '<button id="'+index+'"  type="button" class="btn btn-warning btn-paginations ">'+index+'</button>';
    }
    btnPage += '<button id="suspend-next"  type="button" class="btn btn-success btn-paginations" disabled><i class="fa fa-chevron-right"></i></button>';
    $(location).append(btnPage);

    $('#1').addClass('focus-paginations');
    if(Cpage > 1){ $("#suspend-next").removeAttr('disabled');}

    //-----------btn click------------//
    $('.btn-paginations').click(function(){
        var paged = parseInt($(page).val());
        switch(this.id){
            case'suspend-left': paged = parseInt(paged)-1; break;
            case'suspend-next':paged = parseInt(paged)+1; break;
            default: paged = parseInt(this.id); break;
        }

        if(paged > 1){ $("#suspend-left").removeAttr('disabled');}
        if(paged == 1){ $("#suspend-left").attr('disabled','disabled');}
        if(paged == Cpage){ $("#suspend-next").attr('disabled','disabled');}
        if(paged < Cpage){ $("#suspend-next").removeAttr('disabled');}

        $(page).val(paged);

        if(paged == parseInt($(page).val())){ $('.btn-paginations').removeClass('focus-paginations'); $('#'+paged).addClass('focus-paginations');}
        
        var itemStt = ((ItemPerPage*paged)-ItemPerPage)+1;
        var itemEnd = ItemPerPage*paged;

        getLoanOverDueToTeble(url_getRes, searchArray, ItemPerPage,itemStt,itemEnd, elementtable)
    });
}


function formatDateDMY(date, string) {
    if(date != '' && date != null){
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [day, month, year].join(string);
    }else{
        return '';
    }
}

function formatDateYMD(date, string) {
    if(date != '' && date != null){
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [year, month, day].join(string);
    }else{
        return '';
    }
}

//##################### SMS #########################// 
function getSMSRes(resObj, searchEle, pageObj){
    var searchJson = SearchJson(searchEle);
    $(resObj["elementTable"]).html(null);
   
    $.ajax({
        url: resObj["getRes"], //ทำงานกับไฟล์นี้
        data: { 'Search':searchJson, 'itemStt':pageObj['itemStt'], 'itemEnd':pageObj['itemEnd']},  //ส่งตัวแปร
        type: "POST",
        dataType: 'json',
        async:false,
        success: function(data, status) {
            var tr = null;
            if(data.length > 0){
                var num = 1;
                $.each(data, function (i, val) {
                    var staus = '';
                    (val['status'])? staus = 'สำเร็จ':staus ='ไม่สำเร็จ';
                    tr += '<tr class=" ">';
                    tr += '<td style="width: 1rem !important">'+val['RowNum']+'</td>';
                    tr += '<td style="width: 2rem !important">'+val['customer_code']+'</td>';
                    tr += '<td style="width: 7rem !important">'+val['firstname']+' '+val['lastname']+'</td>';
                    tr += '<td style="width: 2rem !important">'+val['temp_code']+'</td>';
                    tr += '<td style="width: 3rem !important">'+val['tel']+'</td>';
                    tr += '<td style="width: 30rem !important">'+val['message']+'</td>';
                    tr += '<td style="width: 3rem !important">'+staus+'</td>';
                    tr += '<td style="width: 5rem !important">'+val['cdate']+'</td>';
                    
                    //tr += '<td class=" last"  style="text-align: center;">';
                    //tr +=   '<a href="'+base_url+'admin/customer/edit/'+val['customer_code']+' " data-toggle="tooltip" title="แก้ไข">';
                    //tr +=       '<button type="button" class="btn btn-round btn-warning" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-wrench"></i></button>';
                    //tr +=   '</a>';
                    //tr +=   '<a href="'+base_url+'admin/customer/detail/'+val['customer_code']+' " data-toggle="tooltip" title="รายละเอียด">';
                    //tr +=       '<button type="button" class="btn btn-round btn-info" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-file-text-o"></i></button>';
                    //tr +=   '</a>';
                    //tr +=   '<a href="'+base_url+'admin/customer/premise/'+val['customer_code']+' " data-toggle="tooltip" title="หลักฐาน">';
                    //tr +=       '<button type="button" class="btn btn-round btn-success" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;"><i class="fa fa-file-image-o"></i></button>';
                    //tr +=   '</a>';
                    //tr += '</td>';
                    
                    tr += '</tr>';
                    num++;
                });
            }
            $(resObj["elementTable"]).append(tr);
            
        },
        error: function(xhr, status, exception) { 
            //console.log(xhr);
        }
    });
}



//##################### Report Contract #########################// 

function getContractToTeble(url_getRes, searchArray, itemPerPage,itemStt,itemEnd, elementtable){
    var res = getContractReportRes(url_getRes, searchArray, itemPerPage,itemStt,itemEnd, elementtable);
    
    var td = null;
    $(elementtable).html(null);
    $.each(res, function (i, val) {
        td += "<tr>";
        td += " <td>"+val.RowNum+"</td>";
        td += " <td>"+val.temp_code+"</td>";
        td += " <td>"+val.customer_code+"</td>";
        td += " <td>"+val.firstname+" "+val.lastname+"</td>";
        td += " <td>"+val.product_name+"</td>";
        td += " <td>"+val.brand_name+"</td>";
        td += " <td>"+val.monthly_rent+"</td>";
        td += " <td>"+val.contract_date+"</td>";
        td += " <td>"+val.tel+"</td>";
        td += '</td>';

        td += "</tr>";
    });
    $(elementtable).append(td);  
    
}
function getContractReportRes(url_getRes, searchArray, itemPerPage,itemStt,itemEnd, elementtable){
    var res = null;
    $.ajax({
        url: url_getRes, //ทำงานกับไฟล์นี้
        data: {
            "searchArray" :searchArray,
            "itemPerPage" : itemPerPage, 
            "itemStt" : itemStt,
            "itemEnd" : itemEnd
        }, //ส่งตัวแปร
        type: "POST",
        dataType: 'json',
        async:false,
        success: function(data, status) {
            res = data;
        },
        error: function(xhr, status, exception) { 
            //console.log(exception);
        }
    });
    return res;
};
function getContractreportAll(url_getAll, searchArray, itemPerPage,itemStt,itemEnd){
    $.ajax({
        url: url_getAll, //ทำงานกับไฟล์นี้
        data: { 
            "searchArray" :searchArray,
            "itemPerPage" : itemPerPage, 
            "itemStt" : itemStt,
            "itemEnd" : itemEnd
        },  //ส่งตัวแปร
        type: "POST",
        dataType: 'json',
        async:false,
        success: function(data, status) {
            $("#reportAll").val(data[0].allitems); 
        },
        error: function(xhr, status, exception) {  }
    });
}
function reportContractpagination(location,AllItems,ItemPerPage, page, searchArray){
    $(location).html(null);
    var CAllItem = AllItems;
    var Cpage = Math.ceil(CAllItem/ItemPerPage) //ปัดขึ้น;
    
    //var Cpage = 12 //ปัดขึ้น;
    //-----------html pagination------------//
   
    $(location).html(null);
    var btnPage = '<button id="suspend-left"  type="button" class="btn btn-success btn-paginations" disabled><i class="fa fa-chevron-left"></i></button>';
    for (let index = 1; index <= Cpage; index++) {
        btnPage += '<button id="'+index+'"  type="button" class="btn btn-warning btn-paginations ">'+index+'</button>';
    }
    btnPage += '<button id="suspend-next"  type="button" class="btn btn-success btn-paginations" disabled><i class="fa fa-chevron-right"></i></button>';
    $(location).append(btnPage);

    $('#1').addClass('focus-paginations');
    if(Cpage > 1){ $("#suspend-next").removeAttr('disabled');}

    //-----------btn click------------//
    $('.btn-paginations').click(function(){
        var paged = parseInt($(page).val());
        switch(this.id){
            case'suspend-left': paged = parseInt(paged)-1; break;
            case'suspend-next':paged = parseInt(paged)+1; break;
            default: paged = parseInt(this.id); break;
        }

        if(paged > 1){ $("#suspend-left").removeAttr('disabled');}
        if(paged == 1){ $("#suspend-left").attr('disabled','disabled');}
        if(paged == Cpage){ $("#suspend-next").attr('disabled','disabled');}
        if(paged < Cpage){ $("#suspend-next").removeAttr('disabled');}

        $(page).val(paged);

        if(paged == parseInt($(page).val())){ $('.btn-paginations').removeClass('focus-paginations'); $('#'+paged).addClass('focus-paginations');}
        
        var itemStt = ((ItemPerPage*paged)-ItemPerPage)+1;
        var itemEnd = ItemPerPage*paged;

        getContractToTeble(url_getRes, searchArray, ItemPerPage,itemStt,itemEnd, elementtable)
    });
}

function formatDate(date, string) {
    if(date != '' && date != null){
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [year, month, day].join(string);
    }else{
        return '';
    }
}


//##################### PrductSet #########################// 
// List
function DrawProductSetList(base_url, searchEle, replacePosition){
    var searchJson = ProductSetSearchJson(searchEle);
    var res = getResProductSet(base_url, searchJson);
    if(res){ 
        var elements = '';
        $(replacePosition).html(null);
        $.each(res, function (i, val) {
            var no = i+1;
            var agrmt = ["'"+base_url+"', '"+val.product_id+"'"];
            elements += '<tr>';
            elements += '   <td class="">'+no+'</td>';
            elements += '   <td class="">'+val.product_id+'</td>';
            elements += '   <td class="">'+val.product_name+'</td>';
            elements += '   <td class="">'+val.product_pricce+'</td>';
            elements += '   <td class="">'+val.brand_name+'</td>';
            elements += '   <td class="">'+val.cate_name+'</td>';
            //elements += '   <td class="">'+val.product_detail+'</td>';
            elements += '   <td class="">'+val.customer_type+'</td>';
            elements += '   <td class="">'+val.contract_type+'</td>';
            elements += '   <td class="" style="text-align: center;">';
            elements += '       <a href="'+base_url+'admin/productSet/edit/'+val.product_id+' ">';
            elements += '           <button type="button" class="btn btn-round btn-warning" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;">';
            elements += '           <i class="fa fa-wrench"></i> แก้ไข</button>';
            elements += '       </a>';
            //elements += '       <a href="'+base_url+'admin/productCategory/delete/'+val['id']+' ">';
            elements += '           <button type="button" class="btn btn-round btn-danger" onclick="delProductSet('+agrmt+')" style=" font-size: 13px; padding: 0 15px; margin-bottom: inherit;">';
            elements += '           <i class="fa fa-times"></i> ลบ</button>';
            //elements += '       </a>';
            elements += '   </td>';
            elements += '</tr>';
        });
        $(replacePosition).append(elements);
    }
}

function SearchProductSetList(base_url, btn_event, searchEle, replacePosition){
    $(btn_event).click(function () {
        DrawProductSetList(base_url, searchEle, replacePosition);
    });
}

function ResetProductSetList(base_url, btn_event, searchEle, replacePosition){
    $(btn_event).click(function () {
        DrawProductSetList(base_url, null, replacePosition);
        $.each(searchEle, function (i, val) {
            $(val).val(null);
        });
    });
};
function ProductSetSearchJson(searchEle){
    search = {};
    $.each(searchEle, function (i, val) {
        var resEle = $(val).val();
        var objKey = $(val).attr('id');
        search[objKey] = resEle;
    });
    return  JSON.stringify(search);
}
function getResProductSet(base_url, search){
    var res = null;
    $.ajax({
        url: base_url+"admin/productSet/getResProductSet", //ทำงานกับไฟล์นี้
        data:  {
            'Search':search
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


// Create
function ProductSetInstallmentPlusAdd(eventBtn, placeInstall, amountEle){
    $(eventBtn).click(function () {
        var amount = parseInt($(amountEle).val())+1;
        var InstallmentDeletAgrument = "'#installment-format-row-"+amount+"', '"+amountEle+"' ";
        var elem = '<div class="field item form-group" id="installment-format-row-'+amount+'">';
        elem += '<label class="col-form-label col-md-3 col-sm-3  label-align"></label>';
        elem += '<div class="col-md-2 col-sm-2"><input type="number" step="1" min="1" value="1" class="form-control" name="installment-amount'+amount+'" id="installment-amount'+amount+'" /></div>';
        elem += '<div class="col-md-2 col-sm-2"><input type="number" step="1" min="100" value="100" class="form-control" name="installment-pay'+amount+'" id="installment-pay'+amount+'" /></div>';
        elem += '<div class="col-md-2 col-sm-2">';
        elem += '<label for="province-current"></label>';
        elem += '<div style="position: absolute;bottom: 1px;">';
        elem += '   <button type="button" onclick="ProductSetInstallmentDeletAdd('+InstallmentDeletAgrument+')" id="installment-delete'+amount+'" class="btn btn-warning" style="margin-bottom: inherit;">';
        elem += '       <i class="fa fa-minus-square-o"></i>';
        elem += '   </button>';
        elem += '</div>';
        elem += '</div>';
        elem += '</div>';
        //elem += '';
       $(amountEle).val(amount);
       $(placeInstall).append(elem);
       ProductSetInstallmentEleChangeAdd(amountEle); 
    });
    
}
function ProductSetInstallmentDeletAdd(placeInstall, amountEle){
    var amount = parseInt($(amountEle).val())-1;
    $(placeInstall).remove();
    $(amountEle).val(amount);
    ProductSetInstallmentEleChangeAdd(amountEle); 
}
function ProductSetInstallmentEleChangeAdd(amount){
    var res = $(amount).val();
    var installment_amount_id = '#installment-amount'+res;
    $(installment_amount_id).change(function() {
        if(this.value  == ''  || this.value  == null){
            $(installment_amount_id).addClass("input-valid");
        }else{
            $(installment_amount_id).removeClass("input-valid");
        }
    });

    var installment_pay_id = '#installment-pay'+res;
    $(installment_pay_id).change(function() {
        if(this.value  == ''  || this.value  == null){
            $(installment_pay_id).addClass("input-valid");
        }else{
            $(installment_pay_id).removeClass("input-valid");
        }
    });
}

function ProductSetCreateSubmit(submitRequireEle, formId){
    $(formId).submit(function() {
        var valids  = 0;
        $.each(submitRequireEle, function (i, val) {
            switch(val){
                case "#installment-format-amount":
                    var res = $(val).val();
                    for(i = 1; i<= res; i++){

                        var installment_amount_id = '#installment-amount'+i;
                        var installment_amount_val = $(installment_amount_id).val();
                        if(installment_amount_val == '' || installment_amount_val == null){
                            $(installment_amount_id).addClass("input-valid");
                            valids++;
                        }else{
                            $(installment_amount_id).removeClass("input-valid");
                        }

                        var installment_pay_id = '#installment-pay'+i;
                        var installment_pay_val = $(installment_pay_id).val();
                        if(installment_pay_val == ''  || installment_pay_val == null){
                            $(installment_pay_id).addClass("input-valid");
                            valids++;
                        }else{
                            $(installment_pay_id).removeClass("input-valid");
                        }
                    }
                    break;
                default:
                    if($(val).val() == '' || $(val).val() == null ){
                        $(val).addClass("input-valid");
                        valids++;
                    }
                    break;
            }
        });
                
        if(valids == 0){
            return true;
        }else{
            return false;
        }
        //return false;
    });
}
function ProductSetEleChange(RequireEle){
    $.each(RequireEle, function (i, val) {
        $(val).change(function() {
            if(this.value != '' || this.value  != null){
                if(i == 0){// '#product-id'
                    $(val).parent().children('button').removeClass("input-valid");
                }else{
                    $(val).removeClass("input-valid");
                }
            }
        });
    });
}


// Edit 
function ProductSetInstallmentPlus(eventBtn, placeInstall, amountEle){
    $(placeInstall).html('');
    $(eventBtn).click(function () {
        var amount = parseInt($(amountEle).val())+1;
        var InstallmentDeletAgrument = "'#installment-format-row-"+amount+"', '"+amountEle+"' ";
        var elem = '<div class="field item form-group" id="installment-format-row-'+amount+'">';
        elem += '<div class="col-md-5 col-sm-5"><input type="number" step="1" min="1" value="1" class="form-control" name="installment-amount'+amount+'" id="installment-amount'+amount+'" /></div>';
        elem += '<div class="col-md-5 col-sm-5"><input type="number" step="1" min="100" value="100" class="form-control" name="installment-pay'+amount+'" id="installment-pay'+amount+'" /></div>';
        elem += '<div class="col-md-2 col-sm-2">';
        elem += '<label for="province-current"></label>';
        elem += '<div style="position: absolute;bottom: 1px;">';
        elem += '   <button type="button" onclick="ProductSetInstallmentDelet('+InstallmentDeletAgrument+')" id="installment-delete'+amount+'" class="btn btn-warning" style="margin-bottom: inherit;">';
        elem += '       <i class="fa fa-minus-square-o"></i>';
        elem += '   </button>';
        elem += '</div>';
        elem += '</div>';
        elem += '</div>';
        //elem += '';
       $(amountEle).val(amount);
       $(placeInstall).append(elem);
       ProductSetInstallmentEleChange(amountEle); 
    });
    
}
function ProductSetInstallmentDelet(placeInstall, amountEle){
    var amount = parseInt($(amountEle).val())-1;
    $(placeInstall).remove();
    $(amountEle).val(amount);
    ProductSetInstallmentEleChange(amountEle); 
}
function ProductSetInstallmentEleChange(amount){
    var res = $(amount).val();
    var installment_amount_id = '#installment-amount'+res;
    $(installment_amount_id).change(function() {
        if(this.value  == ''  || this.value  == null){
            $(installment_amount_id).addClass("input-valid");
        }else{
            $(installment_amount_id).removeClass("input-valid");
        }
    });

    var installment_pay_id = '#installment-pay'+res;
    $(installment_pay_id).change(function() {
        if(this.value  == ''  || this.value  == null){
            $(installment_pay_id).addClass("input-valid");
        }else{
            $(installment_pay_id).removeClass("input-valid");
        }
    });
}
function ProductSetInstallmentSubmit(submitRequireEle, formId){
    
    $(formId).submit(function() {
        var valids  = 0;
        var res = $(submitRequireEle).val();
        for(i = 1; i<= res; i++){

            var installment_amount_id = '#installment-amount'+i;
            var installment_amount_val = $(installment_amount_id).val();
            if(installment_amount_val == '' || installment_amount_val == null){
                $(installment_amount_id).addClass("input-valid");
                valids++;
            }else{
                $(installment_amount_id).removeClass("input-valid");
            }

            var installment_pay_id = '#installment-pay'+i;
            var installment_pay_val = $(installment_pay_id).val();
            if(installment_pay_val == ''  || installment_pay_val == null){
                $(installment_pay_id).addClass("input-valid");
                valids++;
            }else{
                $(installment_pay_id).removeClass("input-valid");
            }
        }
            //console.log(valids);    
        if(valids == 0){
            return true;
        }else{
            return false;
        }
        //return false;
    });
}
function editProductSetInstallment(base_url, id, amount, pay) {
    $('#amount_installment').val(amount);
    $('#amount_installment').removeClass("input-valid");

    $('#pay_per_month').val(pay);
    $('#pay_per_month').removeClass("input-valid");

    $('#productSet-installment-edit-id').val(id);

    $('#EditInstallmentType').modal();
}

function editProductSetInstallmentSubmit(submitRequireEle, formId){
    $(formId).submit(function() {
        var valids  = 0;
        $.each(submitRequireEle, function (i, val) {
            var el = $(val).val();
            if(el == '' || el == null){
                $(val).addClass("input-valid");
                valids++;
            }else{
                $(val).removeClass("input-valid");
            }
        });

        if(valids == 0){
            return true;
        }else{
            return false;
        }
        //return false;
    });
}


function editProductSet_sub(data) {
    $("#product-sub-type-edit :selected").prop('selected', false);
    $('#productSet-sub-edit-id').val(data.id);
    $('#product_master_id_edit').val(data.product_name);
    $('#productSub-count-edit').val(data.count);
    $("#product-sub-type-edit option[value='" + data.type +"']").attr("selected","selected");

    $("#edit-active-serial option[value='" + data.active_serial +"']").removeAttr("selected");
    $("#edit-active-serial option[value='" + data.active_serial +"']").attr("selected","selected");

    $('#EditSubProductModal').modal();
}


// Delete 


function delProductSet(base_url, id) {
    if (confirm('คุณต้องการที่จะลบสินค้า รหัส '+id+' จริงหรือไม่ ?')) {
        DeleteProductSet(base_url, id);
    } 
}

function DeleteProductSet(base_url, id){
    $.ajax({
        url: base_url+"admin/productSet/DeleteProductSet", //ทำงานกับไฟล์นี้
        data:  {
            'id':id
        },  //ส่งตัวแปร
        type: "POST",
        dataType: 'json',
        async:false,
        success: function(data, status) {
            window.location.href = base_url+"admin/productSet";
            
        },
        error: function(xhr, status, exception) { 
            console.log(exception);
        }
    });
}


function delProductSetInstallment(base_url, id, period, pay, productSet_id) {
    if (confirm('คุณต้องการที่จะลบรูปแบบการผ่อนชำระ จำนวนงวดที่ผ่อนชำระ '+period+' งวด และจำนวนเงินผ่อน '+pay+' บาท ต่องวด จริงหรือไม่ ?')) {
        deleteProductSetInstallment(base_url, id, productSet_id);
    } 
}
function deleteProductSetInstallment(base_url, id, productSet_id){
    var res = null;
    $.ajax({
        url: base_url+"admin/productSet/delProductSetInstallment", //ทำงานกับไฟล์นี้
        data:  {
            'id':id
            },  //ส่งตัวแปร
        type: "POST",
        dataType: 'json',
        async:false,
        success: function(data, status) {
            if(data){
                window.location.href = base_url+"admin/productSet/edit/"+productSet_id;
            }
        },
        error: function(xhr, status, exception) { 
            console.log(exception);
        }
    });
};


function delProductSet_sub(base_url, id, code, productSet_id) {
    if (confirm('คุณต้องการที่จะลบสินค้าย่อย รหัส '+code+' จริงหรือไม่ ?')) {
       deleteProductSet_sub(base_url, id, productSet_id);
    } 
}
function deleteProductSet_sub(base_url, id, productSet_id){
    var res = null;
    $.ajax({
        url: base_url+"admin/productSet/delProductSet_sub", //ทำงานกับไฟล์นี้
        data:  {
            'productSet_sub_id':id,'productSet_id':productSet_id
            },  //ส่งตัวแปร
        type: "POST",
        dataType: 'json',
        async:false,
        success: function(data, status) {
            if(data){
                window.location.href = base_url+"admin/productSet/edit/"+productSet_id;
            }
        },
        error: function(xhr, status, exception) { 
            console.log(exception);
        }
    });
};


//#########################################################// 
    
