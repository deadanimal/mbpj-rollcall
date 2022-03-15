@extends('base')
{{-- @section('head')
<head>

<meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
</head>
@endsection --}}
@section('content')

{{-- calendar --}}
<div class="container-fluid mt--12">
    <!-- Card body -->
    <button type="button" id="prev">
        &lt;
        </button>
        <button type="button" id="next">
        &gt;
        </button>
        <button type="button" id="today">
        Today
        </button>
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
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <h1 id="modalTitle" class="modal-title "></h1>
                        </div>
                    </div>

                    <!-- Card body -->
                    <div class="card-body">
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="maklumat">Makluman</label>
                                    <div class="input-group input-group-merge">
                                        <input id="maklumat" class="form-control" name="maklumat" value="" disabled>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
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
                // start: 'title', // will normally be on the left. if RTL, will be on the right
                // center: '',
                // end: 'today prev,next'
            },
            events: SITEURL + '/dashboard',
            selectable: true,
            selectHelper: true,


            eventClick: function (event, jsEvent, view) {
                $.get(SITEURL + "/rollcalls/get_data/" + event.id, function (data, status) {
                    if (status == "success") {
                        $('#modalTitle').html(event.title);
                        $('#rollcall_mula').val(data.mula_rollcall);
                        $('#rollcall_akhir').val(data.akhir_rollcall);
                        $('#rollcall_lokasi').val(data.lokasi);
                        $('#rollcall_catatan').val(data.catatan);
                        $('#rollcall_pegawai_sokong_id').val(data.pegawai_sokong['name']);
                        $('#rollcall_pegawai_lulus_id').val(data.pegawai_lulus['name']);
                        $('#rollcall_maklumat').html(data.maklumat);
                        $('#calendarModal').modal();
                    } else {
                        alert("Tiada data ditemui");
                    }
                });
            },
        });

    });


</script>
<script>
$("#next").click(function() {
  $("#calendar").fullCalendar("next");
});

$("#prev").click(function() {
  $("#calendar").fullCalendar("prev");
});

$("#today").click(function() {
  $("#calendar").fullCalendar("today");
});
</script>
@endsection

