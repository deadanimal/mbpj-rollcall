<div>
    <div style="width: 100%" style="">
        <img src="C:\laragon\www\rollcall\public\argon\img\mbpj.png" width="100" height="100" style="margin-left: 40%;">
    </div>
    <div>
        <h2 class="h2 text-white d-inline-block mb-0" style="margin-left: 25%;">Sistem Pengurusan Roll Call</h2>
        <h3 class="h2 text-white d-inline-block mb-0" style="margin-left: 30%;">Laporan Kehadiran Bahagian</h3>

    </div>
    <div style="clear:both;">
        <p style="margin-top: 0pt; margin-bottom: 0pt; text-align: left;">&nbsp;</p>
    </div>
    <p style="margin-top: 0pt; margin-bottom: 9pt; line-height: 110%; font-size: 11pt; text-align: left;"><span style="font-family:'Avenir Next Regular';">&nbsp;Nama Bahagian : {{$kumpulan->nama_kumpulan}} </span></p>
    
    <p style="margin-top: 0pt; margin-bottom: 9pt; line-height: 110%; font-size: 11pt; text-align: left;"><span style="font-family:'Avenir Next Regular';">&nbsp;</span><span style="font-family:'Avenir Next Regular';">Hadir : {{$hadir}}&nbsp;</span></p>
    <p style="margin-top: 0pt; margin-bottom: 9pt; line-height: 110%; font-size: 11pt; text-align: left;"><span style="font-family:'Avenir Next Regular';">&nbsp;</span><span style="font-family:'Avenir Next Regular';">Tidak Hadir : {{$tidak_hadir}}&nbsp;</span></p>
    <p style="margin-top: 0pt; margin-bottom: 9pt; line-height: 110%; font-size: 11pt; text-align: left;"><span style="font-family:'Avenir Next Regular';">&nbsp;</span><span style="font-family:'Avenir Next Regular';">Belum Hadir : {{$belum_hadir}}&nbsp;</span></p><br>



    <table cellpadding="0" cellspacing="0" style="width:100%; margin-left:5.4pt; border-collapse:collapse;">
        <thead>
            <tr style="height:12pt;">
                <td colspan="4" style="width: 371.25pt; border-bottom: 1pt solid rgb(26, 85, 212); padding: 4pt 4pt 3.5pt; vertical-align: top; background-color: rgb(25, 64, 194); text-align: center;">
                    <p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 12pt; text-align: left;"><strong><span style="font-family:'Superclarendon Regular'; color:#fefffe;"> Senarai Roll Call Penguatkuasa Bahagian - {{$kumpulan->nama_kumpulan}}</span></strong></p><br>
                </td>
            </tr>
        </thead>
        <tbody>


            @foreach($report_ind as $report_inds)
            <tr style="height:14.65pt;">
                <td style="width:100%; border-top:1pt solid #b5d198; padding:3.5pt 4pt 4pt; vertical-align:top;">
                    <p style="margin-top: 0pt; margin-bottom: 0pt; font-size: 12pt; text-align: left;">&nbsp; </p>
                </td>
                <td style="width:100%; border-top:1pt solid #b5d198; padding:3.5pt 4pt 4pt; vertical-align:top;">
                    
                    @if ($report_inds->lulus===1)
                    <span class="badge badge-pill badge-primary">Hadir</span>
                    @elseif ($report_inds->lulus===0)
                    <span class="badge badge-pill badge-primary">Tidak Hadir</span>
                    @elseif ($report_inds->lulus===null)
                    <span class="badge badge-pill badge-primary">Belum Hadir</span>

                    @endif
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
