@extends('layouts.app_admin_kanan')

@section('content')
    <section class="content" id="section">
        
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">{{cek_name_group()}}</h3>
          </div>
          
          <div class="box-body">
              
              <div id="tabeldata">

              </div>
          </div>
          
        </div>
        
    </section>

   
    
    <div class="modal fade" id="modalpaslon">
      <div class="modal-dialog modal-lg" style="width:80%;margin-top:0px">
        <div class="modal-content">
          <div class="modal-body" style="display: flow-root;">
                <div id="notifikasipaslon"></div>
                <form method="post" id="mydata_paslon" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="pemilihan_id" id="pemilihan_id">
                    <div class="form-group" style="margin-bottom:0px">
                      <label >NIK</label>
                      <input type="text" style="width:20%;display:inline" id="text" class="form-control" onkeyup="cari_nik(this.value)"  placeholder="Masukan NIK">
                      <input type="hidden" style="width:20%" class="form-control" id="nik" name="nik" placeholder="Masukan NIK">
                      <input type="number" style="width:20%;display:inline" placeholder="Nomor Urut" class="form-control" name="no" >
                    </div>
                    <div class="form-group" style="margin-bottom:0px">
                      <label>Nama</label>
                      <input type="text" class="form-control" id="nama" >
                    </div>
                    
                    
                </form><br>
                <span  class="btn btn-default btn-sm" onclick="tutup()" id="tutup">Tutup</span>
                <span  class="btn btn-primary btn-sm" id="simpan_data_paslon" onclick="simpan_data_paslon()">Simpan</span>
                <span  class="btn btn-dafeult btn-sm" id="simpan_data_paslon_proses">Proses....</span>
                <hr style="border-top: 1px solid #e8d7d7;">
                <div id="tampilpaslon" style="padding:1%;overflow-y:scroll;height:400px"></div>
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
            $('#simpan_data_paslon_proses').hide();
            $.ajax({
               type: 'GET',
               url: "{{url('pemilihan/view_data_perunit')}}",
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
            $('#modalpaslon').modal({backdrop: 'static', keyboard: false});
            $.ajax({
               type: 'GET',
               url: "{{url('pemilihan/view_data_paslon')}}",
               data: "id="+a,
               beforeSend: function(){
                    $("#tampilpaslon").html('<center><img src="{{url('/img/loading.gif')}}" width="3%"> Proses Data.............</center>');
               },
               success: function(msg){
                    $("#tampilpaslon").html(msg);
                  
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

        function hapus_paslon(nik,id){
            $.ajax({
               type: 'GET',
               url: "{{url('pemilihan/hapus_paslon')}}",
               data: "nik="+nik+"&pemilihan_id="+id,
               success: function(msg){
                  $.ajax({
                      type: 'GET',
                      url: "{{url('pemilihan/view_data_paslon')}}",
                      data: "id="+msg,
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
                            $.ajax({
                                type: 'GET',
                                url: "{{url('pemilihan/view_data_paslon')}}",
                                data: "id="+data[1],
                                beforeSend: function(){
                                      $("#tampilpaslon").html('<center><img src="{{url('/img/loading.gif')}}" width="3%"> Proses Data.............</center>');
                                },
                                success: function(msg){
                                    $("#text").val('');
                                    $("#nik").val('');
                                    $("#nama").val('');
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
