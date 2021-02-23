@extends('layouts.app_admin_kanan')

@section('content')
    <section class="content" id="section">
        
        <div class="box" style="display:flex;background: none;border-top: none;box-shadow: none;">
          
          
            
          
        </div>
        
    </section>

    
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
