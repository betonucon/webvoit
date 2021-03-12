@extends('layouts.app_admin_kanan')

@section('content')
    <section class="content" id="section">
        
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Hasil Perhitungan Cepat</h3>
          </div>
          
          @if(Auth::user()['role_id']==1)
          <div class="box-header with-border">
            <select id="kode_group" class="form-control" style="width:40%" onchange="cari_kode(this.value)">
                <option value="">PILIH UNIT SKKS</option>
                @foreach(group() as $group)
                  <option value="{{$group['kode_group']}}">{{$group['name']}}</option>
                @endforeach
            </select>
          </div>
          @endif
          <div class="box-body">
              
              <div id="tabeldata">

              </div>
          </div>
          
        </div>
        
    </section>

    
    <div class="modal fade" id="modalpaslon">
      <div class="modal-dialog modal-lg" style="width:95%;margin-top:0px;margin-left:2.5%;">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            
          </div>
          <div class="modal-body" style="display: flow-root;">
                
                <div id="tampilpaslon" style="padding:1%"></div>
          </div>
          
        </div>
      </div>
      
    </div>
   
@endsection

@push('ajax')
  <script>
        $(function () {
          $('#datetimepicker').datetimepicker();
        });


        $(document).ready(function() {
            $('#simpan_data_proses').hide();
            $('#simpan_data_ubah_proses').hide();
            $('#simpan_data_paslon_proses').hide();
            $('#simpan_data_voters_proses').hide();
            $.ajax({
               type: 'GET',
               url: "{{url('quickcount/view_data')}}",
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
        function cari_kode(a){
          $.ajax({
               type: 'GET',
               url: "{{url('quickcount/view_data')}}",
               data: "kode_group="+a,
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
        function tambah_paslon(a,kode){
            
            $('#modalpaslon').modal('show');
            $.ajax({
               type: 'GET',
               url: "{{url('quickcount/view_data_hasil')}}",
               data: "pemilihan_id="+a+"&kode_group="+kode,
               beforeSend: function(){
                    $("#tampilpaslon").html('<center><img src="{{url('/img/loading.gif')}}" width="3%"> Proses Data.............</center>');
               },
               success: function(msg){
                    $("#tampilpaslon").html(msg);
                  
               }
           });
        }
        function hasil_paslon(a,kode){
            
            
            if(kode==''){
                alert('Pilih Unit SKKS');
            }else{
                $('#modalpaslon').modal('show');
                $.ajax({
                    type: 'GET',
                    url: "{{url('quickcount/grafik')}}",
                    data: "pemilihan_id="+a+"&kode_group="+kode,
                    beforeSend: function(){
                            $("#tampilpaslon").html('<center><img src="{{url('/img/loading.gif')}}" width="3%"> Proses Data.............</center>');
                    },
                    success: function(msg){
                            $("#tampilpaslon").html(msg);
                        
                    }
                });
            }
            
        }
        
        
        function ubah(a){
           
           $.ajax({
               type: 'GET',
               url: "{{url('quickcount/ubah')}}",
               data: "id="+a,
               success: function(msg){
                   $('#modalubah').modal('show');
                   $("#tampilubah").html(msg);
                   
               }
           });
            
        }

        function hapus(a,kode){
           
           $.ajax({
               type: 'GET',
               url: "{{url('quickcount/hapus')}}",
               data: "id="+a+"&kode_group="+kode,
               success: function(msg){
                 var data=msg.split('@');
                  $.ajax({
                      type: 'GET',
                      url: "{{url('quickcount/view_data_hasil')}}",
                      data: "pemilihan_id="+data[0]+"&kode_group="+data[1],
                      beforeSend: function(){
                            $("#tampilpaslon").html('<center><img src="{{url('/img/loading.gif')}}" width="3%"> Proses Data.............</center>');
                      },
                      success: function(tam){
                            $("#tampilpaslon").html(tam);
                          
                      }
                });
                   
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

        
       
        function simpan_data(){
            var form=document.getElementById('mydata');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/quickcount/simpan')}}",
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
                    url: "{{url('/quickcount/simpan_paslon')}}",
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
                                url: "{{url('quickcount/view_data_paslon')}}",
                                data: "id="+data[1],
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
                    url: "{{url('/quickcount/simpan_voters')}}",
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
                                url: "{{url('quickcount/view_data_voters')}}",
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
                    url: "{{url('/quickcount/simpan_ubah')}}",
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
