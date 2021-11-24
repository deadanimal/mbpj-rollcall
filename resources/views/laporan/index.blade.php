@extends('base')

<!-- Styles -->
<style>
    #chartdiv {
        width: 100%;
        height: 500px;
    }

</style>

@section('content')

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
    am4core.ready(function () {

        am4core.useTheme(am4themes_animated);
        am4core.addLicense('ch-custom-attribution');

        var chart = am4core.create("chartdiv", am4charts.XYChart);

        var data = {
            !!json_encode($kehadiran) !!
        };
        chart.data = data;


        // chart.data = [{
        //   "year": "2021",
        //   "KehadiranRollcall": 2.5,
        //   "KehadiranRollcallTolak": 2.5,
        //   "KehadiranRollcalltakhadir": 2.1,

        // }, {
        //   "year": "2022",
        //   "KehadiranRollcall": 2.6,
        //   "KehadiranRollcallTolak": 2.7,
        //   "KehadiranRollcalltakhadir": 2.2,

        // }, {
        //   "year": "2023",
        //   "KehadiranRollcall": 2.8,
        //   "KehadiranRollcallTolak": 2.9,
        //   "KehadiranRollcalltakhadir": 2.4,

        // }]

        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "monthname";
        categoryAxis.renderer.grid.template.location = 0;


        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.renderer.inside = true;
        valueAxis.renderer.labels.template.disabled = true;
        valueAxis.min = 0;

        function createSeries(field, name) {

            var series = chart.series.push(new am4charts.ColumnSeries());
            series.name = name;
            series.dataFields.valueY = field;
            series.dataFields.categoryX = "monthname";
            series.sequencedInterpolation = true;

            series.stacked = true;

            series.columns.template.width = am4core.percent(60);
            series.columns.template.tooltipText =
                "[bold]{name}[/]\n[font-size:14px]{categoryX}: {valueY}";

            var labelBullet = series.bullets.push(new am4charts.LabelBullet());
            labelBullet.label.text = "{valueY}";
            labelBullet.locationY = 0.5;
            labelBullet.label.hideOversized = true;

            return series;
        }

        // createSeries("Johor", "Johor");
        // createSeries("Kedah", "Kedah");
        // createSeries("Kelantan", "Kelantan");

        createSeries("semua kehadiran", "Kehadiran Rollcall");
        createSeries("kehadiran diterima", "Kehadiran Rollcall Di Terima");
        createSeries("kehadiran ditolak", "Kehadiran Rollcall Di Tolak");
        createSeries("kehadiran tidak hadir", "Kehadiran Roll Call Tidak hadir");


        // Legend
        chart.legend = new am4charts.Legend();

        // Enable export
        chart.exporting.menu = new am4core.ExportMenu();
        chart.exporting.menu.items = [{
            "label": "...",
            "menu": [{
                    "type": "png",
                    "label": "PNG"
                },
                {
                    "type": "pdf",
                    "label": "PDF"
                },
            ]
        }];
        chart.exporting.menu.align = "right";
        chart.exporting.menu.verticalAlign = "top";
        chart.exporting.filePrefix = "Laporan Kehadiran Roll Call";
        var title = chart.titles.create();
        title.text = "Laporan Kehadiran Roll Call";
        title.fontSize = 25;
        title.marginBottom = 30;

        var options = chart.exporting.getFormatOptions("pdf");
        options.addURL = false;
        chart.exporting.setFormatOptions("pdf", options);
    });
</script>

