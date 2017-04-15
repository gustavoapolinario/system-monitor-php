@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard. Server: {{$id}}</div>

                <div id="charts" class="panel-body">
                    <!-- charts here -->
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(chartReady);
$(function() {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    })
});



var charts = [
    {
        title: 'Load Average',
        hAxis: 'Time',
        pos_arr: 'load_average'
    },
    {
        title: 'Memory Info',
        hAxis: 'Time',
        pos_arr: 'mem_info'
    },
];
function getCSRFTokenValue() {
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
}

function chartReady() {
    for(var c = charts.length-1; c >= 0; c--) {
        var div = document.createElement('div');
        div.style.width = '100%';
        div.style.height = '500px';
        document.getElementById('charts').appendChild(div);
        charts[c].obj = new google.visualization.AreaChart(div);
    }

    getData();
}
function getData() {
    $.ajax({
        url: "/report/{{$id}}/ajax",
        dataType: "json",
        data: { CSRF: getCSRFTokenValue()},
        success: function (data) {
            var newData = [];
            for(var c = 0; c < data.data.length; c++) {
                newData.push(JSON.parse(data.data[c]));
            }
            populateCharts(newData);
        },
        error: function (data) {
            console.log('Error:', data);
            setTimeout(getData, 10000);
        }
    });
}
function populateCharts(data) {
    for(var c = 0; c < charts.length; c++) {
        populateChart(charts[c], data);
    }
}
function getTimeFromDatetimeStr(string) {
    return new Date(string);
}
function populateChart(chart, data) {

    var arrTmp = [
        [
            chart['hAxis'], 
            'Server1'
        ]
    ];
    for(var c = 0; c < data.length; c++) {
        var pos_arr = chart['pos_arr'];
        arrTmp.push(
            [
                getTimeFromDatetimeStr(data[c][ 'created_at' ]),
                parseFloat(data[c][ pos_arr ])
            ]
        );
    }
    console.log(arrTmp)

    var chart_data = google.visualization.arrayToDataTable(arrTmp);
    // var char_data = google.visualization.arrayToDataTable([
    //     [chart['hAxis'], 'Server1', 'Server2'],
    //     ['00:00',  1000,      400],
    //     ['00:05',  1170,      460],
    //     ['00:10',  660,      1120],
    //     ['00:15',  1030,       540],
    //     ['00:20',  930,      840]
    // ]);


    var options = {
        title: chart['title'],
        hAxis: {title: chart['hAxis'],  titleTextStyle: {color: '#333'}},
        vAxis: {minValue: 0},
        animation:{
            duration: 1000,
            easing: 'out',
        },
    };

console.log(chart)
    chart['obj'].draw(chart_data, options);

    setTimeout(getData, 60000);

}
</script>
@endsection
