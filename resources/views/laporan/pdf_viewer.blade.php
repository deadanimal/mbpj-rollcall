@extends('base')

@section('content')
<!-- Page content -->
<div class="header bg-primary pb-6">
    <div class="container-fluid ">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Laporan</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="/laporans"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="/laporans">Laporan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Laporan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="header bg-primary pb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-lg-12 col text-right">
                    <a href="/laporans" class="btn btn-info">Kembali</a>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="container-fluid mt--6">
    <div class="card">
        <div class="card-body">
            <iframe src="{{$url}}" style="width: 100%; height:800px;"></iframe>
        </div>
    </div>
</div>
@endsection
