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
                                <li class="breadcrumb-item"><a href="/rollcalls"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="">Pengurusan</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Roll Call</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-12 col text-right">
                        <a type="button" class="btn btn-neutral" data-toggle="modal" data-target="#tambahkakitangan"> +
                            Tambah Kakitangan Roll Call</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@if(auth()->user()->role == 'naziran')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-wrapper">
                    <!-- Input groups -->
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <h3 class="mb-0">Kemaskini Jadual Roll Call</h3>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <form method="POST" action="/rollcalls/{{$rollcall->id}}">
                                @csrf
                                @method('PUT')
                                <!-- Input groups with icon -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Waktu Mula Semasa</label>
                                            <div class="input-group input-group-merge">
                                                <input class="form-control " value="{{$rollcall->mula_rollcall}}"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Waktu akhir Semasa</label>
                                            <div class="input-group input-group-merge">
                                                <input class="form-control" value="{{$rollcall->akhir_rollcall}}"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mula_rollcall">Kemaskini waktu mula</label>
                                            <div class="form-group">
                                                <div class="input-group date" id="datetimepicker1">
                                                    <input type="text" class="form-control" name="mula_rollcall">
                                                    <span class="input-group-addon input-group-append">
                                                        <button class="btn btn-outline-primary" type="button"
                                                            id="button-addon2"> <span
                                                                class="fa fa-calendar"></span></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="akhir_rollcall">Kemaskini waktu akhir</label>
                                            <div class="form-group">
                                                <div class="input-group date" id="datetimepicker2">
                                                    <input type="text" class="form-control" name="akhir_rollcall">
                                                    <span class="input-group-addon input-group-append">
                                                        <button class="btn btn-outline-primary" type="button"
                                                            id="button-addon2"> <span
                                                                class="fa fa-calendar"></span></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lokasi">Lokasi </label>
                                            <div class="input-group input-group-merge">
                                                <input class="form-control" name="lokasi" value="{{$rollcall->lokasi}}"
                                                    type="text">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-map-marker"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Perkara">Catatan</label>
                                            <div class="input-group input-group-merge">
                                                <input class="form-control" name="catatan"
                                                    value="{{$rollcall->catatan}}" type="text">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tajuk_rollcall">Tajuk</label>
                                            <div class="input-group input-group-merge">
                                                <input class="form-control" name="tajuk_rollcall"
                                                    value="{{$rollcall->tajuk_rollcall}}" type="text">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-map-marker"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>             
                                    <div class="col-md-6 ">
                                        <div class="form-group ">
                                            <label for="status">Status</label>
                                            <div class="input-group input-group-merge">
                                                <select class="form-select form-select-sm col-12" name="status" require>
                                                @foreach ($status as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pegawai_sokong_id">Pilih pegawai sokong</label>
                                            <div class="input-group input-group-merge">
                                                <input class="form-control" name="pegawai_sokong_id"
                                                    value="{{$rollcall->pegawai_sokong_id}}" type="number">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fa fa-address-book"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pegawai_lulus_id">Pilih pegawai lulus</label>
                                            <div class="input-group input-group-merge">
                                                <input class="form-control" name="pegawai_lulus_id"
                                                    value="{{$rollcall->pegawai_lulus_id}}" type="number">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fa fa-address-book"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- Button trigger modal -->   
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="Perkara">Kemaskini Makluman Roll Call</label>
                                                    <div class="form-group">
                                                        <textarea class="form-control"
                                                        id="maklumat" name="maklumat" value="{{$rollcall->maklumat}}"></textarea>
                                                    </div>  
                                        </div>
                                        <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                        data-target="#exampleModal">
                                        Kemaskini
                                    </button>                        
                                </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Makluman</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Kemaskini
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary float-right">Kemaskini</button>
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
    <div class="container-fluid mt--10">
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Senarai Kakitangan </h3>
                        <div class="col-md-6 header float-right mb--12">                 
                        </div>
                        <div class="card-body px-0">
                            <!-- Light table -->
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kakitangan</th>
                                            <th>No Pekerja</th>
                                            <th>NRIC </th>
                                            <th>Email</th>
                                            <th>Tindakan</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- {{$userrollcalls}} --}}
                                        @foreach($userrollcalls as $userrollcall)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$userrollcall->penguatkuasa['name']}}</td>
                                            <td>{{$userrollcall->penguatkuasa['user_code']}}</td>
                                            <td>{{$userrollcall->penguatkuasa['nric']}}</td>
                                            <td>{{$userrollcall->penguatkuasa['email']}}</td>
                                            <td> <button onclick="buang({{ $userrollcall->id }})"class="btn btn-danger btn-sm">Buang<i class="ni ni-basket"></i></button> </td>
                                         
                                        </tr>

                                        <script>
                                            function buang(id) {
                                                swal({
                                                    title: 'Makluman?',
                                                    text: "Buang Kakitangan !",
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
                                                            url: "/userrollcalls/"+id,
                                                            type: "POST",
                                                            data: {
                                                                "id": id,
                                                                "_token": "{{ csrf_token() }}",
                                                                "_method": 'delete'
                                                            },
                                                            success: function(data) {
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
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Kemaskini Sebab Tidak Hadir</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="/rollcalls/kemaskini/kehadiran">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Sebab tak hadir</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                <form>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFileLang" lang="en">
                                        <label class="custom-file-label" for="customFileLang">Select file</label>
                                    </div>
                                </form>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-primary">Kemaskini</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div  class="modal fade" id="tambahkakitangan" tabindex="-1" role="dialog" 
    {{-- <div class="modal fade" id="tambahkakitangan" tabindex="-1" role="dialog" aria-labelledby="tambahkakitanganLabel" --}}
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahkakitanganLabel"> Tambah Kakitangan Roll Call</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-wrapper">

                                <form method="POST" action="/userrollcalls">


                                    @csrf
                                    @if ($errors->any())
                                    <div class="alert alert-danger" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    @if (Session::has('success'))
                                    <div class="alert alert-success text-center">
                                        <p>{{ Session::get('success') }}</p>
                                    </div>
                                    @endif
                                    
                                    <table class="table table-bordered" id="dynamicAddRemove">

                                        <tr>

                                            <th>No Kakitangan</th>
                                            <th>Nama</th>
                                            <th>Tindakan</th>
                                        </tr>
                                        <tr>             
                                            <td><input type="text" name="penguatkuasa_id" required placeholder="Enter penguatkuasa_id" class="form-control"  /></td> 
                                            <td><select id="livesearch" class="livesearch form-control" name="livesearch"></select></td>                              
                                            <td><input type="hidden" name="roll_id" class="form-control" value="{{$rollcall->id}}"/>
                                            <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary float-right">Tambah Kakitangan</button></td>

                                           
                                        </tr>
                                        <script type="text/javascript">

                                            $("#livesearch").select2({
                                                placeholder: ' Kakitangan',
                                                // source: NameArray,
                                                dropdownParent: $("#tambahkakitangan"),
                                                ajax: {
                                                    url: '/ajax-autocomplete-search',
                                                    dataType: 'json',
                                                    delay: 250,
                                                    processResults: function (data) {
                                                        return {
                                                            results: $.map(data, function (item) {
                                                                return {
                                                                    text: item.name,
                                                                    id: item.id
                                                                }
                                                            })
                                                        };
                                                    },
                                                    cache: true
                                                }
                                            });
                                        </script>

        
                                    </table>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                        <button type="submit" class="btn btn-primary">Simpan</button>

                                    </div>   

                                
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
@elseif(auth()->user()->role == 'penguatkuasa')
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
{{-- Script --}}
@section('script')
<script
    src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
</script>
<script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/select2/dist/js/select2.min.js">
</script>
<script
    src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
</script>
<script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/moment.min.js">
</script>
<script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/bootstrap-datetimepicker.js">
</script>
<script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/nouislider/distribute/nouislider.min.js">
</script>
<script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/quill/dist/quill.min.js">
</script>
<script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/dropzone/dist/min/dropzone.min.js">
</script>
<script
    src="https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js">
</script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({
            icons: {
                time: "fa fa-clock",
                date: "fa fa-calendar-day",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
        });
        $('#datetimepicker2').datetimepicker({
            icons: {
                time: "fa fa-clock",
                date: "fa fa-calendar-day",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
        });
    });

</script>
<script src="https://demos.creative-tim.com/argon-dashboard-pro/assets/js/demo.min.js">
</script>



<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">

$(window).on('load', function(){
    // $('ckeditor').ckeditor();
    var lol = CKEDITOR.replace('maklumat');
    lol.setData({!! json_encode($rollcall->maklumat) !!});
})

</script>
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFields[' + i +
            '][penguatkuasa_id]" placeholder="Enter penguatkuasa_id" class="form-control" /></td><td><button type="button" class="btn btn-danger float-right remove-input-field">Tolak Kakitangan</button></td></tr>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>

@endsection

