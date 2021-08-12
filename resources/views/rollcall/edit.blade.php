@extends('base')

@section('content')

<div>
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Kemaskini</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="/rollcalls"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="">Pengurusan</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Roll Call</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(auth()->user()->role == 'naziran')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-wrapper">
                    <!-- Input groups -->
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <h3 class="mb-0">Kemaskini Jadual Roll Call</h3>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <form method="POST" action="/rollcalls/{{$rollcall->id}}">
                                @csrf
                                @method('PUT')
                                <!-- Input groups with icon -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Waktu Mula Semasa</label>
                                            <div class="input-group input-group-merge">
                                                <input class="form-control " value="{{$rollcall->mula_rollcall}}"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Waktu akhir Semasa</label>
                                            <div class="input-group input-group-merge">
                                                <input class="form-control" value="{{$rollcall->akhir_rollcall}}"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mula_rollcall">Kemaskini waktu mula</label>
                                            <div class="form-group">
                                                <div class="input-group date" id="datetimepicker1">
                                                    <input type="text" class="form-control" name="mula_rollcall">
                                                    <span class="input-group-addon input-group-append">
                                                        <button class="btn btn-outline-primary" type="button"
                                                            id="button-addon2"> <span
                                                                class="fa fa-calendar"></span></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="akhir_rollcall">Kemaskini waktu akhir</label>
                                            <div class="form-group">
                                                <div class="input-group date" id="datetimepicker2">
                                                    <input type="text" class="form-control" name="akhir_rollcall">
                                                    <span class="input-group-addon input-group-append">
                                                        <button class="btn btn-outline-primary" type="button"
                                                            id="button-addon2"> <span
                                                                class="fa fa-calendar"></span></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lokasi">Lokasi </label>
                                            <div class="input-group input-group-merge">
                                                <input class="form-control" name="lokasi" value="{{$rollcall->lokasi}}"
                                                    type="text">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-map-marker"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Perkara">Catatan</label>
                                            <div class="input-group input-group-merge">
                                                <input class="form-control" name="catatan"
                                                    value="{{$rollcall->catatan}}" type="text">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tajuk_rollcall">Tajuk</label>
                                            <div class="input-group input-group-merge">
                                                <input class="form-control" name="tajuk_rollcall"
                                                    value="{{$rollcall->tajuk_rollcall}}" type="text">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-map-marker"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Catatan</label>
                                            <div class="input-group input-group-merge">
                                                <input class="form-control" name="status" value="{{$rollcall->status}}"
                                                    type="text">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pegawai_sokong_id">Pilih pegawai sokong</label>
                                            <div class="input-group input-group-merge">
                                                <input class="form-control" name="pegawai_sokong_id"
                                                    value="{{$rollcall->pegawai_sokong_id}}" type="number">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i
                                                            class="fa fa-address-book"></i></span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pegawai_lulus_id">Pilih pegawai lulus</label>
                                            <div class="input-group input-group-merge">
                                                <input class="form-control" name="pegawai_lulus_id"
                                                    value="{{$rollcall->pegawai_lulus_id}}" type="number">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i
                                                            class="fa fa-address-book"></i></span>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary float-right">Kemaskini</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--10">
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Senarai Kakitangan </h3>
                        <div class="card-body px-0">
                            <!-- Light table -->
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kakitangan</th>
                                            <th>No Pekerja</th>
                                            <th>NRIC </th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Tindakan</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @forelse($rollcalls as $rollcall) --}}
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                                                                  
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#exampleModal">
                                                    Lihat
                                                </button>
                                                <button class="btn btn-success" > Kemaskini </button>
                                                <button class="btn btn-danger"> Buang </button>
                                            </td>
                                        </tr>
                                        {{-- @empty
                                        <div style="text-align:center;">
                                            <td>
                                                <h5> Tiada rekod </h5>
                                            </td>
                                        </div>
                                        @endforelse --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Kemaskini Sebab Tidak Hadir</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="/rollcalls/kemaskini/kehadiran">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Sebab tak hadir</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                <form>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFileLang" lang="en">
                                        <label class="custom-file-label" for="customFileLang">Select file</label>
                                    </div>
                                </form>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-primary">Kemaskini</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @elseif(auth()->user()->role == 'penguatkuasa')

    @endif
    <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6">
                <div class="copyright text-center  text-lg-left  text-muted">
                    &copy; 2021 <a href="#" class="font-weight-bold ml-1" target="_blank">Sistem
                        Pengurusan
                        Elaun Lebih Masa</a>
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection {{-- Script --}} 
@section('script') 
<script
        src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
        </script>
        <script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/select2/dist/js/select2.min.js">
        </script>
        <script
            src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
        </script>
        <script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/moment.min.js">
        </script>
        <script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/bootstrap-datetimepicker.js">
        </script>
        <script
            src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/nouislider/distribute/nouislider.min.js">
        </script>
        <script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/quill/dist/quill.min.js">
        </script>
        <script
            src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/dropzone/dist/min/dropzone.min.js">
        </script>
        <script
            src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js">
        </script>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker({
                    icons: {
                        time: "fa fa-clock",
                        date: "fa fa-calendar-day",
                        up: "fa fa-chevron-up",
                        down: "fa fa-chevron-down",
                        previous: 'fa fa-chevron-left',
                        next: 'fa fa-chevron-right',
                        today: 'fa fa-screenshot',
                        clear: 'fa fa-trash',
                        close: 'fa fa-remove'
                    }
                });
                $('#datetimepicker2').datetimepicker({
                    icons: {
                        time: "fa fa-clock",
                        date: "fa fa-calendar-day",
                        up: "fa fa-chevron-up",
                        down: "fa fa-chevron-down",
                        previous: 'fa fa-chevron-left',
                        next: 'fa fa-chevron-right',
                        today: 'fa fa-screenshot',
                        clear: 'fa fa-trash',
                        close: 'fa fa-remove'
                    }
                });
            });

        </script>
        <script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/js/demo.min.js">
        </script>
        @endsection
