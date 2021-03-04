@extends('layouts.app_admin_kanan')

@section('content')
    <section class="content" id="section">
        
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Blank Box</h3>
          </div>
          <div class="box-header with-border">
            <span class="btn btn-primary btn-sm" onclick="tambah()">Tambah</span>
            <select id="kode_group" class="form-control" style="width:40%;display:inline;margin-left:2%" onchange="cari_kode(this.value)">
                <option value="">PILIH UNIT SKKS</option>
                @foreach(group() as $group)
                  <option value="{{$group['kode_group']}}">{{$group['name']}}</option>
                @endforeach
            </select>
          </div>
          <div class="box-body">
              
              <div id="tabeldata">

              </div>
          </div>
          
        </div>
        
    </section>

    <div class="modal fade" id="modaltambah">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Tambah Data</h4>
          </div>
          <div class="modal-body">
                <div id="notifikasi"></div>
                <form method="post" id="mydata" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group" style="margin-bottom: 0px;">
                        <label>Nama E-vote</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Periode:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="periode" class="form-control" id="periode">
                      </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 0px;">
                        <label>Kategori Vote</label>
                        <select name="kat" class="form-control">
                           <option value="">Pilih Vote</option>
                           <option value="1">RUTU</option>
                           <option value="2">Semua Unit SKKS</option>
                           
                        </select>
                    </div>
                    <div class="form-group">
                      <label>Batas Waktu Vote</label>

                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                        <input type="text" name="sampai" class="form-control pull-right" id="datetimepicker" >
                      </div>
                      <!-- /.input group -->
                    </div>
                </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="simpan_data" onclick="simpan_data()">Simpan</button>
            <button type="button" class="btn btn-dafeult" id="simpan_data_proses">Proses....</button>
          </div>
        </div>
      </div>
      
    </div>

    <div class="modal fade" id="modalubah">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Ubah Data</h4>
          </div>
          <div class="modal-body">
                <div id="notifikasiubah"></div>
                <form method="post" id="mydata_ubah" enctype="multipart/form-data">
                    @csrf
                    <div id="tampilubah"></div>
                    
                </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="simpan_data_ubah" onclick="simpan_data_ubah()">Simpan</button>
            <button type="button" class="btn btn-dafeult" id="simpan_data_ubah_proses">Proses....</button>
          </div>
        </div>
      </div>
      
    </div>
    <div class="modal fade" id="modalpaslon">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" onclick="tutup()">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Tambah Data Paslon</h4>
          </div>
          <div class="modal-body" style="display: flow-root;">
                <div id="notifikasipaslon"></div>
                <form method="post" id="mydata_paslon" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="pemilihan_id" id="pemilihan_id">
                    <div class="form-group" style="margin-bottom:0px">
                      <label >NIK</label><br>
                      <input type="text" style="width:20%;display:inline" id="text" class="form-control" onkeyup="cari_nik(this.value)"  placeholder="Masukan NIK">
                      <input type="hidden" style="width:20%" class="form-control" id="nik" name="nik" placeholder="Masukan NIK">
                      <input type="number" style="width:20%;display:inline" placeholder="Nomor Urut" class="form-control" name="nomor" >
                    
                    </div>
                    <div class="form-group" style="margin-bottom:0px">
                      <label>Nama</label>
                      <input type="text" class="form-control" id="nama" >
                    </div>
                    
                </form><br>
                <span  class="btn btn-primary btn-sm" id="simpan_data_paslon" onclick="simpan_data_paslon()">Simpan</span>
                <span  class="btn btn-default btn-sm"  onclick="tutup()">Tutup</span>
                <span  class="btn btn-dafeult btn-sm" id="simpan_data_paslon_proses">Proses....</span>
                <hr style="border-top: 1px solid #e8d7d7;">
                <div id="tampilpaslon" style="padding:1%"></div>
          </div>
          
        </div>
      </div>
      
    </div>
    <div class="modal fade" id="modalvoters">
      <div class="modal-dialog modal-lg" style="width:80%;margin-top:0px">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" onclick="tutup()">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Tambah Data Voters</h4>
          </div>
          <div class="modal-body" style="display: flow-root;">
                <div id="notifikasivoters"></div>
                <form method="post" id="mydata_voters" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="pemilihan_id" id="pemilihan_id_voters">
                    <div class="form-group" style="margin-bottom:0px">
                      <label >NIK</label>
                      <input type="text" style="width:20%" id="text_voters" class="form-control" onkeyup="cari_nik_voters(this.value)"  placeholder="Masukan NIK">
                      <input type="hidden" style="width:20%" class="form-control" id="nik_voters" name="nik" placeholder="Masukan NIK">
                    </div>
                    <div class="form-group" style="margin-bottom:0px">
                      <label>Nama</label>
                      <input type="text" class="form-control" id="nama_voters" >
                    </div>
                    
                </form><br>
                <span  class="btn btn-primary btn-sm" id="simpan_data_voters" onclick="simpan_data_voters()">Simpan</span>
                <span  class="btn btn-default btn-sm" id="simpan_data_voters_proses">Proses....</span>
                <span  class="btn btn-default btn-sm"  onclick="tutup()">Tutup</span>
                
                <hr style="border-top: 1px solid #e8d7d7;">
                <div id="tampilvoters" style="padding:1%;overflow-y:scroll;height:350px;"></div>
          </div>
          
        </div>
      </div>
      
    </div>
