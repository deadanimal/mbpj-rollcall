@extends('base')
<!-- Styles -->
<style>
    #chartdiv {
        width: 100%;
        height: 500px;
    }

</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
    am4core.ready(function () {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("chartdiv", am4charts.XYChart);

        // Add data
        chart.data = [{
            "year": 2005,
            "HADIR": 23.5,
            "TIDAK HADIR": 18.1
        }, {
            "year": 2006,
            "HADIR": 26.2,
            "TIDAK HADIR": 22.8
        }, {
            "year": 2007,
            "HADIR": 30.1,
            "TIDAK HADIR": 23.9
        }, {
            "year": 2008,
            "HADIR": 29.5,
            "TIDAK HADIR": 25.1
        }, {
            "year": 2009,
            "HADIR": 24.6,
            "TIDAK HADIR": 25
        }];

        // Create axes
        var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "year";
        categoryAxis.numberFormatter.numberFormat = "#";
        categoryAxis.renderer.inversed = true;
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.cellStartLocation = 0.1;
        categoryAxis.renderer.cellEndLocation = 0.9;

        var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
        valueAxis.renderer.opposite = true;

        // Create series
        function createSeries(field, name) {
            var series = chart.series.push(new am4charts.ColumnSeries());
            series.dataFields.valueX = field;
            series.dataFields.categoryY = "year";
            series.name = name;
            series.columns.template.tooltipText = "{name}: [bold]{valueX}[/]";
            series.columns.template.height = am4core.percent(100);
            series.sequencedInterpolation = true;

            // // Title

            //   var title = chart.titles.create();
            //   title.text = "";
            //   title.fontSize = 20;
            //   title.marginBottom = 20;

            // Print Chart

            chart.exporting.menu = new am4core.ExportMenu();
            chart.exporting.menu.align = "right";
            chart.exporting.menu.verticalAlign = "top";

            var valueLabel = series.bullets.push(new am4charts.LabelBullet());
            valueLabel.label.text = "{valueX}";
            valueLabel.label.horizontalCenter = "left";
            valueLabel.label.dx = 10;
            valueLabel.label.hideOversized = false;
            valueLabel.label.truncate = false;

            var categoryLabel = series.bullets.push(new am4charts.LabelBullet());
            categoryLabel.label.text = "{name}";
            categoryLabel.label.horizontalCenter = "right";
            categoryLabel.label.dx = -10;
            categoryLabel.label.fill = am4core.color("#fff");
            categoryLabel.label.hideOversized = false;
            categoryLabel.label.truncate = false;
        }

        createSeries("HADIR", "HADIR");
        createSeries("TIDAK HADIR", "TIDAK HADIR");

    }); // end am4core.ready()

</script>





@section('content')

<div>
    <div class="header bg-primary pb-6">
        <div class="container-fluid">

            <div class="row align-items-center py-4">
                <div class="col-lg-12 col-7">
                    <h1 class="h1 text-white "> Selamat Datang {{Auth()->user()->name}} ke Sistem Pengurusan Roll Call
                    </h1>
                    {{-- <h1 class="h2 text-white "> Sistem Pengurusan Roll Call --}}
                    </h1>
                </div>
            </div>
        </div>
        <div class="container-fluid mb--7">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Dashboard</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-4 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">JUMLAH KEHADIRAN ROLL CALL
                                        </h5>
                                        <span class="h2 font-weight-bold mb-0">350,897</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                            <i class="ni ni-active-40"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0"> JUMLAH ROLL CALL TIDAK
                                            HADIR
                                        </h5>
                                        <span class="h2 font-weight-bold mb-0">2,356</span>
                                    </div>
                                    <div class="col-auto">
                                        <div
                                            class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                            <i class="ni ni-chart-pie-35"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0"> JUMLAH KEHADIRAN ROLL
                                            CALL DITOLAK
                                        </h5>
                                        <span class="h2 font-weight-bold mb-0">924</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                            <i class="ni ni-money-coins"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- calendar --}}
    <div class="container-fluid mt--12">
        <!-- Card body -->
        <div class="card-body">
            <h1 class="text-center text-primary"><u>Full Calendar</u></h1>
            <div id="calendar"></div>
        </div>
    </div>
    {{-- modal --}}
    <div id="calendarModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Makluman Roll Call</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <h4 id="modalTitle" class="modal-title"></h4>
                        </div>
                        <!-- Card body -->
                        {{-- <div id="modalBody"></div>   --}}
                        <div class="card-body">

                            @foreach ($rollcalls as $rollcall)

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> Waktu Mula Semasa</label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control " value="{{$rollcall->id}}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Waktu Mula Semasa</label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control " value="{{$rollcall->mula_rollcall}}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Waktu akhir Semasa</label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control" value="{{$rollcall->akhir_rollcall}}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lokasi">Lokasi </label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control" name="lokasi" value="{{$rollcall->lokasi}} "
                                                disabled>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-map-marker"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Perkara">Catatan</label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control" name="catatan" value="{{$rollcall->catatan}}"
                                                disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pegawai_sokong_id">Pegawai Sokong</label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control" name="pegawai_sokong_id"
                                                value="{{$rollcall->pegawai_sokong_id}}" disabled>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-address-book"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pegawai_lulus_id">Pilih pegawai lulus</label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control" name="pegawai_lulus_id"
                                                value="{{$rollcall->pegawai_lulus_id}}" disabled>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-address-book"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Button trigger modal -->
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6">
                <div class="copyright text-center  text-lg-left  text-muted">
                    &copy; 2021 <a href="#" class="font-weight-bold ml-1" target="_blank">Sistem Pengurusan Roll
                        Call
                    </a>
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        var SITEURL = "{{ url('/') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var calendar = $('#calendar').fullCalendar({
            editable: true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: SITEURL + '/dashboard',
            selectable: true,
            selectHelper: true,

            eventClick: function (event, jsEvent, view) {

                $('#modalTitle').html(event.title);
                $('#calendarModal').modal();
            },
        });

    });

</script>
@endsection
