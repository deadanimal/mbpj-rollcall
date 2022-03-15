

@elseif(auth()->user()->role == 'penyelia' )
<div class="card-body">
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel"
            aria-labelledby="tabs-icons-text-1-tab">
            <div>
                <div class="container-fluid mt--6">
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="card">
                                <!-- Card header -->
                                <div class="card-header border-0">
                                    <h3 class="mb-0">Senarai Kehadiran Roll Call</h3>
                                </div>
                                <!-- Light table -->
                                <div class="table-responsive">
                                    <table id="example"
                                        class="display table table-striped table-bordered dt-responsive nowrap"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tajuk Roll Call</th>
                                                <th>Waktu rollcall</th>
                                                <th>Waktu rollcall</th>
                                                <th>Waktu masuk</th>
                                                <th>Waktu keluar</th>
                                                <th>lokasi</th>
                                                <th>Catatan</th>
                                                <th>Pegawai Sokong</th>
                                                <th>Pegawai Lulus</th>
                                                <th>Status</th>
                                                <th>Tindakan</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($rollcalls as $rollcall)
                                            <tr>
                                                <td>{{$rollcall->id}}</td>
                                                <td>{{$rollcall->tajuk_rollcall}}</td>
                                                <td>{{$rollcall->mula_rollcall}}</td>
                                                <td>{{$rollcall->akhir_rollcall}}</td>
                                                <td>{{$rollcall->waktu_masuk}}</td>
                                                <td>{{$rollcall->waktu_keluar}}</td>
                                                <td>{{$rollcall->lokasi}}</td>
                                                <td>{{$rollcall->catatan}}</td>
                                                <td>{{$rollcall->pegawai_sokong_id}}</td>
                                                <td>{{$rollcall->pegawai_lulus_id}}</td>
                                                <td>{{$rollcall->status}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#sokong">
                                                        Sokong
                                                    </button>
                                                    {{-- <a href="" class="btn btn-primary">Sokong</a> --}}
                                                    {{-- <a href="" class="btn btn-danger">Tolak</a> --}}
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#tolak">
                                                        Tolak
                                                    </button>

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
        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
            <div>
                <div class="container-fluid mt--6">
                    {{-- <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0">Filters</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <form>
                                    <div class="row">
                                        <div class="col mb-4">
                                            <h4>Tajuk Roll Call</h4>
                                            <input type="text" class="form-control" placeholder="Tajuk Roll Call">
                                        </div>
                                        <div class="col">
                                            <h4>Lokasi Roll Call</h4>
                                            <input type="text" class="form-control" placeholder="Lokasi">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <h4>Tarikh Mula</h4>
                                            <input id="start" type="date" /><br />
                                        </div>
                                        <div class="col-sm">
                                            <h4>Tarikh Akhir</h4>
                                            <input id="start" type="date" /><br />
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row float-right">
                                <div class="col-sm ">
                                    <button id="clearFilter" class="btn btn-sm btn-danger">Clear Filter</button>
                                    <button class="btn btn-sm btn-primary " id="filter">Filter</button>
                                </div>
                            </div>
                        </div>
                    </div>               --}}
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="card">
                                <!-- Card header -->
                                <div class="card-header border-0">
                                    <h3 class="mb-0">Senarai Sokong Roll Call</h3>
                                </div>
                                <!-- Light table -->
                                <div class="table-responsive">
                                    <table id="example"
                                        class="display table table-striped table-bordered dt-responsive nowrap"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tajuk Roll Call</th>
                                                <th>Waktu rollcall</th>
                                                <th>Waktu rollcall</th>
                                                <th>Waktu masuk</th>
                                                <th>Waktu keluar</th>
                                                <th>lokasi</th>
                                                <th>Catatan</th>
                                                <th>Pegawai Sokong</th>
                                                <th>Pegawai Lulus</th>
                                                <th>Status</th>
                                                <th>Tindakan</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @forelse($rollcalls as $rollcall) --}}
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>


                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal">
                                                        Lihat
                                                    </button>
                                                </td>
                                            </tr>
                                            {{-- @empty
                                                <div style="text-align:center;">
                                                    <td>
                                                        <h5> Tiada rekod </h5>
                                                    </td>
                                                </div>
                                                @endforelse --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
            <div>
                <div class="container-fluid mt--6">
                    {{-- <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0">Filters</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <form>
                                    <div class="row">
                                        <div class="col mb-4">
                                            <h4>Tajuk Roll Call</h4>
                                            <input type="text" class="form-control" placeholder="Tajuk Roll Call">
                                        </div>
                                        <div class="col">
                                            <h4>Lokasi Roll Call</h4>
                                            <input type="text" class="form-control" placeholder="Lokasi">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <h4>Tarikh Mula</h4>
                                            <input id="start" type="date" /><br />
                                        </div>
                                        <div class="col-sm">
                                            <h4>Tarikh Akhir</h4>
                                            <input id="start" type="date" /><br />
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row float-right">
                                <div class="col-sm ">
                                    <button id="clearFilter" class="btn btn-sm btn-danger">Clear Filter</button>
                                    <button class="btn btn-sm btn-primary " id="filter">Filter</button>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="card">
                                <!-- Card header -->
                                <div class="card-header border-0">
                                    <h3 class="mb-0">Senarai Sokong Roll Call</h3>
                                </div>
                                <!-- Light table -->
                                <div class="table-responsive">
                                    <table id="example"
                                        class="display table table-striped table-bordered dt-responsive nowrap"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tajuk Roll Call</th>
                                                <th>Waktu rollcall</th>
                                                <th>Waktu rollcall</th>
                                                <th>Waktu masuk</th>
                                                <th>Waktu keluar</th>
                                                <th>lokasi</th>
                                                <th>Catatan</th>
                                                <th>Pegawai Sokong</th>
                                                <th>Pegawai Lulus</th>
                                                <th>Status</th>
                                                <th>Tindakan</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @forelse($rollcalls as $rollcall) --}}
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>


                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal">
                                                        Lihat
                                                    </button>
                                                </td>
                                            </tr>
                                            {{-- @empty
                                                <div style="text-align:center;">
                                                    <td>
                                                        <h5> Tiada rekod </h5>
                                                    </td>
                                                </div>
                                                @endforelse --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Sokong -->
<div class="modal fade" id="sokong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Makluman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Sokong kehadiran roll call penguatkuasa
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tolak-->
<div class="modal fade" id="tolak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Tolak kehadiran roll call penguatkuasa ?
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Catatan</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

