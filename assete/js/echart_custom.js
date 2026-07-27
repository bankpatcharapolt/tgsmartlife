//echart THEME
 var theme = {
    color: [
        '#26B99A', '#34495E', '#BDC3C7', '#3498DB',
        '#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
    ],

    title: {
        itemGap: 8,
        textStyle: {
            fontWeight: 'normal',
            color: '#408829'
        }
    },

    dataRange: {
        color: ['#1f610a', '#97b58d']
    },

    toolbox: {
        color: ['#408829', '#408829', '#408829', '#408829']
    },

    tooltip: {
        backgroundColor: 'rgba(0,0,0,0.5)',
        axisPointer: {
            type: 'line',
            lineStyle: {
                color: '#408829',
                type: 'dashed'
            },
            crossStyle: {
                color: '#408829'
            },
            shadowStyle: {
                color: 'rgba(200,200,200,0.3)'
            }
        }
    },

    dataZoom: {
        dataBackgroundColor: '#eee',
        fillerColor: 'rgba(64,136,41,0.2)',
        handleColor: '#408829'
    },
    grid: {
        borderWidth: 0
    },

    categoryAxis: {
        axisLine: {
            lineStyle: {
                color: '#408829'
            }
        },
        splitLine: {
            lineStyle: {
                color: ['#eee']
            }
        }
    },

    valueAxis: {
        axisLine: {
            lineStyle: {
                color: '#408829'
            }
        },
        splitArea: {
            show: true,
            areaStyle: {
                color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
            }
        },
        splitLine: {
            lineStyle: {
                color: ['#eee']
            }
        }
    },
    timeline: {
        lineStyle: {
            color: '#408829'
        },
        controlStyle: {
            normal: { color: '#408829' },
            emphasis: { color: '#408829' }
        }
    },

    k: {
        itemStyle: {
            normal: {
                color: '#68a54a',
                color0: '#a9cba2',
                lineStyle: {
                    width: 1,
                    color: '#408829',
                    color0: '#86b379'
                }
            }
        }
    },
    map: {
        itemStyle: {
            normal: {
                areaStyle: {
                    color: '#ddd'
                },
                label: {
                    textStyle: {
                        color: '#c12e34'
                    }
                }
            },
            emphasis: {
                areaStyle: {
                    color: '#99d2dd'
                },
                label: {
                    textStyle: {
                        color: '#c12e34'
                    }
                }
            }
        }
    },
    force: {
        itemStyle: {
            normal: {
                linkStyle: {
                    strokeColor: '#408829'
                }
            }
        }
    },
    chord: {
        padding: 4,
        itemStyle: {
            normal: {
                lineStyle: {
                    width: 1,
                    color: 'rgba(128, 128, 128, 0.5)'
                },
                chordStyle: {
                    lineStyle: {
                        width: 1,
                        color: 'rgba(128, 128, 128, 0.5)'
                    }
                }
            },
            emphasis: {
                lineStyle: {
                    width: 1,
                    color: 'rgba(128, 128, 128, 0.5)'
                },
                chordStyle: {
                    lineStyle: {
                        width: 1,
                        color: 'rgba(128, 128, 128, 0.5)'
                    }
                }
            }
        }
    },
    gauge: {
        startAngle: 225,
        endAngle: -45,
        axisLine: {
            show: true,
            lineStyle: {
                color: [[0.2, '#86b379'], [0.8, '#68a54a'], [1, '#408829']],
                width: 8
            }
        },
        axisTick: {
            splitNumber: 10,
            length: 12,
            lineStyle: {
                color: 'auto'
            }
        },
        axisLabel: {
            textStyle: {
                color: 'auto'
            }
        },
        splitLine: {
            length: 18,
            lineStyle: {
                color: 'auto'
            }
        },
        pointer: {
            length: '90%',
            color: 'auto'
        },
        title: {
            textStyle: {
                color: '#333'
            }
        },
        detail: {
            textStyle: {
                color: 'auto'
            }
        }
    },
    textStyle: {
        fontFamily: 'Arial, Verdana, sans-serif'
    }
};

