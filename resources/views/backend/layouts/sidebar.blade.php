<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar  ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div ">

            {{-- <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="{{ asset('backend/images/user/avatar-2.jpg') }}" alt="User-Profile-Image">
                    <div class="user-details">
                        <span>{{Auth::user()->name}}</span>
                        <div id="more-details">UX Designer<i class="fa fa-chevron-down m-l-5"></i></div>
                    </div>
                </div>
                <div class="collapse" id="nav-user-link">
                    <ul class="list-unstyled">
                        <li class="list-group-item"><a href="#"><i class="feather icon-user m-r-5"></i>View
                                Profile</a></li>
                        <li class="list-group-item"><a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();"><i
                                    class="feather icon-log-out m-r-5"></i>Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div> --}}

            <ul class="nav pcoded-inner-navbar ">
                {{-- <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li> --}}

                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>

                <li class="nav-item pcoded-hasmenu">
                    <a href="javascript:void(0)" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-layout"></i></span><span class="pcoded-mtext">Page
                            layouts</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="#">Vertical</a></li>
                        <li><a href="#">Horizontal</a></li>
                    </ul>
                </li>

            </ul>

        </div>
    </div>
</nav>
<!-- [ navigation menu ] end -->