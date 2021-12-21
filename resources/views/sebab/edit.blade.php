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
                            <li class="breadcrumb-item"><a href="/sebab">Sebab</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Rollcall</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@if(auth()->user()->role == 'naziran' or auth()->user()->role == 'pentadbir_sistem')
<div>
    <div class="container-fluid mt--6">
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                      <!-- Card header -->
                      <div class="card-header bg-default">
                        <h3 class="text-white mb-0">Kemaskini Jadual Roll Call</h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <form method="POST" action="/sebab/{{$sebab->id}}">
                            @csrf
                            @method('PUT')
                            <!-- Input groups with icon -->
                        
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sebab">Sebab </label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control" name="sebab" value="{{$sebab->sebab}}"
                                                type="text">
                                          
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        
                            <div class="row">
                                <div class="col-md-12"> 
                                    <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                                    data-target="#exampleModal">
                                    Kemaskini
                                </button>                        
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-default">
                                            <h5 class="text-white modal-title" id="exampleModalLabel">Makluman</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Kemaskini
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm"
                                                data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary btn-sm float-right">Kemaskini</button>
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