{{-- lain2 --}}
<script>
    am4core.ready(function () {

        am4core.useTheme(am4themes_animated);
        am4core.addLicense('ch-custom-attribution');

        var chart = am4core.create("chartdivkb", am4charts.XYChart);

        // var data = {
        //     !!json_encode($kehadiran) !!
        // };
        // chart.data = data;


        chart.data = [{
          "year": "2021",
          "KehadiranRollcall": 2.5,
          "KehadiranRollcallTolak": 2.5,
          "KehadiranRollcalltakhadir": 2.1,

        }, {
          "year": "2022",
          "KehadiranRollcall": 2.6,
          "KehadiranRollcallTolak": 2.7,
          "KehadiranRollcalltakhadir": 2.2,

        }, {
          "year": "2023",
          "KehadiranRollcall": 2.8,
          "KehadiranRollcallTolak": 2.9,
          "KehadiranRollcalltakhadir": 2.4,

        }]

        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "monthname";
        categoryAxis.renderer.grid.template.location = 0;


        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.renderer.inside = true;
        valueAxis.renderer.labels.template.disabled = true;
        valueAxis.min = 0;

        function createSeries(field, name) {

            var series = chart.series.push(new am4charts.ColumnSeries());
            series.name = name;
            series.dataFields.valueY = field;
            series.dataFields.categoryX = "monthname";
            series.sequencedInterpolation = true;

            series.stacked = true;

            series.columns.template.width = am4core.percent(60);
            series.columns.template.tooltipText =
                "[bold]{name}[/]\n[font-size:14px]{categoryX}: {valueY}";

            var labelBullet = series.bullets.push(new am4charts.LabelBullet());
            labelBullet.label.text = "{valueY}";
            labelBullet.locationY = 0.5;
            labelBullet.label.hideOversized = true;

            return series;
        }

        // createSeries("Johor", "Johor");
        // createSeries("Kedah", "Kedah");
        // createSeries("Kelantan", "Kelantan");

        createSeries("semua kehadiran", "Kehadiran Rollcall");
        createSeries("kehadiran diterima", "Kehadiran Rollcall Di Terima");
        createSeries("kehadiran ditolak", "Kehadiran Rollcall Di Tolak");
        createSeries("kehadiran tidak hadir", "Kehadiran Roll Call Tidak hadir");


        // Legend
        chart.legend = new am4charts.Legend();

        // Enable export
        chart.exporting.menu = new am4core.ExportMenu();
        chart.exporting.menu.items = [{
            "label": "...",
            "menu": [{
                    "type": "png",
                    "label": "PNG"
                },
                {
                    "type": "pdf",
                    "label": "PDF"
                },
            ]
        }];
        chart.exporting.menu.align = "right";
        chart.exporting.menu.verticalAlign = "top";
        chart.exporting.filePrefix = "Laporan Kehadiran Roll Call";
        var title = chart.titles.create();
        title.text = "Laporan Kehadiran Roll Call";
        title.fontSize = 25;
        title.marginBottom = 30;

        var options = chart.exporting.getFormatOptions("pdf");
        options.addURL = false;
        chart.exporting.setFormatOptions("pdf", options);
    });
</script>

<div>
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Laporan</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Laporan</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Laporan</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @if(auth()->user()->role == 'penguatkuasa')

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12">

                <div class="card">
                    <div id="chartdiv"></div>

                </div>

            </div>
        </div>
    </div>
    @elseif(auth()->user()->role == 'penyelia')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12">

                <div class="card">
                    <div id="chartdiv"></div>

                </div>

            </div>
        </div>
    </div>
    @elseif(auth()->user()->role == 'ketua_bahagian' or auth()->user()->role == 'ketua_jabatan')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12">

                <div class="card">
                    <div id="chartdivkb"></div>

                </div>

            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Jana Laporan</h3>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <form method="POST" action="/filter_laporan_hadir">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <h4>Nama Penguatkuasa</h4>
                                <select id="jana_laporan" onchange="janaLaporan()" name ="nama_kakitangan" required placeholder="Enter nama_kakitangan" class="form-control">
                                    @foreach ($user_hadir as $user_hadirs)                                                   
                                    <option hidden selected > Nama Kakitangan</option>
                                    <option value="{{$user_hadirs->id}}">
                                        {{$user_hadirs->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row float-right">
                            <div class="col-sm ">
                                <br>
                                <a id="submit" class="btn btn-primary" href="">Jana Laporan</a>
                            </div>
                        </div>
             
                    </form>
                </div>
            </div>
        </div>
        <div class="row ">
            
            <div class="col-md-12">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Kehadiran Roll Call</h3>
                        <div class="card-body px-0">
                            <!-- Light table -->
                            <div class="table-responsive py-4">
                                <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Roll Call</th>
                                            <th>Nama kakitangan</th>
                                            <th>Status Hadir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($lapor_hadir as $lapor_hadirs)
                                        <tr>
                                            <td>
                                                {{$loop->index+1}}
                                            </td>
                                            <td>
                                                {{$lapor_hadirs->nama_rollcall->tajuk_rollcall}}
                                            </td>
                                            <td>
                                                {{$lapor_hadirs->nama_kakitangan->name}}
                                            </td>
                                            <td>
                                                @if($lapor_hadirs->lulus ===1)
                                               
                                                <span class="badge badge-pill badge-success">Hadir</span>
                                           
                                                @elseif($lapor_hadirs->lulus ===0)
                                            
                                                    <span class="badge badge-pill badge-danger">Tidak Hadir</span>
                                            
                                                @elseif($lapor_hadirs->lulus ===null)
                                            
                                                    <span class="badge badge-pill badge-warning">Belum Hadir</span>
                                            
                                                @endif

                                            </td>
                                    
                                          
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      

    </div>
   
    @elseif(auth()->user()->role == 'naziran')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12">

                <div class="card">
                    <div id="chartdiv"></div>

                </div>

            </div>
        </div>
    </div>

    @else
    --
    @endif

    <!-- Footer -->
    <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6">
                <div class="copyright text-center  text-lg-left  text-muted">
                    &copy; 2021 <a href="" class="font-weight-bold ml-1" target="">Sistem Pengurusan
                        Roll
                        Call
                    </a>
                </div>
            </div>
        </div>
    </footer>
</div>
</div>
</div>

<script type="text/javascript">
    function janaLaporan() {
        let selected_id = $("#jana_laporan option:selected").val();
        $("#submit").attr("href", "/filter_laporan_hadir/" + selected_id);

    }
</script>

    @endsection
