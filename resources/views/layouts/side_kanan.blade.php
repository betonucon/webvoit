      <ul class="sidebar-menu" data-widget="tree">
      @if(Auth::user()['role_id']==1)
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="{{url('evote')}}" target="_blank"><i class="fa fa-folder"></i> <span>E-vote</span></a></li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('unit')}}">&nbsp;&nbsp;<i class="fa fa-circle-o"></i> Unit Internal</a></li>
            <li><a href="{{url('pengguna')}}">&nbsp;&nbsp;<i class="fa fa-circle-o"></i> Pengguna</a></li>
          </ul>
        </li>
        <li><a href="{{url('group')}}"><i class="fa fa-folder"></i> <span>Unit SKKS</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Daftar E-vote</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('pemilihan')}}">&nbsp;&nbsp;<i class="fa fa-circle-o"></i> Terbaru</a></li>
            <li><a href="{{url('pengguna')}}">&nbsp;&nbsp;<i class="fa fa-circle-o"></i> Pengguna</a></li>
          </ul>
        </li>
      @endif

      @if(Auth::user()['role_id']==3)
        <li><a href="{{url('evote')}}" target="_blank"><i class="fa fa-folder"></i> <span>E-vote</span></a></li>
        <li><a href="{{url('pengguna_unit')}}"><i class="fa fa-folder"></i> <span>User [{{cek_name_group()}}]</span></a></li>
        <li><a href="{{url('pemilihan_unit')}}"><i class="fa fa-folder"></i> <span>Daftar E-vote</span></a></li>
      @endif  
      </ul>