//######  echart Bar   #####//
function DashboardInstallment_chart(elem, res) {
    if (typeof (echarts) === 'undefined') { return; }
    var echartBar = echarts.init(document.getElementById(elem), theme);
    echartBar.setOption({
        title: {
            text: 'จำนวนงวดทั้งหมด '+res.total+' งวด',
            subtext: 'จำนวนงวดที่ใกล้ครบกำหนดชำระ และเกินกำหนดชำระ', 
            left: 'center'
        },
        tooltip: { trigger: 'axis'},
        //legend: { x: 200, data: ['periods']},
        toolbox: {
            show: true,
            feature: {
                saveAsImage: {
                    show: true,
                    title: "Save Image"
                }
            }
        },
        calculable: true,
        xAxis: [{
            type: 'value',
            boundaryGap: [0, 0.01]
        }],
        yAxis: [{
            type: 'category',
            data: res.labels
        }],
        tooltip: { 
            trigger: 'item',
            formatter: function (params) {
                var colorSpan = color => '<span style="display:inline-block;margin-right:5px;border-radius:10px;width:9px;height:9px;background-color:' + color + '"></span>';
                return `${colorSpan(params.color)} ${params.name} : จำนวน ${params.data} งวด`;
            }
        },
        series: [
            {
                // name: 'periods',
                type: 'bar',
                data: res.datas,
                radius: '10%',
                center: ['50%', '50%'],
            }
        ]
    });
};
function DashboardInstallmentRes(url){
    var res = null;
    $.ajax({
        url: url, //ทำงานกับไฟล์นี้
        data: {/*'contract_code':contract_code*/},  
        type: "POST",
        dataType: 'json',
        async:false,
        success: function(data, status) { res = data; },
        error: function(xhr, status, exception) { }
    });
    return res;
};


//######  echart Pie   #####//
function DashboardWebContractPie(elem, res){
    var datas = (res.datas != null) ? res.datas : [{value: 0, name: 'ไม่มีข้อมูล'}] ;
    var echartPie = echarts.init(document.getElementById(elem), theme);
    var colorPalette = ['#26b99a', '#670319'];
    echartPie.setOption({
        title: { 
            text: 'ข้อความทั้งหมด '+ res.total+' ข้อความ', 
            subtext: 'ข้อความที่ติดต่อจากหน้าเว็บไซต์ EVORENT', 
            left: 'center'
        },
        tooltip: {
            trigger: 'item',
            formatter: function (params) {
                var colorSpan = color => '<span style="display:inline-block;margin-right:5px;border-radius:10px;width:9px;height:9px;background-color:' + color + '"></span>';
                return `${colorSpan(params.color)} ${params.name} : ${params.data.value} ข้อความ ( ${params.percent}% )`;
            }
            //formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            x: 'center',
            y: 'bottom',
            data: res.legend
        },
        toolbox: {
            show: true,
            feature: {
                magicType: {
                    show: true,
                    type: ['pie', 'funnel'],
                    option: {
                        funnel: {
                            x: '25%',
                            width: '50%',
                            funnelAlign: 'left',
                            max: 1548
                        }
                    }
                },
                restore: {
                    show: true,
                    title: "Restore"
                },
                saveAsImage: {
                    show: true,
                    title: "Save Image"
                }
            }
        },
        calculable: true,
        color: colorPalette,
        series: [{
            type: 'pie',
            radius: '70%',
            center: ['50%', '50%'],
            data: datas
        }]
    });

    var dataStyle = {
        normal: {
            label: {
                show: false
            },
            labelLine: {
                show: false
            }
        }
    };

    var placeHolderStyle = {
        normal: {
            color: 'rgba(0,0,0,0)',
            label: {
                show: false
            },
            labelLine: {
                show: false
            }
        },
        emphasis: {
            color: 'rgba(0,0,0,0)'
        }
    };

    
    
};
function DashboardWebContractRes(url){
    var res = null;
    $.ajax({
        url: url, //ทำงานกับไฟล์นี้
        data: {/*'contract_code':contract_code*/},  
        type: "POST",
        dataType: 'json',
        async:false,
        success: function(data, status) { res = data; },
        error: function(xhr, status, exception) { }
    });
    return res;
};


