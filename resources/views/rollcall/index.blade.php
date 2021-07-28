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
                    <div class="card-body px-0">
                <!-- Light table -->
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
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
                                <th>Status</th>
                                <th>Kehadiran</th>
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
                                <td>{{$rollcall->status}}</td>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
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
{{-- Modal  --}}

<!-- Button trigger modal -->

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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



@elseif(auth()->user()->role == 'naziran' or auth()->user()->role == 'pentadbir_sistem')
<div class="container-fluid mt--6">
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
                                {{-- <th>Waktu masuk</th>
                                <th>Waktu keluar</th> --}}
                                <th>lokasi</th>
                                <th>Catatan</th>
                                <th>Status</th>
                                <th>Pegawai Sokong</th>
                                <th>Pegawai Lulus</th>
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
                                {{-- <td>{{$rollcall->waktu_masuk}}</td>
                                <td>{{$rollcall->waktu_keluar}}</td> --}}
                                <td>{{$rollcall->lokasi}}</td>
                                <td>{{$rollcall->catatan}}</td>
                                <td>{{$rollcall->status}}</td>
                                <td>{{$rollcall->pegawai_sokong_id}}</td>
                                <td>{{$rollcall->pegawai_lulus_id}}</td>
                               
                                <td class="tindakan">
                                    <a href="/rollcalls/{{$rollcall->id}}/edit" class="btn btn-success">Kemaskini</a>
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

@elseif(auth()->user()->role == 'penyelia'or auth()->user()->role == 'ketua_bahagian'or auth()->user()->role == 'ketua_jabatan' )
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
                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
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
                                <th>Status</th>
                                <th>Pegawai Sokong</th>
                                <th>Pegawai Lulus</th>
                                <th>Tindakan</th>

                            </tr>
                        </thead>

                        @forelse($rollcalls as $rollcall)

                        <tbody>
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
                                <td class="tindakan">
                                    <a href="/rollcalls/{{$rollcall->id}}/edit" class="btn btn-success">Kemaskini</a>
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