@endsection

@push('ajax')
  <script>
        $(function () {
          $('#datetimepicker').datetimepicker({
              format: 'YYYY-MM-DD HH:mm:ss'
          });
        });


        $(document).ready(function() {
            $('#simpan_data_proses').hide();
            $('#simpan_data_ubah_proses').hide();
            $('#simpan_data_paslon_proses').hide();
            $('#simpan_data_voters_proses').hide();
            $.ajax({
               type: 'GET',
               url: "{{url('pemilihan/view_data')}}",
               data: "id=id",
               beforeSend: function(){
                    $("#tabeldata").html('<center><img src="{{url('/img/loading.gif')}}" width="3%"> Proses Data.............</center>');
               },
               success: function(msg){
                    $("#tabeldata").html(msg);
                  
               }
           });
            

           

        });

        function tutup(){
            location.reload();
        }
        function tambah(){
            $('#modaltambah').modal('show');
        }
        function tambah_paslon(a){
            $('#pemilihan_id').val(a);
            var kode_group=$('#kode_group').val();
            
            $('#modalpaslon').modal({backdrop: 'static', keyboard: false});
            $.ajax({
               type: 'GET',
               url: "{{url('pemilihan/view_data_paslon')}}",
               data: "id="+a+"&kode_group="+kode_group,
               beforeSend: function(){
                    $("#tampilpaslon").html('<center><img src="{{url('/img/loading.gif')}}" width="3%"> Proses Data.............</center>');
               },
               success: function(msg){
                    $("#tampilpaslon").html(msg);
                  
               }
           });
        }
        function tambah_voters(a){
            $('#pemilihan_id_voters').val(a);
            $('#modalvoters').modal({backdrop: 'static', keyboard: false});
            $.ajax({
               type: 'GET',
               url: "{{url('pemilihan/view_data_voters')}}",
               data: "id="+a,
               beforeSend: function(){
                    $("#tampilvoters").html('<center><img src="{{url('/img/loading.gif')}}" width="3%"> Proses Data.............</center>');
               },
               success: function(msg){
                    $("#tampilvoters").html(msg);
                  
               }
           });
        }
        
        
        function ubah(a){
           
           $.ajax({
               type: 'GET',
               url: "{{url('pemilihan/ubah')}}",
               data: "id="+a,
               success: function(msg){
                   $('#modalubah').modal('show');
                   $("#tampilubah").html(msg);
                   
               }
           });
            
        }

        function hapus(a){
           
           $.ajax({
               type: 'GET',
               url: "{{url('pemilihan/hapus')}}",
               data: "id="+a,
               success: function(msg){
                   location.reload();
                   
               }
           });
            
        }
        function cari_nik(a){
          var kode_group=$('#kode_group').val();
           $.ajax({
               type: 'GET',
               url: "{{url('unit/cari_nik_group')}}",
               data: "id="+a+"&kode_group="+kode_group,
               success: function(msg){
                   var data=msg.split('@');
                   $('#nama').val(data[1]);
                   $('#nik').val(data[0]);
               }
           });
            
        }
        function cari_nik_voters(a){
           
           $.ajax({
               type: 'GET',
               url: "{{url('unit/cari_nik')}}",
               data: "id="+a,
               success: function(msg){
                   var data=msg.split('@');
                   $('#nama_voters').val(data[1]);
                   $('#nik_voters').val(data[0]);
               }
           });
            
        }

        function hapus_paslon(nik,id){
            $.ajax({
               type: 'GET',
               url: "{{url('pemilihan/hapus_paslon')}}",
               data: "nik="+nik+"&pemilihan_id="+id,
               success: function(msg){
                  $.ajax({
                      type: 'GET',
                      url: "{{url('pemilihan/view_data_paslon')}}",
                      data: "id="+msg+"&kode_group="+kode_group,
                      beforeSend: function(){
                            $("#tampilpaslon").html('<center><img src="{{url('/img/loading.gif')}}" width="3%"> Proses Data.............</center>');
                      },
                      success: function(msg){
                          $("#tampilpaslon").html(msg);
                          
                      }
                  });
              }
           });
        }
        function cari_kode(a){
          $.ajax({
               type: 'GET',
               url: "{{url('pemilihan/view_data')}}",
               data: "kode_group="+a,
               beforeSend: function(){
                    $("#tabeldata").html('<center><img src="{{url('/img/loading.gif')}}" width="3%"> Proses Data.............</center>');
               },
               success: function(msg){
                    $("#tabeldata").html(msg);
                  
               }
           });
        }
        function aktif(a){
           
           $.ajax({
               type: 'GET',
               url: "{{url('pemilihan/aktif')}}",
               data: "id="+a,
               success: function(msg){
                   location.reload();
                   
               }
           });
            
        }
        function hidupkan(a){
           
           $.ajax({
               type: 'GET',
               url: "{{url('pemilihan/hidupkan')}}",
               data: "id="+a,
               success: function(msg){
                   location.reload();
                   
               }
           });
            
        }
        function non_aktif(a){
           
           $.ajax({
               type: 'GET',
               url: "{{url('pemilihan/non_aktif')}}",
               data: "id="+a,
               success: function(msg){
                   location.reload();
                   
               }
           });
            
        }
        function matikan(a){
           
           $.ajax({
               type: 'GET',
               url: "{{url('pemilihan/matikan')}}",
               data: "id="+a,
               success: function(msg){
                   location.reload();
                   
               }
           });
            
        }

        function simpan_data(){
            var form=document.getElementById('mydata');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/pemilihan/simpan')}}",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function(){
                        $("#simpan_data_proses").show()
                        $("#simpan_data").hide()
                    },
                    success: function(msg){
                        if(msg=='ok'){
                            location.reload();
                               
                        }else{
                            $("#simpan_data_proses").hide()
                            $("#simpan_data").show()
                            $('#simpan_data').show();
                            $('#notifikasi').html(msg);
                        }
                        
                        
                    }
                });

        } 

        function simpan_data_paslon(){
            var form=document.getElementById('mydata_paslon');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/pemilihan/simpan_paslon')}}",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function(){
                        $("#simpan_data_paslon_proses").show()
                        $("#simpan_data_paslon").hide()
                    },
                    success: function(msg){
                      var data=msg.split('@');
                        if(data[0]=='ok'){
                            var kode_group=$('#kode_group').val();
                            $.ajax({
                                type: 'GET',
                                url: "{{url('pemilihan/view_data_paslon')}}",
                                data: "id="+data[1]+"&kode_group="+kode_group,
                                beforeSend: function(){
                                      $("#tampilpaslon").html('<center><img src="{{url('/img/loading.gif')}}" width="3%"> Proses Data.............</center>');
                                },
                                success: function(msg){
                                    $("#text_voters").val('');
                                    $("#nik_voters").val('');
                                    $("#nama_voters").val('');
                                    $("#tampilpaslon").html(msg);
                                    $("#simpan_data_paslon_proses").hide();
                                    $("#simpan_data_paslon").show();
                                }
                            });
                               
                        }else{
                            $("#simpan_data_paslon_proses").hide()
                            $("#simpan_data_paslon").show()
                            $('#notifikasipaslon').html(msg);
                        }
                        
                        
                    }
                });

        } 
        function simpan_data_voters(){
            var form=document.getElementById('mydata_voters');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/pemilihan/simpan_voters')}}",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function(){
                        $("#simpan_data_voters_proses").show()
                        $("#simpan_data_voters").hide()
                    },
                    success: function(msg){
                      var data=msg.split('@');
                        if(data[0]=='ok'){
                            $.ajax({
                                type: 'GET',
                                url: "{{url('pemilihan/view_data_voters')}}",
                                data: "id="+data[1],
                                beforeSend: function(){
                                      $("#tampilvoters").html('<center><img src="{{url('/img/loading.gif')}}" width="3%"> Proses Data.............</center>');
                                },
                                success: function(msg){
                                    $("#text").val('');
                                    $("#nik").val('');
                                    $("#nama").val('');
                                    $("#tampilvoters").html(msg);
                                    $("#simpan_data_voters_proses").hide();
                                    $("#simpan_data_voters").show();
                                }
                            });
                               
                        }else{
                            $("#simpan_data_voters_proses").hide()
                            $("#simpan_data_voters").show()
                            $('#notifikasivoters').html(msg);
                        }
                        
                        
                    }
                });

        } 
        function simpan_data_ubah(){
            var form=document.getElementById('mydata_ubah');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/pemilihan/simpan_ubah')}}",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function(){
                        $("#simpan_data_ubah_proses").show()
                        $("#simpan_data_ubah").hide()
                    },
                    success: function(msg){
                        if(msg=='ok'){
                            location.reload();
                               
                        }else{
                            $("#simpan_data_ubah_proses").hide()
                            $('#simpan_data_ubah').show();
                            $('#notifikasiubah').html(msg);
                        }
                        
                        
                    }
                });

        } 
  </script>
@endpush
