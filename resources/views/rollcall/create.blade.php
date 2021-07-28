@extends('base')

@section('content')

<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Roll Call</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">roll call</a></li>
                            <li class="breadcrumb-item active" aria-current="page">roll call</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="h3 mb-3">Roll Call</h5>
                    <div class="card-body">
                        <form method="POST" action="/rollcalls">
                            @csrf
                            <!-- Input groups with icon -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tajuk_rollcall">Tajuk roll call</label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control" name="tajuk_rollcall"required placeholder="tajuk"
                                                type="text">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class=""></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tajuk_rollcall">Status</label>
                                        <select class="form-select form-select-sm col-12" name="status" required
                                            aria-label=".form-select-sm example">
                                            <option value="dibuka">Buka</option>
                                            <option value="ditutup"> Tutup</option>
                                            <option value="ditangguh"> Ditangguh</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lokasi">Lokasi roll call</label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control" name="lokasi" required placeholder="lokasi" type="text">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class=""></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="catatan">Catatan</label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control" name="catatan" required placeholder="tajuk" type="text">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class=""></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mula_rollcall">Pilih waktu mula</label>
                                        <div class="input-group date" id="datetimepicker1">
                                            <input type="text" class="form-control" name="mula_rollcall" required> 
                                            <span class="input-group-addon input-group-append">
                                                <button class="btn btn-outline-primary" type="button"
                                                    id="button-addon2"> <span class="fa fa-calendar"></span></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="akhir_rollcall">Pilih waktu akhir</label>
                                        <div class="input-group date" id="datetimepicker2">
                                            <input type="text" class="form-control" name="akhir_rollcall" required>
                                            <span class="input-group-addon input-group-append">
                                                <button class="btn btn-outline-primary" type="button"
                                                    id="button-addon2"> <span class="fa fa-calendar"></span></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pegawai_sokong_id">Pilih pegawai sokong</label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control" name="pegawai_sokong_id" required
                                                placeholder="pegawai_sokong_id">
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
                                            <input class="form-control" name="pegawai_lulus_id" required
                                                placeholder="pegawai_lulus_id">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-address-book"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary float-right">Tambah Roll Call</button>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer pt-0">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6">
                    <div class="copyright text-center  text-lg-left  text-muted">
                        &copy; 2021 <a href="" class="font-weight-bold ml-1" target="">Sistem
                            Pengurusan Roll Call</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

    @endsection


    {{-- Script --}}
    @section('script')
    <script
        src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
    </script>
    <script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/select2/dist/js/select2.min.js">
    </script>
    <script
        src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
    </script>
    <script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/moment.min.js"></script>
    <script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/bootstrap-datetimepicker.js">
    </script>
    <script
        src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/nouislider/distribute/nouislider.min.js">
    </script>
    <script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/quill/dist/quill.min.js"></script>
    <script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/dropzone/dist/min/dropzone.min.js">
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
    <script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/js/demo.min.js"></script>
    @endsection
