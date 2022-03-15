@extends('base')

@section('content')

<style>
    .fc-header-toolbar {
        display: block !important;
    }

</style>
<div>
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="row align-items-center py-4">
                <div class="col-lg-12 col-7">
                    <h1 class="h1 text-white "> Selamat Datang Ke Sistem Pengurusan Roll Call</h1>
                     <h1 class="h1 text-white "> Modul Naziran </h1>
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
                                        <span class="h2 font-weight-bold mb-0">{{$rollcallproses}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                            <i class="ni ni-notification-70"></i>
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
                                        <span class="h2 font-weight-bold mb-0">{{$rollcallselesai}}</span>
                                    </div>
                                    <div class="col-auto">

                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                            <i class="ni ni-notification-70"></i>
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
                                                <span class="h2 font-weight-bold mb-0">{{$rollcalljumlah}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                            <i class="ni ni-notification-70"></i>
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
</div>
{{-- calendar --}}
<div class="container-fluid mt--6">
    <div class="card">
        <div class="card-header bg-default">
            <h3 class="text-white mb-0 text-center">Takwim Roll Call</h3>
        </div>
        <div class="card-body">
            <div id='calendar'></div>
        </div>
    </div>
</div>
{{-- modal --}}
<div id="calendarModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-default">
                <h5 class="text-white modal-title">Maklumat Roll Call</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <span id="modalTitle"></span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <label class=".badge-lg badge-pill badge-info ">Makluman</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group input-group-merge">
                                    <div id="rollcall_maklumat">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Waktu Mula Roll Call</label>
                                    <div class="input-group input-group-merge">
                                        <input id="rollcall_mula" class="form-control" value="" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Waktu Akhir Roll Call</label>
                                    <div class="input-group input-group-merge">
                                        <input id="rollcall_akhir" class="form-control" value="" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lokasi">Lokasi </label>
                                    <div class="input-group input-group-merge">
                                        <input id="rollcall_lokasi" class="form-control" name="lokasi" value=""
                                            disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Perkara">Catatan</label>
                                    <div class="input-group input-group-merge">
                                        <input id="rollcall_catatan" class="form-control" name="catatan" value=""
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
                                        <input id="rollcall_pegawai_sokong_id" class="form-control"
                                            name="pegawai_sokong_id" value="" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pegawai_lulus_id">Pegawai Lulus</label>
                                    <div class="input-group input-group-merge">
                                        <input id="rollcall_pegawai_lulus_id" class="form-control"
                                            name="pegawai_lulus_id" value="" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <label class=".badge-lg badge-pill badge-primary ">Penguatkuasa Terlibat</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group input-group-merge">
                                    <div id="penguatkuasa_id">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
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
                left: 'prev, next today',
                center: 'title',
                // right: 'month,agendaWeek'
                right: 'month'

            },
            events: SITEURL + '/dashboard',
            // selectable: true,
            // selectHelper: true,

            eventClick: function (event, jsEvent, view) {
                $.get(SITEURL + "/rollcalls/get_data/" + event.id, function (data, status) {
                    if (status == "success") {
                        $('#modalTitle').html(event.title);
                        var dateStringWithTimemula = moment(data.mula_rollcall).format(
                            'YYYY-MM-DD HH:mm:ss');
                        var dateStringWithTimeakhir = moment(data.akhir_rollcall).format(
                            'YYYY-MM-DD HH:mm:ss');
                        // console.log(dateStringWithTime)
                        $('#rollcall_mula').val(dateStringWithTimemula);
                        $('#rollcall_akhir').val(dateStringWithTimeakhir);
                        $('#rollcall_lokasi').val(data.lokasi);
                        $('#rollcall_catatan').val(data.catatan);
                        $('#rollcall_pegawai_sokong_id').val(data.pegawai_sokong['name']);
                        $('#rollcall_pegawai_lulus_id').val(data.pegawai_lulus['name']);
                        $('#rollcall_maklumat').html(data.maklumat);
                        var penguatkuasas = "<ol>";
                        data.user_rollcall.forEach((obj) => {

                            penguatkuasas += "<li>" + obj.penguatkuasa.name + "-" +
                                obj.penguatkuasa.nric + "</li>";
                        });
                        penguatkuasas += "</ol>";
                        $('#penguatkuasa_id').html(penguatkuasas);
                        $('#calendarModal').modal();
                    } else {
                        alert("Tiada data ditemui");
                    }
                });
            },
        });

    });

</script>

@endsection
