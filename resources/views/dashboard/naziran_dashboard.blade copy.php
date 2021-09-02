@extends('base')

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
                <div class="modal fade" id="new-event" tabindex="-1" role="dialog" aria-labelledby="new-event-label"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-secondary" role="document">
                        <div class="modal-content">
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form class="new-event--form">
                                    <div class="form-group">
                                        <label class="form-control-label">Event title</label>
                                        <input type="text"
                                            class="form-control form-control-alternative new-event--title"
                                            placeholder="Event Title">
                                    </div>

                                    <input class="new-event--start" />
                                    <input class="new-event--end" />
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

{{-- <script>
    $(document).ready(function () {
        $(".dashbord-body").removeClass("bg-white");
    });
    $(function () {
        $('#calendar').fullCalendar({
            selectable: true,
            height: 650,
            showNonCurrentDates: false,
            editable: false,
            defaultView: 'month',
            // events: [
            //   {
            //     title  : 'event1',
            //     start  : '2021-09-01'
            //   },
            //   {
            //     title  : 'event2',
            //     start  : '2021-09-05',
            //     end    : '2021-09-07'
            //   },
            //   {
            //     title  : 'event3',
            //     start  : '2021-09-09T12:30:00',
            //     allDay : false // will make the time show
            //   }
            // ],
            yearColumns: 3,
            header: {
                left: 'prev,next', //note no "buttons
                center: 'title',
                right: 'year,agendaDay,agendaWeek,month,timelineCustom'

            },

            eventSources: [{
              events: [ // put the array in the `events` property
                {
                  title  : 'event1',
                  start  : '2021-09-01'
                },
                {
                  title  : 'event2',
                  start  : '2021-09-05',
                  end    : '2021-09-07'
                },
                {
                  title  : 'event3',
                  start  : '2021-09-09T12:30:00',
                }
              ],
              // url: '/calendar', // use the `url` property
              color: 'red', // an option!
              textColor: 'white', // an option!
            }],
            eventDataTransform: function (eventData) {
                return {
                    title: eventData.name,
                    start: eventData.start_date,
                    end: eventData.end_date
                }
            },

        });
    });

</script> --}}

{{-- <script>
      $(document).ready(function() {
          // page is now ready, initialize the calendar...
          $('#calendar').fullCalendar({
              // put your options and callbacks here
              defaultView: 'dashboard.naziran_dashboard',
              events : [
                  @foreach($rollcalls as $rollcall)
                  {
                      title : '{{ $rollcall->tajuk_rollcall}}',
start : '{{ $rollcall->mula_rollcall }}',
@if ($rollcall->akhir_rollcall)
end: '{{ $rollcall->akhir_rollcall}}',
@endif
},
@endforeach
],
});
});
</script> --}}

{{-- <script>
          $(document).ready(function () {
              var SITEURL = "{{ url('/') }}";
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$.ajax({
url:'dashboard',
type: "GET",
cache: false,
datatype: 'json',
success: function(data){
GenerateCalendar(data);
},
error : function(error){
alert('Failed');
}
});
function GenerateCalendar(events) {
console.log(events);
// $('#calendar').fullCalendar('destroy');
$('#calendar').fullCalendar({
editable: true,
editable: true,
events: [
{
title : 'event1',
start : '2010-01-01'
},
{
title : 'event2',
start : '2010-01-05',
end : '2010-01-07'
},
{
title : 'event3',
start : '2010-01-09T12:30:00',
allDay : false // will make the time show
}
],
displayEventTime: false,
eventRender: function (event, element, view) {
if (event.allDay === 'true') {
event.allDay = true;
} else {
event.allDay = false;
}
},
selectable: true,
selectHelper: true,
});
}
});

</script> --}}

@endsection
