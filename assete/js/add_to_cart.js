
function ajaxaddToCartMember(product_id , amount , is_replace = false){
    if(user_id != 0){
    $.ajax({
        type: 'POST',
        url: base_url + 'Cart/add_to_cart_member',
        data: {  product_id: product_id,amount:amount,is_replace:is_replace },
        success: function (response) {
            console.log('Data sent successfully:', response);
            if (response.status = true) {
                // ลบบรรทัดในตาราง (table)
               
                var res = JSON.parse(response);
              
                            // เลือกทุก element ที่มี classname 'cart-count'
                    var cartCountElements = document.getElementsByClassName('cart-count');

                    // วนลูปผ่าน elements ทั้งหมดที่เลือกไว้
                    for (var i = 0; i < cartCountElements.length; i++) {
                        cartCountElements[i].innerText = res.sum_amt;
                    }


                localStorage.clear();
            }
        },
        error: function (xhr, status, error) {
            console.error('Error sending data:', error);

        }
    });
    }
}
function addToCart(product_id , clickedButton = null) {
    var amount = $("#number_" + product_id).val(); // ดึงค่าจำนวนสินค้าจาก input


    // แสดงข้อความสำหรับผู้ใช้ (ในที่นี้คือแสดง alert)
    if (user_id != 0) {
        
        ajaxaddToCartMember(product_id,amount);
    } else {

        // ดึงข้อมูลจาก localStorage และแปลงเป็น object หรือสร้าง object ใหม่ถ้าไม่มีข้อมูล
        var cartData = JSON.parse(localStorage.getItem('cartData')) || {};

        // ตรวจสอบว่าสินค้านี้มีอยู่ในตะกร้าแล้วหรือไม่
        if (cartData.hasOwnProperty(product_id)) {
            // มีอยู่แล้ว ให้เพิ่มจำนวนสินค้าเข้าไป
            cartData[product_id].amount = parseInt(cartData[product_id].amount) + parseInt(amount);
        } else {
            // ไม่มีอยู่ในตะกร้า ให้สร้างใหม่
            cartData[product_id] = {
                amount: parseInt(amount)
            };
        }



        // บันทึกข้อมูลลงใน localStorage
        localStorage.setItem('cartData', JSON.stringify(cartData));

        // อัปเดตจำนวนสินค้าในตะกร้าที่แสดงบนหน้าเว็บ
      
        var currentCount = 0;
        var cartCountElements = document.getElementsByClassName('cart-count');

        // วนลูปผ่าน elements ทั้งหมดที่เลือกไว้
        for (var i = 0; i < cartCountElements.length; i++) {
            currentCount = parseInt(cartCountElements[i].innerText);
        }


        var newCount = currentCount + parseInt(amount);

        // เลือกทุก element ที่มี classname 'cart-count'
        var cartCountElement2 = document.getElementsByClassName('cart-count');

        // วนลูปผ่าน elements ทั้งหมดที่เลือกไว้
        for (var i = 0; i < cartCountElement2.length; i++) {
            cartCountElement2[i].innerText = newCount;
        }


        // if (clickedButton) {
         
        //     flyToCartAnimation(clickedButton);
        // }
        
    }
}


/**
 * ฟังก์ชันสร้าง Animation ให้ Object ลอยไปยังตัวเลขบอกจำนวนสินค้า (#cart-count)
 * @param {HTMLElement} clickedButton - ปุ่ม 'เพิ่มไปยังรถเข็น' ที่ถูกคลิก (ใช้หาพิกัดเริ่มต้น)
 */
