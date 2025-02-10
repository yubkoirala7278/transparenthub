@if(Auth::user())
    <div class="dropdown position-relative" style="z-index: 1050 !important;">
        <button class="btn btn-transparent p-0 rounded-0 text-white d-flex align-items-center custom-dropdown-btn"
            type="button" data-bs-toggle="dropdown" aria-expanded="false"
            style="word-break: break-all; border: none; box-shadow: none;">
            {{ strtoupper(Auth::user()->name) }}'s ACCOUNT
        </button>
        <ul class="dropdown-menu shadow-sm bg-white">
            <li><a class="dropdown-item text-dark dropdown-hover" href="#">Manage My Account</a></li>
            <li><a class="dropdown-item text-dark dropdown-hover" href="#">My Orders</a></li>
            <li><a class="dropdown-item text-dark dropdown-hover" href="#">My WishList</a></li>
            <li>
                <a class="dropdown-item text-dark dropdown-hover" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
@else
    <button type="button" class="btn btn-transparent p-0 rounded-0 text-white" data-bs-toggle="modal"
        data-bs-target="#loginModal">
        Login
    </button>
@endif
