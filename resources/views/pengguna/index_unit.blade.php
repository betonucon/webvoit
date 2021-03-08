@extends('layouts.app_admin_kanan')

@section('content')
    <section class="content" id="section">
        
        <div class="box box-default">
          <div class="box-header with-border" style="background:#e4e4ea">
              <div class="box-body">
                <div id="notifikasi"></div>
                <form method="post" id="mydata" enctype="multipart/form-data">
                    @csrf
                      <input type="hidden" name="kode_group" value="{{cek_kode_group()}}">
                    <div class="form-group" style="margin-bottom:0px">
                      <label>NIK:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </div>
                        <input type="text" id="cari" onkeyup="cari_nik(this.value)" class="form-control" >
                      </div>
                    </div>
                    <div class="form-group" style="margin-bottom:0px">
                      <label>Nama:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </div>
                        <input type="text" id="nama" class="form-control" >
                        <input type="hidden" id="nik" name="nik" class="form-control" >
                      </div>
                    </div>
                </form><br>
                <button type="button" class="btn btn-primary btn-sm" id="simpan_data" onclick="simpan_data()">Simpan</button>
                <button type="button" class="btn btn-dafeult btn-sm" id="simpan_data_proses">Proses....</button>
              </div>
              
          </div>
          <div class="box-body">
              <div class="form-group">
                  <div class="col-sm-6">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" onkeyup="cari(this.value)" placeholder="Cari Pengguna">
                  </div>
              </div><br>
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
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control">
                    </div>
                    <div class="form-group" style="margin-bottom: 0px;">
                        <label>Nama Pengguna</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group" style="margin-bottom: 0px;">
                        <label>Foto Profil</label>
                        <input type="file" name="file" class="form-control">
                    </div>
                    <div class="form-group" style="margin-bottom: 0px;">
                        <label>Unit Kerja</label>
                        <select name="kode_unit" class="form-control">
                           <option value="">Pilih Unit</option>
                            @foreach(unit() as $unit)
                              <option value="{{$unit['kode_unit']}}">{{cek_kategori($unit['sts'])}} {{$unit['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="margin-bottom: 0px;">
                        <label>Role</label>
                        <select name="role_id" class="form-control">
                           <option value="">Pilih Role</option>
                           <option value="3">Admin Unit SKKS dan User Voting</option>
                           <option value="2">User Voting</option>
                           
                        </select>
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
@endsection

@push('ajax')
  <script>
        $(document).ready(function() {
            $('#simpan_data_proses').hide();
            $('#simpan_data_ubah_proses').hide();
            $.ajax({
               type: 'GET',
               url: "{{url('pengguna/view_data_unit')}}",
               data: "id=id",
               beforeSend: function(){
                    $("#tabeldata").html('<center><img src="{{url('/img/loading.gif')}}" width="3%"> Proses Data.............</center>');
               },
               success: function(msg){
                    $("#tabeldata").html(msg);
                  
               }
           });
            

        });
        function cari_nik(a){
           
           $.ajax({
               type: 'GET',
               url: "{{url('unit/cari_nik_pengguna')}}",
               data: "id="+a,
               success: function(msg){
                   var data=msg.split('@');
                   $('#nama').val(data[1]);
                   $('#nik').val(data[0]);
               }
           });
            
        }
        function cari(a){
           
          $.ajax({
               type: 'GET',
               url: "{{url('pengguna/view_data_unit')}}?text="+a,
               data: "id=id",
               beforeSend: function(){
                    $("#tabeldata").html('<center><img src="{{url('/img/loading.gif')}}" width="3%"> Proses Data.............</center>');
               },
               success: function(msg){
                    $("#tabeldata").html(msg);
                  
               }
           });
             
         }

        function tambah(){
            $('#modaltambah').modal('show');
        }
        
        function ubah(a){
           
           $.ajax({
               type: 'GET',
               url: "{{url('pengguna/ubah')}}",
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
               url: "{{url('group/hapus_pengguna')}}",
               data: "id="+a,
               success: function(msg){
                $.ajax({
                    type: 'GET',
                    url: "{{url('pengguna/view_data_unit')}}",
                    data: "id=id",
                    beforeSend: function(){
                          $("#tabeldata").html('<center><img src="{{url('/img/loading.gif')}}" width="3%"> Proses Data.............</center>');
                    },
                    success: function(msg){
                          $("#tabeldata").html(msg);
                        
                    }
                });
                   
               }
           });
            
        }

        function simpan_data(){
            var form=document.getElementById('mydata');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/group/simpan_pengguna')}}",
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
                          
                          $('#simpan_data').show();
                          $('#simpan_data_proses').hide();
                          $.ajax({
                            type: 'GET',
                            url: "{{url('pengguna/view_data_unit')}}",
                            data: "id=id",
                            beforeSend: function(){
                                  $("#tabeldata").html('<center><img src="{{url('/img/loading.gif')}}" width="3%"> Proses Data.............</center>');
                            },
                            success: function(msg){
                                  $("#tabeldata").html(msg);
                                  $("#nik").val('');
                                  $("#cari").val('');
                                  $("#nama").val('');
                                
                            }
                          });
                               
                        }else{
                            $("#simpan_data_proses").hide()
                            $("#simpan_data").show()
                            $('#notifikasi').html(msg);
                        }
                        
                        
                    }
                });

        } 

        function simpan_data_ubah(){
            var form=document.getElementById('mydata_ubah');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/pengguna/simpan_ubah')}}",
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
