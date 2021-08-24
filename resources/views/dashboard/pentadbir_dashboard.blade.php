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
  am4core.ready(function() {
  
  // Themes begin
  am4core.useTheme(am4themes_animated);
  // Themes end
  
  var chart = am4core.create("chartdiv", am4charts.XYChart);
  
  var data = [];
  var value = 50;
  for(var i = 0; i < 300; i++){
    var date = new Date();
    date.setHours(0,0,0,0);
    date.setDate(i);
    value -= Math.round((Math.random() < 0.5 ? 1 : -1) * Math.random() * 10);
    data.push({date:date, value: value});
  }
  
  chart.data = data;
  
  // Create axes
  var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
  dateAxis.renderer.minGridDistance = 60;
  
  var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  
  // Create series
  var series = chart.series.push(new am4charts.LineSeries());
  series.dataFields.valueY = "value";
  series.dataFields.dateX = "date";
  series.tooltipText = "{value}"
  
  series.tooltip.pointerOrientation = "vertical";
  
  chart.cursor = new am4charts.XYCursor();
  chart.cursor.snapToSeries = series;
  chart.cursor.xAxis = dateAxis;
  
  //chart.scrollbarY = new am4core.Scrollbar();
  chart.scrollbarX = new am4core.Scrollbar();
  
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
                    </h1>
                </div>
            </div>
        </div>
        <div class="container-fluid">
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
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
  <div class="container-fluid mt--6">
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
      </div>
      <div class="row">
          <div class="col-xl-12">
              <div class="card bg-default">
                     <!-- Card header -->
                     <div class="card-header border-0">
                      <h3 class="mb-0">Log Aktiviti Sistem Roll Call</h3>
                      <div class="card-body px-0">

                      <div class="table-responsive py-4">
                          <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                              style="width:100%">
                              <thead class="thead-light">
                                  <tr>
                                      <th>No</th>
                                      {{-- <th>Id</th> --}}
                                      <th>Nama</th>
                                      <th>Peranan</th>

                                      {{-- <th>Model</th> --}}
                                      <th>Tarikh</th>
                                      <th>Makluman</th>

                                  </tr>
                              </thead>
                              <tbody>

                                  @foreach ($audits as $audit)
                                      <tr>
                                          <td>{{ $loop->index + 1 }}</td>
                                          {{-- <td>{{ $audit->id }}</td> --}}
                                          <td>{{ $audit->name}}</td>
                                          <td>{{ $audit->peranan}}</td>
                                          {{-- <td>{{ $audit->model_name }}</td> --}}
                                          <td>{{ $audit->created_at }}</td>
                                          {{-- <td>{{ $audit->description }}</td> --}}

                                          @if($audit->description =='Log Masuk')
                                              <td>
                                                  <span class="badge badge-pill badge-success">Log Masuk</span>
                                              </td>
                                          @elseif($audit->description =='Log Keluar')
                                              <td>
                                                  <span class="badge badge-pill badge-danger">Log Keluar</span>
                                              </td>
                                          @else 
                                              <td>
                                                  {{$audit->description}}
                                              </td>                                                
                                          @endif
                                      </tr>
                                  @endforeach
                              </tbody>
                          </table>
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
                      &copy; 2021 <a href="#" class="font-weight-bold ml-1" target="_blank">Sistem Pengurusan
                          Elaun Lebih Masa
                      </a>
                  </div>
              </div>
          </div>
      </footer>
  </div>
</div>
@endsection
