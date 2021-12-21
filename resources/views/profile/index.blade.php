@extends('base')

@section('content')
<div>
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Profil</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Makluman</a></li>
                                <li class="breadcrumb-item active" aria-current="page">kakitangan</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-4 order-xl-2">
            <div class="card-header bg-default">
            </div>
            <div class="card card-profile">
                <img src="{{ asset('argon') }}/img/mbpjcenter.jpg" alt="Image placeholder" class="card-img-top">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <a href="#">
                                <img src="{{ asset('argon') }}/img/person.png" class="rounded-circle">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                    <div class="d-flex justify-content-between">

                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col">
                            <div class="card-profile-stats d-flex justify-content-center">

                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h5 class="h3">
                            {{Auth()->user()->name}}<span class="font-weight-light"></span>
                        </h5>
                        <div class="h5 font-weight-300">
                        </div>
                        <div class="h5 mt-4">
                            <i class="ni business_briefcase-24 mr-2"></i>{{Auth()->user()->department_code}}
                        </div>
                        <div>
                            <i class="ni education_hat mr-2"></i>{{Auth()->user()->user_code}}
                        </div>
                    </div>
        
            </div>
            </div>
            <!-- Progress track -->

        </div>
        <div class="col-xl-8 order-xl-1">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card bg-gradient-info border-0">
                        <!-- Card body -->

                    </div>
                </div>

            </div>
            <div class="card">
                <div class="card-header bg-default">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="text-white mb-0">Makluman Kakitangan</h3>
                        </div>
                      
                    </div>
                </div>
                <div class="card-body">
                        {{-- <h6 class="heading-small text-muted mb-4">User information</h6> --}}
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">No. K/P Baru</label>
                                        <input type="text" id="input-username" class="form-control"
                                            placeholder="{{Auth()->user()->nric}}" value="" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Alamat Email </label>
                                        <input type="email" id="input-email" class="form-control"
                                            placeholder="{{Auth()->user()->email}}" value="" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">No Pekerja</label>
                                        <input type="text" id="input-first-name" class="form-control"
                                            placeholder="{{Auth()->user()->user_code}}" value="" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-last-name">No. Tel. Bimbit</label>
                                        <input type="text" id="input-last-name" class="form-control"
                                            placeholder="{{Auth()->user()->phone}}" value="" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Role</label>
                                        <input type="text" id="input-first-name" class="form-control"
                                            placeholder="{{Auth()->user()->role}}" value="" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-last-name">bahagian</label>
                                        <input type="text" id="input-last-name" class="form-control"
                                            placeholder="{{Auth()->user()->department_code}}" value="" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('change.password') }}">
                                                @csrf 
                        
                                                @foreach ($errors->all() as $error)
                                                    <p class="text-danger">{{ $error }}</p>
                                                @endforeach 
                                                @if (\Session::has('success'))
                                                <div class="alert alert-success">
                                                    <ul>
                                                        <li>{!! \Session::get('success') !!}</li>
                                                    </ul>
                                                </div>
                                                @endif
                        
                                                <div class="form-group row">
                                                    <label for="password" class="col-md-4 col-form-label text-md-right">Kata Laluan Semasa</label>
                        
                                                    <div class="col-md-6">
                                                        <input id="myInput" type="password" class="form-control" value="{{Auth()->user()->password}}"><br>
                                                        <input type="checkbox" onclick="myFunction()">  Lihat Kata Laluan

                                                        <script>
                                                            function myFunction() {
                                                              var x = document.getElementById("myInput");
                                                              if (x.type === "password") {
                                                                x.type = "text";
                                                              } else {
                                                                x.type = "password";
                                                              }
                                                            }
                                                        </script>
                                                    </div>
                                                </div>
                        
                                                <div class="form-group row">
                                                    <label for="password" class="col-md-4 col-form-label text-md-right">Kata laluan Baru</label>
                        
                                                    <div class="col-md-6">
                                                        <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                                                    </div>
                                                </div>
                        
                                                <div class="form-group row">
                                                    <label for="password" class="col-md-4 col-form-label text-md-right">Sah Kata Laluan</label>
                            
                                                    <div class="col-md-6">
                                                        <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                                                    </div>
                                                </div>
                        
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-8 offset-md-4">
                                                        <button type="submit" class="btn btn-primary btn-sm float-right">
                                                            Kemaskini
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6">
                <div class="copyright text-center  text-lg-left  text-muted">
                    &copy; 2021 <a href="" class="font-weight-bold ml-1" target="">Sistem Pengurusan Roll Call
                    </a>
                </div>
            </div>

        </div>
    </footer>
</div>
{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
    {{-- @include('sweet::alert') --}}
@endsection
