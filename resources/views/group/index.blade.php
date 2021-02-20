@extends('layouts.app_admin_kanan')

@section('content')
    <section class="content" id="section">
        
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Blank Box</h3>
          </div>
          <div class="box-header with-border">
            <span class="btn btn-primary btn-sm" onclick="tambah()">Tambah</span>
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
          <div class="modal-body" id="awal">
                <div id="notifikasi"></div>
                <form method="post" id="mydata" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group" style="margin-bottom: 0px;">
                        <label>Kode Group</label>
                        <input type="text" name="kode_group" id="kode_group" value="{{kode_group()}}"  class="form-control">
                    </div>
                    <div class="form-group" style="margin-bottom: 0px;">
                        <label>Nama Group</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    
                </form>
          </div>
          <div class="modal-body" id="kedua">
                <div id="notifikasi_dua"></div>
                <form method="post" id="mydata_dua" enctype="multipart/form-data">
                    @csrf
                    
                    <input type="text" class="form-control" onkeyup="cari_unit(this.value)" placeholder="Enter.......">
                    <div id="tampil_unit"></div>
                    
                </form>
          </div>
          <div class="modal-footer" id="awal_btn">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-primary" id="simpan_data" onclick="simpan_data()">Simpan</button>
            <button type="button" class="btn btn-dafeult" id="simpan_data_proses">Proses....</button>
          </div>
          <div class="modal-footer" id="awal_dua">
            <button type="button" class="btn btn-default pull-left" onclick="tutup()">Tutup</button>
            
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
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
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
                      <label >NIK</label>
                      <input type="text" style="width:20%" id="text" class="form-control" onkeyup="cari_nik(this.value)"  placeholder="Masukan NIK">
                      <input type="hidden" style="width:20%" class="form-control" id="nik" name="nik" placeholder="Masukan NIK">
                      
                    </div>
                    <div class="form-group" style="margin-bottom:0px">
                      <label>Nama</label>
                      <input type="text" class="form-control" id="nama" >
                    </div>
                    
                </form><br>
                <span  class="btn btn-primary btn-sm" id="simpan_data_paslon" onclick="simpan_data_paslon()">Simpan</span>
                <span  class="btn btn-dafeult btn-sm" id="simpan_data_paslon_proses">Proses....</span>
                <hr style="border-top: 1px solid #e8d7d7;">
                <div id="tampilpaslon" style="padding:1%"></div>
          </div>
          
        </div>
      </div>
      
    </div>
@endsection

@push('ajax')
  <script>
        $(document).ready(function() {
            $('#simpan_data_proses').hide();
            $('#simpan_data_dua_proses').hide();
            $('#kedua').hide();
            $('#awal_dua').hide();
            $('#simpan_data_ubah_proses').hide();
            $.ajax({
               type: 'GET',
               url: "{{url('group/view_data')}}",
               data: "id=id",
               beforeSend: function(){
                    $("#tabeldata").html('<center><img src="{{url('/img/loading.gif')}}" width="3%"> Proses Data.............</center>');
               },
               success: function(msg){
                    $("#tabeldata").html(msg);
                  
               }
            });
        });

        $(document).ready(function() {
            var kodegroup=$("#kode_group").val();
            
            $.ajax({
               type: 'GET',
               url: "{{url('group/view_data_unit')}}",
               data: "kode_group="+kodegroup,
               beforeSend: function(){
                    $("#tampil_unit").html('<center><img src="{{url('/img/loading.gif')}}" width="3%"> Proses Data.............</center>');
               },
               success: function(msg){
                    $("#tampil_unit").html(msg);
                  
               }
            });
            

        });

        function tambah_pengguna(a){
            location.assign("{{url('group/pengguna')}}?kode_group="+a);
        }

        function tutup(){
          location.reload();
        }
        function tambah(){
          $('#modaltambah').modal({backdrop: 'static', keyboard: false});
        }
        
        function ubah(a){
           
           $.ajax({
               type: 'GET',
               url: "{{url('group/ubah')}}",
               data: "id="+a,
               success: function(msg){
                   $('#modalubah').modal('show');
                   $("#tampilubah").html(msg);
                   
               }
           });
            
        }
        function tambah_unit(unit,group){
          
           $.ajax({
               type: 'GET',
               url: "{{url('group/tambah_unit')}}",
               data: "unit="+unit+"&group="+group,
               success: function(msg){
                  $.ajax({
                    type: 'GET',
                    url: "{{url('group/view_data_unit')}}",
                    data: "kode_group="+group,
                    beforeSend: function(){
                          $("#tampil_unit").html('<center><img src="{{url('/img/loading.gif')}}" width="3%"> Proses Data.............</center>');
                    },
                    success: function(msg){
                          $("#tampil_unit").html(msg);
                        
                    }
                  });
                   
               }
           });
            
        }

        function cari_unit(a){
          var kode_group=$('#kode_group').val();
          $.ajax({
               type: 'GET',
               url: "{{url('group/view_data_unit')}}",
               data: "text="+a+"&kode_group="+kode_group,
               beforeSend: function(){
                    $("#tampil_unit").html('<center><img src="{{url('/img/loading.gif')}}" width="3%"> Proses Data.............</center>');
               },
               success: function(msg){
                    $("#tampil_unit").html(msg);
                  
               }
            });
        }

        function hapus(a){
           
           $.ajax({
               type: 'GET',
               url: "{{url('group/hapus')}}",
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
                    url: "{{url('/group/simpan')}}",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function(){
                        $("#simpan_data_proses").show()
                        $("#simpan_data").hide()
                    },
                    success: function(msg){
                      var data=msg.split('@');
                        if(data[0]=='ok'){
                          
                          location.assign("{{url('group/pengguna')}}?kode_group="+data[1]);
                               
                        }else{
                            $("#simpan_data_proses").hide()
                            $("#simpan_data").show()
                            $('#simpan_data').show();
                            $('#notifikasi').html(msg);
                        }
                        
                        
                    }
                });

        } 
        function simpan_data_ubah(){
            var form=document.getElementById('mydata_ubah');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/group/simpan_ubah')}}",
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
