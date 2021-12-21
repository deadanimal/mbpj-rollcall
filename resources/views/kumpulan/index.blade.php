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
                            <li class="breadcrumb-item"><a href="/kumpulan"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="/kumpulan">Rollcall</a></li>
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
                    <a href="/kumpulan/create" class="btn btn-sm btn-neutral">+ Tambah kumpulan</a>
                </div>
                @elseif(auth()->user()->role == 'pentadbir_sistem')
                <div class="col-lg-12 col text-right">
                    <a href="/kumpulan/create" class="btn btn-sm btn-neutral">+ Tambah kumpulan</a>
                </div>
                @else
                --
                @endif
            </div>
        </div>
    </div>
</div>

@if(auth()->user()->role == 'pentadbir_sistem')
<div>
    <div class="container-fluid mt--6">
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header bg-default border-0">
                        <h3 class="text-white mb-0">kumpulan</h3>
                    </div>
                        <div class="card-body px-0">
                            <!-- Light table -->
                            <div class="table-responsive py-4">
                                <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>kumpulan </th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kumpulan as $kumpulans)
                                        <tr>
                                            <td>
                                                {{$loop->index+1}}
                                            </td>
                                            <td>
                                                {{$kumpulans->nama_kumpulan}}
                                            </td>
                                            <td>
                                                <a href="/kumpulan/{{$kumpulans->id}}/edit"
                                                    class="btn btn-primary btn-sm"> kemaskini <i
                                                        class="ni ni-single-copy-04"></i>
                                                </a>
                                                <br>
                                                <button onclick="buang({{$kumpulans->id}})" class="btn btn-danger btn-sm">Buang <i class="ni ni-basket"></i></button><br><br>
                                            </td>
                                        </tr>

                                        <script>
                                            function buang(id) {
                                                swal({
                                                    title: 'Makluman?',
                                                    text: "Buang Sebab Tidak Hadir?!",
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
                                                            url: "kumpulan/" + id,
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
@elseif(auth()->user()->role == 'naziran')
<div>
    <div class="container-fluid mt--6">
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header bg-default border-0">
                        <h3 class="text-white mb-0">Senarai Kumpulan</h3>
                    </div>
                        <div class="card-body px-0">
                            <!-- Light table -->
                            <div class="table-responsive py-4">
                                <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kumpulan</th>
                                            <th>Tindakan</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kumpulan as $kumpulans)
                                        <tr>
                                            <td>
                                                {{$loop->index+1}}
                                            </td>
                                            <td>
                                                {{$kumpulans->nama_kumpulan}}
                                            </td>
                                            <td>
                                                <a href="/kumpulan/{{$kumpulans->id}}/edit"
                                                    class="btn btn-primary btn-sm"> kemaskini <i
                                                        class="ni ni-single-copy-04"></i>
                                                </a>
                                                <br>
                                                <button onclick="buang({{$kumpulans->id}})" class="btn btn-danger btn-sm">Buang <i class="ni ni-basket"></i></button><br><br>
                                            </td>
                                        </tr>

                                        <script>
                                            function buang(id) {
                                                swal({
                                                    title: 'Makluman?',
                                                    text: "Buang kumpulan ?!",
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
                                                            url: "kumpulan/" + id,
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
    <div class="container-fluid">
        <div >
            @if(auth()->user()->role == 'naziran')
            <div class="col-lg-12 col text-right">
                <a href="/userkumpulan/create" class="btn btn-sm btn-neutral">+ Pengguna Kumpulan</a>
            </div>
            @elseif(auth()->user()->role == 'pentadbir_sistem')
            <div class="col-lg-12 col text-right">
                <a href="/userkumpulan/create" class="btn btn-sm btn-neutral">+ Pengguna Kumpulan</a>
            </div>
            @else
            --
            @endif
            <br>
        </div>
    </div>
<div>
    <div class="container-fluid mt--12">
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header bg-default border-0">
                        <h3 class="text-white mb-0">Senarai Pengguna Kumpulan</h3>
                    </div>
                        <div class="card-body px-0">
                            <!-- Light table -->
                            <div class="table-responsive py-4">
                                <table id="example" class="display table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kumpulan</th>
                                            <th>Senarai Penguatkuasa</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kumpulan as $kump)
                                        <tr>
                                            <td>
                                                {{$loop->index+1}}
                                            </td>
                                            <td>
                                                {{$kump->nama_kumpulan}}
                                            </td>
                                            <td>  
                                             @if (count($kump->user_kumpulan) > 0)

                                                @foreach ($kump->user_kumpulan as $user)
                                                <li>

                                                 <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapus{{$user->user_info->id}}">
                                                    Tekan Untuk Hapus
                                                </button>
                                                
                                                <!-- Modal -->
                                                <div class="modal fade" id="hapus{{$user->user_info->id}}" tabindex="-1" role="dialog" aria-labelledby="hapusLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-default">
                                                        <h5 class="text-white modal-title" id="hapusLabel">Makluman</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <h4>Anda Pasti Untuk Buang ? : </h4><br>
                                                        <h4 class="text-red text-center">{{$user->user_info->name}}</h4>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                                                        <a href="/delete_pengguna_kumpulan/{{$user->user_info->id}}/{{$kump->id}}" class="btn btn-danger btn-sm">Tekan Untuk Hapus</a>

                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>

                                                {{$user->user_info->name}}
                                                
                                                </li>

                                                @endforeach
                                            @else
                                            <a  href="/userkumpulan/create" class="badge badge-pill badge-primary">Sila Tambah Penguatkuasa</a>

                                            @endif
                                            </td>
                                                {{-- @if (count($kump->user_kumpulan) > 0) --}}
                                                {{-- <a href="/userkumpulan/{{$kump->user_kumpulan[0]->id}}/edit"
                                                    class="btn btn-primary btn-sm"> kemaskini <i
                                                        class="ni ni-single-copy-04"></i>
                                                </a> --}}

                                                {{-- @else
                                                <span class="badge badge-pill badge-danger">Sila Tambah Penguatkuasa</span>

                                                @endif --}}
                                              
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
</script>

@endsection
