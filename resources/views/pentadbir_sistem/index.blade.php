@extends('base')

@section('content')
{{-- css --}}
<link rel="stylesheet" href="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">

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
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Pengurusan Penguna</h3>   
                <div class="card-body px-0">
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-basic">
                            <thead class="thead-light">
                        
                                <tr>
                                    <th>No. </th>
                                    <th>No. Pekerja</th>
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
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">
                                                        <a>{{$user->id}}</a>
                                                    </span>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="No. Pekerja">
                                            {{$user->user_code}}
                                        </td>     
                                        <td class="Name">
                                            {{$user->name}}
                                        </td>   
                                        <td class="Email">
                                            {{$user->email}}
                                        </td>   
                                        <td class="Peranan">
                                            <div class="form-group">
                                                <select class="form-select form-select-sm col-8" name="pengurusan" aria-label=".form-select-sm example">
                                                <option value="individu">{{$user->role}}</option>
                                              </div> 
                                            {{-- {{$user->role}} --}}
                                        </td>    
                                        <td class="Status">
                                            <div class="form-group">
                                                <select class="form-select form-select-sm col-8" name="pengurusan" aria-label=".form-select-sm example">
                                                <option value="individu">Aktif</option>
                                                <option value="berkumpulan">Nyahaktif</option></select>
                                              </div>  
                                        </td>          
                                        <td class="Tindakan">
                                            <a href="#"class="btn btn-success">Kemaskini</a>
                                        </td>
                                        
                                    </tr>
                                    @empty
                                    Tiada Rekod
                                    @endforelse

                                    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- datatables --}}
<script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>
@endsection
