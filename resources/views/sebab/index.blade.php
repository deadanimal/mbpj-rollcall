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
                            <li class="breadcrumb-item"><a href="/sebab"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="/sebab">Rollcall</a></li>
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
                    <a href="/sebab/create" class="btn btn-sm btn-neutral">+ Tambah Sebab</a>
                </div>
                @elseif(auth()->user()->role == 'pentadbir_sistem')
                <div class="col-lg-12 col text-right">
                    <a href="/sebab/create" class="btn btn-sm btn-neutral">+ Tambah Sebab</a>
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
                    <div class="card-header border-0">
                        <h3 class="mb-0">Senarai Sebab Tidak Hadir</h3>
                        <div class="card-body px-0">
                            <!-- Light table -->
                            <div class="table-responsive py-4">
                                <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Sebab Roll Call</th>
                                            <th>Tindakan</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sebab as $sebabs)
                                        <tr>
                                            <td>
                                                {{$loop->index+1}}
                                            </td>
                                            <td>
                                                {{$sebabs->sebab}}
                                            </td>
                                            <td>
                                                <a href="/sebab/{{$sebabs->id}}/edit"
                                                    class="btn btn-primary btn-sm"> kemaskini <i
                                                        class="ni ni-single-copy-04"></i>
                                                </a>
                                                <br>
                                                <button onclick="buang({{$sebabs->id}})" class="btn btn-danger btn-sm">Buang <i class="ni ni-basket"></i></button><br><br>
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
                                                            url: "sebab/" + id,
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
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Senarai Sebab Tidak Hadir</h3>
                        <div class="card-body px-0">
                            <!-- Light table -->
                            <div class="table-responsive py-4">
                                <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Sebab Roll Call</th>
                                            <th>Tindakan</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sebab as $sebabs)
                                        <tr>
                                            <td>
                                                {{$loop->index+1}}
                                            </td>
                                            <td>
                                                {{$sebabs->sebab}}
                                            </td>
                                            <td>
                                                <a href="/sebab/{{$sebabs->id}}/edit"
                                                    class="btn btn-primary btn-sm"> kemaskini <i
                                                        class="ni ni-single-copy-04"></i>
                                                </a>
                                                <br>
                                                <button onclick="buang({{$sebabs->id}})" class="btn btn-danger btn-sm">Buang <i class="ni ni-basket"></i></button><br><br>
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
                                                            url: "sebab/" + id,
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
