@extends('layouts.app_admin')

@section('content')
    <section class="content" id="section">
        
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Blank Box</h3>
          </div>
          <div class="box-body">
            @if(cek_pemilihan_aktif()>0)
              @foreach(pemilihan_aktif() as $no=>$det)
                <div class="colom-25">
                    <div class="nomor_user">
                      NO {{$no+1}}
                    </div>
                    <div class="img_user">
                        <img src="{{url('profil/'.cek_pengguna($det['nik'])['foto'])}}" onclick="pilih({{$no}})" class="imgnya" alt="User Image">
                        <div class="centered"><span class="btn btn-primary btn-sm">Klik Area Foto</span></div>
                    </div>
                    <div class="nama_user">
                      {{cek_pengguna($det['nik'])['name']}}<br>
                      {{$det['nik']}}
                    </div>
                </div>
              @endforeach
            @endif
          </div>
          
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
  </script>
@endpush
