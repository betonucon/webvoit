@extends('layouts.app_admin')

@section('content')
    <section class="content" id="section">
        
        <div class="box" style="display:flex;background: none;border-top: none;box-shadow: none;">
          
          
            @if(cek_pemilihan_aktif()>0)
              <div id="tampilkan_paslon" style="width:100%"></div>
            @endif
          
        </div>
        
    </section>

    <div class="modal fade" id="modalpilih">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Perhatian</h4>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin akan melakukan vote?</p>
            <form method="post" id="mydata" enctype="multipart/form-data">
               @csrf
              <input type="hidden" name="id" id="pemilihan_id">
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="simpan_data" onclick="simpan_data()">Proses Pemilihan</button>
            <button type="button" class="btn btn-dafeult" id="simpan_data_proses">Proses....</button>
          </div>
        </div>
      </div>
      
    </div>
@endsection

@push('ajax')
  <script>
      function pilih(a){
        $('#modalpilih').modal({backdrop: 'static', keyboard: false});
        $('#pemilihan_id').val(a);
      }

      $(document).ready(function() {
            $("#simpan_data_proses").hide();
            $.ajax({
              type: 'GET',
              url: "{{url('view_data_homenya')}}",
              data: "id=id",
              beforeSend: function(){
                    $("#tampilkan_paslon").html('<center> Proses Data.............</center>');
              },
              success: function(msg){
                    $("#tampilkan_paslon").html(msg);
                  
              }
            });

            $.ajax({
                type: 'GET',
                url: "{{url('pemilihan/sisa_waktu')}}",
                data: "id=id",
                success: function(msg){
                    var data=msg.split('@');
                    $("#sisa_waktu").html(data[0]);
                    $("#waktu_sekarang").html(data[1]);
                    
                }
            });
            
            var $container = $("#nomor");
                $container.load("rss-feed-data.php");  
            var refreshId = setInterval(function()
            {
              $.ajax({
                type: 'GET',
                url: "{{url('view_data_homenya')}}",
                data: "id=id",
                beforeSend: function(){
                      $("#tampilkan_paslon").html('<center> Proses Data.............</center>');
                },
                success: function(msg){
                      $("#tampilkan_paslon").html(msg);
                    
                }
              });
            }, 20000);

            var $sisawaktu = $("#siswa_waktu");
                $sisawaktu.load("rss-feed-data.php");  
            var refreshwaktu = setInterval(function()
            {
             
                $.ajax({
                    type: 'GET',
                    url: "{{url('pemilihan/sisa_waktu')}}",
                    data: "id=id",
                    success: function(msg){
                        var data=msg.split('@');
                        $("#sisa_waktu").html(data[0]);
                        $("#waktu_sekarang").html(data[1]);
                        
                    }
                });
            }, 1000);
            
            

      });

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
                        
                            location.reload();
                       
                        
                    }
                });

        } 
  </script>
@endpush
