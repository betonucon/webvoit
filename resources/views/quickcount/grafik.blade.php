<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | ChartJS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{url(link_html().'/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url(link_html().'/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{url(link_html().'/bower_components/Ionicons/css/ionicons.min.css')}}">
  <link rel="stylesheet" href="{{url(link_html().'/dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
    @media only screen and (min-width: 650px) {
        .colommenang{
            width:30%;
            text-align:center;
            padding:1%;
            margin-left:35%;
            margin-top:10%;
            margin-bottom:2%;
            /* border:double 3px #000; */
            display: table;
        }
        .judulmenang{
            width:100%;
            float:left;
            text-align:left;
            background:#e2f791;
            padding:1%;
            font-size:20px;
            text-transform:uppercase;
            border:solid 1px #dcbebe;
            display: table;
        }
        .imgnyamenang{
            width: 100%;
            height: 200px;
            margin-left:0.5%;
            border-radius:100%;
            display:block;
            
        }
        .nama_user{
            width:100%;
            padding:1%;
            font-size:12px;
            border:solid 1px #dcbebe;
            font-weight:bold;
            height:70px;
            
            font-size:13px;
        }
    }
    @media only screen and (max-width: 640px) {
        .colommenang{
            width:54%;
            text-align:center;
            padding:1%;
            margin-left:23%;
            margin-top:10%;
            margin-bottom:2%;
            /* border:double 3px #000; */
            display: table;
        }
        .judulmenang{
            width:100%;
            float:left;
            text-align:left;
            background:#e2f791;
            padding:1%;
            font-size:15px;
            text-transform:uppercase;
            border:solid 1px #dcbebe;
            display: table;
        }
        .imgnyamenang{
            width: 100%;
            height: 200px;
            margin-left:0.5%;
            border-radius:100%;
            display:block;
            
        }
        .nama_user{
            width:100%;
            padding:1%;
            font-size:12px;
            border:solid 1px #dcbebe;
            font-weight:bold;
            height:70px;
            
            font-size:13px;
        }
    }
    </style>
</head>
    <body>

        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Quickcount</h3>
              @if(Auth::user()['role_id']==3)
                @if(stspemilihan($pemilihan['id'],cek_kode_group())==1)
                    <span class="btn btn-success btn-sm" style="margin-left:2%" onclick="akhiri({{$pemilihan['id']}},'{{cek_kode_group()}}')"><i class="fa fa-remove"></i> Tutup Vote</span>
                @endif
              @endif
            </div>
            <div class="box-body" id="diprint">
                <div class="col-md-8">
                    <div id="bar-chart" style="height: 300px;"></div>
                </div>
                <div class="col-md-4">
                    <div class="judul" style="width:100%;text-align:center">
                        <b>Hasil Vote {{$pemilihan['name']}}</b><br>{{$group['name']}}<br>{{$pemilihan['periode']}}
                    </div>
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Calon</th>
                            <th style="width: 40px">Suara</th>
                        </tr>
                            @foreach($rinci as $r=>$rinci)
                                <?php
                                    if($rinci['nik']==999999){
                                        $nama='Abstain';
                                    }else{
                                        $nama=$rinci->pengguna['name'];
                                    }
                                ?>
                                <tr>
                                    <td>{{$r+1}}</td>
                                    <td>{{$nama}}</td>
                                    <td><span class="badge bg-red">{{cek_hasil($rinci['nik'],$rinci['pemilihan_id'],$rinci['kode_group'])}}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <div class="judul" style="width:100%;text-align:center">
                        
                    </div>
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th>Hak Pilih</th>
                            <th>Suara Masuk</th>
                            <th>Abstain</th>
                            <th>Belum Vote</th>
                            
                        </tr>
                           
                        <tr>
                            <td>{{$hakpilih}}</td>
                            <td>{{$voters}}</td>
                            <td>{{$abstain}}</td>
                            <td>{{$belum}}</td>
                        </tr>
                            
                        </tbody>
                    </table>
                </div>
                @if(stspemilihan($pemilihan['id'],$group['kode_group'])==2)
                <div class="col-md-12" style="background-image: linear-gradient(to right top, #567cbb, #4d65a1, #444e87, #3a396e, #2f2455);color:#fff">
                    <div class="judulmenang" style="color:blue">
                            <marquee>
                                @foreach($hasilnya as $hsl)
                                    SELAMAT ATAS TERPILIHNYA [{{$hsl['nik']}}]{{$hsl['pengguna']['name']}} DALAM PEMILIHAN {{$pemilihan['name']}} PADA RUTU {{$group['name']}}
                                @endforeach
                            </marquee>
                        </div>
                            @foreach($hasilnya2 as $hsl)
                                
                                <div class="colommenang">
                                    <div class="img_user_menang" >
                                        <img src="{{url('pengguna/enkripsi?text='.enkripsi_akuh($hsl['nik']))}}"  class="imgnyamenang" alt="User Image">
                                    </div>
                                    <div class="nama_user" >
                                        {{$hsl['nik']}}<br>
                                        {{$hsl['pengguna']['name']}}
                                        <br>Suara <b>( {{$hsl['total']}} )</b>
                                    </div>
                                    
                                </div>

                            @endforeach    
                </div>
                @endif
            </div>
            <!-- /.box-body -->
          </div>
        <script src="{{url(link_html().'/bower_components/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{url(link_html().'/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script src="{{url(link_html().'/bower_components/fastclick/lib/fastclick.js')}}"></script>
        <script src="{{url(link_html().'/bower_components/Flot/jquery.flot.js')}}"></script>
        <script src="{{url(link_html().'/bower_components/Flot/jquery.flot.resize.js')}}"></script>
        <script src="{{url(link_html().'/bower_components/Flot/jquery.flot.pie.js')}}"></script>
        <script src="{{url(link_html().'/bower_components/Flot/jquery.flot.categories.js')}}"></script>

       <script src="{{url(link_html().'/dist/js/adminlte.min.js')}}"></script>
        <script>
            function printDiv(divName){
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;

            }

            function akhiri(id,group){
                if (confirm('Apakah yakin akan menutup vote?')) {
                    $.ajax({
                        type: 'GET',
                        url: "{{url('quickcount/akhiri')}}",
                        data: "pemilihan_id="+id+"&kode_group="+group,
                        success: function(msg){
                                location.reload();
                            
                        }
                    });
                }else{
                    alert('ok');
                }
            }
	    </script>
        <script>
        $(function () {
            
            /*
            * BAR CHART
            * ---------
            */

            var bar_data = {
            data : [
                @foreach($data as $o)
                    <?php
                        if($o['nik']==999999){
                            $tampil='Abstain';
                        }else{
                            $tampil=$o->pengguna['name'];
                        }
                    ?>

                    ['{{$tampil}}', {{cek_hasil($o['nik'],$o['pemilihan_id'],$o['kode_group'])}}],
                @endforeach
            ],
            color: '#3c8dbc'
            }
            $.plot('#bar-chart', [bar_data], {
            grid  : {
                borderWidth: 1,
                borderColor: '#f3f3f3',
                tickColor  : '#f3f3f3'
            },
            series: {
                bars: {
                show    : true,
                barWidth: 0.5,
                align   : 'center'
                }
            },
            xaxis : {
                mode      : 'categories',
                tickLength: 0
            }
            })
            /* END BAR CHART */

            

        })

        
        </script>
    </body>
</html>
