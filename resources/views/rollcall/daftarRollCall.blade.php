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
                                 <li class="breadcrumb-item"><a href="/rollcalls"><i class="fas fa-home"></i></a></li>
                                 <li class="breadcrumb-item"><a href="/rollcalls/create">Rollcall</a></li>
                                 <li class="breadcrumb-item active" aria-current="page">Rollcall</li>
                             </ol>
                         </nav>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="container-fluid mt--6">

         <div class="row ">
             <div class="col-md-12">
                 <div class="card">
                     <!-- Card header -->
                     <div class="card-header bg-default border-0">
                         <h3 class="text-white mb-0">Senarai Roll Call Perlu Hadir</h3>
                     </div>
                     <div class="card-body px-0">
                         <!-- Light table -->
                         <div class="row mb-4 ml-2">
                             <div class="col text-end">
                                 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bukaQr">
                                     Buka QR Code
                                 </button>
                                 <!-- Modal -->
                                 <div class="modal fade" id="bukaQr" tabindex="-1" role="dialog"
                                     aria-labelledby="bukaQrLabel" aria-hidden="true">
                                     <div class="modal-dialog" role="document">
                                         <div class="modal-content">
                                             <div class="modal-header">
                                                 <h5 class="modal-title" id="bukaQrLabel">QR Code</h5>
                                                 <button type="button" class="close" data-dismiss="modal"
                                                     aria-label="Close">
                                                     <span aria-hidden="true">&times;</span>
                                                 </button>
                                             </div>
                                             <div class="modal-body d-flex justify-content-center">
                                                 <div id="qrcodeUser"></div>
                                                 <script type="text/javascript">
                                                     new QRCode(document.getElementById("qrcodeUser"), "{{ auth()->user()->nric }}");
                                                 </script>
                                             </div>
                                             <div class="modal-footer">
                                                 <button type="button" class="btn btn-secondary"
                                                     data-dismiss="modal">Close</button>
                                                 <button type="button" class="btn btn-primary">Save changes</button>
                                             </div>
                                         </div>
                                     </div>
                                 </div>

                             </div>
                         </div>
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
                                         <th style="background-color:#00FF00"> Masuk / Keluar <br><br> eKedatangan
                                         </th>
                                         {{-- <th>Pegawai Sokong <br><br> Pegawai Lulus</th> --}}
                                         <th>Tindakan</th>
                                         <th>Status</th>

                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($userrollcalls as $userrollcall)
                                         <tr>
                                             <td>
                                                 {{ $loop->index + 1 }}
                                             </td>

                                             <td>{{ $userrollcall->siri_rollcall }} -
                                                 {{ $userrollcall->tajuk_rollcall }}<br><br>

                                                 @if ($userrollcall->status == 'dibuka')
                                                     <span class="badge badge-pill badge-success">DIBUKA</span>
                                                 @elseif($userrollcall->status == 'ditutup')
                                                     <span class="badge badge-pill badge-danger">DITUTUP</span>
                                                 @elseif($userrollcall->status == 'ditangguh')
                                                     <span class="badge badge-pill badge-warning">DITANGGUH</span>
                                                 @endif

                                             </td>
                                             {{-- <td>{{$userrollcall->id}}</td> --}}
                                             <td>{{ $userrollcall->mula_rollcall }}
                                                 <br><br>{{ $userrollcall->akhir_rollcall }}
                                             </td>
                                             <td>{{ $userrollcall->lokasi }} <br> <br>
                                                 {{ $userrollcall->catatan }}<br><br> </td>
                                             <td>
                                                 @if ($userrollcall->masuk === null)
                                                     <span class="badge badge-pill badge-primary">Dalam Proses</span>
                                                     <br><br>
                                                     {{-- <input type="datetime-local" onchange="MasaMula({{$userrollcall->userrollcall_id}},this)" value={{$userrollcall->mula}}>
                                                <br><br> --}}
                                                 @elseif($userrollcall->masuk !== null)
                                                     {{ $userrollcall->masuk }}<br><br>
                                                 @endif

                                                 @if ($userrollcall->keluar === null)
                                                     <span class="badge badge-pill badge-primary">Dalam
                                                         Proses</span>

                                                     {{-- <input type="datetime-local" onchange="MasaAkhir({{$userrollcall->userrollcall_id}},this)" value={{$userrollcall->mula}}> --}}
                                                 @elseif($userrollcall->keluar !== null)
                                                     {{ $userrollcall->keluar }}<br>
                                                 @endif


                                             </td>
                                             <td>
                                                 <h5> Tarikh : <span style="color:rgb(0, 17, 255)">
                                                         {{ $userrollcall->tarikh }}</span> </h5>
                                                 <h5> Mula : <span style="color:rgb(0, 17, 255)">
                                                         {{ $userrollcall->clockintime }}</span> </h5>
                                                 <h5> Akhir : <span style="color:rgb(0, 17, 255)">
                                                         {{ $userrollcall->clockouttime }}</span> </h5>
                                                 <h5> Status : <span style="color:rgb(0, 17, 255)">
                                                         {{ $userrollcall->statusdesc }}</span> </h5>
                                                 <h5> Waktu Anjal :<span style="color:rgb(0, 17, 255)">
                                                         {{ $userrollcall->waktuanjal }}</span> </h5>
                                             </td>


                                             {{-- <td> {{$userrollcall->pegawai_sokong_name}} <br><br>{{$userrollcall->pegawai_lulus_name}}</td> --}}

                                             <td>

                                                 @if ($userrollcall->keluar === null)
                                                     @if ($userrollcall->keterangan === null)
                                                         <button type="button" class="btn btn-primary btn-sm"
                                                             data-toggle="modal"
                                                             data-target="#sebabtakhadir{{ $userrollcall->userrollcall_id }}">
                                                             Hantar Sebab
                                                         </button>
                                                     @elseif($userrollcall->keterangan !== null)
                                                         <span class="badge badge-pill badge-danger">Tidak
                                                             Hadir</span><br><br>


                                                         <button type="button" class="btn btn-primary btn-sm"
                                                             data-toggle="modal"
                                                             data-target="#semaksebab{{ $userrollcall->userrollcall_id }}">
                                                             Lihat
                                                         </button>
                                                     @endif
                                                 @elseif($userrollcall->masuk !== null)
                                                     <span class="badge badge-pill badge-success">Masuk
                                                     </span><br><br>
                                                     <span class="badge badge-pill badge-success">Keluar </span>
                                                 @endif


                                             </td>
                                             <td>

                                                 @if ($userrollcall->sokong === null)
                                                     <span class="badge badge-pill badge-primary">Proses
                                                         Semakan</span>
                                                 @elseif($userrollcall->sokong === 0)
                                                     <span class="badge badge-pill badge-danger">Ditolak : </span>
                                                     {{ $userrollcall->sokong_sebab }}
                                                 @elseif($userrollcall->sokong === 1)
                                                     <span class="badge badge-pill badge-success">Disahkan
                                                     </span><br><br>

                                                     @if ($userrollcall->lulus === null)
                                                         <span class="badge badge-pill badge-primary">Semakan
                                                             Pegawai</span>
                                                     @elseif($userrollcall->lulus === 1)
                                                         <span class="badge badge-pill badge-success">Diluskan</span>
                                                     @elseif($userrollcall->lulus === 0)
                                                         <span class="badge badge-pill badge-danger">Ditolak</span>
                                                     @endif
                                                 @endif
                                             </td>
                                         </tr>
                                         <!-- Modal -->
                                         <div class="modal fade" id="semaksebab{{ $userrollcall->userrollcall_id }}"
                                             aria-hidden="true">
                                             <div class="modal-dialog" role="document">
                                                 <div class="modal-content">
                                                     <div class="modal-header bg-default">
                                                         <h5 class="modal-title text-white" id="exampleModalLabel">
                                                             Sebab Tidak Hadir Roll Call</h5>
                                                         <button type="button" class="close" data-dismiss="modal"
                                                             aria-label="Close">
                                                             <span aria-hidden="true">&times;</span>
                                                         </button>
                                                     </div>
                                                     <div class="modal-body">
                                                         <div class="row">
                                                             <div class="col-md-12">
                                                                 <div class="form-group">
                                                                     <label>Sebab Tidak Hadir</label>
                                                                     <div class="input-group input-group-merge">
                                                                         <input class="form-control"
                                                                             value="{{ $userrollcall->keterangan }}"
                                                                             disabled> <br>

                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div class="col-md-12 text-center">
                                                                 <div class="form-group">
                                                                     <label>Lampiran</label><br>
                                                                     <a type="button"
                                                                         href="{{ $userrollcall->lampiran }}"
                                                                         target="_blank" class="btn btn-primary">
                                                                         Muat Turun</a>
                                                                     <br>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>

                                                     <div class="modal-footer">
                                                         <button type="button" class="btn btn-sm btn-primary"
                                                             data-dismiss="modal">Tutup</button>
                                                     </div>
                                                 </div>

                                             </div>
                                         </div>
                                         <!-- Modal -->
                                         <div class="modal fade" id="sebabtakhadir{{ $userrollcall->userrollcall_id }}"
                                             tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                             aria-hidden="true">
                                             <div class="modal-dialog modal-dialog-centered" role="document">
                                                 <div class="modal-content">
                                                     <div class="modal-header">
                                                         <h5 class="modal-title" id="exampleModalLabel ">Kemaskini
                                                             Sebab Tidak Hadir</h5>
                                                         <button type="button" class="close" data-dismiss="modal"
                                                             aria-label="Close">
                                                             <span aria-hidden="true">&times;</span>
                                                         </button>
                                                     </div>
                                                     <div class="modal-body">
                                                         <form method="POST" action="/simpan_sebab"
                                                             enctype="multipart/form-data">
                                                             @csrf

                                                             <div class="col-md-12 ">
                                                                 <div class="form-group ">
                                                                     <input type="hidden"
                                                                         value="{{ $userrollcall->userrollcall_id }}"
                                                                         name="id">
                                                                 </div>
                                                             </div>
                                                             <div class="col-md-12 ">
                                                                 <div class="form-group ">
                                                                     <label for="status">Sebab Tidak Hadir</label>
                                                                     <div class="input-group input-group-merge">
                                                                         <select class="form-control" name="keterangan"
                                                                             require>
                                                                             @foreach ($sebab as $sebabs)
                                                                                 <option value="{{ $sebabs->sebab }}">
                                                                                     {{ $sebabs->sebab }}</option>
                                                                             @endforeach
                                                                         </select>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div class="col-md-12 ">
                                                                 <div class="form-group ">
                                                                     <label for="avatar">Lampiran Sebab Tidak
                                                                         Hadir:</label>
                                                                     <div class="input-group input-group-merge">
                                                                         <input type="file" id="avatar"
                                                                             name="file_path"
                                                                             accept="image/png, image/jpeg">
                                                                         </select>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div class="modal-footer">
                                                                 <button type="button" class="btn btn-secondary"
                                                                     data-dismiss="modal">Tutup</button>
                                                                 <button type="submit"
                                                                     class="btn btn-primary">Kemaskini</button>
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
 @endsection
