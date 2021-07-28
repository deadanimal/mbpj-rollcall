@extends('base')

@section('content')

<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Pengurusan Pengguna</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pengurusan Pengguna</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">BILANGAN STAF
                                    </h5>
                                    <span class="h2 font-weight-bold mb-0">350,897</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                        <i class="ni ni-active-40"></i>
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
                                    <h5 class="card-title text-uppercase text-muted mb-0"> BILANGAN STAF SEMENTARA
                                    </h5>
                                    <span class="h2 font-weight-bold mb-0">2,356</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                        <i class="ni ni-chart-pie-35"></i>
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
                                    <h5 class="card-title text-uppercase text-muted mb-0"> BILANGAN STAF TETAP
                                    </h5>
                                    <span class="h2 font-weight-bold mb-0">924</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                        <i class="ni ni-money-coins"></i>
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


{{--  --}}
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Pengurusan Penguna</h3>
                    <div class="card-body px-0">
                        <div class="table-responsive py-4">
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                                style="width:100%">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No.Pekerja</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Peranan</th>
                                    <th>Status</th>
                                    <th>Tindakan</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>    
                                        <td>{{$user->user_code}}</td>  
                                        <td>{{$user->name}}</td>  
                                        <td>{{$user->email}}</td>  
                                        <td>{{$user->role}}</td>   
                                        <td>{{$user->status}} </td>
                                        <td><a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal"
                                                    data-target="#modalLoginForm">Kemaskini</a>
                                            </div>
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
    {{-- Modal  --}}


    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Kemaskini Maklumat</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    {{-- form  --}}

                    <form method="POST" action="/users/kemaskini">
                        <div class="md-form mb-3">
                            <label data-error="wrong" data-success="right" for="defaultForm-email">No Pekerja</label>
                            <input name="user_code" id="defaultForm-email" class="form-control validate">
                        </div>
                        <div class="form-group">
                            <select class="form-select form-select-sm col-12" name="role"
                                aria-label=".form-select-sm example">
                                <option value="pentadbir_sistem">Pentadbir Sistem</option>
                                <option value="naziran">Naziran</option>
                                <option value="penyelia">Penyelia</option>
                                <option value="ketua_jabatan">Ketua Jabatan</option>
                                <option value="ketua_bahagian">Ketua Bahagian</option>
                                <option value="penguatkuasa">Penguatkuasa</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-select form-select-sm col-12" name="role"
                                aria-label=".form-select-sm example">
                                <option value="aktif">Aktif</option>
                                <option value="tidak_aktif">Nyahaktifkan</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-default">Kemaskini</button>
                </div>
            </div>
        </div>
    </div>
    @endsection