//######  Charng Pie chart  #####//
function CharngPieChart(elem, res){
    var texted = (res != null) ? res[0].installment : 0 ;
    var subtext = (res != null) ? res[0].period : 0 ;
    var datas = (res != null) ? res[0].res : [{value: 0, name: 'ไม่มีข้อมูล'}] ;
    var legends = (res != null) ? res[0].legend : ['ไม่มีข้อมูล'] ;

    var colorPalette = ['#34495e', '#00b04f', '#a9310a','#9b59b6'];
    var echartPie = echarts.init(document.getElementById(elem), theme);
    echartPie.setOption({
        title: { 
            text: 'ชำระไปแล้วทั้งหมด '+ texted+' งวด', 
            subtext: 'จำนวนงวดที่ต้องชำระ '+ subtext +' งวด', 
            left: 'center'
        },
        tooltip: {
            trigger: 'item',
            formatter: function (params) {
                var colorSpan = color => '<span style="display:inline-block;margin-right:5px;border-radius:10px;width:9px;height:9px;background-color:' + color + '"></span>';
                return `${colorSpan(params.color)} ${params.name} ( ${params.percent}% )`;
            }
            //formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            x: 'center',
            y: 'bottom',
            data: legends
        },
        toolbox: {
            show: true,
            feature: {
                magicType: {
                    show: true,
                    type: ['pie', 'funnel'],
                    option: {
                        funnel: {
                            x: '25%',
                            width: '50%',
                            funnelAlign: 'left',
                            max: 1548
                        }
                    }
                },
                restore: {
                    show: true,
                    title: "Restore"
                },
                saveAsImage: {
                    show: true,
                    title: "Save Image"
                }
            }
        },
        calculable: true,
        color: colorPalette,
        series: [{
            type: 'pie',
            radius: '50%',
            center: ['50%', '50%'],
            data: datas
        }]
    });
};
function jsonContractToChart(url, contract_code){
    var res = null;
    $.ajax({
        url: url, //ทำงานกับไฟล์นี้
        data: {
            'contract_code':contract_code
            },  
        type: "POST",
        dataType: 'json',
        async:false,
        success: function(data, status) { 
            //เตรียมข้อมูลเพื่อทำ pie chart
            res = [{
            'period': data[0].count_period,
            'res': [
                {value: data[0].over_duedate, name: 'ชำระล่าช้า '+data[0].over_duedate+' งวด'}, 
                {value: data[0].normal_duedate, name: 'ชำระปรกติ '+data[0].normal_duedate+' งวด'},
                {value: data[0].normal_due, name: 'คงเหลือ '+data[0].normal_due+' งวด'},
                {value: data[0].over_due, name: 'ค้างชำระ '+data[0].over_due+' งวด'},
            ],
            'installment' : data[0].count_installment,
            'legend' : ['ชำระล่าช้า '+data[0].over_duedate+' งวด','ชำระปรกติ '+data[0].normal_duedate+' งวด','คงเหลือ '+data[0].normal_due+' งวด','ค้างชำระ '+data[0].over_due+' งวด']
            }];
        },
        error: function(xhr, status, exception) { }
    });
    return res;
};

