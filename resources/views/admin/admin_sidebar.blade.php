
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- Sidebar user panel (optional) -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="{{ Auth::user()->avatar }}" class="img-circle" alt="User Image" />
                    </div>
                    <div class="pull-left info">
                        <p>{{ Auth::user()->name }}</p>
                        <!-- Status -->
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>

                <!-- search form (Optional) -->
                <form action="#" method="get" class="sidebar-form" style="display:none">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search..."/>
          <span class="input-group-btn">
            <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
          </span>
                    </div>
                </form>
                <!-- /.search form -->

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu">
                    <li class="header">NAVIGATOR</li>
                    <!-- Optionally, you can add icons to the links -->
                    <li @if($navi == 'home') class="active" @endif><a href="/"><span>Home</span></a></li>
                    <li @if($navi == 'as') class="active" @endif><a href="/user/setting"><span>Account Setting</span></a></li>
                    <li @if($navi == 'ca') class="active" @endif><a href="/user/avatar"><span>Change Avatar</span></a></li>
                    @if(Auth::user()->isAdmin == 3)
                    <li class="treeview @if($treeview == 'accounts') active @endif">
                        <a href="#"><span>Accounts</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li @if($navi == 'al') class="active" @endif><a href="{{url('account/list')}}">All users</a></li>
                            <li @if($navi == 'pl') class="active" @endif><a href="{{url('account/list/unapproved')}}">Pending users</a></li>
                        </ul>
                    </li>
                    @endif
                    <li class="treeview @if($treeview == 'cma') active @endif">
                        <a href="#"><span>Mail Account</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li @if($navi == 'cne') class="active" @endif><a href="{{url('email/create')}}">Email Creator</a></li>
                            <li @if($navi == 'reb') class="active" @endif><a href="{{ url('/email/bugs') }}">Report Email Bugs</a></li>
                        </ul>
                    </li>
                    <li class="treeview @if($treeview == 'checker') active @endif">
                        <a href="#"><span>Checkers</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li @if($navi == 'stripe') class="active" @endif><a href="{{ url('/checker/stripe') }}">Credit Card</a></li>
                            <li @if($navi == 'stripe2') class="active" @endif><a href="{{ url('/checker/stripe/proxified') }}">Credit Card(With Socks5/Proxy)</a></li>
                            <li @if($navi == 'BIN') class="active" @endif><a href="{{ url('/checker/bin') }}">BIN Checker</a></li>
                            <li @if($navi == 'proxychecker') class="active" @endif><a href="{{ url('/checker/proxy') }}">Proxy Checker</a></li>
                        </ul>
                    </li>
                    <li><a href="https://team-ator.net/" target="_blank"><span>Bin Generator</span></a></li>
                </ul><!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>