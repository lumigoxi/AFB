            <div class="container">
                      <a class="navbar-brand pt-0 pb-0" 
                      @if(Auth::check())
                      href="{{ route('dashboard') }}" 
                        @else
                        href="{{ route('/') }}" 
                        @endif
                      ><img src="{{ URL::asset('img/amigo-fiel-logo.jpg') }}" alt="">AMIGO FIEL</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ml-auto text-center">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        {{-- @guest --}}
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Principal <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/historias">Historias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/adoptar">Adoptar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/actividades">Actividades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contactanos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link donar" href="#">Donar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" 
                           @if(Auth::check())
                            href="{{ route('dashboard') }}" 
                                @else
                            href="{{ route('login') }}" 
                          @endif
                            >Iniciar Sesión</a>
                        </li>
                           
                     {{--    @else --}}
                     @if(Auth::check())
                        <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Cerrar Sesión
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                     @endif
                        {{-- @endguest --}}
                    </ul>
                </div>
            </div>
            