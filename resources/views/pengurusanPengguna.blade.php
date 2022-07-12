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
                                <li class="breadcrumb-item"><a href="/pengurusan_pengguna"><i class="fas fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="/pengurusan_pengguna">Pengurusan Pengguna</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Utama</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="container-fluid mt--6">
            <div class="row ">
                <div class="col-md-12">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header bg-default border-0">
                            <h3 class="text-white mb-0">Senarai Pengguna</h3>
                        </div>
                        <div class="card-body px-0">
                            <!-- Light table -->
                            <div class="table-responsive py-4">
                                <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>NRIC</th>
                                            <th>QR</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    {{ $user->name }}
                                                </td>
                                                <td>
                                                    {{ $user->nric }}
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <button onclick="showQR({{ $user->nric }})" type="button"
                                                                class="btn btn-primary" data-toggle="modal"
                                                                data-target="#exampleModal">
                                                                QR Code
                                                            </button>
                                                        </div>
                                                        <div class="col-10">
                                                            @if ($user->role != 'pentadbir_sistem')
                                                                <select class="form-control d-inline"
                                                                    onchange="tukarRole({{ $user->id }}, this)">
                                                                    <option
                                                                        {{ $user->role == 'naziran' ? 'selected' : '' }}
                                                                        value="naziran">Naziran</option>
                                                                    <option
                                                                        {{ $user->role == 'penyelia' ? 'selected' : '' }}
                                                                        value="penyelia">Penyelia</option>
                                                                    <option
                                                                        {{ $user->role == 'penguatkuasa' ? 'selected' : '' }}
                                                                        value="penguatkuasa">Penguatkuasa</option>
                                                                    <option
                                                                        {{ $user->role == 'ketua_jabatan' ? 'selected' : '' }}
                                                                        value="ketua_jabatan">Ketua Jabatan</option>
                                                                    <option
                                                                        {{ $user->role == 'ketua_bahagian' ? 'selected' : '' }}
                                                                        value="ketua_bahagian">Ketua Bahagian</option>
                                                                </select>
                                                            @else
                                                                <input type="text" value="Pentadbir Sistem" readonly>
                                                            @endif

                                                        </div>
                                                    </div>

                                                    <!-- Modal -->
                                                    <div class="modal fade" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" id="exampleModal"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Modal
                                                                        title</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="text-center qrcode" id="qrcode"></div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <a id="modal_href" href="/printqr"
                                                                        class="btn btn-primary">Print</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


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
    <script>
        function showQR(nric) {
            $(".qrcode").html('');
            $("#modal_href").attr("href", '/printqr/' + nric);
            new QRCode(document.getElementById("qrcode"), "" + nric);
            $(".qrcode > img").css({
                "margin": "auto"
            });

        }

        function tukarRole(user_id, newRole) {
            $.ajax({
                method: "POST",
                url: "/update_role_in_naziran",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "user_id": user_id,
                    "newRole": newRole.value
                },
            }).done(function(response) {
                alert("Update Berjaya");
            });

        }
    </script>
@endsection
