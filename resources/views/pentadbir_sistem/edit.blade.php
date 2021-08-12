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
                                <li class="breadcrumb-item"><a href="/users"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="">Pengurusan</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pengguna</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(auth()->user()->role == 'pentadbir_sistem'or auth()->user()->role == 'naziran' )
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-wrapper">
                    <!-- Input groups -->
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <h3 class="mb-0">Kemaskini Pengurusan Pengguna</h3>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <form method="POST" action="/users/{{$user->id}}">
                                @csrf
                                @method('PUT')
                                <!-- Input groups with icon -->
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nama</label>
                                            <div class="input-group input-group-merge">
                                                <input class="form-control" value="{{$user->name}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">No Pengenalan</label>
                                            <div class="input-group input-group-merge">
                                                <input class="form-control" value="{{$user->nric}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">No Telefon</label>
                                            <div class="input-group input-group-merge">
                                                <input class="form-control" value="{{$user->phone}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <div class="input-group input-group-merge">
                                                <input class="form-control" value="{{$user->email}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">No Pekerja</label>
                                            <div class="input-group input-group-merge">
                                                <input class="form-control" value="{{$user->user_code}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Jabatan</label>
                                            <div class="input-group input-group-merge">
                                                <input class="form-control" value="{{$user->department_code}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status">
                                                @foreach ($status as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label for="role">Peranan</label>
                                            <select name="role" >
                                                @foreach ($roles as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="nav">

                                            <td><a href="/users/ " class="btn btn-success ">Kembali</a></td>
                                            <button type="button" class="btn btn-primary " data-toggle="modal"
                                                data-target="#exampleModalLong">
                                                    Kemaskini    
                                           </button>
                                        </div>
                                    </div>
                                    <!-- Button trigger modal -->
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Kemaskini Peranan
                                                        Pengguna</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Kemaskini Peranan Pengguna ??
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" class="btn btn-success">
                                                    <button type="button" class="btn btn-danger"data-dismiss="modal">Close</button>
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
    @elseif(auth()->user()->role == '')

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
