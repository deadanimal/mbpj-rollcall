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
            <div class="row ">
                @if(auth()->user()->role == 'naziran')
                <div class="col-lg-12 col text-right">
                    <a href="/rollcalls/create" class="btn btn-sm btn-neutral">+ Tambah Roll Call</a>
                </div>
                @elseif(auth()->user()->role == 'penyelia' or auth()->user()->role == 'ketua_bahagian' or
                auth()->user()->role == 'ketua_jabatan' )

                <div class="nav-wrapper  w-100">
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
                                aria-selected="false"><i class="ni ni-calendar-grid-58 mr-2"></i>Senarai Lulus Roll
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
                        <h3 class="mb-0">Senarai Roll Call Perlu Hadir</h3>
                        <div class="card-body px-0">
                            <!-- Light table -->
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tajuk Roll Call</th>
                                            <th>Waktu Mula <br><br>Akhir rollcall</th>                                              
                                            <th>Lokasi <br><br> Makluman</th>
                                            <th>Waktu masuk <br><br> Waktu keluar</th>
                                            <th style="background-color:#00FF00" > Masuk / Keluar <br><br> eKedatangan</th>
                                            <th>Pegawai Sokong <br><br> Pegawai Lulus</th>
                                            <th>Tindakan</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($userrollcalls as $userrollcall)
                                        <tr>
                                            <td>
                                                {{$loop->index+1}}
                                            </td>

                                            <td>{{$userrollcall->tajuk_rollcall}}<br><br>

                                                @if($userrollcall->status =='dibuka')
                                               
                                                <span class="badge badge-pill badge-success">DIBUKA</span>
                                           
                                                @elseif($userrollcall->status =='ditutup')
                                            
                                                    <span class="badge badge-pill badge-danger">DITUTUP</span>
                                            
                                                @elseif($userrollcall->status =='ditangguh')
                                            
                                                    <span class="badge badge-pill badge-warning">DITANGGUH</span>
                                            
                                                @endif

                                            </td>
                                            {{-- <td>{{$userrollcall->id}}</td> --}}

                                            <td>{{$userrollcall->mula_rollcall}} <br><br>{{$userrollcall->akhir_rollcall}}</td>
                                            <td>{{$userrollcall->lokasi}} <br> <br> {{$userrollcall->catatan}}<br><br> </td>
                                            <td>
                                                {{$userrollcall->masuk}}<br><br>

                                                @if($userrollcall->masuk === null)
                                                <input type="datetime-local" onchange="MasaMula({{$userrollcall->userrollcall_id}},this)" value={{$userrollcall->mula}}>
                                                 <br><br>
                                                 @elseif($userrollcall->masuk !== null)
                                                 @endif

                                                {{$userrollcall->keluar}}<br><br>

                                                @if($userrollcall->keluar === null)
                                                <input type="datetime-local" onchange="MasaAkhir({{$userrollcall->userrollcall_id}},this)" value={{$userrollcall->mula}}>
                                                @elseif($userrollcall->keluar !== null)

                                                @endif
                                            
                                            </td>
                                            <td> 
                                                <input type="text" value="ekedatangan" disabled>
                                                
                                                <br> <br> 
                                
                                                <input type="text" value="ekedatangan" disabled>
                                                
                                            </td>
                                        
                                            
                                            <td> {{$userrollcall->pegawai_sokong_name}} <br><br>{{$userrollcall->pegawai_lulus_name}}</td>
                                   
                                            <td>
                                                @if($userrollcall->masuk === null)

                                                   <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#exampleModal{{ $userrollcall->userrollcall_id }}">
                                                    Hantar Sebab
                                                    </button>      
                                                    
                                                @elseif($userrollcall->masuk !== null)
                                            
                                                    <span class="badge badge-pill badge-success">Dalam Proses</span><br><br>

                                                    @if($userrollcall->keluar !== null)

                                                    <span class="badge badge-pill badge-success">Dalam Proses</span><br><br>                            

                                                    @elseif($userrollcall->keluar === null)

                                                    <span class="badge badge-pill badge-primary">Dalam Proses</span><br><br>

                                                        {{-- @if($userrollcall->keterangan === null) --}} 


                                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#sebabtakhadir{{$userrollcall->userrollcall_id}}">
                                                        Hantar Sebab
                                                        </button>  
                                                        <br><br>{{$userrollcall->keterangan}}

                                                        {{-- @elseif($userrollcall->keterangan !== null)

                                                        @endif --}}
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="sebabtakhadir{{ $userrollcall->userrollcall_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel ">Kemaskini Sebab Tidak Hadir</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="/simpan_sebab/{{$userrollcall->userrollcall_id }}/">
                                                            @csrf
                                                            
                                                            <label for="exampleFormControlTextarea1">Keterangan</label>
                                                            <textarea class="form-control" name="keterangan" id="exampleFormControlTextarea1 "  placeholder="Sebab Tidak Hadir Roll Call"></textarea><br><br>
                                                    
                                                            <label for="avatar">Lampiran Sebab Tidak Hadir:</label>

                                                            <input type="file" id="avatar" name="file_path" accept="image/png, image/jpeg">
                                                        

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-primary">Kemaskini</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
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
                                            <th>Waktu mula <br><br>akhir rollcall</th>
                                            <th>lokasi<br><br> Catatan</th>
                                            <th>Pegawai Sokong <br><br>Pegawai Lulus</th>
                                            <th>Tindakan</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rollcalls as $rollcall)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$rollcall->tajuk_rollcall}}<br><br>
                                                @if($rollcall->status =='dibuka')
                                              
                                                    <span class="badge badge-pill badge-success">DIBUKA</span>
                                               
                                                @elseif($rollcall->status =='ditutup')
                                              
                                                    <span class="badge badge-pill badge-danger">DITUTUP</span>
                                               
                                                @elseif($rollcall->status =='ditangguh')
                                              
                                                    <span class="badge badge-pill badge-warning">DITANGGUH</span>
                                               
                                                @endif
                                        
                                            </td>
                                            <td>{{$rollcall->mula_rollcall}}<br><br>{{$rollcall->akhir_rollcall}}</td>
                                            <td>{{$rollcall->lokasi}}<br><br>{{$rollcall->catatan}}</td>
                                            <td>{{$rollcall->pegawai_lulus_id}}<br><br>{{$rollcall->pegawai_sokong_id}}</td>
                                            <td>   
                                            <button onclick="buang({{ $rollcall->id }})" class="btn btn-danger btn-sm">Buang <i class="ni ni-basket"></i></button>
                                            </td>

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
                                            <th>Waktu mula <br><br> akhir rollcall</th>
                                            <th>lokasi<br><br>Catatan</th>
                                            <th>Pegawai Sokong<br><br>Pegawa Lulus</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rollcalls as $rollcall)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$rollcall->tajuk_rollcall}}<br><br>  
                                                @if($rollcall->status =='dibuka')
                                               
                                                    <span class="badge badge-pill badge-success">DIBUKA</span>
                                                
                                                @elseif($rollcall->status =='ditutup')
                                               
                                                    <span class="badge badge-pill badge-danger">DITUTUP</span>
                                                
                                                @elseif($rollcall->status =='ditangguh')
                                               
                                                    <span class="badge badge-pill badge-warning">DITANGGUH</span>
                                                
                                                @endif
                                            </td>
                                            <td>{{$rollcall->akhir_rollcall}}<br><br>{{$rollcall->mula_rollcall}}</td>
                                            <td>{{$rollcall->lokasi}}<br><br>{{$rollcall->catatan}}</td>
                                            <td>
                                                @foreach ($users as $user)
                                                @if ($rollcall->pegawai_sokong_id == $user->id)
                                                <option>
                                                    {{$user->name}} </option>
                                                @endif
                                                @endforeach
                                                <br>
                                                @foreach ($users as $user)
                                                @if ($rollcall->pegawai_lulus_id == $user->id)
                                                <option>
                                                    {{$user->name}} </option>
                                                @endif
                                                @endforeach
                                            </td>
                                            <td class="tindakan">
                                             
                                                <a href="/rollcalls/{{$rollcall->id}}/edit"
                                                    class="btn btn-primary btn-sm"> kemaskini <i
                                                        class="ni ni-single-copy-04"></i>
                                                </a>
                                             
                                                <button onclick="buang({{ $rollcall->id }})"
                                                    class="btn btn-danger btn-sm">Buang <i
                                                        class="ni ni-basket"></i></button>
                                            </td>

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
@elseif(auth()->user()->role == 'ketua_bahagian'or auth()->user()->role == 'ketua_jabatan'or auth()->user()->role == 'penyelia' )
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
                                <h3 class="mb-0">Senarai Roll Call</h3>
                            </div>
                            <!-- Light table -->
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tajuk Roll Call</th>
                                            <th>Waktu Mula <br><br>Akhir rollcall</th>                                              
                                            <th>Lokasi <br><br> Makluman</th>
                                            <th>Pegawai Sokong <br><br> Pegawai Lulus</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rollcalls as $rollcall)
                                        <tr>
                                            <td>{{$rollcall->id}}</td>
                                            <td>{{$rollcall->tajuk_rollcall}}<br><br>
                                                @if($rollcall->status =='dibuka')
                                            
                                                <span class="badge badge-pill badge-success">DIBUKA</span>
                                            
                                                @elseif($rollcall->status =='ditutup')
                                                
                                                    <span class="badge badge-pill badge-danger">DITUTUP</span>
                                                
                                                @elseif($rollcall->status =='ditangguh')
                                                
                                                    <span class="badge badge-pill badge-warning">DITANGGUH</span>
                                                
                                                @endif                                             
                                            </td>
                                            <td>{{$rollcall->mula_rollcall}}<br><br>{{$rollcall->akhir_rollcall}}</td>
                                        
                                            <td>{{$rollcall->lokasi}}<br> <br>{{$rollcall->catatan}}</td>
                                            <td>{{$rollcall->pegawai_sokong}} <br> <br>{{$rollcall->pegawai_lulus}}</td>
                                          
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#lihat{{$rollcall->id}}">
                                                    Lihat
                                                </button>   
                                            </td>
                                        </tr>
                                        {{-- Modal Lihat --}}
                                        <div class="modal fade " id="lihat{{$rollcall->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"> Makluman</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" value="{{$rollcall->tajuk_rollcall}}" disabled>
                                                            <input type="text" class="form-control" value="{{$rollcall->mula_rollcall}}-{{$rollcall->akhir_rollcall}}"disabled>
                                                            <input type="text" class="form-control" value="{{$rollcall->status}}"disabled>
                                                            <input type="text" class="form-control" value="{{$rollcall->lokasi}}"disabled>
                                                            <input type="text" class="form-control" value="{{$rollcall->catatan}}"disabled>
                                                            <input type="text" class="form-control" value="{!!$rollcall->maklumat!!}"disabled>
                                                            <input type="text" class="form-control" value="{{$rollcall->pegawai_sokong}} - {{$rollcall->pegawai_lulus}} "disabled>



                                                          </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                                                        {{-- <button type="button" class="btn btn-primary">Simpan</button> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>             
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
                                <table id="example" class="display table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tajuk Roll Call</th>
                                            <th>Nama Penguatkuasa</th>
                                            <th>Waktu Mula <br><br> Akhir rollcall</th>                                              
                                            <th>Lokasi <br><br> Makluman</th>
                                            <th>Waktu masuk <br><br> Waktu keluar</th>
                                            <th style="background-color:#00FF00" > Masuk / Keluar <br><br> eKedatangan</th>
                                            <th>Pegawai Sokong<br><br> Pegawai Lulus</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rollcall_sokong_baru as $pegawai_sokong_rollcall)
                                        <tr>
                                            
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$pegawai_sokong_rollcall->tajuk_rollcall}}</td>
                                            <td>{{$pegawai_sokong_rollcall->nama_pemohon}}</td>
                                            <td>{{$pegawai_sokong_rollcall->mula_rollcall}} <br><br> {{$pegawai_sokong_rollcall->akhir_rollcall}}</td>
                                            <td >{{$pegawai_sokong_rollcall->lokasi}} <br><br> {{$pegawai_sokong_rollcall->catatan}}</td>

                                            @if($pegawai_sokong_rollcall->masuk !== null)
                                            <td>{{$pegawai_sokong_rollcall->masuk}} <br> <br>{{$pegawai_sokong_rollcall->keluar}}</td>
                                            @elseif($pegawai_sokong_rollcall->masuk === null)
                                            <td>                      
                                                 <span class="badge badge-pill badge-primary">Dalam Proses</span>
                                                <br> <br>
                                                <span class="badge badge-pill badge-primary">Dalam Proses</span>
                                            </td>
                                            @endif                                        
                                            <td>
                                                <input type="text" value="ekedatangan" disabled>
                                                <br> <br> 
                                                <input type="text" value="ekedatangan" disabled>
                                            </td>
                                            <td>{{$pegawai_sokong_rollcall->pegawai_sokong_name}}<br><br>{{$pegawai_sokong_rollcall->pegawai_lulus_name}}</td>
                                            <td>
                                                {{-- satu if masuk belum ada --}}
                                                @if($pegawai_sokong_rollcall->masuk !== null)   

                                                        {{-- semak sokong --}}

                                                       @if($pegawai_sokong_rollcall->sokong === null)

                                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                            data-target="#sokong{{$pegawai_sokong_rollcall->id}}">
                                                            Sokong
                                                        </button>
                                                        <br><br>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#tolak_sokong{{$pegawai_sokong_rollcall->id}}">
                                                            Tolak
                                                        </button>
                                                        @elseif($pegawai_sokong_rollcall->sokong === 1)
                                                        <span class="badge badge-pill badge-success">Disahkan Pegawai Sokong</span><br><br>
                                                       
                                                            {{-- semak lulus --}}

                                                            @if($pegawai_sokong_rollcall->lulus === null)
                                                            <span class="badge badge-pill badge-primary">Dalam Proses Pegawai Lulus</span>
                                                            @elseif($pegawai_sokong_rollcall->lulus === 1)
                                                            <span class="badge badge-pill badge-success">Diluluskan Pegawai Lulus</span>
                                                            @elseif($pegawai_sokong_rollcall->lulus === 0)
                                                            <span class="badge badge-pill badge-danger">Ditolak Pegawai Lulus</span>
                                                            @endif

                                                        @elseif($pegawai_sokong_rollcall->sokong === 0)
                                                        <span class="badge badge-pill badge-danger">Ditolak Pegawai Sokong</span><br><br>
                                                        <span class="badge badge-pill badge-danger">Ditolak kehadiran </span>
                                                        @endif

                                                @elseif($pegawai_sokong_rollcall->masuk ===null)
                                                <span class="badge badge-pill badge-primary">Dalam Proses</span>
                                                <br> <br>
                                                <span class="badge badge-pill badge-primary">Dalam Proses</span>
                                                @endif

                                            </td>
                                        </tr>
                                        <!-- Modal Sokong -->
                                        <div class="modal fade" id="sokong{{$pegawai_sokong_rollcall->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"> Makluman</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Sokong Kehadiran Roll Call Penguatkuasa
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Tutup</button>

                                                        <a href="/sokong/{{$pegawai_sokong_rollcall->id}}/"
                                                            class="btn btn-success btn-sm">Sokong</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Tolak-->
                                        <div class="modal fade" id="tolak_sokong{{$pegawai_sokong_rollcall->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" 
                                                        id="exampleModalLabel"> 
                                                            Tolak Kehadiran Roll Call Penguatkuasa ?
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <form method="POST" action="/tolak_sokong">
                                                                @csrf
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="Perkara">Sebab Tolak Permohonan</label>
                                                                        <input type="hidden"
                                                                            value="{{ $pegawai_sokong_rollcall->id }}" name="id">
                                                                        <div class="input-group input-group-merge">
                                                                            <input class="form-control"
                                                                                name="sokong_sebab"
                                                                                placeholder="Sebab" type="text">
                                                                        </div>
                                                                    </div>
                                                                
                                                                <button type="button" class="btn btn-primary btn-sm "data-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-success btn-sm">Hantar</button>
                                                          
                                                         
                                                            </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
    <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
        <div>
            <div class="container-fluid mt--6">
                {{-- Filter --}}
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
                {{-- Senarai LULUS --}}
                <div class="row ">
                    <div class="col-md-12">
                        <div class="card">
                            <!-- Card header -->
                            <div class="card-header border-0">
                                <h3 class="mb-0">Senarai Lulus Roll Call</h3>
                            </div>
                            <!-- Light table -->
                            <div class="table-responsive">
                                <table id="example"
                                    class="display table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tajuk Roll Call</th>
                                            <th>Nama Penguatkuasa</th>
                                            <th>Waktu Mula <br><br> Akhir rollcall</th>                                              
                                            <th>Lokasi <br><br> Makluman</th>
                                            <th>Waktu masuk <br><br> Waktu keluar</th>
                                            <th style="background-color:#00FF00" > Masuk / Keluar <br><br> eKedatangan</th>
                                            <th>Pegawai Sokong<br><br> Pegawai Lulus</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rollcall_lulus_baru as $pegawai_lulus_rollcall)
                                        <tr>
                                            
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$pegawai_lulus_rollcall->tajuk_rollcall}}</td>
                                            <td>{{$pegawai_lulus_rollcall->nama_pemohon}}</td>
                                            <td>{{$pegawai_lulus_rollcall->mula_rollcall}} <br><br> {{$pegawai_lulus_rollcall->akhir_rollcall}}</td>
                                            <td>{{$pegawai_lulus_rollcall->lokasi}} <br><br> {{$pegawai_lulus_rollcall->catatan}}</td>

                                            @if($pegawai_lulus_rollcall->masuk !== null)
                                            <td>{{$pegawai_lulus_rollcall->masuk}} <br> <br>{{$pegawai_lulus_rollcall->keluar}}</td>
                                            @elseif($pegawai_lulus_rollcall->masuk === null)
                                            <td>                      
                                                 <span class="badge badge-pill badge-primary">Dalam Proses</span>
                                                <br> <br>
                                                <span class="badge badge-pill badge-primary">Dalam Proses</span>
                                            </td>
                                            @endif
                                            <td>
                                                <input type="text" value="ekedatangan" disabled>
                                                <br> <br> 
                                                <input type="text" value="ekedatangan" disabled>
                                            </td>
                                            <td>{{$pegawai_lulus_rollcall->pegawai_sokong_name}}<br><br>{{$pegawai_lulus_rollcall->pegawai_lulus_name}}</td>
                                            <td>
                                                @if($pegawai_lulus_rollcall->masuk !== null)

                                                   @if($pegawai_sokong_rollcall)
                                                    {{-- Semak lulus status --}}
                                                    @if($pegawai_lulus_rollcall->sokong === null)

                                                       <span class="badge badge-pill badge-primary">Dalam Proses Pegawai Lulus</span>

                                                     @elseif($pegawai_lulus_rollcall->sokong === 1)

                                                         @if($pegawai_lulus_rollcall->lulus === null)

                                                            <span class="badge badge-pill badge-success">Disahkan Pegawai Sokong</span><br><br>

                                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                            data-target="#lulus{{$pegawai_lulus_rollcall->id}}">
                                                            Lulus
                                                            </button>
                                                            {{-- <br><br> --}}
                                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                                data-target="#tolak_lulus{{$pegawai_lulus_rollcall->id}}">
                                                                Tolak
                                                            </button>

                                                        @elseif($pegawai_lulus_rollcall->lulus === 1)

                                                            <span class="badge badge-pill badge-success">Disahkan Pegawai Sokong</span><br><br>
                                                            <span class="badge badge-pill badge-success">Diluluskan Pegawai Lulus</span>

                                                        @elseif($pegawai_lulus_rollcall->lulus === 0)

                                                            <span class="badge badge-pill badge-success">Disahkan Pegawai Sokong</span><br><br>
                                                            <span class="badge badge-pill badge-danger">Ditolak Pegawai Lulus</span>

                                                        @endif


                                                    @elseif($pegawai_lulus_rollcall->sokong === 0)
                                                    <span class="badge badge-pill badge-danger">Ditolak Pegawai Sokong</span><br><br>
                                                    <span class="badge badge-pill badge-danger">Ditolak Pegawai Lulus</span>

                                                    @endif

                                                    @elseif($pegawai_lulus_rollcall->lulus === 1)
                                                    <span class="badge badge-pill badge-success">Disahkan Pegawai Lulus</span><br><br>
                                                    @elseif($pegawai_lulus_rollcall->lulus === 0)
                                                    <span class="badge badge-pill badge-danger">Ditolak Pegawai Lulus</span><br><br>
                                                    @endif

                                                @elseif($pegawai_lulus_rollcall->masuk ===null)
                                                <span class="badge badge-pill badge-primary">Dalam Proses</span>
                                                <br> <br>
                                                <span class="badge badge-pill badge-primary">Dalam Proses</span>
                                                @endif

                                            </td>
                                        </tr>
                                         <!-- Modal lulus -->
                                         <div class="modal fade" id="lulus{{$pegawai_lulus_rollcall->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"> Makluman</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Lulus Kehadiran Roll Call Penguatkuasa
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Tutup</button>

                                                        <a href="/lulus/{{$pegawai_lulus_rollcall->id}}/"
                                                            class="btn btn-success btn-sm">Lulus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Tolak-->
                                        <div class="modal fade" id="tolak_lulus{{$pegawai_lulus_rollcall->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"> Tolak Kehadiran Roll Call Penguatkuasa ?
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <form method="POST" action="/tolak_lulus">
                                                                @csrf
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="Perkara">Sebab Tolak Permohonan</label>
                                                                        <input type="hidden"
                                                                            value="{{ $pegawai_lulus_rollcall->id }}" name="id">
                                                                        <div class="input-group input-group-merge">
                                                                            <input class="form-control"
                                                                                name="lulus_sebab"
                                                                                placeholder="Sebab" type="text">
                                                                        </div>
                                                                    </div>
                                                                
                                                                <button type="button" class="btn btn-primary btn-sm "data-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-success btn-sm">Hantar</button>
                                                          
                                                         
                                                            </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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

</div>
@endsection
@section ('script')
<script>
    $(document).ready(function () {
        var table = $('table.display').DataTable();
    });

    // Kemaskini Masuk dan Keluar
        function MasaMula(obj, obj2) {
            alert(obj)
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/ubah-masa_mula/" + obj,
            type: "POST",
            data: {
                "masuk": obj2.value
            }
        
        });
    }
    function MasaAkhir(obj, obj2) {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/ubah-masa_akhir/" + obj,
            type: "POST",
            data: {
                "keluar": obj2.value
            }
        
        });
    }
    // ________________

</script>

@endsection