//######  Customer Pie chart  #####//
function CustomerPieChart(elem, res){
    var texted = (res != null) ? res[0].installment : 0 ;
    var subtext = (res != null) ? res[0].period : 0 ;
    var datas = (res != null) ? res[0].res : [{value: 0, name: 'ไม่มีข้อมูล'}] ;
    var legends = (res != null) ? res[0].legend : ['ไม่มีข้อมูล'] ;

    var colorPalette = ['#34495e', '#00b04f', '#a9310a','#9b59b6'];
    var echartPie = echarts.init(document.getElementById(elem), theme);
    echartPie.setOption({
        title: { 
            text: 'ชำระไปแล้วทั้งหมด '+ texted+' งวด', 
            subtext: 'จำนวนงวดที่ต้องชำระ '+ subtext +' งวด', 
            left: 'center'
        },
        tooltip: {
            trigger: 'item',
            formatter: function (params) {
                var colorSpan = color => '<span style="display:inline-block;margin-right:5px;border-radius:10px;width:9px;height:9px;background-color:' + color + '"></span>';
                return `${colorSpan(params.color)} ${params.name} ( ${params.percent}% )`;
            }
            //formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            x: 'center',
            y: 'bottom',
            data: legends
        },
        toolbox: {
            show: true,
            feature: {
                magicType: {
                    show: true,
                    type: ['pie', 'funnel'],
                    option: {
                        funnel: {
                            x: '25%',
                            width: '50%',
                            funnelAlign: 'left',
                            max: 1548
                        }
                    }
                },
                restore: {
                    show: true,
                    title: "Restore"
                },
                saveAsImage: {
                    show: true,
                    title: "Save Image"
                }
            }
        },
        calculable: true,
        color: colorPalette,
        series: [{
            type: 'pie',
            radius: '50%',
            center: ['50%', '50%'],
            data: datas
        }]
    });
};
function GetCustomerContractToPieChart(url, contract_code){
    var res = null;
    $.ajax({
        url: url, //ทำงานกับไฟล์นี้
        data: {
            'contract_code':contract_code
            },  
        type: "POST",
        dataType: 'json',
        async:false,
        success: function(data, status) { 
            //เตรียมข้อมูลเพื่อทำ pie chart
            res = [{
            'period': data[0].count_period,
            'res': [
                {value: data[0].over_duedate, name: 'ชำระล่าช้า '+data[0].over_duedate+' งวด'}, 
                {value: data[0].normal_duedate, name: 'ชำระปรกติ '+data[0].normal_duedate+' งวด'},
                {value: data[0].normal_due, name: 'คงเหลือ '+data[0].normal_due+' งวด'},
                {value: data[0].over_due, name: 'ค้างชำระ '+data[0].over_due+' งวด'},
            ],
            'installment' : data[0].count_installment,
            'legend' : ['ชำระล่าช้า '+data[0].over_duedate+' งวด','ชำระปรกติ '+data[0].normal_duedate+' งวด','คงเหลือ '+data[0].normal_due+' งวด','ค้างชำระ '+data[0].over_due+' งวด']
            }];
        },
        error: function(xhr, status, exception) { }
    });
    return res;
};

//######  Installment table  #####//
function DashboardInstallment_table(elementtable, res){
    var td = null;
    $(elementtable).html(null);
    $.each(res, function (i, val) {
        var styles = '';
        var tx = '';
        switch(val.overdue_code){
            case 10: styles =' style="color: #670319;" '; tx = '';break;
            case 0: styles =' style="color: #dcbb09;" '; break;
            default:styles ='';break;
        }

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
        td += " <td>"+(i+1)+"</td>";
        td += " <td>"+val.contract_code+"</td>";
        td += " <td>"+val.period+"</td>";
        td += " <td>"+val.firstname+" "+val.lastname+"</td>";
        td += " <td>"+val.installment_payment+"</td>";
        td += " <td>"+ formatDate(val.payment_duedate,'-')+"</td>";
        td += " <td>"+ formatDate(val.extend_duedate,'-')+"</td>";
        td += " <td "+styles+">"+ val.overdue+"</td>";

        td += '<td class=" last"  style="text-align: center;padding-right: .2rem;padding-left: .2rem;">';
        var sendsms = (val.sendsms == 1) ? 'disabled' :'';
        if(val.status_code == 0 && val.installment_payment > 0 && val.overdue != ''){
            //var jsons = '';
            var jsons = "{ 'customer_code':'"+val.customer_code+"', 'customer':'"+val.firstname+' '+val.lastname+"', 'temp_code':'"+val.temp_code+"', 'period':'"+val.period+"', 'payment':'"+val.installment_payment+"', 'keywords':'"+SMSkeyword+"', 'duedate':'"+formatDateDMY(val.payment_duedate,'/')+"', 'tel':'"+val.tel+"'}";
            td += '     <button '+sendsms+' id="period'+val.RowNum+'" onclick="messageModal('+jsons+')" type="button" class="btn btn-round btn-info edit-button" style=" font-size: 13px; padding: 0 10px; margin-bottom: inherit;" data-toggle="tooltip" title="ส่ง sms">';
            td += '         <i class="fa fa-envelope"></i>';
            td += '     </button>';
        }
        td += '     <button id="period'+val.RowNum+'"  attr-data="'+val.contract_code+'"  type="button" class="btn btn-round btn-warning contracted" style=" font-size: 13px; padding: 0 10px; margin-bottom: inherit;" data-toggle="tooltip" title="สัญญา '+val.contract_code+'">';
        td += '         <i class="fa fa-pie-chart"></i>';
        td += '     </button>';
        td += '</td>';

        td += "</tr>";
    });
    $(elementtable).append(td);  
}
function GetInstallmentToTable(url, contract_code){
    var res = null;
    $.ajax({
        url: url, //ทำงานกับไฟล์นี้
        data: {
            'contract_code':contract_code
            },  
        type: "POST",
        dataType: 'json',
        async:false,
        success: function(data, status) { 
            res = data;
        },
        error: function(xhr, status, exception) { }
    });
    return res;
};

