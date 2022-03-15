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
                                <li class="breadcrumb-item"><a href="/kumpulan/create">kumpulan</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Rollcall</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (auth()->user()->role == 'naziran' or auth()->user()->role == 'pentadbir_sistem')

        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header bg-default">
                            <h5 class="text-white h3 mb-3">Kemaskini kumpulan Roll Call</h5>
                        </div>
                        <div class="card-body " >
                            <form method="POST" action="/userkumpulan">
                                @csrf
                                <!-- Input groups with icon -->

                                <div class="row" >
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="kumpulan">Pilih Kumpulan</label>

                                            <select name="id_kumpulan" class="form-control custom-select" required>
                                                <option value="" >Pilih Kumpulan</option>
                                                @foreach ($kumpulan as $kumpulans)
                                                    <option value="{{ $kumpulans->id }}">{{ $kumpulans->nama_kumpulan }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="col-md-12">
                                        <div class="form-group " >
                                            <label for="id_user">Pilih Penguatkuasa:                                               
                                                  
                                            </label>
                                            <h4 class="text-red">Tekan kekunci Ctrl (windows) atau Command (Mac) semasa memilih nama penguatkuasa untuk pilihan secara pukal.
                                            </h4>
                                            <select class="form-control mb-3 col-xl"  style="height:50vh" name="id_user[]" id="id_user"
                                                multiple required>

                                                @foreach ($user as $users)
                                                    <option value="{{ $users->id }}">{{ $users->nric }} - {{ $users->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>          
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm float-right">Tambah</button>
                            </form>
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

@endsection
