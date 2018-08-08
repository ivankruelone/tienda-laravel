<nav class="navbar navbar-expand-md navbar-light navbar-laravel fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Online store') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}"> <i class="fas fa-sign-in-alt"></i> {{ __('Login') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}"> <i class="fab fa-wpforms"></i> {{ __('Register') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('checkout') }}"> <i class="fas fa-shopping-cart"></i> Check out (@php echo Cart::count(); @endphp) </a> 
                </li>
                @else
                    @if( Auth::user()->role == 'admin' )
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('order.pending') }}"> <i class="fas fa-box"></i> Pending orders </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('order.sent') }}"> <i class="fas fa-box"></i> Sent orders </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/items') }}"> <i class="fas fa-tshirt"></i> Items </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('items.inactive') }}"> <i class="fas fa-tshirt"></i> Inactive Items </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('order.sales') }}"> <i class="fas fa-hand-holding-usd"></i> Sales </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fas fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/orders') }}"> <i class="fas fa-box"></i> My orders </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fas fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('checkout') }}"> <i class="fas fa-shopping-cart"></i> Check out (@php echo Cart::count(); @endphp) </a>
                    </li>
                    @endif
                @endguest
            </ul>
        </div>
    </div>
</nav>