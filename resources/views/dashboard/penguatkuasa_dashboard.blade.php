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
    {{-- <div class="container-fluid"> --}}
        {{-- <div class="container-fluid mt--6">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card bg-default">
                        <div class="card-header ">
                            <div class="row align-items-center">
                                <div class="col">


                                </div>
                            </div>
                            <div class="card-body">
                                <div id="chartdiv"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="header header-dark bg-primary pb-6 content__title content__title--calendar mt-0">
                <div class="container-fluid">
                  <div class="header-body">
                    <div class="row align-items-center py-4">
                      <div class="col-lg-6">
                        <h6 class="fullcalendar-title h2 text-white d-inline-block mb-0">Full calendar</h6>
                        <nav aria-label="breadcrumb" class="d-none d-lg-inline-block ml-lg-4">  
                        </nav>
                      </div>
                      <div class="col-lg-6 mt-3 mt-lg-0 text-lg-right">
                        <a href="#" class="fullcalendar-btn-prev btn btn-sm btn-neutral">
                          <i class="fas fa-angle-left"></i>
                        </a>
                        <a href="#" class="fullcalendar-btn-next btn btn-sm btn-neutral">
                          <i class="fas fa-angle-right"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="month">Month</a>
                        <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicWeek">Week</a>
                        <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicDay">Day</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                      <!-- Card body -->
                      <div class="container-fluid mt--6">
                        <div class="row">
                          <div class="col">
                            <!-- Fullcalendar -->
                            <div class="card card-calendar">
                              <!-- Card header -->
                              <div class="card-header">
                                <!-- Title -->
                                <h5 class="h3 mb-0">Jadual Roll Call</h5>
                              </div>
                              <!-- Card body -->
                              <div class="card-body p-0">
                                <div class="calendar" data-toggle="calendar" id="calendar"></div>
                              </div>
                            </div>
                            <!-- Modal - Add new event -->
                            <!--* Modal header *-->
                            <!--* Modal body *-->
                            <!--* Modal footer *-->
                            <!--* Modal init *-->
                            <div class="modal fade" id="new-event" tabindex="-1" role="dialog" aria-labelledby="new-event-label" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered modal-secondary" role="document">
                                <div class="modal-content">
                                  <!-- Modal body -->
                                  <div class="modal-body">
                                    <form class="new-event--form">
                                      <div class="form-group">
                                        <label class="form-control-label">Event title</label>
                                        <input type="text" class="form-control form-control-alternative new-event--title" placeholder="Event Title">
                                      </div>
                                      <div class="form-group mb-0">
                                        <label class="form-control-label d-block mb-3">Status color</label>
                                        <div class="btn-group btn-group-toggle btn-group-colors event-tag" data-toggle="buttons">
                                          <label class="btn bg-info active"><input type="radio" name="event-tag" value="bg-info" autocomplete="off" checked></label>
                                          <label class="btn bg-warning"><input type="radio" name="event-tag" value="bg-warning" autocomplete="off"></label>
                                          <label class="btn bg-danger"><input type="radio" name="event-tag" value="bg-danger" autocomplete="off"></label>
                                          <label class="btn bg-success"><input type="radio" name="event-tag" value="bg-success" autocomplete="off"></label>
                                          <label class="btn bg-default"><input type="radio" name="event-tag" value="bg-default" autocomplete="off"></label>
                                          <label class="btn bg-primary"><input type="radio" name="event-tag" value="bg-primary" autocomplete="off"></label>
                                        </div>
                                      </div>
                                      <input class="new-event--start" />
                                      <input  class="new-event--end" />
                                    </form>
                                  </div>
                                  <!-- Modal footer -->
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary new-event--add">Add event</button>
                                    <button type="button" class="btn btn-link ml-auto" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- Modal - Edit event -->
                            <!--* Modal body *-->
                            <!--* Modal footer *-->
                            <!--* Modal init *-->
                            <div class="modal fade" id="edit-event" tabindex="-1" role="dialog" aria-labelledby="edit-event-label" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered modal-secondary" role="document">
                                <div class="modal-content">
                                  <!-- Modal body -->
                                  <div class="modal-body">
                                    <form class="edit-event--form">
                                      <div class="form-group">
                                        <label class="form-control-label">Event title</label>
                                        <input type="text" class="form-control form-control-alternative edit-event--title" placeholder="Event Title">
                                      </div>
                                      <div class="form-group">
                                        <label class="form-control-label d-block mb-3">Status color</label>
                                        <div class="btn-group btn-group-toggle btn-group-colors event-tag mb-0" data-toggle="buttons">
                                          <label class="btn bg-info active"><input type="radio" name="event-tag" value="bg-info" autocomplete="off" checked></label>
                                          <label class="btn bg-warning"><input type="radio" name="event-tag" value="bg-warning" autocomplete="off"></label>
                                          <label class="btn bg-danger"><input type="radio" name="event-tag" value="bg-danger" autocomplete="off"></label>
                                          <label class="btn bg-success"><input type="radio" name="event-tag" value="bg-success" autocomplete="off"></label>
                                          <label class="btn bg-default"><input type="radio" name="event-tag" value="bg-default" autocomplete="off"></label>
                                          <label class="btn bg-primary"><input type="radio" name="event-tag" value="bg-primary" autocomplete="off"></label>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="form-control-label">Description</label>
                                        <textarea class="form-control form-control-alternative edit-event--description textarea-autosize" placeholder="Event Desctiption"></textarea>
                                        <i class="form-group--bar"></i>
                                      </div>
                                      <input  class="edit-event--id">
                                    </form>
                                  </div>
                                  <!-- Modal footer -->
                                  <div class="modal-footer">
                                    <button class="btn btn-primary" data-calendar="update">Update</button>
                                    <button class="btn btn-danger" data-calendar="delete">Delete</button>
                                    <button class="btn btn-link ml-auto" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
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
