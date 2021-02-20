@extends('layouts.app_admin_kanan')

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
            <h4 class="modal-title">Default Modal</h4>
          </div>
          <div class="modal-body">
            <p>One fine body…</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
      
    </div>
@endsection

@push('ajax')
  <script>
      function pilih(a){
        $('#modalpilih').modal('show');
      }

      $(document).ready(function() {
            $.ajax({
               type: 'GET',
               url: "{{url('view_data_homenya_admin')}}",
               data: "id=id",
               beforeSend: function(){
                    $("#tampilkan_paslon").html('<center> Proses Data.............</center>');
               },
               success: function(msg){
                    $("#tampilkan_paslon").html(msg);
                  
               }
           });
            

      });
  </script>
@endpush
