<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->

                @auth
                    @can('viewAny', App\Models\Category::class)
                    <li class="nav-item">
                        <x-nav-link text="Create Category" :url="route('category.create')" />
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->url() ===  route('category.index')? 'active' : ''}}" href="{{ route('category.index') }}">Category</a>
                    </li>
                    @endcan
                    <li class="nav-item">
                        <a class="nav-link {{request()->url() ===  route('article.create')? 'active' : ''}}" href="{{ route('article.create') }}">Create Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->url() ===  route('article.index')? 'active' : ''}}" href="{{ route('article.index') }}">Articles</a>
                    </li>
                    @can('show-users-list')
                    <li class="nav-item">
                        <a class="nav-link {{request()->url() ===  route('users')? 'active' : ''}}" href="{{ route('users') }}">Users</a>
                    </li>
                    @endcan
                    <li class="nav-item">
                        <a class="nav-link {{request()->url() ===  route('photo.index')? 'active' : ''}}" href="{{ route('photo.index') }}">My photos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->url() ===  route('article.index',['trash'=>1])? 'active' : ''}}" href="{{ route('article.index',['trash'=>1]) }}">Bin</a>
                    </li>
                @endauth

                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link {{request()->url() ===  route('login')? 'active' : ''}}" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link {{request()->url() ===  route('register')? 'active' : ''}}" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                            <br>
                            {{ Auth::user()->role }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
