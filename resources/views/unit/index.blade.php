@extends('layouts.app_admin')

@section('content')
    <section class="content" id="section">
        
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Blank Box</h3>
          </div>
          <div class="box-header with-border">
            <span class="btn btn-primary btn-sm" onclick="tambah()">Tambah</span>
            <span class="btn btn-success btn-sm">Upload Excel</span>
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
                        <label>Kode Unit</label>
                        <input type="text" name="kode_unit" class="form-control">
                    </div>
                    <div class="form-group" style="margin-bottom: 0px;">
                        <label>Nama Unit</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group" style="margin-bottom: 0px;">
                        <label>Kategori</label>
                        <select name="sts" class="form-control">
                           <option value="">Pilih Kategori</option>
                            @foreach(kategori() as $kat)
                              <option value="{{$kat['id']}}">{{$kat['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- <div class="form-group">
                        <label>Disabled Result</label>
                        <select class="form-control" style="width: 100%;border-radius:0px">
                            <option selected="selected">Alabama</option>
                            <option>Alaska</option>
                            <option disabled="disabled">California (disabled)</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                        </select>
                    </div> -->
                    
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
               url: "{{url('unit/view_data')}}",
               data: "id=id",
               beforeSend: function(){
                    $("#tabeldata").html('<center><img src="{{url('/img/loading.gif')}}" width="3%"> Proses Data.............</center>');
               },
               success: function(msg){
                    $("#tabeldata").html(msg);
                  
               }
           });
            

        });

        function tambah(){
            $('#modaltambah').modal('show');
        }
        
        function ubah(a){
           
           $.ajax({
               type: 'GET',
               url: "{{url('unit/ubah')}}",
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
               url: "{{url('unit/hapus')}}",
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
                    url: "{{url('/unit/simpan')}}",
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
        function simpan_data_ubah(){
            var form=document.getElementById('mydata_ubah');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/unit/simpan_ubah')}}",
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
