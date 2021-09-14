@extends('base')

@section('content')
<div class="header bg-primary pb-6">
    <div class="container-fluid ">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Pengurusan</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="/permohonans"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="/permohonans/create">Rollcall</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Rollcall</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="header bg-primary pb-3">
        <div class="container-fluid">
            <div class="row">
                @if(auth()->user()->role == 'naziran')
                <div class="col-lg-12 col text-right">
                    <a href="/rollcalls/create" class="btn btn-sm btn-neutral">+ Tambah Roll Call</a>
                </div>
                @elseif(auth()->user()->role == 'penyelia' or auth()->user()->role == 'ketua_bahagian' or
                auth()->user()->role == 'ketua_jabatan' )

                <div class="nav-wrapper">
                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab"
                                href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1"
                                aria-selected="true"><i class="ni ni-bell-55 mr-2"></i>Senarai Kehadiran Roll Call</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab"
                                href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2"
                                aria-selected="false"><i class="ni ni-calendar-grid-58 mr-2"></i>Senarai Sokong Roll
                                Call</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab"
                                href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3"
                                aria-selected="false"><i class="ni ni-calendar-grid-58 mr-2"></i>Senarai Tolak Roll
                                Call</a>
                        </li>
                    </ul>
                </div>
                @else
                --
                @endif
            </div>
        </div>
    </div>
