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
                            <li class="breadcrumb-item"><a href="/rollcalls/create">Sebab</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Rollcall</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@if(auth()->user()->role == 'naziran' or auth()->user()->role == 'pentadbir_sistem')

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header bg-default">
                    <h5 class="text-white h3 mb-3">Kemaskini Sebab Roll Call</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="/sebab">
                        @csrf
                        <!-- Input groups with icon -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="sebab">Kemaskini</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" name="sebab" required
                                            placeholder="sebab" type="text">
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button  class="btn btn-primary btn-sm float-right">Tambah</button>

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
