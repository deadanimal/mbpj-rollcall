<div>
    <div style="width: 100%" style="">
        <img src="C:\laragon\www\rollcall\public\argon\img\mbpj.png" width="100" height="100" style="margin-left: 40%;">
    </div>
    <div>
        <h2 class="h2 text-white d-inline-block mb-0" style="margin-left: 25%;">Sistem Pengurusan Roll Call</h2>
        <h3 class="h2 text-white d-inline-block mb-0" style="margin-left: 35%;">Laporan Kehadiran</h3>

    </div>
    <div style="clear:both;">
        <p style="margin-top: 0pt; margin-bottom: 0pt; text-align: left;">&nbsp;</p>
    </div>
    <p style="margin-top: 0pt; margin-bottom: 9pt; line-height: 110%; font-size: 11pt; text-align: left;"><span style="font-family:'Avenir Next Regular';">&nbsp;Nama Penguatkuasa : {{$kakitangan->name}}</span></p>
    <p style="margin-top: 0pt; margin-bottom: 9pt; line-height: 110%; font-size: 11pt; text-align: left;"><span style="font-family:'Avenir Next Regular';">&nbsp;NRIC : {{$kakitangan->nric}}</span></p>
    
    <p style="margin-top: 0pt; margin-bottom: 9pt; line-height: 110%; font-size: 11pt; text-align: left;"><span style="font-family:'Avenir Next Regular';">&nbsp;</span><span style="font-family:'Avenir Next Regular';">Hadir : {{$hadir}}&nbsp;</span></p>
    <p style="margin-top: 0pt; margin-bottom: 9pt; line-height: 110%; font-size: 11pt; text-align: left;"><span style="font-family:'Avenir Next Regular';">&nbsp;</span><span style="font-family:'Avenir Next Regular';">Tidak Hadir : {{$tidak_hadir}}&nbsp;</span></p>
    <p style="margin-top: 0pt; margin-bottom: 9pt; line-height: 110%; font-size: 11pt; text-align: left;"><span style="font-family:'Avenir Next Regular';">&nbsp;</span><span style="font-family:'Avenir Next Regular';">Belum Hadir : {{$belum_hadir}}&nbsp;</span></p><br>



    <table cellpadding="0" cellspacing="0" style="width:100%; margin-left:5.4pt; border-collapse:collapse;">
        <thead>
            <tr style="height:12pt;">
                <td colspan="4" style="width: 371.25pt; border-bottom: 1pt solid rgb(181, 209, 152); padding: 4pt 4pt 3.5pt; vertical-align: top; background-color: rgb(44, 58, 189); text-align: center;">
                    <p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 12pt; text-align: center;"><strong><span style="font-family:'Superclarendon Regular'; color:#fefffe;"> Senarai Roll Call Penguatkuasa</span></strong></p>
                </td>
             
            </tr>
        </thead><br><br>
        <tr style="height:14.65pt;">
            <td style="width:100%; border-top:1pt solid #b5d198; padding:3.5pt 4pt 4pt; vertical-align:top; background-color: rgb(116, 127, 226); text-align: center;">
                <p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 12pt; text-align: center;">&nbsp; Tajuk Roll Call</p>
            </td>
            <td style="width:100%; border-top:1pt solid #b5d198; padding:3.5pt 4pt 4pt; vertical-align:top; background-color: rgb(116, 127, 226); text-align: center;">
                <p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 12pt; text-align: center;">&nbsp;Status </p>
            </td>
            <td style="width:100%; border-top:1pt solid #b5d198; padding:3.5pt 4pt 4pt; vertical-align:top; background-color: rgb(116, 127, 226); text-align: center;">
                <p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 12pt; text-align: center;">&nbsp; Mula Roll Call</p>
            </td>
            <td style="width:100%; border-top:1pt solid #b5d198; padding:3.5pt 4pt 4pt; vertical-align:top; background-color: rgb(116, 127, 226); text-align: center;">
                <p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 12pt; text-align: center;">&nbsp; Akhir Roll Call</p>
            </td>
        </tr>
        <tbody>
            @foreach($report_ind as $report_inds)
            <tr style="height:14.65pt;">
                <td style="width:100%; border-top:1pt solid #b5d198; padding:3.5pt 4pt 4pt; vertical-align:top;">
                    {{-- {{isset($lapor_hadirs->nama_rollcall->tajuk_rollcall)? $lapor_hadirs->nama_rollcall->tajuk_rollcall : "" }} --}}

                    <p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 12pt; text-align: center;">&nbsp; {{isset($report_inds->nama_rollcall->tajuk_rollcall)?$report_inds->nama_rollcall->tajuk_rollcall :""}}</p>
                </td>
                <td style="width:100%; border-top:1pt solid #b5d198; padding:3.5pt 4pt 4pt; vertical-align:top; text-align: center;">
                    
                    @if ($report_inds->lulus===1)
                    <span class="badge badge-pill badge-primary">Hadir</span>
                    @elseif ($report_inds->lulus===0)
                    <span class="badge badge-pill badge-primary">Tidak Hadir</span>
                    @elseif ($report_inds->lulus===null)
                    <span class="badge badge-pill badge-primary">Belum Hadir</span>

                    @endif
                </td>
                <td style="width:100%; border-top:1pt solid #b5d198; padding:3.5pt 4pt 4pt; vertical-align:top;">
                    <p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 12pt; text-align: center;">&nbsp; {{isset($report_inds->nama_rollcall->mula_rollcall)?$report_inds->nama_rollcall->mula_rollcall :""}}</p>
                </td>
                <td style="width:100%; border-top:1pt solid #b5d198; padding:3.5pt 4pt 4pt; vertical-align:top;">
                    <p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 12pt; text-align: center;">&nbsp; {{isset($report_inds->nama_rollcall->akhir_rollcall)?$report_inds->nama_rollcall->akhir_rollcall :""}}</p>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p style="margin-top: 0pt; margin-bottom: 9pt; line-height: 110%; font-size: 11pt; text-align: left;"><br></p>
    <p style="margin-top: 0pt; margin-bottom: 9pt; line-height: 110%; font-size: 11pt; text-align: left;"><span style="font-family:'Avenir Next Regular';">&nbsp;</span></p>
    <p style="margin-top: 0pt; margin-bottom: 9pt; line-height: 110%; font-size: 11pt; text-align: left;"><span style="font-family:'Avenir Next Regular';">&nbsp;</span><span style="font-family:'Avenir Next Regular';">&nbsp;</span></p>
    <p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; line-height: 120%; font-size: 10pt;"><span style="font-family:'Superclarendon Light'; color:#191919;"><div class="copyright text-center  text-lg-left  text-muted">
        &copy; 2021 <a href="" class="font-weight-bold ml-1" target="">Sistem Pengurusan Roll Call </a>
    </div></span></p><br>
    <p style="margin-top: 0pt; margin-bottom: 0pt; text-align: center; line-height: 120%; font-size: 10pt;"><span style="font-family:'Superclarendon Light'; color:#191919;"><div class="copyright text-center  text-lg-left  text-muted">
       <a  class="font-weight-bold ml-1" target="">Tarikh Laporan Dijana - {{$currentdate}}
        </a>
    </div></span></p>
    <div style="clear: both; text-align: center;">
        <p style="margin-top: 0pt; margin-bottom: 0pt; text-align: left;">&nbsp;</p>
    </div>
</div>
