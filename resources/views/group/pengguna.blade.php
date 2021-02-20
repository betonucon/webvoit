@extends('layouts.app_admin_kanan')

@section('content')
    <section class="content" id="section">
        
        <div class="box box-default">
          <div class="box-header with-border" style="background:#e4e4ea">
              <div class="box-body">
                <div id="notifikasi"></div>
                <form method="post" id="mydata" enctype="multipart/form-data">
                    @csrf
                      <input type="hidden" name="kode_group" value="{{$kode_group}}">
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
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Cari nik">
                  </div>
              </div><br>
              <div id="tabeldata" style="margin-top:2%">

              </div>
          </div>
          
        </div>
        
    </section>

    
    
   
@endsection

@push('ajax')
  <script>
        $(document).ready(function() {
            $('#simpan_data_proses').hide();
            $.ajax({
               type: 'GET',
               url: "{{url('group/view_data_pengguna?kode_group='.$kode_group)}}",
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
               url: "{{url('unit/cari_nik')}}",
               data: "id="+a,
               success: function(msg){
                   var data=msg.split('@');
                   $('#nama').val(data[1]);
                   $('#nik').val(data[0]);
               }
           });
            
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
               url: "{{url('group/hapus_pengguna')}}",
               data: "id="+a,
               success: function(msg){
                $.ajax({
                    type: 'GET',
                    url: "{{url('group/view_data_pengguna?kode_group='.$kode_group)}}",
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
                            url: "{{url('group/view_data_pengguna?kode_group='.$kode_group)}}",
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