function InstallentTable_pie(elem, res, contract_code){
    var texted = (res != null) ? res[0].installment : 0 ;
    var subtext = (res != null) ? res[0].period : 0 ;
    var datas = (res != null) ? res[0].res : [{value: 0, name: 'ไม่มีข้อมูล'}] ;
    var legends = (res != null) ? res[0].legend : ['ไม่มีข้อมูล'] ;
    var contract = (contract_code != null) ? 'รหัสสัญญา '+contract_code+' ' : '' ;

    var colorPalette = ['#34495e', '#26b99a', '#670319','#9b59b6'];
    var echartPie = echarts.init(document.getElementById(elem), theme);
    echartPie.setOption({
        title: { 
            text: contract+'ชำระแล้ว '+ texted+' งวด', 
            subtext: 'จำนวนงวดที่ต้องชำระ '+ subtext +' งวด', 
            left: 'center'
        },
        tooltip: {
            trigger: 'item',
            formatter: function (params) {
                var colorSpan = color => '<span style="display:inline-block;margin-right:5px;border-radius:10px;width:9px;height:9px;background-color:' + color + '"></span>';
                return `${colorSpan(params.color)} ${params.name} ( ${params.percent}% )`;
            }
            //formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            x: 'center',
            y: 'bottom',
            data: legends
        },
        toolbox: {
            show: true,
            feature: {
                magicType: {
                    show: true,
                    type: ['pie', 'funnel'],
                    option: {
                        funnel: {
                            x: '25%',
                            width: '50%',
                            funnelAlign: 'left',
                            max: 1548
                        }
                    }
                },
                restore: {
                    show: true,
                    title: "Restore"
                },
                saveAsImage: {
                    show: true,
                    title: "Save Image"
                }
            }
        },
        calculable: true,
        color: colorPalette,
        series: [{
            type: 'pie',
            radius: '50%',
            center: ['50%', '50%'],
            data: datas
        }]
    });
};
function GetInstallentTable_pie(url, contract_code){
    var res = null;
    $.ajax({
        url: url, //ทำงานกับไฟล์นี้
        data: {
            'contract_code':contract_code
            },  
        type: "POST",
        dataType: 'json',
        async:false,
        success: function(data, status) { 
            //เตรียมข้อมูลเพื่อทำ pie chart
            res = [{
            'period': data[0].count_period,
            'res': [
                {value: data[0].over_duedate, name: 'ชำระล่าช้า '+data[0].over_duedate+' งวด'}, 
                {value: data[0].normal_duedate, name: 'ชำระปรกติ '+data[0].normal_duedate+' งวด'},
                {value: data[0].normal_due, name: 'คงเหลือ '+data[0].normal_due+' งวด'},
                {value: data[0].over_due, name: 'ค้างชำระ '+data[0].over_due+' งวด'},
            ],
            'installment' : data[0].count_installment,
            'legend' : ['ชำระล่าช้า '+data[0].over_duedate+' งวด','ชำระปรกติ '+data[0].normal_duedate+' งวด','คงเหลือ '+data[0].normal_due+' งวด','ค้างชำระ '+data[0].over_due+' งวด']
            }];
        },
        error: function(xhr, status, exception) { }
    });
    return res;
};