</div>
@if(auth()->user()->role == 'penguatkuasa')
<div>
    <div class="container-fluid mt--6">

        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Senarai Roll Call</h3>
                        <div class="card-body px-0">
                            <!-- Light table -->
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Tajuk Roll Call</th>
                                            <th>No</th>
                                            <th>Waktu rollcall</th>
                                            <th>Waktu rollcall</th>
                                            <th>Waktu masuk</th>
                                            <th>Waktu keluar</th>
                                            <th>Kehadiran</th>
                                            <th>lokasi</th>
                                            <th>Catatan</th>
                                            <th>Status</th>
                                            <th>Tindakan</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($rollcalls as $rollcall)
                                        <tr>
                                            <td>{{$rollcall->tajuk_rollcall}}</td>
                                            <td>{{$rollcall->id}}</td>
                                            <td>{{$rollcall->mula_rollcall}}</td>
                                            <td>{{$rollcall->akhir_rollcall}}</td>
                                            <td>{{$rollcall->waktu_masuk}}</td>
                                            <td>{{$rollcall->waktu_keluar}}</td>
                                            <td></td>
                                            <td>{{$rollcall->lokasi}}</td>
                                            <td>{{$rollcall->catatan}}</td>
                                            @if($rollcall->status =='dibuka')
                                            <td>
                                                <span class="badge badge-pill badge-success">DIBUKA</span>
                                            </td>
                                            @elseif($rollcall->status =='ditutup')
                                            <td>
                                                <span class="badge badge-pill badge-danger">DITUTUP</span>
                                            </td>
                                            @elseif($rollcall->status =='ditangguh')
                                            <td>
                                                <span class="badge badge-pill badge-warning">DITANGGUH</span>
                                            </td>
                                            @endif
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#exampleModal">
                                                    Lihat
                                                </button>
                                            </td>
                                        </tr>
                                        @empty
                                        <div style="text-align:center;">
                                            <td>
                                                <h5> Tiada rekod </h5>
                                            </td>
                                        </div>
                                        @endforelse
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
</div>
@elseif(auth()->user()->role == 'pentadbir_sistem')
<div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">BILANGAN ROLL CALL DIBUKA
                                </h5>
                                <span class="h2 font-weight-bold mb-0">{{$dibuka}}</span>
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
                                <h5 class="card-title text-uppercase text-muted mb-0">BILANGAN ROLL CALL DITANGGUH
                                </h5>
                                <span class="h2 font-weight-bold mb-0">{{$ditangguh}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
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
                                <h5 class="card-title text-uppercase text-muted mb-0">BILANGAN ROLL CALL SELESAI
                                </h5>
                                <span class="h2 font-weight-bold mb-0">{{$ditutup}}</span>
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

        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Senarai Roll Call</h3>
                        <div class="card-body px-0">
                            <!-- Light table -->
                            <div class="table-responsive py-4">
                                <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tajuk Roll Call</th>
                                            <th>Waktu mula rollcall</th>
                                            <th>Waktu akhir rollcall</th>
                                            <th>lokasi</th>
                                            <th>Catatan</th>
                                            <th>Status</th>
                                            <th>Pegawai Sokong</th>
                                            <th>Pegawai Lulus</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rollcalls as $rollcall)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$rollcall->tajuk_rollcall}}</td>
                                            <td>{{$rollcall->mula_rollcall}}</td>
                                            <td>{{$rollcall->akhir_rollcall}}</td>
                                            <td>{{$rollcall->lokasi}}</td>
                                            <td>{{$rollcall->catatan}}</td>
                                          
                                            @if($rollcall->status =='dibuka')
                                            <td>
                                                <span class="badge badge-pill badge-success">DIBUKA</span>
                                            </td>
                                            @elseif($rollcall->status =='ditutup')
                                            <td>
                                                <span class="badge badge-pill badge-danger">DITUTUP</span>
                                            </td>
                                            @elseif($rollcall->status =='ditangguh')
                                            <td>
                                                <span class="badge badge-pill badge-warning">DITANGGUH</span>
                                            </td>
                                            @endif
                                            <td>{{$rollcall->pegawai_lulus['name']}}</td>
                                            <td>{{$rollcall->pegawai_sokong['name']}}</td>
                        
                                        </tr>

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
</div>
@elseif(auth()->user()->role == 'naziran')
<div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">BILANGAN ROLL CALL DIBUKA
                                </h5>
                                <span class="h2 font-weight-bold mb-0">{{$dibuka}}</span>
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
                                <h5 class="card-title text-uppercase text-muted mb-0">BILANGAN ROLL CALL DITANGGUH
                                </h5>
                                <span class="h2 font-weight-bold mb-0">{{$ditangguh}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
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
                                <h5 class="card-title text-uppercase text-muted mb-0">BILANGAN ROLL CALL SELESAI
                                </h5>
                                <span class="h2 font-weight-bold mb-0">{{$ditutup}}</span>
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

        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Senarai Roll Call</h3>
                        <div class="card-body px-0">
                            <!-- Light table -->
                            <div class="table-responsive py-4">
                                <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tajuk Roll Call</th>
                                            <th>Waktu mula rollcall</th>
                                            <th>Waktu akhir rollcall</th>
                                            <th>lokasi</th>
                                            <th>Catatan</th>
                                            <th>Pegawai Sokong</th>
                                            <th>Pegawa Lulus</th>
                                            <th>Status</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($rollcalls as $rollcall)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$rollcall->tajuk_rollcall}}</td>
                                            <td>{{$rollcall->mula_rollcall}}</td>
                                            <td>{{$rollcall->akhir_rollcall}}</td>
                                            <td>{{$rollcall->lokasi}}</td>
                                            <td>{{$rollcall->catatan}}</td>
                                            <td>
                                                @foreach ($users as $user)
                                                @if ($rollcall->pegawai_sokong_id == $user->id)
                                                    <option>
                                                    {{$user->name}} </option>
                                                @endif
                                                 @endforeach
                                            </td>
                                            <td>
                                                @foreach ($users as $user)
                                                @if ($rollcall->pegawai_lulus_id == $user->id)
                                                    <option>
                                                    {{$user->name}} </option>
                                                @endif
                                                 @endforeach  
                                            </td>
                                            @if($rollcall->status =='dibuka')
                                            <td>
                                                <span class="badge badge-pill badge-success">DIBUKA</span>
                                            </td>
                                            @elseif($rollcall->status =='ditutup')
                                            <td>
                                                <span class="badge badge-pill badge-danger">DITUTUP</span>
                                            </td>
                                            @elseif($rollcall->status =='ditangguh')
                                            <td>
                                                <span class="badge badge-pill badge-warning">DITANGGUH</span>
                                            </td>
                                            @endif
                                            {{-- <td>{{$rollcall->pegawai_sokong_id}}</td>
                                            <td>{{$rollcall->pegawai_lulus_id}}</td> --}}

                                            <td class="tindakan">
                                                {{-- <form method="POST" action="/rollcalls/{{$rollcall->id}}"> --}}
                                                {{-- @csrf
                                                    @method('DELETE') --}}
                                                <a href="/rollcalls/{{$rollcall->id}}/edit"
                                                    class="btn btn-primary btn-sm"> kemaskini <i
                                                        class="ni ni-single-copy-04"></i>
                                                </a>
                                                {{-- <a onclick="buang({{ $rollcall->id }})"
                                                class="btn btn-danger"> <i class="ni ni-basket"></i>
                                                </a> --}}
                                                <button onclick="buang({{ $rollcall->id }})"
                                                    class="btn btn-danger btn-sm">Buang <i
                                                        class="ni ni-basket"></i></button> </td>

                                            {{-- </form> --}}
                                        </tr>

                                        <script>
                                            function buang(id) {
                                                swal({
                                                    title: 'Makluman?',
                                                    text: "Buang butiran Roll Call?!",
                                                    type: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#3085d6',
                                                    cancelButtonColor: '#d33',
                                                    confirmButtonText: 'Buang',
                                                    cancelButtonText: 'Tutup',

                                                }).then(result => {
                                                    console.log("result", result);
                                                    if (result.value == true) {
                                                        console.log("id", id);
                                                        $.ajax({
                                                            url: "rollcalls/" + id,
                                                            type: "POST",
                                                            data: {
                                                                "id": id,
                                                                "_token": "{{ csrf_token() }}",
                                                                "_method": 'delete'
                                                            },
                                                            success: function (data) {
                                                                location.reload();
                                                            },
                                                        });

                                                    } else if (result.dismiss == "cancel") {
                                                        console.log("dismiss");
                                                    }
                                                })
                                            }

                                        </script>

                                        </td>
                                        </tr>
                                        @empty
                                        <div style="text-align:center;">
                                            <td>
                                                <h5> Tiada rekod </h5>
                                            </td>
                                        </div>
                                        @endforelse


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@elseif(auth()->user()->role == 'penyelia' )
<div class="card shadow">
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel"
                aria-labelledby="tabs-icons-text-1-tab">
                <div>
                    <div class="container-fluid mt--6">
                        {{-- <div class="card">
                            <div class="card-header">
                                <h3 class="mb-0">Filters</h3>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <form>
                                        <div class="row">
                                            <div class="col mb-4">
                                                <h4>Tajuk Roll Call</h4>
                                                <input type="text" class="form-control" placeholder="Tajuk Roll Call">
                                            </div>
                                            <div class="col">
                                                <h4>Lokasi Roll Call</h4>
                                                <input type="text" class="form-control" placeholder="Lokasi">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm">
                                                <h4>Tarikh Mula</h4>
                                                <input id="start" type="date" /><br />
                                            </div>
                                            <div class="col-sm">
                                                <h4>Tarikh Akhir</h4>
                                                <input id="start" type="date" /><br />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="row float-right">
                                    <div class="col-sm ">
                                        <button id="clearFilter" class="btn btn-sm btn-danger">Clear Filter</button>
                                        <button class="btn btn-sm btn-primary " id="filter">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="card">
                                    <!-- Card header -->
                                    <div class="card-header border-0">
                                        <h3 class="mb-0">Senarai Kehadiran Roll Call</h3>
                                    </div>
                                    <!-- Light table -->
                                    <div class="table-responsive">
                                        <table id="example"
                                            class="table table-striped table-bordered dt-responsive nowrap"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tajuk Roll Call</th>
                                                    <th>Waktu rollcall</th>
                                                    <th>Waktu rollcall</th>
                                                    <th>Waktu masuk</th>
                                                    <th>Waktu keluar</th>
                                                    <th>lokasi</th>
                                                    <th>Catatan</th>
                                                    <th>Pegawai Sokong</th>
                                                    <th>Pegawai Lulus</th>
                                                    <th>Status</th>
                                                    <th>Tindakan</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($rollcalls as $rollcall)
                                                <tr>
                                                    <td>{{$rollcall->id}}</td>
                                                    <td>{{$rollcall->tajuk_rollcall}}</td>
                                                    <td>{{$rollcall->mula_rollcall}}</td>
                                                    <td>{{$rollcall->akhir_rollcall}}</td>
                                                    <td>{{$rollcall->waktu_masuk}}</td>
                                                    <td>{{$rollcall->waktu_keluar}}</td>
                                                    <td>{{$rollcall->lokasi}}</td>
                                                    <td>{{$rollcall->catatan}}</td>
                                                    <td>{{$rollcall->pegawai_sokong_id}}</td>
                                                    <td>{{$rollcall->pegawai_lulus_id}}</td>
                                                    <td>{{$rollcall->status}}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary"
                                                            data-toggle="modal" data-target="#sokong">
                                                            Sokong
                                                        </button>
                                                        {{-- <a href="" class="btn btn-primary">Sokong</a> --}}
                                                        {{-- <a href="" class="btn btn-danger">Tolak</a> --}}
                                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                                            data-target="#tolak">
                                                            Tolak
                                                        </button>

                                                    </td>
                                                </tr>
                                                @empty
                                                <div style="text-align:center;">
                                                    <td>
                                                        <h5> Tiada rekod </h5>
                                                    </td>
                                                </div>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                <div>
                    <div class="container-fluid mt--6">
                        {{-- <div class="card">
                            <div class="card-header">
                                <h3 class="mb-0">Filters</h3>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <form>
                                        <div class="row">
                                            <div class="col mb-4">
                                                <h4>Tajuk Roll Call</h4>
                                                <input type="text" class="form-control" placeholder="Tajuk Roll Call">
                                            </div>
                                            <div class="col">
                                                <h4>Lokasi Roll Call</h4>
                                                <input type="text" class="form-control" placeholder="Lokasi">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm">
                                                <h4>Tarikh Mula</h4>
                                                <input id="start" type="date" /><br />
                                            </div>
                                            <div class="col-sm">
                                                <h4>Tarikh Akhir</h4>
                                                <input id="start" type="date" /><br />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="row float-right">
                                    <div class="col-sm ">
                                        <button id="clearFilter" class="btn btn-sm btn-danger">Clear Filter</button>
                                        <button class="btn btn-sm btn-primary " id="filter">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div>               --}}
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="card">
                                    <!-- Card header -->
                                    <div class="card-header border-0">
                                        <h3 class="mb-0">Senarai Sokong Roll Call</h3>
                                    </div>
                                    <!-- Light table -->
                                    <div class="table-responsive">
                                        <table id="example"
                                            class="table table-striped table-bordered dt-responsive nowrap"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tajuk Roll Call</th>
                                                    <th>Waktu rollcall</th>
                                                    <th>Waktu rollcall</th>
                                                    <th>Waktu masuk</th>
                                                    <th>Waktu keluar</th>
                                                    <th>lokasi</th>
                                                    <th>Catatan</th>
                                                    <th>Pegawai Sokong</th>
                                                    <th>Pegawai Lulus</th>
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
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>


                                                    <td>
                                                        <button type="button" class="btn btn-primary"
                                                            data-toggle="modal">
                                                            Lihat
                                                        </button>
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
                </div>
            </div>
            <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                <div>
                    <div class="container-fluid mt--6">
                        {{-- <div class="card">
                            <div class="card-header">
                                <h3 class="mb-0">Filters</h3>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <form>
                                        <div class="row">
                                            <div class="col mb-4">
                                                <h4>Tajuk Roll Call</h4>
                                                <input type="text" class="form-control" placeholder="Tajuk Roll Call">
                                            </div>
                                            <div class="col">
                                                <h4>Lokasi Roll Call</h4>
                                                <input type="text" class="form-control" placeholder="Lokasi">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm">
                                                <h4>Tarikh Mula</h4>
                                                <input id="start" type="date" /><br />
                                            </div>
                                            <div class="col-sm">
                                                <h4>Tarikh Akhir</h4>
                                                <input id="start" type="date" /><br />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="row float-right">
                                    <div class="col-sm ">
                                        <button id="clearFilter" class="btn btn-sm btn-danger">Clear Filter</button>
                                        <button class="btn btn-sm btn-primary " id="filter">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="card">
                                    <!-- Card header -->
                                    <div class="card-header border-0">
                                        <h3 class="mb-0">Senarai Sokong Roll Call</h3>
                                    </div>
                                    <!-- Light table -->
                                    <div class="table-responsive">
                                        <table id="example"
                                            class="table table-striped table-bordered dt-responsive nowrap"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tajuk Roll Call</th>
                                                    <th>Waktu rollcall</th>
                                                    <th>Waktu rollcall</th>
                                                    <th>Waktu masuk</th>
                                                    <th>Waktu keluar</th>
                                                    <th>lokasi</th>
                                                    <th>Catatan</th>
                                                    <th>Pegawai Sokong</th>
                                                    <th>Pegawai Lulus</th>
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
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>


                                                    <td>
                                                        <button type="button" class="btn btn-primary"
                                                            data-toggle="modal">
                                                            Lihat
                                                        </button>
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
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Sokong -->
<div class="modal fade" id="sokong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Makluman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Sokong kehadiran roll call penguatkuasa
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tolak-->
<div class="modal fade" id="tolak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Tolak kehadiran roll call penguatkuasa ?
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Catatan</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
@elseif(auth()->user()->role == 'ketua_bahagian'or auth()->user()->role == 'ketua_jabatan' )
<div class="card shadow">
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel"
                aria-labelledby="tabs-icons-text-1-tab">
                <div>
                    <div class="container-fluid mt--6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="mb-0">Filters</h3>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <form>
                                        <div class="row">
                                            <div class="col mb-4">
                                                <h4>Tajuk Roll Call</h4>
                                                <input type="text" class="form-control" placeholder="Tajuk Roll Call">
                                            </div>
                                            <div class="col">
                                                <h4>Lokasi Roll Call</h4>
                                                <input type="text" class="form-control" placeholder="Lokasi">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm">
                                                <h4>Tarikh Mula</h4>
                                                <input id="start" type="date" /><br />
                                            </div>
                                            <div class="col-sm">
                                                <h4>Tarikh Akhir</h4>
                                                <input id="start" type="date" /><br />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="row float-right">
                                    <div class="col-sm ">
                                        <button id="clearFilter" class="btn btn-sm btn-danger">Clear Filter</button>
                                        <button class="btn btn-sm btn-primary " id="filter">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row ">

                            <div class="col-md-12">
                                <div class="card">
                                    <!-- Card header -->
                                    <div class="card-header border-0">
                                        <h3 class="mb-0">Senarai Kehadiran Roll Call</h3>
                                    </div>
                                    <!-- Light table -->
                                    <div class="table-responsive">
                                        <table id="example"
                                            class="table table-striped table-bordered dt-responsive nowrap"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tajuk Roll Call</th>
                                                    <th>Waktu rollcall</th>
                                                    <th>Waktu rollcall</th>
                                                    <th>Waktu masuk</th>
                                                    <th>Waktu keluar</th>
                                                    <th>lokasi</th>
                                                    <th>Catatan</th>
                                                    <th>Pegawai Sokong</th>
                                                    <th>Pegawai Lulus</th>
                                                    <th>Status</th>
                                                    <th>Tindakan</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($rollcalls as $rollcall)
                                                <tr>
                                                    <td>{{$rollcall->id}}</td>
                                                    <td>{{$rollcall->tajuk_rollcall}}</td>
                                                    <td>{{$rollcall->mula_rollcall}}</td>
                                                    <td>{{$rollcall->akhir_rollcall}}</td>
                                                    <td>{{$rollcall->waktu_masuk}}</td>
                                                    <td>{{$rollcall->waktu_keluar}}</td>
                                                    <td>{{$rollcall->lokasi}}</td>
                                                    <td>{{$rollcall->catatan}}</td>
                                                    <td>{{$rollcall->pegawai_sokong_id}}</td>
                                                    <td>{{$rollcall->pegawai_lulus_id}}</td>
                                                    <td>{{$rollcall->status}}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary"
                                                            data-toggle="modal" data-target="#sokong">
                                                            Sokong
                                                        </button>
                                                        {{-- <a href="" class="btn btn-primary">Sokong</a> --}}
                                                        {{-- <a href="" class="btn btn-danger">Tolak</a> --}}
                                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                                            data-target="#tolak">
                                                            Tolak
                                                        </button>

                                                    </td>
                                                </tr>
                                                @empty
                                                <div style="text-align:center;">
                                                    <td>
                                                        <h5> Tiada rekod </h5>
                                                    </td>
                                                </div>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                <div>
                    <div class="container-fluid mt--6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="mb-0">Filters</h3>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <form>
                                        <div class="row">
                                            <div class="col mb-4">
                                                <h4>Tajuk Roll Call</h4>
                                                <input type="text" class="form-control" placeholder="Tajuk Roll Call">
                                            </div>
                                            <div class="col">
                                                <h4>Lokasi Roll Call</h4>
                                                <input type="text" class="form-control" placeholder="Lokasi">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm">
                                                <h4>Tarikh Mula</h4>
                                                <input id="start" type="date" /><br />
                                            </div>
                                            <div class="col-sm">
                                                <h4>Tarikh Akhir</h4>
                                                <input id="start" type="date" /><br />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="row float-right">
                                    <div class="col-sm ">
                                        <button id="clearFilter" class="btn btn-sm btn-danger">Clear Filter</button>
                                        <button class="btn btn-sm btn-primary " id="filter">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="card">
                                    <!-- Card header -->
                                    <div class="card-header border-0">
                                        <h3 class="mb-0">Senarai Sokong Roll Call</h3>
                                    </div>
                                    <!-- Light table -->
                                    <div class="table-responsive">
                                        <table id="example"
                                            class="table table-striped table-bordered dt-responsive nowrap"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tajuk Roll Call</th>
                                                    <th>Waktu rollcall</th>
                                                    <th>Waktu rollcall</th>
                                                    <th>Waktu masuk</th>
                                                    <th>Waktu keluar</th>
                                                    <th>lokasi</th>
                                                    <th>Catatan</th>
                                                    <th>Pegawai Sokong</th>
                                                    <th>Pegawai Lulus</th>
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
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>


                                                    <td>
                                                        <button type="button" class="btn btn-primary"
                                                            data-toggle="modal" data-target="#sokong">
                                                            Sokong
                                                        </button>
                                                        {{-- <a href="" class="btn btn-primary">Sokong</a> --}}
                                                        {{-- <a href="" class="btn btn-danger">Tolak</a> --}}
                                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                                            data-target="#tolak">
                                                            Tolak
                                                        </button>

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
                </div>
            </div>
            <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                <div>
                    <div class="container-fluid mt--6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="mb-0">Filters</h3>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <form>
                                        <div class="row">
                                            <div class="col mb-4">
                                                <h4>Tajuk Roll Call</h4>
                                                <input type="text" class="form-control" placeholder="Tajuk Roll Call">
                                            </div>
                                            <div class="col">
                                                <h4>Lokasi Roll Call</h4>
                                                <input type="text" class="form-control" placeholder="Lokasi">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm">
                                                <h4>Tarikh Mula</h4>
                                                <input id="start" type="date" /><br />
                                            </div>
                                            <div class="col-sm">
                                                <h4>Tarikh Akhir</h4>
                                                <input id="start" type="date" /><br />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="row float-right">
                                    <div class="col-sm ">
                                        <button id="clearFilter" class="btn btn-sm btn-danger">Clear Filter</button>
                                        <button class="btn btn-sm btn-primary " id="filter">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="card">
                                    <!-- Card header -->
                                    <div class="card-header border-0">
                                        <h3 class="mb-0">Senarai Tolak Roll Call</h3>
                                    </div>
                                    <!-- Light table -->
                                    <div class="table-responsive">
                                        <table id="example"
                                            class="table table-striped table-bordered dt-responsive nowrap"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tajuk Roll Call</th>
                                                    <th>Waktu rollcall</th>
                                                    <th>Waktu rollcall</th>
                                                    <th>Waktu masuk</th>
                                                    <th>Waktu keluar</th>
                                                    <th>lokasi</th>
                                                    <th>Catatan</th>
                                                    <th>Pegawai Sokong</th>
                                                    <th>Pegawai Lulus</th>
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
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>


                                                    <td>
                                                        <button type="button" class="btn btn-primary"
                                                            data-toggle="modal">
                                                            Lihat
                                                        </button>
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
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Sokong -->
<div class="modal fade" id="sokong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Makluman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Lulus kehadiran roll call penguatkuasa
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tolak-->
<div class="modal fade" id="tolak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Tolak kehadiran roll call penguatkuasa ?
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Catatan</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
@else
<div>
    <div class="container-fluid mt--12">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Modul ini tidak dibekalkan kepada anda. Sila hubungi pentadbir
                            sistem anda.</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<footer class="footer pt-0">
    <div class="row align-items-center justify-content-lg-between">
        <div class="col-lg-6">
            <div class="copyright text-center  text-lg-left  text-muted">
                &copy; 2021 <a href="" class="font-weight-bold ml-1" target="">Sistem Pengurusan Elaun
                    Lebih Masa</a>
            </div>
        </div>
    </div>
</footer>
</div>
@endsection
@section ('script')

@endsection