// ต้องวางโค้ดนี้ใน <script> หรือในไฟล์ JS ที่โหลดก่อน addToCart
function flyToCartAnimation(clickedButton) {
    const flyer = document.createElement('div');
    flyer.classList.add('fly-to-cart-item');
    document.body.appendChild(flyer);

    const cartTarget = document.getElementById('cart-count'); 
    
    if (!cartTarget) {
        console.error('Target cart count element (id="cart-count") not found!');
        flyer.remove();
        return;
    }

    // A. ตำแหน่งเริ่มต้น (ปุ่มที่ถูกคลิก)
    const startRect = clickedButton.getBoundingClientRect();
    const startX = startRect.left + startRect.width / 2 - 10; 
    const startY = startRect.top + startRect.height / 2 - 10;
    
    // B. ตำแหน่งเป้าหมาย (#cart-count)
    const targetRect = cartTarget.getBoundingClientRect();
    const targetX = targetRect.left + targetRect.width / 2 - 10;
    const targetY = targetRect.top + targetRect.height / 2 - 10;

    // 1. กำหนดสไตล์เริ่มต้น (ตำแหน่ง)
    flyer.style.left = `${startX}px`;
    flyer.style.top = `${startY}px`;
   
    // 2. เริ่ม Animation
    setTimeout(() => {
        flyer.style.transform = `translate(${targetX - startX}px, ${targetY - startY}px)`;
        flyer.style.opacity = '0.5';
        flyer.style.width = '0px'; 
        flyer.style.height = '0px';
    }, 50);
    
    // 3. ลบ Element เมื่อ Animation เสร็จสิ้น
    flyer.addEventListener('transitionend', () => {
        flyer.remove();
    });
}
function countTotalStorage(){
    var cartData = JSON.parse(localStorage.getItem('cartData')) || {};

    // คำนวณจำนวนสินค้าทั้งหมด
    var totalItems = 0;
    if(cartData){
        for (var key in cartData) {
            if (cartData.hasOwnProperty(key)) {
                totalItems += parseInt(cartData[key].amount);
            }
        }
       
      
          // เลือกทุก element ที่มี classname 'cart-count'
          var cartCountElement = document.getElementsByClassName('cart-count');

          // วนลูปผ่าน elements ทั้งหมดที่เลือกไว้
          for (var i = 0; i < cartCountElement.length; i++) {
              cartCountElement[i].innerText = totalItems;
          }
  
        

        

        
    }
}
function increaseValue(id) {
    var value = parseInt(document.getElementById('number_' + id).value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('number_' + id).value = value;


}
function WithUpdatePrice(id , event){
 
        if(user_id == 0){
            var value = parseInt(document.getElementById('number_' + id).value, 10);
            value = isNaN(value) ? 0 : value;
           
            document.getElementById('number_' + id).value = value;


            var priceTxt = $("#price_" + id).text();
            // Remove commas from $total before parsing
            var totalString = priceTxt.toString();
            var totalWithoutCommas = totalString.replace(/,/g, '');

            $total = value * parseFloat(totalWithoutCommas);
            var formattedTotal = $total.toLocaleString();
            $("#total_" + id).text(formattedTotal);

            updateTotal();
            updatePrice();

            var cartData = JSON.parse(localStorage.getItem('cartData')) || {};

            // ตรวจสอบว่าสินค้านี้มีอยู่ในตะกร้าแล้วหรือไม่
            if (cartData.hasOwnProperty(id)) {
                // ลบข้อมูลใน localStorage
                cartData[id].amount = value;

                // บันทึกข้อมูลกลับไปยัง Local Storage
                localStorage.setItem('cartData', JSON.stringify(cartData));

                countTotalStorage();

            }
        }else{
            var value = parseInt(document.getElementById('number_' + id).value, 10);
            value = isNaN(value) ? 0 : value;
            document.getElementById('number_' + id).value = value;

        

            var priceTxt = $("#price_" + id).text();
            // Remove commas from $total before parsing
            var totalString = priceTxt.toString();
            var totalWithoutCommas = totalString.replace(/,/g, '');

            $total = value * parseFloat(totalWithoutCommas);
            var formattedTotal = $total.toLocaleString();
            $("#total_" + id).text(formattedTotal);

            updateTotal();
            updatePrice();

            ajaxaddToCartMember(id,value , true);
        }
    
}
function increaseValueWithUpdatePrice(id) {

    if(user_id == 0){
        var value = parseInt(document.getElementById('number_' + id).value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        document.getElementById('number_' + id).value = value;


        var priceTxt = $("#price_" + id).text();
        // Remove commas from $total before parsing
        var totalString = priceTxt.toString();
        var totalWithoutCommas = totalString.replace(/,/g, '');

        $total = value * parseFloat(totalWithoutCommas);
        var formattedTotal = $total.toLocaleString();
        $("#total_" + id).text(formattedTotal);

        updateTotal();
        updatePrice();

        var cartData = JSON.parse(localStorage.getItem('cartData')) || {};

        // ตรวจสอบว่าสินค้านี้มีอยู่ในตะกร้าแล้วหรือไม่
        if (cartData.hasOwnProperty(id)) {
            // ลบข้อมูลใน localStorage
            cartData[id].amount = value;

             // บันทึกข้อมูลกลับไปยัง Local Storage
            localStorage.setItem('cartData', JSON.stringify(cartData));

            countTotalStorage();

        }
    }else{
        
       

        var value = parseInt(document.getElementById('number_' + id).value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        document.getElementById('number_' + id).value = value;

      

        var priceTxt = $("#price_" + id).text();
        // Remove commas from $total before parsing
        var totalString = priceTxt.toString();
        var totalWithoutCommas = totalString.replace(/,/g, '');

        $total = value * parseFloat(totalWithoutCommas);
        var formattedTotal = $total.toLocaleString();
        $("#total_" + id).text(formattedTotal);

        updateTotal();
        updatePrice();

        ajaxaddToCartMember(id,value , true);
    }
    
}

function sumValuesByClassName(className) {
    // Select all elements with the specified class name
    var elements = document.querySelectorAll('.' + className);

    // Initialize a variable to store the sum
    var sum = 0;

    // Loop through each element and add its value or text content to the sum
    elements.forEach(function (element) {
        // Check if the element is an <input> or <span>
        if (element.tagName === 'INPUT') {
            // If it's an <input>, add its value to the sum
            sum += parseInt(element.value) || 0; // Handle NaN (Not a Number) cases
        } else if (element.tagName === 'SPAN') {
            // If it's a <span>, add its text content to the sum
            var priceTxt = element.textContent.trim();
            if (!priceTxt) {
                sum += 0;
            } else {
                // Remove commas from $total before parsing
                var totalString = priceTxt.toString();
                var totalWithoutCommas = totalString.replace(/,/g, '');

                sum += parseFloat(totalWithoutCommas) || 0; // Handle NaN (Not a Number) cases
            }

        }
    });

    // Return the total sum
    return sum;
}



function decreaseValueWithUpdatePrice(id) {

    if(user_id == 0){
            var value = parseInt(document.getElementById('number_' + id).value, 10);
            value = isNaN(value) ? 0 : value;
            value < 1 ? value = 1 : '';
            value--;
            if (value < 1) {
                value = 1;
            }
            document.getElementById('number_' + id).value = value;

            var priceTxt = $("#price_" + id).text();
            // Remove commas from $total before parsing
            var totalString = priceTxt.toString();
            var totalWithoutCommas = totalString.replace(/,/g, '');

            $total = value * parseFloat(totalWithoutCommas);
            var formattedTotal = $total.toLocaleString();
            $("#total_" + id).text(formattedTotal);

            updateTotal();
            updatePrice();

            var cartData = JSON.parse(localStorage.getItem('cartData')) || {};
            // ตรวจสอบว่าสินค้านี้มีอยู่ในตะกร้าแล้วหรือไม่
            if (cartData.hasOwnProperty(id)) {
                // ลบข้อมูลใน localStorage
                cartData[id].amount = value;

                   // บันทึกข้อมูลกลับไปยัง Local Storage
               localStorage.setItem('cartData', JSON.stringify(cartData));

               countTotalStorage();
    
            }
    }else{
        var value = parseInt(document.getElementById('number_' + id).value, 10);
        value = isNaN(value) ? 0 : value;
        value < 1 ? value = 1 : '';
        value--;
        if (value < 1) {
            value = 1;
        }
        document.getElementById('number_' + id).value = value;

        var priceTxt = $("#price_" + id).text();
        // Remove commas from $total before parsing
        var totalString = priceTxt.toString();
        var totalWithoutCommas = totalString.replace(/,/g, '');

        $total = value * parseFloat(totalWithoutCommas);
        var formattedTotal = $total.toLocaleString();
        $("#total_" + id).text(formattedTotal);

        updateTotal();
        updatePrice();

        ajaxaddToCartMember(id,value , true);
    }

}

function updateTotal() {
    var totalSum = sumValuesByClassName('numberCart');
    var formattedTotal = totalSum.toLocaleString();
    $("#totalSum").text(formattedTotal);
}

function updatePrice() {
    var totalPrice = sumValuesByClassName('total_price');


    var formattedTotal = totalPrice.toLocaleString();


    $("#priceAmount").text(formattedTotal);
}
function decreaseValue(id) {
    var value = parseInt(document.getElementById('number_' + id).value, 10);
    value = isNaN(value) ? 0 : value;
    value < 1 ? value = 1 : '';
    value--;
    if (value < 1) {
        value = 1;
    }
    document.getElementById('number_' + id).value = value;
}

function removeStorageCartData(product_id, user_id) {
    if (user_id == 0) {
        var cartData = JSON.parse(localStorage.getItem('cartData')) || {};

        // ตรวจสอบว่าสินค้านี้มีอยู่ในตะกร้าแล้วหรือไม่
        if (cartData.hasOwnProperty(product_id)) {
            // ลบข้อมูลใน localStorage
            delete cartData[product_id];
            localStorage.setItem('cartData', JSON.stringify(cartData));

            // ลบบรรทัดในตาราง (table)
            var tr = document.getElementById('tr_' + product_id);
            if (tr) {
                tr.remove(); // หรือใช้ tr.parentNode.removeChild(tr);
            }
            updateTotal();
            updatePrice();

            countTotalStorage();
        }

    } else {
        delete_data_member(product_id, user_id);
    }
}
function delete_data_member(product_id, user_id) {

    $.ajax({
        type: 'POST',
        url: base_url + 'Cart/delete_data_member',
        data: { user_id: user_id, product_id: product_id },
        success: function (response) {
            console.log('Data sent successfully:', response);
            if (response.status = true) {
                // ลบบรรทัดในตาราง (table)
                var tr = document.getElementById('tr_' + product_id);
                if (tr) {
                    tr.remove(); // หรือใช้ tr.parentNode.removeChild(tr);
                }

                updateTotal();
                updatePrice();
                getAmount();
            }
        },
        error: function (xhr, status, error) {
            console.error('Error sending data:', error);

        }
    });



}
function getCartData(base_url) {
    // ดึงข้อมูลจาก localStorage และแปลงเป็น object หรือสร้าง object ใหม่ถ้าไม่มีข้อมูล
    var cartData = JSON.parse(localStorage.getItem('cartData')) || {};
    
    if (cartData && user_id == 0) {
        $.ajax({
            type: 'POST',
            url: base_url + 'Cart/get_data',
            data: cartData,
            success: function (response) {
                console.log('Data sent successfully:', response);
                // ทำสิ่งที่คุณต้องการหลังจากส่งข้อมูลไปยังเซิร์ฟเวอร์เรียบร้อย
                var jsonData = JSON.parse(response);
                // เลือกตำแหน่งที่จะใส่ข้อมูลใน HTML
                var tbody = $('#cart-table-body');

                // วนลูปผ่านข้อมูลที่ได้จาก JSON
                jsonData.data.forEach(function (item) {
                    // สร้างแถวของตาราง
                    var row = $('<tr id="tr_' + item.product_id + '">');

                    var contents = `<div class="form-increase d-flex">
                        <button class="value-button btn btn-light mt-auto" id="decrease_${item.product_id}" onclick="decreaseValueWithUpdatePrice(${item.product_id})" value="Decrease Value">-</button>
                        <input type="number"  id="number_${item.product_id}" onkeyup="if (event.keyCode >= 48 && event.keyCode <= 57) WithUpdatePrice(${item.product_id}, this);"  class="numberCart form-control mt-auto" value="${item.amount}" style="-webkit-appearance: none; margin: 0;width:45px;height:40px;">
                        <button class="value-button btn btn-light mt-auto" id="increase_${item.product_id}" onclick="increaseValueWithUpdatePrice(${item.product_id})" value="Increase Value">+</button>
                     </div>`;
                    item.thumnal = item.thumnal.replace('./', '');

                    row.append('<td><img class="hide-on-mobile" src="' + base_url + item.thumnal + '" alt="product image" style="max-width: 133px; height: auto;"> ' + item.name + '</td>');
                    var price = parseFloat(item.price);
                    var formattedprice = price.toLocaleString();

                    row.append('<td><span id="price_' + item.product_id + '">' + formattedprice + '</span>&nbsp;บาท</td>');

                    row.append('<td>' + contents + '</td>');

                    var total_price = parseFloat(item.total_price);
                    var formattedTotal = total_price.toLocaleString();


                    row.append('<td><span  id="total_' + item.product_id + '" class="total_price">' + formattedTotal + '</span>&nbsp;บาท</td>');

                    row.append('<td style="text-align:center;"><span style="cursor:pointer;" onclick="removeStorageCartData(' + item.product_id + ' , ' + user_id + ')">ลบ</span></td>');


                    tbody.append(row);
                });

                updateTotal();
                updatePrice();
            },
            error: function (xhr, status, error) {
                console.error('Error sending data:', error);

            }
        });
    } else {
        if (user_id != 0) {
            $.ajax({
                type: 'POST',
                url: base_url + 'Cart/get_data_member',
                data: { user_id: user_id },
                success: function (response) {
                    console.log('Data sent successfully:', response);
                    // ทำสิ่งที่คุณต้องการหลังจากส่งข้อมูลไปยังเซิร์ฟเวอร์เรียบร้อย
                    var jsonData = JSON.parse(response);
                    // เลือกตำแหน่งที่จะใส่ข้อมูลใน HTML
                    var tbody = $('#cart-table-body');

                    // วนลูปผ่านข้อมูลที่ได้จาก JSON
                    jsonData.data.forEach(function (item) {
                        // สร้างแถวของตาราง
                        var row = $('<tr id="tr_' + item.product_id + '">');

                        var contents = `<div class="form-increase d-flex">
                            <button class="value-button btn btn-light mt-auto" id="decrease_${item.product_id}" onclick="decreaseValueWithUpdatePrice(${item.product_id})" value="Decrease Value">-</button>
                            <input type="number"  id="number_${item.product_id}" onkeyup="if (event.keyCode >= 48 && event.keyCode <= 57) WithUpdatePrice(${item.product_id}, this);" class="numberCart form-control mt-auto" value="${item.amount}" style="-webkit-appearance: none; margin: 0;width:45px;height:40px;">
                            <button class="value-button btn btn-light mt-auto" id="increase_${item.product_id}" onclick="increaseValueWithUpdatePrice(${item.product_id})" value="Increase Value">+</button>
                         </div>`;
                        item.thumnal = item.thumnal.replace('./', '');

                        row.append('<td><img class="hide-on-mobile" src="' + base_url + item.thumnal + '" alt="product image" style="max-width: 133px; height: auto;"> ' + item.name + '</td>');
                        var price = parseFloat(item.price);
                        var formattedprice = price.toLocaleString();

                        row.append('<td><span id="price_' + item.product_id + '">' + formattedprice + '</span>&nbsp;บาท</td>');

                        row.append('<td>' + contents + '</td>');

                        var total_price = parseFloat(item.total_price);
                        var formattedTotal = total_price.toLocaleString();


                        row.append('<td><span  id="total_' + item.product_id + '" class="total_price">' + formattedTotal + '</span>&nbsp;บาท</td>');

                        row.append('<td style="text-align:center;"><span style="cursor:pointer;" onclick="removeStorageCartData(' + item.product_id + ' , ' + user_id + ')">ลบ</span></td>');


                        tbody.append(row);
                    });

                    updateTotal();
                    updatePrice();
                },
                error: function (xhr, status, error) {
                    console.error('Error sending data:', error);

                }
            });
        }
    }


}

function getCartMember(base_url , order_id = null) {
    // ดึงข้อมูลจาก localStorage และแปลงเป็น object หรือสร้าง object ใหม่ถ้าไม่มีข้อมูล
        if(user_id != 0 && order_id != null && order_id != 0){
            $.ajax({
                type: 'POST',
                url: base_url + 'Cart/get_data_member_by_orderId',
                data: { user_id: user_id , order_id:order_id },
                success: function (response) {
                    console.log('Data sent successfully:', response);
                    // ทำสิ่งที่คุณต้องการหลังจากส่งข้อมูลไปยังเซิร์ฟเวอร์เรียบร้อย
                    var jsonData = JSON.parse(response);
                    // เลือกตำแหน่งที่จะใส่ข้อมูลใน HTML
                    var tbody = $('#cart-table-body');

                    // วนลูปผ่านข้อมูลที่ได้จาก JSON
                    var total_amount_with_ship = 0;
                    var totalAmount = 0;
                    jsonData.data.forEach(function (item) {
                        console.log(item);
                        var html = "<div class='row'>";
                            html += '<div class="col-md-6 col-12" >';
                                html += '<img class="hide-on-mobile" src="' + base_url + item.thumnal + '" alt="product image" style="max-width: 133px; height: auto;"> ' + item.name;
                            // 
                            html += '</div>';
                            html += '<div class="col-md-2 col-12" style="display:flex;align-items:center;">';
                               var price = parseFloat(item.price);
                               var formattedprice = price.toLocaleString();
                               html += '<span  id="price_' + item.product_id + '">' + formattedprice + '</span>&nbsp;บาท';

                        // row.append('<td><span id="price_' + item.product_id + '">' + formattedprice + '</span>&nbsp;บาท</td>');
                            html += '</div>';
                            html += '<div class="col-md-2 col-6" style="display:flex;align-items:center;">';
                            html += '<span  id="amount_' + item.product_id + '"> จำนวน ' + item.amount + '</span>';
                            html += '</div>';
                            html += '<div class="col-md-2 col-6" style="display:flex;align-items:center;">';
                                var amount = parseInt(item.amount);
                                totalAmount += amount;
                                var total = price * amount;
                                total_amount_with_ship += total +350;
                                var formattedpricetotal = total.toLocaleString();
                                html += '<span  id="total_' + item.product_id + '"> ราคา ' + formattedpricetotal + '&nbsp;บาท</span>';
                            html += '</div>';
                        html += '</div>';
               
                        $("#cartContainer").append(html);


                    });
                  
                    var html = '';

                    // เริ่มต้นสร้าง HTML ของ footerDivPayment โดยใช้ Bootstrap Grid System
                    html += '<div id="footerDivPayment" class="row justify-content-end">';
                    html += '    <div class="col-md-3">'; // ให้ div อยู่ทางขวา 6 คอลัมน์ใน md screen (medium)
                    
                    html += '        <div><label style="color:#005EB8;">ค่าจัดส่งสินค้า</label><span>&nbsp;350 บาท</span></div>';
                    html += '        <div><label style="color:red;font-size:12px;" >*ส่งในจังหวัดกรุงเทพฯฟรี</label></div>';
                    html += '        <div><label style="color:red;font-size:12px;">*ต่างจังหวัด 350 บาททั่วประเทศ</label></div>';
                   
                    var formattedtotal_amount_with_ship = total_amount_with_ship.toLocaleString();
                    html += '        <div><label>ราคารวมค่าจัดส่ง</label><span class="total_amount_with_ship"> ' + formattedtotal_amount_with_ship + ' บาท</span></div>';
                    html += '<input type="hidden" name="paymentDetail" id="paymentDetail" attr-totalamount="'+totalAmount+'" attr-totalwithship="'+total_amount_with_ship+'" />';
                    html += '    </div>'; // ปิด div ของ col-md-6
                    html += '</div>'; // ปิด div ของ footerDivPayment
                    
                    // นำ HTML ที่สร้างไปใช้งาน
                    console.log(html); // ตรวจสอบ HTML ที่สร้างใน console หรือนำไปใช้ต่อไป
                    
                       

                            
                            setTimeout(
                                // วนลูปผ่าน elements เพื่อเปลี่ยนข้อความในแต่ละ element
                                updateTotalPayment(formattedtotal_amount_with_ship  ,totalAmount)
                            , 2000);
                           

                            
                        html += '</div>';
                    html += "</div>";
                    $("#cartContainer").append(html);
                },
                error: function (xhr, status, error) {
                    console.error('Error sending data:', error);

                }
            });
        }
        if (user_id != 0 && (order_id == 0)) {
            $.ajax({
                type: 'POST',
                url: base_url + 'Cart/get_data_member',
                data: { user_id: user_id },
                success: function (response) {
                    console.log('Data sent successfully:', response);
                    // ทำสิ่งที่คุณต้องการหลังจากส่งข้อมูลไปยังเซิร์ฟเวอร์เรียบร้อย
                    var jsonData = JSON.parse(response);
                    // เลือกตำแหน่งที่จะใส่ข้อมูลใน HTML
                    var tbody = $('#cart-table-body');

                    // วนลูปผ่านข้อมูลที่ได้จาก JSON
                    var total_amount_with_ship = 0;
                    var totalAmount = 0;
                    jsonData.data.forEach(function (item) {
                        console.log(item);
                        var html = "<div class='row'>";
                            html += '<div class="col-md-6 col-12" >';
                                html += '<img class="hide-on-mobile" src="' + base_url + item.thumnal + '" alt="product image" style="max-width: 133px; height: auto;"> ' + item.name;
                            // 
                            html += '</div>';
                            html += '<div class="col-md-2 col-12" style="display:flex;align-items:center;">';
                               var price = parseFloat(item.price);
                               var formattedprice = price.toLocaleString();
                               html += '<span  id="price_' + item.product_id + '">' + formattedprice + '</span>&nbsp;บาท';

                        // row.append('<td><span id="price_' + item.product_id + '">' + formattedprice + '</span>&nbsp;บาท</td>');
                            html += '</div>';
                            html += '<div class="col-md-2 col-6" style="display:flex;align-items:center;">';
                            html += '<span  id="amount_' + item.product_id + '"> จำนวน ' + item.amount + '</span>';
                            html += '</div>';
                            html += '<div class="col-md-2 col-6" style="display:flex;align-items:center;">';
                                var amount = parseInt(item.amount);
                                totalAmount += amount;
                                var total = price * amount;
                                total_amount_with_ship += total + 350;
                                var formattedpricetotal = total.toLocaleString();
                                html += '<span  id="total_' + item.product_id + '"> ราคา ' + formattedpricetotal + '&nbsp;บาท</span>';
                            html += '</div>';
                        html += '</div>';
               
                        $("#cartContainer").append(html);


                    });
                  
                    var html = '';

                    // เริ่มต้นสร้าง HTML ของ footerDivPayment โดยใช้ Bootstrap Grid System
                    html += '<div id="footerDivPayment" class="row justify-content-end">';
                    html += '    <div class="col-md-3">'; // ให้ div อยู่ทางขวา 6 คอลัมน์ใน md screen (medium)
                    
                    html += '        <div><label style="color:#005EB8;">ค่าจัดส่งสินค้า</label><span>&nbsp;350 บาท</span></div>';
                    html += '        <div><label style="color:red;font-size:12px;" >*ส่งในจังหวัดกรุงเทพฯฟรี</label></div>';
                    html += '        <div><label style="color:red;font-size:12px;">*ต่างจังหวัด 350 บาททั่วประเทศ</label></div>';
                    
                    var formattedtotal_amount_with_ship = total_amount_with_ship.toLocaleString();
                    html += '        <div><label>ราคารวมค่าจัดส่ง</label><span class="total_amount_with_ship"> ' + formattedtotal_amount_with_ship + ' บาท</span></div>';
                    html += '<input type="hidden" name="paymentDetail" id="paymentDetail" attr-totalamount="'+totalAmount+'" attr-totalwithship="'+total_amount_with_ship+'" />';
                    html += '    </div>'; // ปิด div ของ col-md-6
                    html += '</div>'; // ปิด div ของ footerDivPayment
                    
                    // นำ HTML ที่สร้างไปใช้งาน
                    console.log(html); // ตรวจสอบ HTML ที่สร้างใน console หรือนำไปใช้ต่อไป
                    
                       

                            
                            setTimeout(
                                // วนลูปผ่าน elements เพื่อเปลี่ยนข้อความในแต่ละ element
                                updateTotalPayment(formattedtotal_amount_with_ship  ,totalAmount)
                            , 2000);
                           

                            
                        html += '</div>';
                    html += "</div>";
                    $("#cartContainer").append(html);
                },
                error: function (xhr, status, error) {
                    console.error('Error sending data:', error);

                }
            });
        }
    }

function updateTotalPayment(formattedtotal_amount_with_ship , totalAmount){
    $("#totalAmount").html(totalAmount);
    var elements = document.querySelectorAll('.total_amount_with_ship');
    elements.forEach(function(element) {
        element.textContent = " " +formattedtotal_amount_with_ship + " บาท";
    })
}
function addToCartMember() {
    if (user_id != 0) {
        var cartData = JSON.parse(localStorage.getItem('cartData')) || {};
        if (cartData) {
            $.ajax({
                type: 'POST',
                url: base_url + 'Cart/update_data',
                data: cartData,
                success: function (response) {
                    var res = JSON.parse(response);
                  

                      // เลือกทุก element ที่มี classname 'cart-count'
                    var cartCountElement = document.getElementsByClassName('cart-count');

                    // วนลูปผ่าน elements ทั้งหมดที่เลือกไว้
                    for (var i = 0; i < cartCountElement.length; i++) {
                        cartCountElement[i].innerText = res.sum_amt;
                    }

                    localStorage.clear();

                },
                error: function (xhr, status, error) {
                    console.error('Error sending data:', error);

                }
            });
        }
    } else {
        getAmount();
    }
}


function getAmount() {
    $.ajax({
        type: 'POST',
        url: base_url + 'Cart/getAmount',
        data: cartData,
        success: function (response) {
            var res = JSON.parse(response);
            if(res.sum_amt > 0){
                
                // เลือกทุก element ที่มี classname 'cart-count'
                var cartCountElements = document.getElementsByClassName('cart-count');

                // วนลูปผ่าน elements ทั้งหมดที่เลือกไว้
                for (var i = 0; i < cartCountElements.length; i++) {
                    cartCountElements[i].innerText = res.sum_amt;
                }

            }
           // localStorage.clear();


        },
        error: function (xhr, status, error) {
            console.error('Error sending data:', error);

        }
    });
}