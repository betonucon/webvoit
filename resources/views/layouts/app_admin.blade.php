<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SKKS Krakatau Steel</title>
  <!-- Tell the browser to be responsive to screen width -->
<link rel="shortcut icon" href="https://sso.krakatausteel.com/public/fav.png">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{url(link_html().'/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url(link_html().'/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{url(link_html().'/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url(link_html().'/dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{url(link_html().'/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{url(link_html().'/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{url(link_html().'/plugins/iCheck/all.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{url(link_html().'/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{url(link_html().'/plugins/timepicker/bootstrap-timepicker.min.css')}}">
  <link rel="stylesheet" href="{{url(link_html().'/bower_components/select2/dist/css/select2.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{url(link_html().'/dist/css/skins/_all-skins.min.css')}}">
  <style>
    #wraper{
      background-image: linear-gradient(to right top, #94a4bc, #7389b9, #5c6db2, #504ea7, #4f2996);
    }
    @media only screen and (min-width: 650px) {
      
      .colom-25{
        width:18%;
        float:left;
        text-align:center;
        margin:1%;
        padding:1%;
        background:#fff;
        border:solid 1px #dcbebe;
        display: table;
      }
      .colommenang{
        width:30%;
        text-align:center;
        padding:1%;
        margin-left:35%;
        margin-top:10%;
        margin-bottom:2%;
        /* border:double 3px #000; */
        display: table;
      }
      .judulmenang{
        width:100%;
        float:left;
        text-align:left;
        background:#e2f791;
        padding:1%;
        font-size:20px;
        border:solid 1px #dcbebe;
        display: table;
      }
      .colommenang-100{
        width:100%;
        float:left;
        text-align:left;
        background-image: linear-gradient(to right top, #dee4ee, #9cecff, #00f6f3, #2cf8a2, #a8eb12);
        border:solid 1px #dcbebe;
        display: table;
      }
      .colom-100{
        width:100%;
        float:left;
        text-align:left;
        background:#fff;
        border:solid 1px #dcbebe;
        display: table;
      }
      
      .colom-20{
        width:25%;
        float:left;
        text-align:center;
        margin:1%;
        padding:1%;
        background:#fff;
        border:solid 1px #dcbebe;
        display: table;
      }
      #select2{
        border-radius:0px;
      }
      .kepala{
        width:100%;
        background:#fff;
        border-bottom:solid 1px #7f7c7c;
        padding-left:2%;
        padding-right:2%;
        padding-top:1%;
        padding-bottom:1%;
        display: flow-root;
        
      }
      .img-kiri{
        width:10%;
        float:left;
        height:80px;
        display: flex;

      }
      .img-tengah{
        width:80%;
        float:left;
        height:80px;
        display:flow-root;
        text-align:center;
        padding-left:1%;
        padding-right:1%;
        font-size:22px;
        font-weight:bold;
      }
      .img-kanan{
        width:10%;
        float:left;
        height:80px;
        display: flex;
      }
      .imgnya{
        width: 100%;
        height: 180px;
        margin-left:0.5%;
        /* border-radius:100%; */
        display:block;
        
      }
      .imgnyamenang{
        width: 100%;
        height: 200px;
        margin-left:0.5%;
        border-radius:100%;
        display:block;
        
      }
      .img_user{
        width:100%;
        height:150px;
        display: initial;
        position: relative;
        /* border:solid 1px #dcbebe; */
      }
      .img_user_menang{
        width:100%;
        display: initial;
        position: relative;
        border-radius:100%;
        /* border:solid 1px #dcbebe; */
      }
      .nomor_user{
        width:100%;
        padding:1%;
        border:solid 1px #dcbebe;
        font-weight:bold;
        font-size:16px;
      }
      .nama_user{
        width:100%;
        padding:1%;
        font-size:12px;
        border:solid 1px #dcbebe;
        font-weight:bold;
        height:70px;
        
        font-size:13px;
      }
      .nama_user_no{
        width:100%;
        padding:1%;
        border:solid 1px #fff;
        font-weight:bold;
        font-size:13px;
      }
      .centered {
        position: absolute;
        display:none;
        top: 80%;
        left: 50%;
        transform: translate(-50%, -50%);
      }
      .gambar-news{
        background:#a5a5ad;
        padding:1%;
        display:block;
        width:30%;
        height:200px;
      }
    }
    @media only screen and (max-width: 640px) {
      #section{
        padding:20px 0px 0px 0px ;
      }
      .judulmenang{
        width:100%;
        float:left;
        text-align:left;
        background:#e2f791;
        padding:1%;
        font-size:15px;
        border:solid 1px #dcbebe;
        display: table;
      }
      .colommenang-100{
        width:100%;
        float:left;
        text-align:left;
        background-image: linear-gradient(to right top, #dee4ee, #9cecff, #00f6f3, #2cf8a2, #a8eb12);
        border:solid 1px #dcbebe;
        display: table;
      }
      .colommenang{
        width:30%;
        text-align:center;
        padding:1%;
        margin-left:35%;
        margin-top:10%;
        margin-bottom:2%;
        /* border:double 3px #000; */
        display: table;
      }
      .colom-100{
        width:100%;
        float:left;
        text-align:left;
        background:#fff;
        border:solid 1px #dcbebe;
        display: table;
      }
      .colom-25{
        width:31%;
        float:left;
        text-align:center;
        margin:1%;
        padding:1%;
        background:#fff;
        border:solid 1px #dcbebe;
        display: table;
      }
      .kepala{
        display:none;
      }
      .imgnya{
        width:99%;
        margin-left:0.5%;
        /* border-radius:100%; */
        display:block;
        position: relative;
      }
      .img_user{
        width:100%;
        height:100px;
        display: flex;
        border:solid 1px #dcbebe;
      }
      .imgnyamenang{
        width: 100%;
        height: 150px;
        margin-left:0.5%;
        border-radius:100%;
        display:block;
        
      }
      .nomor_user{
        width:100%;
        padding:1%;
        border:solid 1px #dcbebe;
      }
      .nama_user{
        width:100%;
        font-size:9px;
        padding:1%;
        height:40px;
        border:solid 1px #dcbebe;
      }
      .centered {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
      }
    }
  </style>
  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
  <div class="kepala">
    <div class="img-kiri">
      <img src="{{url('img/logo_skks.png')}}" style="width:100%">
    </div>
    <div class="img-tengah">
      {!!title()!!}
      
    </div>
    <div class="img-kanan">
      <img src="{{url('img/logo_ks.png')}}" style="width:100%">
    </div>
      
  </div>
  <header class="main-header">
    
    <nav class="navbar navbar-static-top" style="background:#2c1e67">
    
      <div class="container">
        <div class="navbar-header">
          <a href="../../index2.html" class="navbar-brand"><i class="fa fa-circle-o-notch fa-spin"></i> <b>S</b>KK<b>S</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          @include('layouts.side')
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="fa fa-user"></i> 
                <span class="hidden-xs">{{Auth::user()['name']}} | Logout</span>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </a>
              
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper" id="wraper">
    <div class="container">
      <!-- Content Header (Page header) -->
      @if($menu!='Home')
        <section class="content-header" id="section" style="color:#fff">
          <h1>
            {{$menu}}
            

            
            
          </h1>
          <div id="sisa_waktu" ></div>
          <ol class="breadcrumb">
            <li><a href="#" style="color:#fff"><div id="waktu_sekarang"></div></a></li>
          </ol>
          
        </section>
      @endif
      <!-- Main content -->
      @yield('content')
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer" style="display:none">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.18
      </div>
      <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->

<script src="{{url(link_html().'/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{url(link_html().'/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{url(link_html().'/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{url(link_html().'/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{url(link_html().'/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->

<script src="{{url(link_html().'/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url(link_html().'/dist/js/demo.js')}}"></script>
<script src="{{url(link_html().'/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{url(link_html().'/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{url(link_html().'/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- bootstrap time picker -->
<script src="{{url(link_html().'/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
@stack('ajax')
<script>
  $(function () {
    //Initialize Select2 Elements
    $('#select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
</body>
</html>
