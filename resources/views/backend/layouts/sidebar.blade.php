<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar  ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div ">

            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="{{ asset('backend/images/admin.png') }}" alt="User-Profile-Image">
                    <div class="user-details">
                        <span>{{Auth::user()->name}}</span>
                        <div id="more-details">Transparent Hub<i class="fa fa-chevron-down m-l-5"></i></div>
                    </div>
                </div>
                <div class="collapse" id="nav-user-link">
                    <ul class="list-unstyled">
                        <li class="list-group-item"><a href="#"><i class="fa-solid fa-user m-r-5"></i>View
                                Profile</a></li>
                        <li class="list-group-item"><a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();"><i class="fa-solid fa-arrow-right-from-bracket m-r-5"></i>Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link "><span class="pcoded-micon"><i class="fa-solid fa-house"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>

                <li class="nav-item pcoded-hasmenu">
                    <a href="javascript:void(0)" class="nav-link "><span class="pcoded-micon"><i class="fa-solid fa-newspaper"></i></span><span class="pcoded-mtext">News</span></a>
                    <ul class="pcoded-submenu" style="padding: 0px">
                        <li><a href="{{route('news.index')}}">News</a></li>
                        <li><a href="{{route('news_category.index')}}">Category</a></li>
                        <li><a href="{{route('news_source.index')}}">Source</a></li>
                    </ul>
                </li>

                <li class="nav-item pcoded-hasmenu">
                    <a href="javascript:void(0)" class="nav-link "><span class="pcoded-micon"><i class="fa-solid fa-newspaper"></i></span><span class="pcoded-mtext">E-commerce</span></a>
                    <ul class="pcoded-submenu" style="padding: 0px">
                        <li><a href="">Category</a></li>
                        <li><a href="">Sub Category</a></li>
                        <li><a href="">Brands</a></li>
                        <li><a href="">Products</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('blogs.index') }}" class="nav-link "><span class="pcoded-micon"><i class="fa-solid fa-blog"></i></span><span class="pcoded-mtext">Blogs</span></a>
                </li>

                

            </ul>

        </div>
    </div>
</nav>
<!-- [ navigation menu ] end -->
