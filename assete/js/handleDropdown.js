function populateProvinceSelect() {
    var provinceSelect = document.getElementById('province');
    // Clear existing options
    provinceSelect.innerHTML = '<option value="">กรุณาเลือก</option>';
    console.log(province);
    // Populate with provinces from JSON
    province.forEach(function(province) {
        var option = document.createElement('option');
        option.value = province.id;
        option.textContent = province.name_th;
        provinceSelect.appendChild(option);
    });



    console.log(province);
}

function populateProvinceCompSelect() {
    var provinceSelect = document.getElementById('provinceComp');
    // Clear existing options
    provinceSelect.innerHTML = '<option value="">กรุณาเลือก</option>';
    console.log(province);
    // Populate with provinces from JSON
    province.forEach(function(province) {
        var option = document.createElement('option');
        option.value = province.id;
        option.textContent = province.name_th;
        provinceSelect.appendChild(option);
    });



    console.log(province);
}

function populateAmphurCompSelect(provinceId) {
    var amphurSelect = document.getElementById('districtComp');
    // Clear existing options
    amphurSelect.innerHTML = '<option value="">กรุณาเลือก</option>';

    // Populate with amphurs based on selected province
    var filteredAmphurs = amphur.filter(function(item) {
        return item.province_id === provinceId;
    });
    console.log(filteredAmphurs);
    filteredAmphurs.forEach(function(amphur) {
        var option = document.createElement('option');
        option.value = amphur.id;
        option.textContent = amphur.name_th;
        amphurSelect.appendChild(option);
    });
}

function populateDistrictCompSelect(amphurId) {
    var districtSelect = document.getElementById('subdistrictComp');
    // Clear existing options
    districtSelect.innerHTML = '<option value="">กรุณาเลือก</option>';


    $.ajax({
        url: base_url + 'login/get_districts/' + amphurId, // Replace 'your_php_file.php' with the actual path to your PHP file
        type: 'GET',
        success: function(response) {
            // Handle the response here
            if (response) {
                var res = JSON.parse(response);
                res.forEach(function(district) {
                    var option = document.createElement('option');
                    option.value = district.id;
                    option.textContent = district.name_th;
                    option.setAttribute('zipcode', district.zip_code); // Set the zipcode attribute
                    districtSelect.appendChild(option);
                });

            }
        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error(xhr.responseText);
        }
    });

}
// Populate with districts based on selected amphur


function populateAmphurSelect(provinceId) {
    var amphurSelect = document.getElementById('district');
    // Clear existing options
    amphurSelect.innerHTML = '<option value="">กรุณาเลือก</option>';

    // Populate with amphurs based on selected province
    var filteredAmphurs = amphur.filter(function(item) {
        return item.province_id === provinceId;
    });
    console.log(filteredAmphurs);
    filteredAmphurs.forEach(function(amphur) {
        var option = document.createElement('option');
        option.value = amphur.id;
        option.textContent = amphur.name_th;
        amphurSelect.appendChild(option);
    });
}

function populateDistrictSelect(amphurId) {
    var districtSelect = document.getElementById('subdistrict');
    // Clear existing options
    districtSelect.innerHTML = '<option value="">กรุณาเลือก</option>';


    $.ajax({
        url: base_url + 'login/get_districts/' + amphurId, // Replace 'your_php_file.php' with the actual path to your PHP file
        type: 'GET',
        success: function(response) {
            // Handle the response here
            if (response) {
                var res = JSON.parse(response);
                res.forEach(function(district) {
                    var option = document.createElement('option');
                    option.value = district.id;
                    option.textContent = district.name_th;
                    option.setAttribute('zipcode', district.zip_code); // Set the zipcode attribute
                    districtSelect.appendChild(option);

                    
                });

            }
        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error(xhr.responseText);
        }
    });

}
// Populate with districts based on selected amphur



document.getElementById('province').addEventListener('change', function() {
    var provinceId = this.value;
    populateAmphurSelect(provinceId);
});

document.getElementById('district').addEventListener('change', function() {
    var amphurId = this.value;
    populateDistrictSelect(amphurId);
});

document.getElementById('subdistrict').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var zipcode = selectedOption.getAttribute('zipcode');
    $("#zipcode").val(zipcode);
});
if(document.getElementById('provinceComp')){
document.getElementById('provinceComp').addEventListener('change', function() {
    var provinceId = this.value;
    populateAmphurCompSelect(provinceId);
});
}
if(document.getElementById('districtComp')){
document.getElementById('districtComp').addEventListener('change', function() {
    var amphurId = this.value;
    populateDistrictCompSelect(amphurId);
});
}
if(document.getElementById('subdistrictComp')){
document.getElementById('subdistrictComp').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var zipcode = selectedOption.getAttribute('zipcode');
    $("#zipcodeComp").val(zipcode);
});
}
