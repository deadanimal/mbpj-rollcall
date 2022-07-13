@extends('base')

@section('content')
    <div>
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 text-white d-inline-block mb-0">Kemaskini</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item"><a href="/rollcalls"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="/rollcalls">Pengurusan</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Roll Call</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-12 col text-right">
                            <a type="button" class="btn btn-neutral btn-sm" data-toggle="modal"
                                data-target="#tambahkakitangan"> +
                                Tambah Penguatkuasa Roll Call</a>
                            <a type="button" class="btn btn-neutral btn-sm" data-toggle="modal"
                                data-target="#tambahbahagian"> +
                                Tambah Bahagian</a>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                data-target="#lihatqrcode" onclick="runQR()"> Imbas QRCODE
                                <i class="ni ni-square-pin"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="lihatqrcode" tabindex="-1" role="dialog"
                                aria-labelledby="lihatqrcodeLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-default">
                                            <h5 class="modal-title text-white" id="lihatqrcodeLabel">QRcode</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="container">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <div id="qr-reader" style="width:500px"></div>
                                                    <div id="qr-reader-results"></div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm"
                                                data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>


                                    <script type="text/javascript" src="https://unpkg.com/html5-qrcode"></script>
                                    <script>
                                        var resultContainer = document.getElementById('qr-reader-results');
                                        var lastResult, countResults = 0;

                                        function ismaelPegawai(url) {
                                            window.location.assign(url);
                                        }

                                        function onScanSuccess(decodedText, decodedResult) {
                                            var rollcall_id = @json($rollcall->id);

                                            if (decodedText !== lastResult) {
                                                ++countResults;
                                                lastResult = decodedText;

                                                id = `${decodedText}`;

                                                $.ajax({
                                                    method: "POST",
                                                    url: '/scanQr',
                                                    data: {
                                                        "_token": "{{ csrf_token() }}",
                                                        "nric": id,
                                                        "rollcall_id": rollcall_id,
                                                    },
                                                }).done(function(response) {
                                                    html5QrcodeScanner.clear();
                                                    alert("Rekod Disimpan");
                                                    location.reload();
                                                });
                                            }
                                        }

                                        function runQR() {
                                            var html5QrcodeScanner = new Html5QrcodeScanner(
                                                "qr-reader", {
                                                    fps: 10,
                                                    qrbox: 250
                                                });
                                            html5QrcodeScanner.render(onScanSuccess);
                                        }

                                        var html5QrcodeScanner = new Html5QrcodeScanner(
                                            "qr-reader", {
                                                fps: 10,
                                                qrbox: 250
                                            });
                                        html5QrcodeScanner.render(onScanSuccess);
                                        $(document).ready(function() {
                                            html5QrcodeScanner.clear();
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (auth()->user()->role == 'naziran')
            <div class="container-fluid mt--6">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-wrapper">
                            <!-- Input groups -->
                            <div class="card">
                                <!-- Card header -->
                                <div class="card-header bg-default">
                                    <h3 class="text-white mb-0">Kemaskini Jadual Roll Call</h3>
                                </div>
                                <!-- Card body -->
                                <div class="card-body">
                                    <form method="POST" action="/rollcalls/{{ $rollcall->id }}">
                                        @csrf
                                        @method('PUT')
                                        <!-- Input groups with icon -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> Waktu Mula Semasa</label>
                                                    <div class="input-group input-group-merge">
                                                        <input class="form-control "
                                                            value="{{ $rollcall->mula_rollcall }}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Waktu akhir Semasa</label>
                                                    <div class="input-group input-group-merge">
                                                        <input class="form-control"
                                                            value="{{ $rollcall->akhir_rollcall }}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mula_rollcall">Kemaskini waktu mula</label>
                                                    <div class="form-group">
                                                        <div class="input-group date" id="datetimepicker1">
                                                            <input type="text" class="form-control" name="mula_rollcall">
                                                            <span class="input-group-addon input-group-append">
                                                                <button class="btn btn-outline-primary" type="button"
                                                                    id="button-addon2"> <span
                                                                        class="fa fa-calendar"></span></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="akhir_rollcall">Kemaskini waktu akhir</label>
                                                    <div class="form-group">
                                                        <div class="input-group date" id="datetimepicker2">
                                                            <input type="text" class="form-control"
                                                                name="akhir_rollcall">
                                                            <span class="input-group-addon input-group-append">
                                                                <button class="btn btn-outline-primary" type="button"
                                                                    id="button-addon2"> <span
                                                                        class="fa fa-calendar"></span></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="lokasi">Lokasi </label>
                                                    <div class="input-group input-group-merge">
                                                        <input class="form-control" name="lokasi"
                                                            value="{{ $rollcall->lokasi }}" type="text">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-map-marker"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Perkara">Catatan</label>
                                                    <div class="input-group input-group-merge">
                                                        <input class="form-control" name="catatan"
                                                            value="{{ $rollcall->catatan }}" type="text">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-eye"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tajuk_rollcall">Tajuk</label>
                                                    <div class="input-group input-group-merge">
                                                        <input class="form-control" name="tajuk_rollcall"
                                                            value="{{ $rollcall->tajuk_rollcall }}" type="text">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-map-marker"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 ">
                                                <div class="form-group ">
                                                    <label for="status">Status</label>
                                                    <div class="input-group input-group-merge">
                                                        <select class="form-control" name="status" require>
                                                            @foreach ($status as $key => $value)
                                                                <option {{ $rollcall->status == $key ? 'selected' : '' }}
                                                                    value="{{ $key }}">{{ $value }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <!-- Button trigger modal -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="Perkara">Kemaskini Makluman Roll Call</label>
                                                    <div class="form-group">
                                                        <textarea class="form-control" id="maklumat" name="maklumat" value="{{ $rollcall->maklumat }}"></textarea>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary btn-sm float-right"
                                                    data-toggle="modal" data-target="#exampleModal">
                                                    Kemaskini
                                                </button>

                                            </div>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-default">
                                                            <h5 class="text-white modal-title" id="exampleModalLabel">
                                                                Makluman</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Kemaskini Roll Call ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm"
                                                                data-dismiss="modal">Tutup</button>
                                                            <button type="submit"
                                                                class="btn btn-primary btn-sm float-right">Kemaskini</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt--10">
                <div class="row ">
                    <div class="col-md-12">

                        <button style="margin-bottom: 10px" class="btn btn-danger btn-sm delete_all "
                            data-url="{{ url('penguatkuasaDeleteAll') }}">Hapus Pilihan</button>
                        <form action="/btn-log-keluar-semua" class="d-inline" method="POST">
                            @csrf
                            @foreach ($userrollcalls as $urc)
                                @if (isset($urc->masuk) && !isset($urc->keluar))
                                    <input type="hidden" name="userrollcalls[]" value="{{ $urc->id }}">
                                @endif
                            @endforeach
                            <button style="margin-bottom: 10px" class="btn btn-primary btn-sm">Keluar Semua</button>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <!-- Card header -->
                            <div class="card-header bg-default border-0">
                                <h3 class="text-white mb-0">Senarai Penguatkuasa Terlibat </h3>
                            </div>
                            <div class="col-md-6 header float-right mb--12">
                            </div>
                            <div class="card-body px-0">
                                <!-- Light table -->
                                <x:notify-messages />

                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th width="50px"><input type="checkbox" id="master"></th>

                                                <th>No</th>
                                                <th>Nama Penguatkuasa</th>
                                                <th>No Pekerja | NRIC </th>
                                                <th>Pegawai Sokong <br> Pegawai Lulus</th>
                                                <th>Waktu Masuk </th>
                                                <th> Waktu Keluar</th>
                                                <th>Status </th>

                                                <th>Tindakan</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- {{$userrollcalls}} --}}
                                            @foreach ($userrollcalls as $userrollcall)
                                                <tr>
                                                    <td><input type="checkbox" class="sub_chk"
                                                            data-id="{{ $userrollcall->id }}"></td>

                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $userrollcall->penguatkuasa['name'] }}</td>
                                                    <td>{{ $userrollcall->penguatkuasa['user_code'] }}<br><br>{{ $userrollcall->penguatkuasa['nric'] }}
                                                    </td>
                                                    <td>{{ $userrollcall->pegawaiSokong->name ?? 'Tidak Wujud' }} <br>
                                                        {{ $userrollcall->pegawaiLulus->name ?? 'Tidak Wujud' }}</td>
                                                    @if ($userrollcall['masuk'] === null)
                                                        <td><span class="badge badge-pill badge-primary">Dalam
                                                                Proses</span></td>
                                                    @elseif($userrollcall['masuk'] !== null)
                                                        <td>{{ $userrollcall['masuk'] }}</td>
                                                    @endif
                                                    @if ($userrollcall['keluar'] === null)
                                                        <td><span class="badge badge-pill badge-primary">Dalam
                                                                Proses</span></td>
                                                    @elseif($userrollcall['keluar'] !== null)
                                                        <td>{{ $userrollcall['keluar'] }}</td>
                                                    @endif

                                                    @if ($userrollcall['sokong'] === null)
                                                        <td><span class="badge badge-pill badge-primary">Dalam
                                                                Proses</span></td>
                                                    @elseif($userrollcall['sokong'] === 1)
                                                        <td><span
                                                                class="badge badge-pill badge-success">Disokong</span><br><br>
                                                            @if ($userrollcall['lulus'] === null)
                                                                <span class="badge badge-pill badge-primary">Dalam
                                                                    Proses</span>
                                                            @elseif($userrollcall['lulus'] === 1)
                                                                <span
                                                                    class="badge badge-pill badge-success">Diluluskan</span>
                                                            @elseif($userrollcall['lulus'] === 0)
                                                                <span class="badge badge-pill badge-danger">Ditolak</span>
                                                                :
                                                                {{ $userrollcall['lulus_sebab'] }}<br><br>
                                                            @endif
                                                        </td>
                                                    @elseif($userrollcall['sokong'] === 0)
                                                        <td><span class="badge badge-pill badge-danger">Ditolak</span> :
                                                            {{ $userrollcall['sokong_sebab'] }}<br><br>
                                                            <span class="badge badge-pill badge-danger">Ditolak</span>
                                                        </td>
                                                    @endif

                                                    <td> <button
                                                            onclick="buang({{ $userrollcall->id }})"class="btn btn-danger btn-sm"><i
                                                                class="ni ni-basket"></i></button>

                                                        @if (auth()->user()->role == 'naziran')
                                                            @if (isset($userrollcall->masuk) && !isset($userrollcall->keluar))
                                                                <a class="btn btn-primary btn-sm"
                                                                    href="/btn-keluar-roll-call/{{ $userrollcall->id }}">Keluar</a>
                                                            @endif
                                                        @endif
                                                    </td>

                                                </tr>

                                                <script>
                                                    function buang(id) {
                                                        swal({
                                                            title: 'Makluman?',
                                                            text: "Hapus Penguatkuasa !",
                                                            type: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: '#3085d6',
                                                            cancelButtonColor: '#d33',
                                                            confirmButtonText: 'Buang',
                                                            cancelButtonText: 'Tutup',

                                                        }).then(result => {
                                                            if (result.value == true) {
                                                                $.ajax({
                                                                    url: "/userrollcalls/" + id,
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

                                                            } else if (result.dismiss == "cancel") {}
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
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <input type="file" class="custom-file-input" id="customFileLang"
                                                    lang="en">
                                                <label class="custom-file-label" for="customFileLang">Select file</label>
                                            </div>
                                        </form>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm"
                                        data-dismiss="modal">Tutup</button>
                                    <button type="button" class="btn btn-primary btn-sm">Kemaskini</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="tambahkakitangan" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-default">
                            <h5 class="text-white modal-title" id="tambahkakitanganLabel"> Tambah Penguatkuasa Roll Call
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card-wrapper">

                                        <form method="POST" action="/userrollcalls">
                                            @csrf
                                            @if ($errors->any())
                                                <div class="alert alert-danger" role="alert">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            @if (Session::has('success'))
                                                <div class="alert alert-success text-center">
                                                    <p>{{ Session::get('success') }}</p>
                                                </div>
                                            @endif
                                            <div class="container">
                                                <div class="row">

                                                    <div class="col-12">
                                                        <div id="multiple-select" class="mt-3">
                                                            <select class="advmultiselect mt-4" multiple
                                                                placeholder="Penguatkuasa" name="penguatkuasa_id"
                                                                id="advmultiselect">
                                                                @foreach ($kakitangan as $k)
                                                                    <option value="{{ $k->id }}">
                                                                        {{ $k->name }} - {{ $k->nric }} -
                                                                        {{ $k->role }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <input type="hidden" name="roll_id" class="form-control"
                                                value="{{ $rollcall->id }}" />


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>

                                            </div>


                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="tambahbahagian" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-default">
                            <h5 class="text-white modal-title" id="tambahbahagianLabel"> Tambah Bahagian</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card-wrapper">
                                        <form method="POST" action="/simpanbahagian">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="kumpulan">Pilih Kumpulan</label><br>
                                                        <select name="id_kumpulan" class="form-control custom-select"
                                                            required>
                                                            <option hidden selected disabled>Pilih Kumpulan</option>
                                                            @foreach ($kumpulan as $kumpulans)
                                                                <option value="{{ $kumpulans->id }}">
                                                                    {{ $kumpulans->nama_kumpulan }}</option>
                                                            @endforeach
                                                        </select>


                                                    </div>
                                                </div>
                                                <input type="hidden" name="roll_id" class="form-control"
                                                    value="{{ $rollcall->id }}" />
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>

                                            </div>
                                    </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(auth()->user()->role == 'penguatkuasa')
        @endif
        <footer class="footer pt-0">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6">
                    <div class="copyright text-center  text-lg-left  text-muted">
                        &copy; 2021 <a href="#" class="font-weight-bold ml-1" target="_blank">Sistem
                            Pengurusan
                            Elaun Lebih Masa</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

@endsection
{{-- Script --}}
@section('script')
    <script src="/assets/vendor/bootstrap-datetimepicker.js"></script>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>


    <script>
        $(document).ready(function() {


            VirtualSelect.init({
                ele: '.advmultiselect',
                required: true,
                noOptionsText: 'Tiada',
                noSearchResultsTex: 'Tiada',
                optionSelectedText: 'pemohon telah dipilih',
                optionsSelectedText: 'pemohon telah dipilih',
                allOptionsSelectedText: 'Semua telah dipilih',
                maxWidth: '1000px',
                placeholder: 'Sila Pilih',
                searchPlaceholderText: 'Cari...',
                name: 'kakitangan',
                multiple: true
            });

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

            var lol = CKEDITOR.replace('maklumat');
            lol.setData({!! json_encode($rollcall->maklumat) !!});
            var i = 0;


            $('#master').on('click', function(e) {
                if ($(this).is(':checked', true)) {
                    $(".sub_chk").prop('checked', true);
                } else {
                    $(".sub_chk").prop('checked', false);
                }
            });


            $('.delete_all').on('click', function(e) {

                var allVals = [];
                $(".sub_chk:checked").each(function() {
                    allVals.push($(this).attr('data-id'));
                });

                if (allVals.length <= 0) {
                    alert("Sila Tandakan Pilihan Senarai Hapus Penguatkuasa Yang Diperlukan.");
                } else {
                    var check = confirm("Anda Pasti Untuk Hapus Semua Pilihan Anda?");
                    if (check == true) {
                        var join_selected_values = allVals.join(",");
                        $.ajax({
                            url: $(this).data('url'),
                            type: 'DELETE',
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


        });
    </script>
@endsection
