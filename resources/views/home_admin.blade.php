@extends('layouts.app_admin_kanan')
<style>
          .kolom{
                width:80%;
                margin-left:10%;
                margin-top:5%;
                border:dotted blue 2px;
                padding:1%;
                text-align:center;
                font-size:24px;
            }
</style>
@section('content')
    <section class="content" id="section">
        <div id="tampilkandata"></div>
        
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
               url: "{{url('group/tampilkan_group')}}",
               data: "id=id",
               beforeSend: function(){
                    $("#tampilkandata").html('<center> Proses Data.............</center>');
               },
               success: function(msg){
                    $("#tampilkandata").html(msg);
                  
               }
           });
            

      });
  </script>
@endpush
