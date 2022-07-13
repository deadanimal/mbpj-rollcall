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
        <div class="header bg-primary pb-3">
            <div class="container-fluid">
                <div class="row ">
                    @if (auth()->user()->role == 'naziran')
                        <div class="col-lg-12 col text-right">
                            <a href="/rollcalls/create" class="btn btn-sm btn-neutral">+ Tambah Roll Call</a>
                        </div>
                    @elseif(auth()->user()->role == 'penyelia' or auth()->user()->role == 'ketua_bahagian' or auth()->user()->role == 'ketua_jabatan')
                        <div class="nav-wrapper  w-100">
                            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab"
                                        href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1"
                                        aria-selected="true"><i class="ni ni-bell-55 mr-2"></i>Senarai Kehadiran Roll
                                        Call</a>
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
    @if (auth()->user()->role == 'penguatkuasa')
        <div>
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
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#bukaQr">
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
                                                                <span
                                                                    class="badge badge-pill badge-success">Diluskan</span>
                                                            @elseif($userrollcall->lulus === 0)
                                                                <span class="badge badge-pill badge-danger">Ditolak</span>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                                <!-- Modal -->
                                                <div class="modal fade"
                                                    id="semaksebab{{ $userrollcall->userrollcall_id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-default">
                                                                <h5 class="modal-title text-white" id="exampleModalLabel">
                                                                    Sebab Tidak Hadir Roll Call</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
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
                                                <div class="modal fade"
                                                    id="sebabtakhadir{{ $userrollcall->userrollcall_id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel ">Kemaskini
                                                                    Sebab Tidak Hadir</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
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
                                                                                <select class="form-control"
                                                                                    name="keterangan" require>
                                                                                    @foreach ($sebab as $sebabs)
                                                                                        <option
                                                                                            value="{{ $sebabs->sebab }}">
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
                                        <span class="h2 font-weight-bold mb-0">{{ $dibuka }}</span>
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
                                        <span class="h2 font-weight-bold mb-0">{{ $ditangguh }}</span>
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
                                        <span class="h2 font-weight-bold mb-0">{{ $ditutup }}</span>
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
                            <div class="card-header bg-default border-0 mb-4">
                                <h3 class="text-white mb-0">Senarai Roll Call</h3>
                            </div>
                            <div class="card-body px-0">
                                <!-- Light table -->
                                <div class="table-responsive py-4">
                                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tajuk Roll Call</th>
                                                <th>Waktu mula </th>
                                                <th>Rollcall</th>
                                                <th>Status</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($rollcalls as $rollcall)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $rollcall->siri_rollcall }} -
                                                        {{ $rollcall->tajuk_rollcall }}
                                                    </td>
                                                    <td>{{ $rollcall->mula_rollcall }}</td>
                                                    <td>{{ $rollcall->akhir_rollcall }}</td>
                                                    <td>
                                                        @if ($rollcall->status == 'dibuka')
                                                            <span class="badge badge-pill badge-success">DIBUKA</span>
                                                        @elseif($rollcall->status == 'ditutup')
                                                            <span class="badge badge-pill badge-danger">DITUTUP</span>
                                                        @elseif($rollcall->status == 'ditangguh')
                                                            <span class="badge badge-pill badge-warning">DITANGGUH</span>
                                                        @endif

                                                    </td>
                                                    <td>
                                                        {{-- <button onclick="buang({{ $rollcall->id }})" class="btn btn-danger btn-sm">Buang <i class="ni ni-basket"></i></button><br><br> --}}
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#lihatpentadbir{{ $rollcall->id }}">
                                                            Lihat
                                                        </button>
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
                                                                    success: function(data) {
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

                                    {{-- Modal Lihat Pentadbir --}}
                                    @foreach ($rollcalls as $rollcall)
                                        <div class="modal fade " id="lihatpentadbir{{ $rollcall->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-default">
                                                        <h5 class="text-white modal-title" id="exampleModalLabel">
                                                            Makluman
                                                        </h5>

                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">

                                                        <div class="form-row">
                                                            <div class="form-group col-md-12 text-center">
                                                                @if ($rollcall->status == 'dibuka')
                                                                    <span
                                                                        class="badge badge-pill badge-success">DIBUKA</span>
                                                                @elseif($rollcall->status == 'ditutup')
                                                                    <span
                                                                        class="badge badge-pill badge-danger">DITUTUP</span>
                                                                @elseif($rollcall->status == 'ditangguh')
                                                                    <span
                                                                        class="badge badge-pill badge-warning">DITANGGUH</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <input type="text" class="form-control"
                                                                    value="{{ $rollcall->tajuk_rollcall }}" disabled>
                                                            </div>

                                                            <div class="form-group col-md-6">
                                                                <input type="text" class="form-control"
                                                                    value="{{ $rollcall->lokasi }}" disabled>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <input type="text" class="form-control"
                                                                    value="{{ $rollcall->mula_rollcall }}" disabled>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <input type="text" class="form-control"
                                                                    value="{{ $rollcall->akhir_rollcall }}" disabled>
                                                            </div>


                                                            <div class="form-group col-md-6">
                                                                <input type="text" class="form-control"
                                                                    value="{{ $rollcall->pegawai_sokong }}" disabled>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <input type="text" class="form-control"
                                                                    value="{{ $rollcall->pegawai_lulus }}" disabled>

                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <input type="text" class="form-control"
                                                                    value="{{ $rollcall->catatan }} " disabled>
                                                            </div>
                                                            {{-- <div class="form-group col-md-12">
                                                    <input type="text" class="form-control" value="{{$rollcall->maklumat}}"disabled>     
                                                </div> --}}
                                                            <div class="container-fluid mt-2">
                                                                <div class="row">
                                                                    <div class="col-xl-4 col-md-6">
                                                                        <div class="card card-stats">
                                                                            <!-- Card body -->
                                                                            <div class="card-body bg-default text-center">
                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <h5
                                                                                            class="card-title text-uppercase text-muted mb-0 text-white">
                                                                                            HADIR
                                                                                        </h5>
                                                                                        <span
                                                                                            class="h2 text-white font-weight-bold mb-0">{{ $rollcall->jumlah_phadir }}</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-4 col-md-6">
                                                                        <div class="card card-stats">
                                                                            <!-- Card body -->
                                                                            <div class="card-body bg-default text-center ">
                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <h5
                                                                                            class="card-title text-uppercase text-muted mb-0 text-white">
                                                                                            TIDAK HADIR
                                                                                        </h5>
                                                                                        <span
                                                                                            class="h2 text-white font-weight-bold mb-0">{{ $rollcall->jumlah_ptidak_hadir }}</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-4 col-md-6">
                                                                        <div class="card card-stats">
                                                                            <!-- Card body -->
                                                                            <div class="card-body bg-default text-center">
                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <h5
                                                                                            class="card-title text-uppercase text-muted mb-0 text-white">
                                                                                            JUMLAH
                                                                                        </h5>
                                                                                        <span
                                                                                            class="h2 text-white font-weight-bold mb-0">{{ $rollcall->jumlah_ptotal }}</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-12">

                                                                <div class="table-responsive">
                                                                    <table id="example"
                                                                        class="display table table-striped table-bordered nowrap"
                                                                        style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                {{-- <th>No</th> --}}
                                                                                <th>Nama Penguatkuasa</th>
                                                                                <th>Waktu Masuk</th>
                                                                                <th>Akhir Keluar</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($rollcallsnew as $rollcallsbaru)
                                                                                <?php if ($rollcallsbaru['roll_id'] == $rollcall->id) { ?>
                                                                                <tr>
                                                                                    {{-- <td></td> --}}
                                                                                    <td>{{ $rollcallsbaru['penguatkuasa'] }}
                                                                                    </td>

                                                                                    @if ($rollcallsbaru['masuk'] === null)
                                                                                        <td>
                                                                                            <span
                                                                                                class="badge badge-pill badge-primary">Dalam
                                                                                                Proses</span>
                                                                                        </td>
                                                                                    @elseif($rollcallsbaru['masuk'] !== null)
                                                                                        <td>{{ $rollcallsbaru['masuk'] }}
                                                                                        </td>
                                                                                    @endif

                                                                                    @if ($rollcallsbaru['keluar'] === null)
                                                                                        <td>
                                                                                            <span
                                                                                                class="badge badge-pill badge-primary">Dalam
                                                                                                Proses</span>
                                                                                        </td>
                                                                                    @elseif($rollcallsbaru['keluar'] !== null)
                                                                                        <td>{{ $rollcallsbaru['keluar'] }}
                                                                                        </td>
                                                                                    @endif


                                                                                </tr>
                                                                                <?php } ?>
                                                                            @endforeach

                                                                        </tbody>



                                                                    </table>
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            data-dismiss="modal">Tutup</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

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
                                        <span class="h2 font-weight-bold mb-0">{{ $dibuka }}</span>
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
                                        <span class="h2 font-weight-bold mb-0">{{ $ditangguh }}</span>
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
                                        <span class="h2 font-weight-bold mb-0">{{ $ditutup }}</span>
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
                            <div class="card-header bg-default border-0 mb-4">
                                <h3 class="text-white mb-0">Senarai Roll Call</h3>
                            </div>
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
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($rollcalls as $rollcall)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $rollcall->siri_rollcall }} -
                                                        {{ $rollcall->tajuk_rollcall }}<br><br>
                                                        @if ($rollcall->status == 'dibuka')
                                                            <span class="badge badge-pill badge-success">DIBUKA</span>
                                                        @elseif($rollcall->status == 'ditutup')
                                                            <span class="badge badge-pill badge-danger">DITUTUP</span>
                                                        @elseif($rollcall->status == 'ditangguh')
                                                            <span class="badge badge-pill badge-warning">DITANGGUH</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $rollcall->akhir_rollcall }}<br><br>{{ $rollcall->mula_rollcall }}
                                                    </td>
                                                    <td>{{ $rollcall->lokasi }}<br><br>{{ $rollcall->catatan }}</td>

                                                    <td>

                                                        <a href="/rollcalls/{{ $rollcall->id }}/edit"
                                                            class="btn btn-primary btn-sm"> <i
                                                                class="ni ni-single-copy-04">
                                                            </i>
                                                        </a>

                                                        <button type="button" class="btn btn-info btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#lihat{{ $rollcall->id }}"><i
                                                                class="ni ni-zoom-split-in"></i>

                                                        </button>


                                                        <button onclick="buang({{ $rollcall->id }})"
                                                            class="btn btn-danger btn-sm"><i class="ni ni-basket"></i>
                                                        </button>



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
                                                                    success: function(data) {
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
                                    {{-- Modal Lihat --}}
                                    @foreach ($rollcalls as $rollcall)
                                        <div class="modal fade " id="lihat{{ $rollcall->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-default">
                                                        <h2 class="text-white"> Maklumat Kehadiran Penguatkuasa </h2>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="container-fluid mt-4">
                                                        <div class="row">
                                                            <div class="col-xl-4 col-md-6">
                                                                <div class="card card-stats">
                                                                    <!-- Card body -->
                                                                    <div class="card-body bg-default text-center">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <h5
                                                                                    class="card-title text-uppercase text-muted mb-0 text-white">
                                                                                    HADIR
                                                                                </h5>
                                                                                <span
                                                                                    class="h2 text-white font-weight-bold mb-0">{{ $rollcall->jumlah_phadir }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-4 col-md-6">
                                                                <div class="card card-stats">
                                                                    <!-- Card body -->
                                                                    <div class="card-body bg-default text-center ">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <h5
                                                                                    class="card-title text-uppercase text-muted mb-0 text-white">
                                                                                    TIDAK HADIR
                                                                                </h5>
                                                                                <span
                                                                                    class="h2 text-white font-weight-bold mb-0">{{ $rollcall->jumlah_ptidak_hadir }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-4 col-md-6">
                                                                <div class="card card-stats">
                                                                    <!-- Card body -->
                                                                    <div class="card-body bg-default text-center">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <h5
                                                                                    class="card-title text-uppercase text-muted mb-0 text-white">
                                                                                    JUMLAH
                                                                                </h5>
                                                                                <span
                                                                                    class="h2 text-white font-weight-bold mb-0">{{ $rollcall->jumlah_ptotal }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-row">

                                                            <div class="form-group col-md-12">
                                                                <!-- Light table -->

                                                                <div class="table-responsive">
                                                                    <table id="example"
                                                                        class="display table table-striped table-bordered nowrap"
                                                                        style="width:100%">
                                                                        <thead>
                                                                            <tr>
                                                                                {{-- <th>No</th> --}}
                                                                                <th>Nama Penguatkuasa</th>
                                                                                <th>Waktu Masuk</th>
                                                                                <th>Akhir Keluar</th>
                                                                                <th>Sebab Tidak Hadir </th>
                                                                                <th>Lampiran </th>


                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($rollcallsnew as $rollcallsbaru)
                                                                                <?php if ($rollcallsbaru['roll_id'] == $rollcall->id) { ?>
                                                                                <tr>
                                                                                    {{-- <td></td> --}}
                                                                                    <td>{{ $rollcallsbaru['penguatkuasa'] }}
                                                                                    </td>

                                                                                    <td>
                                                                                        {{-- @if ($rollcallsbaru->keterangan !== null)
                                                                                            <span
                                                                                                class="badge badge-pill badge-danger">Tidak
                                                                                                Hadir</span>
                                                                                        @elseif($rollcallsbaru['masuk'] === null)
                                                                                            <span
                                                                                                class="badge badge-pill badge-primary">Dalam
                                                                                                Proses</span>
                                                                                        @else
                                                                                            {{ $rollcallsbaru['masuk'] }}
                                                                                        @endif --}}

                                                                                        @isset($rollcallsbaru->masuk)
                                                                                            {{ $rollcallsbaru->masuk }}
                                                                                        @else
                                                                                            @if ($rollcallsbaru->keterangan === null)
                                                                                                <span
                                                                                                    class="badge badge-pill badge-primary">Dalam
                                                                                                    Proses</span>
                                                                                            @else
                                                                                                <span
                                                                                                    class="badge badge-pill badge-danger">Tidak
                                                                                                    Hadir</span>
                                                                                            @endif
                                                                                        @endisset
                                                                                    </td>

                                                                                    <td>
                                                                                        @if ($rollcallsbaru->keterangan !== null)
                                                                                            <span
                                                                                                class="badge badge-pill badge-danger">Tidak
                                                                                                Hadir</span>
                                                                                        @elseif($rollcallsbaru['keluar'] === null)
                                                                                            <span
                                                                                                class="badge badge-pill badge-primary">Dalam
                                                                                                Proses</span>
                                                                                        @else
                                                                                            {{ $rollcallsbaru['keluar'] }}
                                                                                        @endif
                                                                                    </td>
                                                                                    <td>
                                                                                        @if ($rollcallsbaru['keterangan'] === null)
                                                                                            <span
                                                                                                class="badge badge-pill badge-default">Tiada
                                                                                                Rekod</span>
                                                                                        @elseif($rollcallsbaru['keterangan'] !== null)
                                                                                            {{ $rollcallsbaru['keterangan'] }}
                                                                                        @endif

                                                                                    </td>
                                                                                    <td>
                                                                                        @if ($rollcallsbaru['file_path'] === null)
                                                                                            <span
                                                                                                class="badge badge-pill badge-default">Tiada
                                                                                                Rekod</span>
                                                                                        @elseif($rollcallsbaru['file_path'] !== null)
                                                                                            <a type="button"
                                                                                                href="{{ $rollcallsbaru['file_path'] }}"
                                                                                                target="_blank"
                                                                                                class="btn btn-sm btn-primary">Muat
                                                                                                Turun</a>
                                                                                        @endif
                                                                                    </td>


                                                                                </tr>
                                                                                <?php } ?>
                                                                            @endforeach

                                                                        </tbody>
                                                                    </table>

                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary"
                                                            data-dismiss="modal">Tutup</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif(auth()->user()->role == 'ketua_bahagian' or auth()->user()->role == 'ketua_jabatan' or auth()->user()->role == 'penyelia')
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel"
                aria-labelledby="tabs-icons-text-1-tab">
                <div>
                    <div class="container-fluid mt--6">
                        <div class="card">
                            <div class="card-header bg-default">
                                <h3 class="text-white mb-0">Carian</h3>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <form>
                                        <div class="row">
                                            <div class="col-sm mb-4">
                                                <label for="tajuk_rollcall">Pilih Tajuk Roll Call</label>
                                                <select id="selected_rollcall" name="tajuk_rollcall"
                                                    class="form-control">
                                                    <option hidden selected> Tajuk Roll Call
                                                    </option>
                                                    @foreach ($rollcalls as $rollcallsfilter)
                                                        <option
                                                            value="{{ $rollcallsfilter->siri_rollcall }} - {{ $rollcallsfilter->tajuk_rollcall }}">
                                                            {{ $rollcallsfilter->siri_rollcall }} -
                                                            {{ $rollcallsfilter->tajuk_rollcall }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="row float-right">
                                    <div class="col-sm ">
                                        <a href="" class="btn btn-sm btn-danger">Hapus Cari</a>
                                        <button onclick="customFilter()" class="btn btn-sm btn-primary "
                                            id="filter">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row ">

                            <div class="col-md-12">
                                <div class="card">
                                    <!-- Card header -->
                                    <div class="card-header bg-default border-0 mb-4">
                                        <h3 class="text-white mb-0">Senarai Roll Call</h3>
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
                                                    <th>Waktu Mula <br><br>Akhir rollcall</th>
                                                    <th>Lokasi <br><br> Makluman</th>
                                                    <th>Pegawai Sokong <br><br> Pegawai Lulus</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($rollcalls as $rollcall)
                                                    <tr>
                                                        <td>{{ $rollcall->id }}</td>
                                                        <td>{{ $rollcall->siri_rollcall }} -
                                                            {{ $rollcall->tajuk_rollcall }}<br><br>
                                                            @if ($rollcall->status == 'dibuka')
                                                                <span class="badge badge-pill badge-success">DIBUKA</span>
                                                            @elseif($rollcall->status == 'ditutup')
                                                                <span class="badge badge-pill badge-danger">DITUTUP</span>
                                                            @elseif($rollcall->status == 'ditangguh')
                                                                <span
                                                                    class="badge badge-pill badge-warning">DITANGGUH</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $rollcall->mula_rollcall }}<br><br>{{ $rollcall->akhir_rollcall }}
                                                        </td>

                                                        <td>{{ $rollcall->lokasi }}<br> <br>{{ $rollcall->catatan }}
                                                        </td>
                                                        <td>{{ $rollcall->pegawai_sokong }} <br>
                                                            <br>{{ $rollcall->pegawai_lulus }}
                                                        </td>

                                                        <td>
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#lihat{{ $rollcall->id }}">
                                                                Lihat
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                        {{-- Modal Lihat --}}
                                        @foreach ($rollcalls as $rollcall)
                                            <div class="modal fade " id="lihat{{ $rollcall->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-default">
                                                            <h5 class="text-white modal-title" id="exampleModalLabel">
                                                                Makluman -
                                                                @if ($rollcall->status == 'dibuka')
                                                                    <span
                                                                        class="badge badge-pill badge-success">DIBUKA</span>
                                                                @elseif($rollcall->status == 'ditutup')
                                                                    <span
                                                                        class="badge badge-pill badge-danger">DITUTUP</span>
                                                                @elseif($rollcall->status == 'ditangguh')
                                                                    <span
                                                                        class="badge badge-pill badge-warning">DITANGGUH</span>
                                                                @endif
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table>
                                                            </table>
                                                            <div class="form-row">
                                                                {{-- <div class="form-group col-md-12">
                                                        <label>Maklumat </label>

                                                        {!!$rollcall->maklumat!!}
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Tajuk</label>
                                                        <input type="text" class="form-control" value="{{$rollcall->tajuk_rollcall}}" disabled>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Lokasi</label>
                                                        <input type="text" class="form-control" value="{{$rollcall->lokasi}}"disabled>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Mula Roll Call</label>
                                                        <input type="text" class="form-control" value="{{$rollcall->mula_rollcall}}"disabled>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Akhir Roll Call</label>
                                                        <input type="text" class="form-control" value="{{$rollcall->akhir_rollcall}}"disabled>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Pegawai Sokong</label>
                                                        <input type="text" class="form-control" value="{{$rollcall->pegawai_sokong}}"disabled>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Pegawai Lulus</label>
                                                        <input type="text" class="form-control" value="{{$rollcall->pegawai_lulus}}"disabled> 
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Catatan</label>
                                                        <input type="text" class="form-control" value="{{$rollcall->catatan}} "disabled>
                                                    </div> --}}

                                                                <div class="container-fluid mt-2">
                                                                    <div class="row">
                                                                        <div class="col-xl-4 col-md-6">
                                                                            <div class="card card-stats">
                                                                                <!-- Card body -->
                                                                                <div
                                                                                    class="card-body bg-default text-center">
                                                                                    <div class="row">
                                                                                        <div class="col">
                                                                                            <h5
                                                                                                class="card-title text-uppercase text-muted mb-0 text-white">
                                                                                                HADIR
                                                                                            </h5>
                                                                                            <span
                                                                                                class="h2 text-white font-weight-bold mb-0">{{ $rollcall->jumlah_phadir }}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-4 col-md-6">
                                                                            <div class="card card-stats">
                                                                                <!-- Card body -->
                                                                                <div
                                                                                    class="card-body bg-default text-center ">
                                                                                    <div class="row">
                                                                                        <div class="col">
                                                                                            <h5
                                                                                                class="card-title text-uppercase text-muted mb-0 text-white">
                                                                                                TIDAK HADIR
                                                                                            </h5>
                                                                                            <span
                                                                                                class="h2 text-white font-weight-bold mb-0">{{ $rollcall->jumlah_ptidak_hadir }}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-4 col-md-6">
                                                                            <div class="card card-stats">
                                                                                <!-- Card body -->
                                                                                <div
                                                                                    class="card-body bg-default text-center">
                                                                                    <div class="row">
                                                                                        <div class="col">
                                                                                            <h5
                                                                                                class="card-title text-uppercase text-muted mb-0 text-white">
                                                                                                JUMLAH
                                                                                            </h5>
                                                                                            <span
                                                                                                class="h2 text-white font-weight-bold mb-0">{{ $rollcall->jumlah_ptotal }}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <!-- Light table -->

                                                                    <div class="table-responsive">
                                                                        <table id="example"
                                                                            class="display table table-striped table-bordered nowrap"
                                                                            style="width:100%">
                                                                            <thead>
                                                                                <tr>
                                                                                    {{-- <th>No</th> --}}
                                                                                    <th>Nama Penguatkuasa</th>
                                                                                    <th>Waktu Masuk</th>
                                                                                    <th>Akhir Keluar</th>
                                                                                    <th>Sebab Tidak Hadir</th>
                                                                                    <th>Lampiran</th>

                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($rollcallsnew as $rollcallsbaru)
                                                                                    <?php if ($rollcallsbaru['roll_id'] == $rollcall->id) { ?>
                                                                                    <tr>
                                                                                        {{-- <td></td> --}}
                                                                                        <td>{{ $rollcallsbaru['penguatkuasa'] }}
                                                                                        </td>

                                                                                        @if ($rollcallsbaru['masuk'] === null)
                                                                                            <td>
                                                                                                <span
                                                                                                    class="badge badge-pill badge-primary">Dalam
                                                                                                    Proses</span>
                                                                                            </td>
                                                                                        @elseif($rollcallsbaru['masuk'] !== null)
                                                                                            <td>{{ $rollcallsbaru['masuk'] }}
                                                                                            </td>
                                                                                        @endif

                                                                                        @if ($rollcallsbaru['keluar'] === null)
                                                                                            <td>
                                                                                                <span
                                                                                                    class="badge badge-pill badge-primary">Dalam
                                                                                                    Proses</span>
                                                                                            </td>
                                                                                        @elseif($rollcallsbaru['keluar'] !== null)
                                                                                            <td>{{ $rollcallsbaru['keluar'] }}
                                                                                            </td>
                                                                                        @endif
                                                                                        <td>
                                                                                            @if ($rollcallsbaru['keterangan'] === null)
                                                                                                <span
                                                                                                    class="badge badge-pill badge-default">Tiada
                                                                                                    Rekod</span>
                                                                                            @elseif($rollcallsbaru['keterangan'] !== null)
                                                                                                {{ $rollcallsbaru['keterangan'] }}
                                                                                            @endif

                                                                                        </td>
                                                                                        <td>
                                                                                            @if ($rollcallsbaru['file_path'] === null)
                                                                                                <span
                                                                                                    class="badge badge-pill badge-default">Tiada
                                                                                                    Rekod</span>
                                                                                            @elseif($rollcallsbaru['file_path'] !== null)
                                                                                                <a type="button"
                                                                                                    href="storage/{{ $rollcallsbaru['file_path'] }}"
                                                                                                    target="_blank"
                                                                                                    class="btn btn-sm btn-primary">Muat
                                                                                                    Turun</a>
                                                                                            @endif
                                                                                        </td>


                                                                                    </tr>
                                                                                    <?php } ?>
                                                                                @endforeach

                                                                            </tbody>



                                                                        </table>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary"
                                                                data-dismiss="modal">Tutup</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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
                            <div class="card-header bg-default">
                                <h3 class="text-white mb-0">Carian</h3>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <form>
                                        <div class="row">
                                            <div class="col-sm mb-4">
                                                <label for="tajuk_rollcall">Pilih Tajuk Roll Call</label>
                                                <select id="selected_rollcall2" name="tajuk_rollcall"
                                                    class="form-control">
                                                    <option hidden selected> Tajuk Roll Call
                                                    </option>
                                                    @foreach ($rollcalls as $rollcallsfilter2)
                                                        <option
                                                            value="{{ $rollcallsfilter2->siri_rollcall }} - {{ $rollcallsfilter2->tajuk_rollcall }}">
                                                            {{ $rollcallsfilter2->siri_rollcall }} -
                                                            {{ $rollcallsfilter2->tajuk_rollcall }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="row float-right">
                                    <div class="col-sm ">
                                        <a href="" class="btn btn-sm btn-danger">Hapus Cari</a>
                                        <button onclick="customFilter2()" class="btn btn-sm btn-primary "
                                            id="filter">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="col-md-12 mb-4">
                                    <button style="margin-bottom: 10px" class="btn btn-primary btn-sm sokong_all "
                                        data-url="{{ url('PegawaiSokongAll') }}">Sokong Pilihan</button>
                                    {{-- <button style="margin-bottom: 10px" class="btn btn-danger btn-sm tolak_sokong_all" data-url="{{ url('TolakSokongAll') }}">Tolak Pilihan</button> --}}

                                </div>
                                <div class="card">

                                    <!-- Card header -->
                                    <div class="card-header bg-default border-0 mb-4">
                                        <h3 class="text-white mb-0">Senarai Sokong Roll Call</h3>
                                    </div>
                                    <!-- Light table -->
                                    <div class="table-responsive">
                                        <table id="example"
                                            class="display table table-striped table-bordered dt-responsive nowrap"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th width="50px"><input type="checkbox" id="masterSokong"></th>
                                                    {{-- <th width="50px"><input type="checkbox" id="masterTolakSokong"></th> --}}

                                                    <th>No</th>
                                                    <th>Tajuk Roll Call<br><br>Waktu Mula <br> Akhir rollcall</th>
                                                    <th>Nama Penguatkuasa</th>
                                                    <th>Waktu masuk <br><br> Waktu keluar</th>
                                                    <th style="background-color:#00FF00"> Masuk / Keluar <br><br>
                                                        eKedatangan</th>
                                                    {{-- <th>Pegawai Sokong<br><br> Pegawai Lulus</th> --}}
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($rollcall_sokong_baru as $pegawai_sokong_rollcall)
                                                    <tr>
                                                        @if ($pegawai_sokong_rollcall->sokong === null)
                                                            <td><input type="checkbox" class="sub_chk"
                                                                    data-id="{{ $pegawai_sokong_rollcall->id }}"></td>
                                                        @else
                                                            <td><input type="checkbox" disabled></td>
                                                        @endif
                                                        {{-- <td><input type="checkbox" class="sub_chk" data-id="{{$pegawai_sokong_rollcall->id}}"></td> --}}

                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $pegawai_sokong_rollcall->siri_rollcall }} -
                                                            {{ $pegawai_sokong_rollcall->tajuk_rollcall }}
                                                            <br><br>{{ $pegawai_sokong_rollcall->mula_rollcall }}
                                                            <br><br>
                                                            {{ $pegawai_sokong_rollcall->akhir_rollcall }}
                                                        </td>
                                                        <td>{{ $pegawai_sokong_rollcall->nama_pemohon }}</td>
                                                        {{-- <td>{{$pegawai_sokong_rollcall->mula_rollcall}} <br><br> {{$pegawai_sokong_rollcall->akhir_rollcall}}</td> --}}
                                                        {{-- <td >{{$pegawai_sokong_rollcall->lokasi}} <br><br> {{$pegawai_sokong_rollcall->catatan}}</td> --}}

                                                        @if ($pegawai_sokong_rollcall->masuk !== null)
                                                            <td>{{ $pegawai_sokong_rollcall->masuk }} <br>
                                                                <br>{{ $pegawai_sokong_rollcall->keluar }}
                                                            </td>
                                                        @elseif($pegawai_sokong_rollcall->masuk === null)
                                                            <td>
                                                                <span class="badge badge-pill badge-primary">Dalam
                                                                    Proses</span>
                                                                <br> <br>
                                                                <span class="badge badge-pill badge-primary">Dalam
                                                                    Proses</span>
                                                            </td>
                                                        @endif
                                                        <td>

                                                            <h5> Tarikh : <span
                                                                    style="color:rgb(255, 0, 21)">{{ $pegawai_sokong_rollcall->tarikh }}</span>
                                                            </h5>
                                                            <h5> Mula : <span style="color:rgb(255, 0, 21)">
                                                                    {{ $pegawai_sokong_rollcall->clockintime }}</span>
                                                            </h5>
                                                            <h5> Akhir : <span
                                                                    style="color:rgb(255, 0, 21)">{{ $pegawai_sokong_rollcall->clockouttime }}</span>
                                                            </h5>
                                                            {{-- <h5>  Jumlah OT  : <span style ="color:rgb(255, 0, 21)">{{$pegawai_sokong_rollcall->totalworkinghour}}</span> </h5> --}}
                                                            <h5> Status : <span
                                                                    style="color:rgb(255, 0, 21)">{{ $pegawai_sokong_rollcall->statusdesc }}</span>
                                                            </h5>
                                                            {{-- <h5>  Jumlah Jam  : <span style ="color:rgb(255, 0, 21)">{{$pegawai_sokong_rollcall->totalotduration}}</span> </h5> --}}
                                                            <h5> Waktu Anjal : <span
                                                                    style="color:rgb(255, 0, 21)">{{ $pegawai_sokong_rollcall->waktuanjal }}</span>
                                                            </h5>

                                                        </td>
                                                        {{-- <td>{{$pegawai_sokong_rollcall->pegawai_sokong_name}}<br><br>{{$pegawai_sokong_rollcall->pegawai_lulus_name}}</td> --}}
                                                        <td>
                                                            {{-- satu if masuk belum ada --}}
                                                            @if ($pegawai_sokong_rollcall->masuk !== null)
                                                                {{-- semak sokong --}}

                                                                @if ($pegawai_sokong_rollcall->sokong === null)
                                                                    <button type="button" class="btn btn-primary btn-sm"
                                                                        data-toggle="modal"
                                                                        data-target="#sokong{{ $pegawai_sokong_rollcall->id }}">
                                                                        Sokong
                                                                    </button>
                                                                    <br><br>
                                                                    <button type="button" class="btn btn-danger btn-sm"
                                                                        data-toggle="modal"
                                                                        data-target="#tolak_sokong{{ $pegawai_sokong_rollcall->id }}">
                                                                        Tolak
                                                                    </button>
                                                                @elseif($pegawai_sokong_rollcall->sokong === 1)
                                                                    <span class="badge badge-pill badge-success">Disahkan
                                                                        Pegawai Sokong</span><br><br>

                                                                    {{-- semak lulus --}}

                                                                    @if ($pegawai_sokong_rollcall->lulus === null)
                                                                        <span class="badge badge-pill badge-primary">Dalam
                                                                            Proses Pegawai Lulus</span>
                                                                    @elseif($pegawai_sokong_rollcall->lulus === 1)
                                                                        <span
                                                                            class="badge badge-pill badge-success">Diluluskan
                                                                            Pegawai Lulus</span>
                                                                    @elseif($pegawai_sokong_rollcall->lulus === 0)
                                                                        <span class="badge badge-pill badge-danger">Ditolak
                                                                            Pegawai Lulus</span><br><br>
                                                                        Sebab Tolak :
                                                                        {{ $pegawai_sokong_rollcall->lulus_sebab }}
                                                                    @endif
                                                                @elseif($pegawai_sokong_rollcall->sokong === 0)
                                                                    <span class="badge badge-pill badge-danger">Ditolak
                                                                        Pegawai Sokong</span><br><br>
                                                                    Sebab Tolak :
                                                                    {{ $pegawai_sokong_rollcall->sokong_sebab }}<br><br>
                                                                    <span class="badge badge-pill badge-danger">Ditolak
                                                                        kehadiran </span>
                                                                @endif
                                                            @elseif($pegawai_sokong_rollcall->masuk === null)
                                                                <span class="badge badge-pill badge-primary">Dalam
                                                                    Proses</span>
                                                                <br> <br>
                                                                <span class="badge badge-pill badge-primary">Dalam
                                                                    Proses</span>
                                                            @endif

                                                        </td>
                                                    </tr>
                                                    <!-- Modal Sokong -->
                                                    <div class="modal fade"
                                                        id="sokong{{ $pegawai_sokong_rollcall->id }}" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-default">
                                                                    <h5 class="text-white modal-title"
                                                                        id="exampleModalLabel"> Makluman</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Sokong Kehadiran Roll Call Penguatkuasa
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary btn-sm"
                                                                        data-dismiss="modal">Tutup</button>

                                                                    <a href="/sokong/{{ $pegawai_sokong_rollcall->id }}/"
                                                                        class="btn btn-success btn-sm">Sokong</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal Tolak-->
                                                    <div class="modal fade"
                                                        id="tolak_sokong{{ $pegawai_sokong_rollcall->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-default">
                                                                    <h5 class="modal-title text-white"
                                                                        id="exampleModalLabel">
                                                                        Tolak Kehadiran Roll Call Penguatkuasa ?
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="POST" action="/tolak_sokong">
                                                                        @csrf
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="Perkara">Sebab Tolak
                                                                                    Permohonan</label>
                                                                                <input type="hidden"
                                                                                    value="{{ $pegawai_sokong_rollcall->id }}"
                                                                                    name="id">
                                                                                <div class="input-group input-group-merge">
                                                                                    <textarea class="form-control " name="sokong_sebab" placeholder="Sebab" type="text" rows="5"></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-primary btn-sm "
                                                                                    data-dismiss="modal">Tutup</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-success btn-sm">Hantar</button>
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
            <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                <div>
                    <div class="container-fluid mt--6">
                        {{-- Filter --}}
                        <div class="card">
                            <div class="card-header bg-default">
                                <h3 class="text-white mb-0">Carian</h3>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <form>
                                        <div class="row">
                                            <div class="col-sm mb-4">
                                                <label for="tajuk_rollcall">Pilih Tajuk Roll Call</label>
                                                <select id="selected_rollcall3" name="tajuk_rollcall"
                                                    class="form-control">
                                                    <option hidden selected> Tajuk Roll Call
                                                    </option>
                                                    @foreach ($rollcalls as $rollcallsfilter3)
                                                        <option
                                                            value="{{ $rollcallsfilter3->siri_rollcall }} - {{ $rollcallsfilter3->tajuk_rollcall }}">
                                                            {{ $rollcallsfilter3->siri_rollcall }} -
                                                            {{ $rollcallsfilter3->tajuk_rollcall }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="row float-right">
                                    <div class="col-sm ">
                                        <a href="" class="btn btn-sm btn-danger">Hapus Cari</a>
                                        <button onclick="customFilter3()" class="btn btn-sm btn-primary "
                                            id="filter">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Senarai LULUS --}}
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="col-md-12 mb-4">

                                    <button style="margin-bottom: 10px" class="btn btn-primary btn-sm lulus_all "
                                        data-url="{{ url('PegawaiLulusAll') }}">Lulus Pilihan</button>
                                    {{-- <button style="margin-bottom: 10px" class="btn btn-danger btn-sm  " data-url="{{ url('TolakLulusAll') }}">Tolak Pilihan</button> --}}
                                </div>
                                <div class="card">
                                    <!-- Card header -->
                                    <div class="card-header bg-default border-0 mb-4">
                                        <h3 class="text-white mb-0">Senarai Lulus Roll Call</h3>
                                    </div>
                                    <!-- Light table -->
                                    <div class="table-responsive">
                                        <table id="example"
                                            class="display table table-striped table-bordered dt-responsive nowrap"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th width="50px"><input type="checkbox" id="masterLulus"></th>

                                                    <th>No</th>
                                                    <th>Tajuk Roll Call<br><br> Waktu Mula <br><br> Akhir rollcall</th>
                                                    <th>Nama Penguatkuasa</th>
                                                    <th>Waktu masuk <br><br> Waktu keluar</th>
                                                    <th style="background-color:#00FF00"> Masuk / Keluar <br><br>
                                                        eKedatangan</th>
                                                    {{-- <th>Pegawai Sokong<br><br> Pegawai Lulus</th> --}}
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($rollcall_lulus_baru as $pegawai_lulus_rollcall)
                                                    <tr>
                                                        @if ($pegawai_sokong_rollcall->sokong === null)
                                                            <td><input type="checkbox" class="sub_chk"
                                                                    data-id="{{ $pegawai_lulus_rollcall->id }}"></td>
                                                        @else
                                                            <td><input type="checkbox" disabled></td>
                                                        @endif
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $pegawai_lulus_rollcall->siri_rollcall }} -
                                                            {{ $pegawai_lulus_rollcall->tajuk_rollcall }}
                                                            <br><br>{{ $pegawai_lulus_rollcall->mula_rollcall }}<br><br>{{ $pegawai_lulus_rollcall->akhir_rollcall }}
                                                        </td>
                                                        <td>{{ $pegawai_lulus_rollcall->nama_pemohon }}</td>
                                                        {{-- <td>{{$pegawai_lulus_rollcall->mula_rollcall}} <br><br> {{$pegawai_lulus_rollcall->akhir_rollcall}}</td> --}}
                                                        {{-- <td>{{$pegawai_lulus_rollcall->lokasi}} <br><br> {{$pegawai_lulus_rollcall->catatan}}</td> --}}

                                                        @if ($pegawai_lulus_rollcall->masuk !== null)
                                                            <td>{{ $pegawai_lulus_rollcall->masuk }} <br>
                                                                <br>{{ $pegawai_lulus_rollcall->keluar }}
                                                            </td>
                                                        @elseif($pegawai_lulus_rollcall->masuk === null)
                                                            <td>
                                                                <span class="badge badge-pill badge-primary">Dalam
                                                                    Proses</span>
                                                                <br> <br>
                                                                <span class="badge badge-pill badge-primary">Dalam
                                                                    Proses</span>
                                                            </td>
                                                        @endif
                                                        <td>

                                                            <h5> Tarikh : <span
                                                                    style="color:rgb(255, 0, 21)">{{ $pegawai_lulus_rollcall->tarikh }}</span>
                                                            </h5>
                                                            <h5> Mula : <span style="color:rgb(255, 0, 21)">
                                                                    {{ $pegawai_lulus_rollcall->clockintime }}</span>
                                                            </h5>
                                                            <h5> Akhir : <span
                                                                    style="color:rgb(255, 0, 21)">{{ $pegawai_lulus_rollcall->clockouttime }}</span>
                                                            </h5>
                                                            {{-- <h5>  Jumlah OT  : <span style ="color:rgb(255, 0, 21)">{{$pegawai_lulus_rollcall->totalworkinghour}}</span> </h5> --}}
                                                            <h5> Status : <span
                                                                    style="color:rgb(255, 0, 21)">{{ $pegawai_lulus_rollcall->statusdesc }}</span>
                                                            </h5>
                                                            {{-- <h5>  Jumlah Jam  : <span style ="color:rgb(255, 0, 21)">{{$pegawai_lulus_rollcall->totalotduration}}</span> </h5> --}}
                                                            <h5> Waktu Anjal : <span
                                                                    style="color:rgb(255, 0, 21)">{{ $pegawai_lulus_rollcall->waktuanjal }}</span>
                                                            </h5>

                                                        </td>
                                                        {{-- <td>{{$pegawai_lulus_rollcall->pegawai_sokong_name}}<br><br>{{$pegawai_lulus_rollcall->pegawai_lulus_name}}</td> --}}
                                                        <td>
                                                            @if ($pegawai_lulus_rollcall->masuk !== null)
                                                                @if ($pegawai_lulus_rollcall)
                                                                    {{-- Semak lulus status --}}
                                                                    @if ($pegawai_lulus_rollcall->sokong === null)
                                                                        <span class="badge badge-pill badge-primary">Dalam
                                                                            Proses Pegawai Lulus</span>
                                                                    @elseif($pegawai_lulus_rollcall->sokong === 1)
                                                                        @if ($pegawai_lulus_rollcall->lulus === null)
                                                                            <span
                                                                                class="badge badge-pill badge-success">Disahkan
                                                                                Pegawai Sokong</span><br><br>

                                                                            <button type="button"
                                                                                class="btn btn-primary btn-sm"
                                                                                data-toggle="modal"
                                                                                data-target="#lulus{{ $pegawai_lulus_rollcall->id }}">
                                                                                Lulus
                                                                            </button>
                                                                            {{-- <br><br> --}}
                                                                            <button type="button"
                                                                                class="btn btn-danger btn-sm"
                                                                                data-toggle="modal"
                                                                                data-target="#tolak_lulus{{ $pegawai_lulus_rollcall->id }}">
                                                                                Tolak
                                                                            </button>
                                                                        @elseif($pegawai_lulus_rollcall->lulus === 1)
                                                                            <span
                                                                                class="badge badge-pill badge-success">Disahkan
                                                                                Pegawai Sokong</span><br><br>
                                                                            <span
                                                                                class="badge badge-pill badge-success">Diluluskan
                                                                                Pegawai Lulus</span>
                                                                        @elseif($pegawai_lulus_rollcall->lulus === 0)
                                                                            <span
                                                                                class="badge badge-pill badge-success">Disahkan
                                                                                Pegawai Sokong</span><br><br>
                                                                            <span
                                                                                class="badge badge-pill badge-danger">Ditolak
                                                                                Pegawai Lulus</span><br><br>
                                                                            Sebab Tolak :
                                                                            {{ $pegawai_lulus_rollcall->lulus_sebab }}
                                                                        @endif
                                                                    @elseif($pegawai_lulus_rollcall->sokong === 0)
                                                                        <span class="badge badge-pill badge-danger">Ditolak
                                                                            Pegawai Sokong </span><br><br>
                                                                        Sebab Tolak
                                                                        :{{ $pegawai_lulus_rollcall->sokong_sebab }}
                                                                        <br><br>
                                                                        <span class="badge badge-pill badge-danger">Ditolak
                                                                            Pegawai Lulus</span>
                                                                    @endif
                                                                @elseif($pegawai_lulus_rollcall->lulus === 1)
                                                                    <span class="badge badge-pill badge-success">Disahkan
                                                                        Pegawai Lulus</span><br><br>
                                                                @elseif($pegawai_lulus_rollcall->lulus === 0)
                                                                    <span class="badge badge-pill badge-danger">Ditolak
                                                                        Pegawai Lulus</span><br><br>
                                                                @endif
                                                            @elseif($pegawai_lulus_rollcall->masuk === null)
                                                                <span class="badge badge-pill badge-primary">Dalam
                                                                    Proses</span>
                                                                <br> <br>
                                                                <span class="badge badge-pill badge-primary">Dalam
                                                                    Proses</span>
                                                            @endif

                                                        </td>
                                                    </tr>
                                                    <!-- Modal lulus -->
                                                    <div class="modal fade"
                                                        id="lulus{{ $pegawai_lulus_rollcall->id }}" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-default">
                                                                    <h5 class="text-white modal-title"
                                                                        id="exampleModalLabel"> Makluman</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Lulus Kehadiran Roll Call Penguatkuasa
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary btn-sm"
                                                                        data-dismiss="modal">Tutup</button>

                                                                    <a href="/lulus/{{ $pegawai_lulus_rollcall->id }}/"
                                                                        class="btn btn-success btn-sm">Lulus</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal Tolak-->
                                                    <div class="modal fade"
                                                        id="tolak_lulus{{ $pegawai_lulus_rollcall->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-default">
                                                                    <h5 class="modal-title text-white"
                                                                        id="exampleModalLabel"> Tolak Kehadiran Roll Call
                                                                        Penguatkuasa ?
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="POST" action="/tolak_lulus">
                                                                        @csrf
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="Perkara">Sebab Tolak
                                                                                    Permohonan</label>
                                                                                <input type="hidden"
                                                                                    value="{{ $pegawai_lulus_rollcall->id }}"
                                                                                    name="id">
                                                                                <div class="input-group input-group-merge">
                                                                                    <textarea class="form-control" name="lulus_sebab" placeholder="Sebab" type="text" rows="5"></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-primary btn-sm "
                                                                                    data-dismiss="modal">Tutup</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-success btn-sm">Hantar</button>

                                                                            </div>
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
@section('script')
    <script>
        //var table;
        var table = $('table.display').DataTable();
        // $(document).ready(function () {
        //     table = $('table.display').DataTable();
        // });

        // Kemaskini Masuk dan Keluar
        function MasaMula(obj, obj2) {
            alert(obj)
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/ubah-masa_mula/" + obj,
                type: "POST",
                data: {
                    "masuk": obj2.value
                }

            });
        }

        function MasaAkhir(obj, obj2) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/ubah-masa_akhir/" + obj,
                type: "POST",
                data: {
                    "keluar": obj2.value
                }

            });
        }

        function customFilter() {
            let selected_tajuk = $("#selected_rollcall option:selected").val();
            $("#example_filter input").val(selected_tajuk);
        }

        function customFilter2() {
            let selected_tajuk = $("#selected_rollcall2 option:selected").val()
            $("#example_filter input").val(selected_tajuk);
        }

        function customFilter3() {
            let selected_tajuk = $("#selected_rollcall3 option:selected").val()
            $("#example_filter input").val(selected_tajuk);
            // console.log(table);

            // table.search(selected_tajuk).draw();

        }
        // ________________
    </script>
    {{-- Sokong All --}}
    <script type="text/javascript">
        $(document).ready(function() {


            $('#masterSokong').on('click', function(e) {
                if ($(this).is(':checked', true)) {
                    $(".sub_chk").prop('checked', true);
                } else {
                    $(".sub_chk").prop('checked', false);
                }
            });


            $('.sokong_all').on('click', function(e) {


                var allVals = [];
                $(".sub_chk:checked").each(function() {
                    allVals.push($(this).attr('data-id'));
                });


                if (allVals.length <= 0) {
                    alert("Sila Tandakan Pilihan Senarai Sokong Roll Call Yang Diperlukan ");
                } else {


                    var check = confirm("Anda Pasti Untuk Sokong Semua Pilihan Anda?");
                    if (check == true) {


                        var join_selected_values = allVals.join(",");
                        alert(join_selected_values);


                        $.ajax({
                            url: $(this).data('url'),
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: 'ids=' + join_selected_values,
                            success: function(data) {
                                if (data['success']) {
                                    $(".sub_chk:checked").each(function() {
                                        $(this).parents("tr").remove();
                                    });
                                    alert(data['success']);
                                } else if (data['error']) {
                                    alert(data['error']);
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }

                                window.location.reload();
                            },
                            error: function(data) {
                                alert(data.responseText);
                            }
                        });


                        $.each(allVals, function(index, value) {
                            $('table tr').filter("[data-row-id='" + value + "']").remove();
                        });
                    }
                }
            });





            $(document).on('confirm', function(e) {
                var ele = e.target;
                e.preventDefault();


                $.ajax({
                    url: ele.href,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data['success']) {
                            $("#" + data['tr']).slideUp("slow");
                            alert(data['success']);
                        } else if (data['error']) {
                            alert(data['error']);
                        } else {
                            alert('Whoops Something went wrong!!');
                        }

                        window.location.reload();
                    },
                    error: function(data) {
                        alert(data.responseText);
                    }
                });


                return false;
            });
        });
    </script>

    {{-- Tolak Sokong All --}}
    {{-- <script type="text/javascript">
        $(document).ready(function() {


            $('#masterTolakSokong').on('click', function(e) {
                if ($(this).is(':checked', true)) {
                    $(".sub_chk").prop('checked', true);
                } else {
                    $(".sub_chk").prop('checked', false);
                }
            });


            $('.tolak_sokong_all').on('click', function(e) {


                var allVals = [];
                $(".sub_chk:checked").each(function() {
                    allVals.push($(this).attr('data-id'));
                });


                if (allVals.length <= 0) {
                    alert("Sila Tandakan Pilihan Senarai Tolak Roll Call Yang Diperlukan ");
                } else {


                    var check = confirm("Anda Pasti Untuk Tolak Semua Pilihan Anda?");
                    if (check == true) {


                        var join_selected_values = allVals.join(",");
                        alert(join_selected_values);


                        $.ajax({
                            url: $(this).data('url'),
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: 'ids=' + join_selected_values,
                            success: function(data) {
                                if (data['success']) {
                                    $(".sub_chk:checked").each(function() {
                                        $(this).parents("tr").remove();
                                    });
                                    alert(data['success']);
                                } else if (data['error']) {
                                    alert(data['error']);
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }

                                window.location.reload();
                            },
                            error: function(data) {
                                alert(data.responseText);
                            }
                        });


                        $.each(allVals, function(index, value) {
                            $('table tr').filter("[data-row-id='" + value + "']").remove();
                        });
                    }
                }
            });




            $(document).on('confirm', function(e) {
                var ele = e.target;
                e.preventDefault();


                $.ajax({
                    url: ele.href,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data['success']) {
                            $("#" + data['tr']).slideUp("slow");
                            alert(data['success']);
                        } else if (data['error']) {
                            alert(data['error']);
                        } else {
                            alert('Whoops Something went wrong!!');
                        }

                        window.location.reload();
                    },
                    error: function(data) {
                        alert(data.responseText);
                    }
                });


                return false;
            });
        });


        <
        script type = "text/javascript" >
            $(document).ready(function() {

                $('#masterLulus').on('click', function(e) {
                    if ($(this).is(':checked', true)) {
                        $(".sub_chk").prop('checked', true);
                    } else {
                        $(".sub_chk").prop('checked', false);
                    }
                });


                $('.lulus_all').on('click', function(e) {


                    var allVals = [];
                    $(".sub_chk:checked").each(function() {
                        allVals.push($(this).attr('data-id'));
                    });


                    if (allVals.length <= 0) {
                        alert("Sila Tandakan Pilihan Senarai Lulus Roll Call Yang Diperlukan ");
                    } else {


                        var check = confirm("Anda Pasti Untuk Lulus Semua Pilihan Anda?");
                        if (check == true) {


                            var join_selected_values = allVals.join(",");
                            alert(join_selected_values);


                            $.ajax({
                                url: $(this).data('url'),
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: 'ids=' + join_selected_values,
                                success: function(data) {
                                    if (data['success']) {
                                        $(".sub_chk:checked").each(function() {
                                            $(this).parents("tr").remove();
                                        });
                                        alert(data['success']);
                                    } else if (data['error']) {
                                        alert(data['error']);
                                    } else {
                                        alert('Whoops Something went wrong!!');
                                    }

                                    window.location.reload();
                                },
                                error: function(data) {
                                    alert(data.responseText);
                                }
                            });


                            $.each(allVals, function(index, value) {
                                $('table tr').filter("[data-row-id='" + value + "']").remove();
                            });
                        }
                    }
                });





                $(document).on('confirm', function(e) {
                    var ele = e.target;
                    e.preventDefault();


                    $.ajax({
                        url: ele.href,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            if (data['success']) {
                                $("#" + data['tr']).slideUp("slow");
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }

                            window.location.reload();
                        },
                        error: function(data) {
                            alert(data.responseText);
                        }
                    });


                    return false;
                });
            });
    </script> --}}
@endsection
