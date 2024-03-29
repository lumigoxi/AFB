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
                        <li class="nav-item">
                            <a class="nav-link
                            {{ Request::path() ==  '/' ? 'active' : ''  }}" 
                            href="/">Principal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::path() ==  'historias' ? 'active' : ''  }}" href="/historias">Historias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::path() ==  'adoptar' ? 'active' : ''  }}" href="/adoptar">Adoptar</a>
                        </li>
                        <li class="nav-item {{ Request::path() ==  'actividades' ? 'active' : ''  }}">
                            <a class="nav-link" href="/actividades">Actividades</a>
                        </li>
                        <li class="nav-item {{ Request::path() ==  'contactanos' ? 'active' : ''  }}">
                            <a class="nav-link" href="/contactanos">Contáctanos</a>
                        </li>
                        <li class="nav-item">
                                  <form action="https://www.paypal.com/cgi-bin/webscr" method="post"  target="_blank">
<input type="hidden" name="cmd" value="_s-xclick" />
<input type="hidden" name="hosted_button_id" value="LZ8GYCCK9S9W6" />
<input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_donate_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Botón Donar con PayPal" />
<img alt="" border="0" src="https://www.paypal.com/es_ES/i/scr/pixel.gif" width="1" height="1" />
</form>
                        </li>
                        <li class="nav-item {{ Request::path() ==  'login' ? 'active' : ''  }}">
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
            