<?php
/**
 * $data 로 온 배열명으로 활용 가능
 */
?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>ChartJS</h3>
                <p class="text-subtitle text-muted">A chart for user </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ChartJS</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Bar Chart</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="bar"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Line Chart</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="line"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="h4">ajax 샘플</div>
                <div class="form-group">
                    <label>차트 개수</label>
                    <input type="text" id="chart_length" class="form-control" value="0" onkeyup="checkNumberCheck(this, this.value)">
                    <button type="button" class="btn btn-primary" onclick="rendDataAPI($('#chart_length').val())">ajax 로드</button>
                </div>
            </div>
        </div>
    </section>
</div>


<script src="/demo/dist/assets/vendors/chartjs/Chart.min.js"></script>
<!--<script src="/demo/dist/assets/js/pages/ui-chartjs.js"></script>-->

<script>

    var ctx1 = document.getElementById("bar").getContext("2d");
    var chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        info: '#41B1F9',
        blue: '#3245D1',
        purple: 'rgb(153, 102, 255)',
        grey: '#EBEFF6'
    };
    var chartSampleData = {
        type: 'bar',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
            datasets: [{
                label: 'Students',
                backgroundColor: [chartColors.grey, chartColors.grey, chartColors.grey, chartColors.grey, chartColors.info, chartColors.blue, chartColors.grey],
                data: [
                    5,
                    10,
                    30,
                    40,
                    35,
                    55,
                    15,
                ]
            }]
        },
        options: {
            responsive: true,
            barRoundness: 1,
            title: {
                display: true,
                text: "Students in 2020"
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        suggestedMax: 40 + 20,
                        padding: 10,
                    },
                    gridLines: {
                        drawBorder: false,
                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: false,
                        drawBorder: false
                    }
                }]
            }
        }
    };


    function checkNumberCheck( obj, value ){
        var val = 0;
        if(isNaN(value)){
            val = 0;
        }else{
            val = parseInt(value);
            $(obj).val(parseInt(value));
        }

        if( val > 20 ){
            val = 20;
        }

        $(obj).val(parseInt(val));

        return true;
    }


    function setChartRenderData(APIData) {

        var chartParam = {
            labels : [],
            data : [],
            backgroundColor : [],
        };

        for (var i in APIData) {
            chartParam.labels.push(APIData[i].labels);
            chartParam.data.push(APIData[i].data);
            chartParam.backgroundColor.push(chartColors[APIData[i].backgroundColor]);
        }

        chartSampleData.data.labels = chartParam.labels;
        chartSampleData.data.datasets[0].data = chartParam.data;
        chartSampleData.data.datasets[0].backgroundColor = chartParam.backgroundColor;

        new Chart(ctx1, chartSampleData);
    }

    /**
     * API sample
     */
    function rendDataAPI(length) {

        var ajaxURL = "/sample/chartAPI";
        var ajaxParam = {
            length: length
        };

        $.ajax({
            url: ajaxURL,
            type: "POST",
            data: ajaxParam,
            dataType: "JSON",
            success: function (result) {
                if (result.result === true) {
                    setChartRenderData(result.data);
                }
            },
            error: function () {
                console.log('ERROR');
            }
        });
    }

    $(document).ready(function () {

        rendDataAPI(5);
    });


</script>