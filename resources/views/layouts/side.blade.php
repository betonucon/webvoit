          <ul class="nav navbar-nav">
            @if(Auth::user()['role_id']==1)
            <li><a href="{{url('unit')}}">Unit SKKS </a></li>
            <li><a href="{{url('pengguna')}}">Pengguna</a></li>
            <li><a href="{{url('group')}}">Group</a></li>
            <li><a href="{{url('pemilihan')}}">Pemilihan</a></li>
            @endif
          </ul>
          <!-- <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
            </div>
          </form> -->