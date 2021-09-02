@extends('base')

<head>
  {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}" /> --}}

    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" /> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
</head>

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
                                        <h5 class="card-title text-uppercase text-muted mb-0">JUMLAH ROLL CALL DALAM
                                            PROSES
                                        </h5>
                                        <span class="h2 font-weight-bold mb-0">78</span>
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
                                        <h5 class="card-title text-uppercase text-muted mb-0"> JUMLAH ROLL CALL SELESAI
                                        </h5>
                                        <span class="h2 font-weight-bold mb-0">26</span>
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
                                        <h5 class="card-title text-uppercase text-muted mb-0"> JUMLAH ROLL CALL <h5>
                                                <span class="h2 font-weight-bold mb-0">92</span>
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
                                                  value="{{$rollcall->pegawai_sokong_id}}"disabled>
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
                                                  value="{{$rollcall->pegawai_lulus_id}}"disabled>
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
                        Call</a>
                </div>
            </div>
        </div>
    </footer>
</div>
</div>
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
                // $.ajax({  
                //     type: "GET",  
                //     data: "id=" + $(this).attr("id"), 
                //   });
                // ______________
                // var id_ = event.id;
                // var divId = '#rollCall' + id_;
                // // $(divId).html('dsadas')
                // // var d = new Date(event.rollcall.akhir_rollcall);
                // var htmlStatement = `
                // <div class="table-responsive py-4">
                //             <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                //                 style="width:100%">
                //                 <thead>
                //                     <tr>
                //                         <th>No</th>
                //                         <th>Tajuk Roll Call</th>
                //                         <th>Waktu mula rollcall</th>
                //                         <th>Waktu akhir rollcall</th>
                //                         <th>lokasi</th>
                //                         <th>Catatan</th>
                //                         <th>Status</th>                                  
                //                         <th>Tindakan</th>
                //                     </tr>
                //                 </thead>
                //                 <tbody>
                //                     @forelse($rollcalls as $rollcall)
                //                     <tr>
                //                         <td>{{$loop->index+1}}</td>
                //                         <td>{{$rollcall->tajuk_rollcall}}</td>
                //                         <td>{{$rollcall->mula_rollcall}}</td>
                //                         <td>{{$rollcall->akhir_rollcall}}</td>                                       
                //                         <td>{{$rollcall->lokasi}}</td>
                //                         <td>{{$rollcall->catatan}}</td>
                //                         @if($rollcall->status =='dibuka')
                //                         <td>
                //                             <span class="badge badge-pill badge-success">DIBUKA</span>
                //                         </td>
                //                         @elseif($rollcall->status =='ditutup')
                //                         <td>
                //                             <span class="badge badge-pill badge-danger">DITUTUP</span>
                //                         </td>
                //                         @elseif($rollcall->status =='ditangguh')
                //                         <td>
                //                             <span class="badge badge-pill badge-warning">DITANGGUH</span>
                //                         </td>
                //                         @endif
                //                         {{-- <td>{{$rollcall->pegawai_sokong_id}}</td>
                //                         <td>{{$rollcall->pegawai_lulus_id}}</td> --}}                                 
                //                     </tr>                                  
                //                   @endforeach
                //                 </tbody>
                //             </table>
                //         </div>
                
                // `
                
                $('#modalTitle').html(event.title);
                // $('#modalBody').html(event.description);
                // // $('#modalBody').html(htmlStatement);
                // $('#eventUrl').attr('href', event.url);
                $('#calendarModal').modal();
            },
        });

    });

</script>
@endsection
