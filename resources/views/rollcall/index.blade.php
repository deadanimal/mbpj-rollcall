@extends('base')

<link rel="stylesheet" href="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/fullcalendar/dist/fullcalendar.min.css">
<link rel="stylesheet" href="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/sweetalert2/dist/sweetalert2.min.css">

<script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/moment/min/moment.min.js"></script>
<script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>

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

                @if(auth()->user()->role == 'naziran')
                <div class="col-lg-6 col-5 text-right">
                    <a href="/rollcalls/create" class="btn btn-sm btn-neutral">Tambah Roll Call</a>
                </div>
                @elseif(auth()->user()->role == 'penguatkuasa')
                @else
                @endif

            </div>
        </div>
    </div>
</div>
@if(auth()->user()->role == 'penguatkuasa')
<div class="container-fluid mt--6">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Senarai Roll Call</h3>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="no">No</th>
                                <th scope="col" class="sort" data-sort="tajuk_rollcall">Tajuk Roll Call</th>
                                <th scope="col" class="sort" data-sort="waktu_masuk">Waktu rollcall</th>
                                <th scope="col" class="sort" data-sort="waktu_keluar">Waktu rollcall</th>
                                <th scope="col" class="sort" data-sort="waktu_masuk_sebenar">Waktu masuk</th>
                                <th scope="col" class="sort" data-sort="waktu_keluar_sebenar">Waktu keluar</th>
                                <th scope="col" class="sort" data-sort="lokasi">lokasi</th>
                                <th scope="col" class="sort" data-sort="catatan">Catatan</th>
                                <th scope="col" class="sort" data-sort="status">Status</th>
                                <th scope="col" class="sort" data-sort="tindakan">Tindakan</th>
                                
                            </tr>
                        </thead>
                        <tbody class="list">
                            @forelse($rollcalls as $rollcall)
                            <tr>
                                <th scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="name mb-0 text-sm">
                                                <a> {{$rollcall->id}}</a>
                                            </span>
                                        </div>
                                    </div>
                                </th>
                                <td class="tajuk_rollcall">
                                    {{$rollcall->tajuk_rollcall}}
                                </td>
                                <td class="mula_rollcall">
                                    {{$rollcall->mula_rollcall}}
                                </td> 
                                <td class="akhir_rollcall">
                                    {{$rollcall->akhir_rollcall}}
                                </td> 
                                <td class="mula_rollcall_sebenar">
                                    {{-- {{$rollcall->mula_rollcall}} --}}
                                </td> 
                                <td class="akhir_rollcall_sebenar">
                                    {{-- {{$rollcall->akhir_rollcall}} --}}
                                </td>   
                                <td class="lokasi">
                                    {{$rollcall->lokasi}}
                                </td>   

                                <td class="status">
                                    {{$rollcall->catatan}}
                                </td> 
                                <td class="catatan">
                                    {{$rollcall->status}}
                                </td>                 
                                <td class="tindakan">
                                    <a href=""class="btn btn-success">Kemaskini</a>
                                </td>
                            </tr>
                            @empty
                            <div style="text-align:center;">
                                <td  >
                                    <h5>  Tiada rekod </h5>
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
@elseif(auth()->user()->role == 'naziran')

<div class="container-fluid mt--6">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Senarai Roll Call</h3>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="no">No</th>
                                <th scope="col" class="sort" data-sort="tajuk_rollcall">Tajuk Roll Call</th>
                                <th scope="col" class="sort" data-sort="waktu_masuk">Waktu Mula Roll Call</th>
                                <th scope="col" class="sort" data-sort="waktu_keluar">Waktu Akhir Roll Call</th>
                                <th scope="col" class="sort" data-sort="lokasi">Lokasi</th>
                                <th scope="col" class="sort" data-sort="catatan">Catatan</th>
                                <th scope="col" class="sort" data-sort="status">Status</th>
                                <th scope="col" class="sort" data-sort="pegawai_sokong">Pegawai Sokong</th>
                                <th scope="col" class="sort" data-sort="pegawai_lulus">Pegawai Lulus</th>
                                <th scope="col" class="sort" data-sort="tindakan">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @forelse($rollcalls as $rollcall)
                            <tr>
                                <th scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="name mb-0 text-sm">
                                                <a> {{$rollcall->id}}</a>
                                            </span>
                                        </div>
                                    </div>
                                </th>
                                <td class="tajuk_rollcall">
                                    {{$rollcall->tajuk_rollcall}}
                                </td>
                                <td class="mula_rollcall">
                                    {{$rollcall->mula_rollcall}}
                                </td> 
                                <td class="akhir_rollcall">
                                    {{$rollcall->akhir_rollcall}}
                                </td>   
                                <td class="lokasi">
                                    {{$rollcall->lokasi}}
                                </td>   

                                <td class="status">
                                    {{$rollcall->catatan}}
                                </td> 
                                <td class="catatan">
                                    <a class="btn btn-success"> {{$rollcall->status}}</a>
                                </td> 
                                <td class="sokong">
                                    {{$rollcall->pegawai_sokong_id}}
                                </td> 
                                <td class="lulus">
                                    {{$rollcall->pegawai_lulus_id}}
                                </td>                 
                                <td class="tindakan">
                                    <a href="/rollcalls/{{$rollcall->id}}/edit"class="btn btn-success">Kemaskini</a>
                                </td>
                            </tr>
                            @empty
                            <div style="text-align:center;">
                                <td  >
                                    <h5>  Tiada rekod </h5>
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
@else
<div class="container-fluid mt--12">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Modul ini tidak dibekalkan kepada anda. Sila hubungi
                        pentadbir
                        sistem anda.</h3>
                </div>

            </div>
        </div>
    </div>
    @endif


    

    {{--  --}}
    <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6">
                <div class="copyright text-center  text-lg-left  text-muted">
                    &copy; 2021 <a href="" class="font-weight-bold ml-1" target="">Sistem
                        Pengurusan Elaun Lebih
                        Masa</a>
                </div>
            </div>
        </div>
    </footer>
</div>
<div>
@endsection
